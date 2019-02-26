<?php

/**
 * Description
 * @fecha 
 * @author 
 */
class CargaRutasMbController extends Controller {

    public $layout = LAYOUT_IMPORTAR;

    public function actionIndex() {
        if (Yii::app()->request->isAjaxRequest) {
            return;
        } else {
            unset(Yii::app()->session['rutasMbItems']);
            unset(Yii::app()->session['cargaAnterior']);

            $model = new CargaRutasMbForm();
            $this->render('/carga/cargaRutasMb', array('model' => $model));
        }
    }

    public function actionSubirArchivo() {

        unset(Yii::app()->session['cargaAnterior']);
        Yii::app()->session['itemsFueraPeriodo'] = 0;
        $response = new Response();
        try {
            $model = new CargaRutasMbForm();
            $rutasMbItems = array();
            if (isset($_POST['CargaRutasMbForm'])) {
                $model->attributes = $_POST['CargaRutasMbForm'];
                if ($model->validate()) {

//                    unset($_SESSION['rutasMbItems']);
                    unset(Yii::app()->session['rutasMbItems']);
                    $filePath = Yii::app()->params['archivosRutasMb'];
                    $model->rutaArchivo = CUploadedFile::getInstance($model, 'rutaArchivo');
                    $model->rutaArchivo->saveAs($filePath);
//                    $_SESSION['archivosRutasMb'] = $filePath;
//                    $_SESSION['ModelForm'] = $model;
                    Yii::app()->session['archivosRutasMb'] = $filePath;
                    Yii::app()->session['ModelForm'] = $model;

                    $operation = "r";
//                    $delimiter = ';';
                    $delimiter = $model->delimitadorColumnas;
                    $file = new File($filePath, $operation, $delimiter);
                    $totalRows = $file->getTotalFilas();

                    if ($totalRows > 0) {
                        $totalBloques = ceil($totalRows / TAMANIO_BLOQUE);
                        $numeroBloque = 1;
                        $tamanioBloque = TAMANIO_BLOQUE;

                        while ($numeroBloque <= intval($totalBloques)) {
                            $file = new File($filePath, $operation, $delimiter);
                            $registroInicio = (($numeroBloque - 1) * $tamanioBloque) + 1;
                            $dataInsert = $this->getDatosMostrar($file, $registroInicio, $tamanioBloque);
                            if (count($dataInsert) > 0) {
                                $rutasMbItems = array_merge($rutasMbItems, $dataInsert);
                                unset($dataInsert);
                            }
                            $numeroBloque ++;
                        }
//                        $_SESSION['rutasMbItems'] = $rutasMbItems;
                        Yii::app()->session['rutasMbItems'] = $rutasMbItems;
                        if (Yii::app()->session['itemsFueraPeriodo'] > 0) {
                            Yii::app()->user->setFlash('resultadoHistorial', Yii::app()->session['itemsFueraPeriodo'] . ' registros se omitieron por estar fuera del periodo');
                        }
                    } else {
                        $response->Message = 'El archivo no contiene registros';
                        $response->Status = NOTICE;
                    }
                } else {
//                    echo CActiveForm::validate($model);
//                    Yii::app()->end();
                }
            }
        } catch (Exception $e) {
            $response->Message = Yii::app()->params['mensajeExcepcion'];
            $response->Status = ERROR;
            $response->ClassMessage = CLASS_MENSAJE_ERROR;
        }
        $this->render('/carga/cargaRutasMb', array('model' => $model));
        return;
    }

    private function getDatosMostrar($file, $start, $blockSize) {
        $dataInsert = array();
        $dataFile = $file->getDatosRutasMb($start, $blockSize);
        foreach ($dataFile as $row) {
            $data = array(
                'CODIGO' => ($row['CODIGO'] == '') ? null : $row['CODIGO'],
                'RUTA' => ($row['RUTA'] == '') ? null : $row['RUTA'],
                'CLIENTE' => ($row['CLIENTE'] == '') ? null : $row['CLIENTE'],
                'NOMBRE' => ($row['NOMBRE'] == '') ? null : $row['NOMBRE'],
                'TIPODENEGOCIO' => ($row['TIPODENEGOCIO'] == '') ? null : $row['TIPODENEGOCIO'],
                'DIRECCION' => ($row['DIRECCION'] == '') ? null : $row['DIRECCION'],
                'DIRECCIONDESCRIPCION' => ($row['DIRECCIONDESCRIPCION'] == '') ? null : $row['DIRECCIONDESCRIPCION'],
                'REFERENCIA' => ($row['REFERENCIA'] == '') ? null : $row['REFERENCIA'],
                'SEMANA' => ($row['SEMANA'] == '') ? null : $row['SEMANA'],
                'DIA' => ($row['DIA'] == '') ? null : $row['DIA'],
                'SECUENCIA' => ($row['SECUENCIA'] == '') ? null : $row['SECUENCIA'],
                'ESTATUS' => ($row['ESTATUS'] == '') ? null : $row['ESTATUS'],
            );
            array_push($dataInsert, $data);
            unset($data);
        }
        return $dataInsert;
    }

