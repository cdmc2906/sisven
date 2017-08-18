<?php

/**
 * Description
 * @fecha 
 * @author 
 */
class RevisaMinesDesconocidosController extends Controller {

    public function actionIndex() {
        if (Yii::app()->request->isAjaxRequest) {
            return;
        } else {
//            unset($_SESSION['rutasMbItems']);
            unset(Yii::app()->session['minesDesconocidosItems']);
            $model = new CargaMinesDesconocidosForm();
            $this->render('/producto/cargaMinesDesconocidos', array('model' => $model));
        }
    }

    public function actionSubirArchivo() {

        $response = new Response();
        try {
            $model = new CargaMinesDesconocidosForm();
            $minesDesconocidosItems = array();
            if (isset($_POST['CargaMinesDesconocidosForm'])) {
                $model->attributes = $_POST['CargaMinesDesconocidosForm'];
                if ($model->validate()) {

                    unset(Yii::app()->session['minesDesconocidosItems']);
                    $filePath = Yii::app()->params['archivosRutasMb'];
                    $model->rutaArchivo = CUploadedFile::getInstance($model, 'rutaArchivo');
                    $model->rutaArchivo->saveAs($filePath);

                    Yii::app()->session['archivoMinesDesconocidos'] = $filePath;
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
                                $minesDesconocidosItems = array_merge($minesDesconocidosItems, $dataInsert);
                                unset($dataInsert);
                            }
                            $numeroBloque ++;
                        }
//                        $_SESSION['rutasMbItems'] = $rutasMbItems;
                        Yii::app()->session['minesDesconocidosItems'] = $minesDesconocidosItems;
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
        $this->render('/producto/cargaMinesDesconocidos', array('model' => $model));
        return;
    }

    private function getDatosMostrar($file, $start, $blockSize) {
        $dataInsert = array();
        $dataFile = $file->getDatosMinesDesconocidos($start, $blockSize);
        foreach ($dataFile as $row) {
            $cminTransferido = new FTransferenciasMovistarModel();
            $minTransferido = $cminTransferido->getDatosMinxICC(trim($row['ICC'], '\''));
//            var_dump($minTransferido[0]['tm_nombredestino']);die();
            if (count($minTransferido) > 0) {

                $data = array(
                    'NRO' => ($row['NRO'] == '') ? null : $row['NRO'],
                    'ICC' => ($row['ICC'] == '') ? null : $row['ICC'],
                    'MIN' => ($row['MIN'] == '') ? null : $row['MIN'],
                    'FECHAALTA' => ($row['FECHAALTA'] == '') ? null : $row['FECHAALTA'],
                    'CODIGOVENDEDOR' => $minTransferido[0]['tm_nombredestino'],
                    'FECHATRANSFERENCIA' => $minTransferido[0]['tm_fecha'],
//                    'CIUDAD' => ($row['CIUDAD'] == '') ? null : $row['CIUDAD'],
                );
            } else {
                $data = array(
                    'NRO' => ($row['NRO'] == '') ? null : $row['NRO'],
                    'ICC' => ($row['ICC'] == '') ? null : $row['ICC'],
                    'MIN' => ($row['MIN'] == '') ? null : $row['MIN'],
                    'FECHAALTA' => ($row['FECHAALTA'] == '') ? null : $row['FECHAALTA'],
                    'CODIGOVENDEDOR' => 'NO ENCONTRADO',
//                    'CIUDAD' => ($row['CIUDAD'] == '') ? null : $row['CIUDAD'],
                    'FECHATRANSFERENCIA' => 'NO ENCONTRADO'
                );
            }
            array_push($dataInsert, $data);

            unset($data);
        }
//        var_dump($dataInsert);die();
        return $dataInsert;
    }

    public function actionGuardarRutas() {
        $response = new Response();
        $rutasRepetidos = '';
        try {
//            $_SESSION['itemRutaDuplicado'] = 0;
//            $_SESSION['itemRutaActualizado'] = 0;
            Yii::app()->session['itemRutaDuplicado'] = 0;
            Yii::app()->session['itemRutaActualizado'] = 0;

            if (isset($_SESSION['archivosRutasMb'])) {
//                $filePath = $_SESSION['archivosRutasMb'];
                $filePath = Yii::app()->session['archivosRutasMb'];

                $operation = "r";
//                $delimiter = ';';
//                $delimiter = $_SESSION['ModelForm']["delimitadorColumnas"]; //';';
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

//                        if ($_SESSION['itemRutaActualizado'] > 0)
//                            $mensaje .= '<br> Se han actualizado ' . $_SESSION['itemRutaActualizado'] . ' registros.';
//                        if ($_SESSION['itemRutaDuplicado'] > 0)
//                            $mensaje .= '<br> Se han omitido ' . $_SESSION['itemRutaDuplicado'] . ' registros duplicados en el archivo.';

                        if (Yii::app()->session['itemRutaActualizado'] > 0)
                            $mensaje .= '<br> Se han actualizado ' . Yii::app()->session['itemRutaActualizado'] . ' registros.';
                        if (Yii::app()->session['itemRutaDuplicado'] > 0)
                            $mensaje .= '<br> Se han omitido ' . Yii::app()->session['itemRutaDuplicado'] . ' registros duplicados en el archivo.';
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

    private function getDatosGuardar($file, $start, $blockSize) {
        $datos = array();
        $datosRutas = array();
        $rutasRepetidos = array();
        $existeBdd = false;
        $itemRutaRepetidos = array();
        $itemRutaActualizados = array();

        $dataFile = $file->getDatosRutasMb($start, $blockSize);
        foreach ($dataFile as $row) {
            $existeBdd = RutaMbModel::model()->findByAttributes(array('r_cod_cliente' => $row['CLIENTE']));
            if ($existeBdd) {
                $existeBdd->delete();
//                $_SESSION['itemRutaActualizado'] += 1;
                Yii::app()->session['itemRutaActualizado'] += 1;
                $clienteEnRuta = array(
                    'CLIENTE' => $row['CLIENTE'],
                    'RUTAANTERIOR' => $existeBdd["r_ruta"],
                    'RUTANUEVA' => $row['RUTA']
                );
                array_push($itemRutaActualizados, $clienteEnRuta);
            }
            $exisArray = false;
            foreach ($datosRutas as $item) {
                $exisArray = in_array($row['CLIENTE'], $item);
                if ($exisArray)
                    break;
            }
            if (!$exisArray) {
                $data = array(
                    //''r_cod' => ($row[''] == '') ? null : $row[''],
                    'r_ruta' => ($row['RUTA'] == '') ? null : $row['RUTA'],
                    'r_cod_cliente' => ($row['CLIENTE'] == '') ? null : $row['CLIENTE'],
                    'r_nom_cliente' => ($row['NOMBRE'] == '') ? null : $row['NOMBRE'],
                    'r_cod_direccion' => ($row['DIRECCION'] == '') ? null : $row['DIRECCION'],
                    'r_direccion' => ($row['DIRECCIONDESCRIPCION'] == '') ? null : $row['DIRECCIONDESCRIPCION'],
                    'r_referencia' => ($row['REFERENCIA'] == '') ? null : $row['REFERENCIA'],
                    'r_semana' => ($row['SEMANA'] == '') ? null : $row['SEMANA'],
                    'r_dia' => ($row['DIA'] == '') ? null : $row['DIA'],
                    'r_secuencia' => ($row['SECUENCIA'] == '') ? null : $row['SECUENCIA'],
                    'r_estatus' => ($row['ESTATUS'] == '') ? null : $row['ESTATUS'],
                    'r_fch_ingreso' => date(FORMATO_FECHA_LONG),
                    'r_fch_modificacion' => date(FORMATO_FECHA_LONG),
                    'r_fch_desde' => date(FORMATO_FECHA_LONG),
                    'r_fch_hasta' => date(FORMATO_FECHA_LONG),
                    'r_usuario_ing_mod ' => Yii::app()->user->id
                );

                array_push($datosRutas, $data);
                unset($data);
            } else {
//                $_SESSION['itemRutaDuplicado'] = $_SESSION['itemRutaDuplicado'] + 1;
                Yii::app()->session['itemRutaDuplicado'] = Yii::app()->session['itemRutaDuplicado'] + 1;
            }
        }
        $datos['rutasmb'] = $datosRutas;
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
            $response->Result = Yii::app()->session['minesDesconocidosItems'];
//            unset(Yii::app()->session['minesDesconocidosItems']);
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

    public function actionGenerateExcel() {
        $response = new Response();
        try {
            $revisionMinesDesconocidos = array();
//        var_dump(Yii::app()->session['detallerevisionhistorialitem']);            die();
//            $datos = $_SESSION['detallerevisionhistorialitem']; // $_SESSION['historialitem'];
            $datos =Yii::app()->session['minesDesconocidosItems'];
//            var_dump($datos);die();
            foreach ($datos as $value) {
                $dat = array(
//                    'FECHAREVISION' => $value['FECHAREVISION'],
                    'NRO' => $value['NRO'],
                    'ICC' => '\''.$value['ICC'],
                    'MIN' => '\''.$value['MIN'],
                    'FECHAALTA' => $value['FECHAALTA'],
                    'CODIGOVENDEDOR' => $value['CODIGOVENDEDOR'],
                    'FECHATRANSFERENCIA' => $value['FECHATRANSFERENCIA']
                );
                array_push($revisionMinesDesconocidos, $dat);
            }

            $NombreArchivo = "reporte_revision_mines_desconocidos";
            $NombreHoja = "reporte";

            $autor = "Tececab"; //$_SESSION['CUENTA'];
            $titulo = "reporte_revision_mines_desconocidos";
            $tema = "reporte_revision_mines_desconocidos";
            $keywords = "office 2007";

            $excel = new excel();

            $excel->getObjPHPExcel()->getProperties()
                    ->setCreator($autor)
                    ->setLastModifiedBy($autor)
                    ->setTitle($titulo)
                    ->setSubject($tema)
                    ->setDescription($tema)
                    ->setKeywords($keywords)
                    ->setCategory($tema);

            $excel->SetHojaDefault(0);
            $excel->SetNombreHojaActiva($NombreHoja);

            $excel->Mapeo($revisionMinesDesconocidos);

            $excel->CrearArchivo('Excel2007', $NombreArchivo);
            $excel->GuardarArchivo();
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
        return;
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