    public function actionGuardarRutas() {
        $response = new Response();
        $rutasRepetidos = '';
        try {
            Yii::app()->session['itemRutaDuplicado'] = 0;
            Yii::app()->session['itemRutaActualizado'] = 0;

            if (isset($_SESSION['archivosRutasMb'])) {
                $filePath = Yii::app()->session['archivosRutasMb'];

                $fRutasMobilvendor = new FRutaModel();
                Yii::app()->session['cargaAnterior'] = intval($fRutasMobilvendor->getCargaAnterior()[0]['ultimacarga']);

                $operation = "r";
                $delimiter = Yii::app()->session['ModelForm']["delimitadorColumnas"]; //';';
                $file = new File($filePath, $operation, $delimiter);
                $totalRows = $file->getTotalFilas();

                $totalRutasGuardados = 0;
                $totalRutasNoGuardados = 0;

                if ($totalRows > 0) {
                    $totalBloques = ceil($totalRows / TAMANIO_BLOQUE);
                    $numeroBloque = 1;
                    $tamanioBloque = TAMANIO_BLOQUE;

                    while ($numeroBloque <= intval($totalBloques)) {
                        $file = new File($filePath, $operation, $delimiter);
                        $registroInicio = (($numeroBloque - 1) * $tamanioBloque) + 1;
                        $dataInsertar = $this->getDatosGuardar($file, $registroInicio, $tamanioBloque);
                        $datosRutasMb = $dataInsertar['rutasmb'];

                        if (count($datosRutasMb) > 0) {
                            $dbConnection = new CI_DB_active_record(null);
                            $sql = $dbConnection->insert_batch('tb_ruta_mb', $datosRutasMb);
                            $sql = str_replace('"', '', $sql);
                            $connection = Yii::app()->db_conn;
                            $connection->active = true;
                            $transaction = $connection->beginTransaction();
                            $command = $connection->createCommand($sql);
                            $countInsert = $command->execute();
                            if ($countInsert > 0) {
                                $transaction->commit();
                                $totalRutasGuardados = $totalRutasGuardados + $countInsert;
                            } else {
                                $transaction->rollback();
                                $totalRutasNoGuardados = $totalRutasNoGuardados + $countInsert;
                            }
                            unset($datosRutasMb);
                            $connection->active = false;
                        }
                        $numeroBloque ++;
                    }

                    if ($totalRutasNoGuardados > 0) {
                        $response->Message = 'Se produjo un error en la carga del archivo';
                        $response->ClassMessage = CLASS_MENSAJE_ERROR;
                    } else {

                        $mensaje = 'Se han cargado ' . $totalRutasGuardados . ' registros correctamente.';

                        if (Yii::app()->session['itemRutaActualizado'] > 0)
                            $mensaje .= '<br> Se han actualizado ' . Yii::app()->session['itemRutaActualizado'] . ' registros.';
                        if (Yii::app()->session['itemRutaDuplicado'] > 0)
                            $mensaje .= '<br> Se han omitido ' . Yii::app()->session['itemRutaDuplicado'] . ' registros duplicados en el archivo.';

                        unset(Yii::app()->session['archivosHistorialMb']);
                        unset(Yii::app()->session['ModelForm']);
                        unset(Yii::app()->session['rutasMbItems']);
                        unset(Yii::app()->session['itemsFueraPeriodo']);

                        $mensaje .= $response->Message = $mensaje;
                    }

                    unlink($filePath);
                } else {
                    $response->Message = 'El archivo no contiene registros';
                    $response->Status = NOTICE;
                }
            } else {
                $response->Message = 'Cargue el archivo nuevamente';
                $response->Status = NOTICE;
            }
        } catch (Exception $e) {
            $response->Message = 'Se ha producido un error al guardar los datos';
            $response->Status = ERROR;
            $response->ClassMessage = CLASS_MENSAJE_ERROR;
        }

        $this->actionResponse(null, null, $response);
        return;
    }

    private function GenerarHistorial($rutaEnBase, $tipoControlCambio, $row) {
        $cambio = '';
        switch ($tipoControlCambio) {
            case 1:
                $cambio .= ($rutaEnBase["r_ruta"] != $row['RUTA']) ? 'ruta_' : '';
                $cambio .= ($rutaEnBase["r_cod_direccion"] != $row['DIRECCION'] ) ? 'direccion_' : '';
                $cambio .= ($rutaEnBase["r_semana"] != $row['SEMANA']) ? 'semana_' : '';
                $cambio .= ($rutaEnBase["r_dia"] != $row['DIA']) ? 'dia_' : '';
                $cambio .= ($rutaEnBase["r_secuencia"] != $row['SECUENCIA'] ) ? 'secuencia_' : '';
                $cambio .= ($rutaEnBase["r_estatus"] != $row['ESTATUS']) ? 'estado_' : '';
                $historialClienteRuta = new HistorialClienteRutaModel();
                $historialClienteRuta->hcr_codigo_cliente = $rutaEnBase["r_cod_cliente"];
                $historialClienteRuta->hcr_ruta_anterior = $rutaEnBase["r_ruta"];
                $historialClienteRuta->hcr_ruta_nueva = $row['RUTA'];

                $historialClienteRuta->hcr_direccion_anterior = $rutaEnBase["r_cod_direccion"];
                $historialClienteRuta->hcr_direccion_nueva = $row['DIRECCION'];

                $historialClienteRuta->hcr_semana_anterior = $rutaEnBase["r_semana"];
                $historialClienteRuta->hcr_semana_nueva = $row['SEMANA'];

                $historialClienteRuta->hcr_dia_anterior = $rutaEnBase["r_dia"];
                $historialClienteRuta->hcr_dia_nuevo = $row['DIA'];

                $historialClienteRuta->hcr_secuencia_anterior = $rutaEnBase["r_secuencia"];
                $historialClienteRuta->hcr_secuencia_nueva = $row['SECUENCIA'];

                $historialClienteRuta->hcr_estado_anterior = $rutaEnBase["r_estatus"];
                $historialClienteRuta->hcr_estado_nuevo = $row['ESTATUS'];

                $historialClienteRuta->hcr_fch_actualiza_ruta = date(FORMATO_FECHA_LONG);
                $historialClienteRuta->hcr_cambios = $cambio;
                $historialClienteRuta->hcr_fch_ingreso = date(FORMATO_FECHA_LONG);
                $historialClienteRuta->hcr_fch_modificacion = date(FORMATO_FECHA_LONG);
                $historialClienteRuta->hcr_cod_usuario_ing_mod = Yii::app()->user->id;


                break;
            case 2:
                $cambio = 'eliminado_de_ruta';
                $historialClienteRuta = new HistorialClienteRutaModel();
                $historialClienteRuta->hcr_codigo_cliente = $rutaEnBase["r_cod_cliente"];
                $historialClienteRuta->hcr_ruta_anterior = $rutaEnBase["r_ruta"];
                $historialClienteRuta->hcr_ruta_nueva = 'ELIMI_RUTA';

                $historialClienteRuta->hcr_direccion_anterior = $rutaEnBase["r_cod_direccion"];
                $historialClienteRuta->hcr_direccion_nueva = $rutaEnBase["r_cod_direccion"];

                $historialClienteRuta->hcr_semana_anterior = $rutaEnBase["r_semana"];
                $historialClienteRuta->hcr_semana_nueva = 0;

                $historialClienteRuta->hcr_dia_anterior = $rutaEnBase["r_dia"];
                $historialClienteRuta->hcr_dia_nuevo = 0;

                $historialClienteRuta->hcr_secuencia_anterior = $rutaEnBase["r_secuencia"];
                $historialClienteRuta->hcr_secuencia_nueva = 0;

                $historialClienteRuta->hcr_estado_anterior = $rutaEnBase["r_estatus"];
                $historialClienteRuta->hcr_estado_nuevo = 0;

                $historialClienteRuta->hcr_fch_actualiza_ruta = date(FORMATO_FECHA_LONG);
                $historialClienteRuta->hcr_cambios = $cambio;
                $historialClienteRuta->hcr_fch_ingreso = date(FORMATO_FECHA_LONG);
                $historialClienteRuta->hcr_fch_modificacion = date(FORMATO_FECHA_LONG);
                $historialClienteRuta->hcr_cod_usuario_ing_mod = Yii::app()->user->id;

                break;
        }

        $historialClienteRuta->save();
        return;
    }

    private function getDatosGuardar($file, $start, $blockSize) {
        $datos = array();
        $datosRutas = array();
        $rutasRepetidos = array();
        $existeBdd = false;
        $itemRutaRepetidos = array();
        $itemRutaActualizados = array();



//        var_dump($cargaAnterior);die();
        $cargaNueva = Yii::app()->session['cargaAnterior'] + 1;

        $dataFile = $file->getDatosRutasMb($start, $blockSize);
        foreach ($dataFile as $row) {
            $rutaEnBase = RutaMbModel::model()->findByAttributes(
                    array('r_cod_cliente' => $row['CLIENTE']
                        , 'pg_id' => Yii::app()->session['idPeriodoAbierto']
                        , 'r_semana' => $row['SEMANA']
                    )
            );

            if ($rutaEnBase && (
                    $rutaEnBase["r_ruta"] != $row['RUTA'] ||
                    $rutaEnBase["r_cod_direccion"] != $row['DIRECCION'] ||
//                    $rutaEnBase["r_semana"] != $row['SEMANA'] ||
                    $rutaEnBase["r_dia"] != $row['DIA'] ||
                    $rutaEnBase["r_secuencia"] != $row['SECUENCIA'] ||
                    $rutaEnBase["r_estatus"] != $row['ESTATUS'])) {

                $this->GenerarHistorial($rutaEnBase, 1, $row);
//                $rutaEnBase->delete();
            }

            $exisArray = false;
//            foreach ($datosRutas as $item) {
//                $exisArray = in_array($row['CLIENTE'], $item);
//                if ($exisArray)
//                    break;
//            }
//            if (!$exisArray) {
            $data = array(
                'r_ruta' => ($row['RUTA'] == '') ? null : $row['RUTA'],
                'pg_id' => Yii::app()->session['idPeriodoAbierto'],
                'r_cod_cliente' => ($row['CLIENTE'] == '') ? null : $row['CLIENTE'],
                'r_nom_cliente' => ($row['NOMBRE'] == '') ? null : $row['NOMBRE'],
                'r_cod_direccion' => ($row['DIRECCION'] == '') ? null : $row['DIRECCION'],
                'r_direccion' => ($row['DIRECCIONDESCRIPCION'] == '') ? null : $row['DIRECCIONDESCRIPCION'],
                'r_referencia' => ($row['REFERENCIA'] == '') ? null : $row['REFERENCIA'],
                'r_semana' => ($row['SEMANA'] == '') ? null : $row['SEMANA'],
                'r_dia' => ($row['DIA'] == '') ? null : $row['DIA'],
                'r_secuencia' => ($row['SECUENCIA'] == '') ? null : $row['SECUENCIA'],
                'r_estatus' => ($row['ESTATUS'] == '') ? null : $row['ESTATUS'],
                'r_numero_carga_informacion' => $cargaNueva,
                'r_fch_ingreso' => date(FORMATO_FECHA_LONG),
                'r_fch_modificacion' => date(FORMATO_FECHA_LONG),
                'r_fch_desde' => date(FORMATO_FECHA_LONG),
                'r_fch_hasta' => date(FORMATO_FECHA_LONG),
                'r_usuario_ing_mod ' => Yii::app()->user->id
            );

            array_push($datosRutas, $data);
            unset($data);
//            } else {
//                Yii::app()->session['itemRutaDuplicado'] = Yii::app()->session['itemRutaDuplicado'] + 1;
//            }
        }

//        //eliminacion de los clientes de la carga anterior
//        $datos['rutasmb'] = $datosRutas;
//        $rutasEliminar = RutaMbModel::model()->findAllByAttributes(
//                array(
//                    'r_numero_carga_informacion' => Yii::app()->session['cargaAnterior']
//                    , 'pg_id' => Yii::app()->session['idPeriodoAbierto']
//                )
//        );
////        var_dump($rutasEliminar,Yii::app()->session['idPeriodoAbierto']);die();
//
//
//        foreach ($rutasEliminar as $rutaEliminar) {
//            $dummy = array();
//            $this->GenerarHistorial($rutaEliminar, 2, $dummy);
//            $rutaEliminar->delete();
//        }
////        var_dump($datos['rutasmb']);die();
        return $datos;
    }

    public function actionVerDatosArchivo() {
        if (!Yii::app()->request->isAjaxRequest) {
            $error['message'] = Yii::app()->params['msjErrorAccesoPag'];
            $error['code'] = Yii::app()->params['codErrorAccesoPag'];
            $this->render(Yii::app()->params['pagError'], $error);
        }

        $response = new Response();
        try {
//            $response->Result = $_SESSION['rutasMbItems'];
//            unset($_SESSION['rutasMbItems']);
            $response->Result = Yii::app()->session['rutasMbItems'];
            unset(Yii::app()->session['rutasMbItems']);
        } catch (Exception $e) {
            $mensaje = array(
                'code' => $e->getCode(),
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            );

            $response->Message = Yii::app()->params['mensajeExcepcion'];
            $response->Status = ERROR;
        }
        $this->actionResponse(null, null, $response);
        return;
    }

    private function actionResponse($view = 'error', $model = null, $response = null) {
        if (Yii::app()->request->isAjaxRequest) {
            echo json_encode($response);
        } else {
            $this->render($view, $model);
        }
    }

//    public function filters() {
//// return the filter configuration for this controller, e.g.:
//        return array('accessControl', array('CrugeAccessControlFilter'));
//    }
//
//    public function accessRules() {
//        return array(
//            array('allow', // allow authenticated users to access all actions
//                'users' => array('@'),
//            ),
//            array('deny', // deny all users
//                'users' => array('*'),
//            ),
//        );
//    }
}
