<?php

/**
 * Description
 * @fecha 
 * @author 
 */
class CargaOrdenesMbController extends Controller {

    public $layout = LAYOUT_IMPORTAR;

    public function actionIndex() {
        if (Yii::app()->request->isAjaxRequest) {
            return;
        } else {
            unset(Yii::app()->session['ordenesMbItems']);
            $model = new CargaOrdenesMbForm();
            $this->render('/carga/cargaOrdenesMb', array('model' => $model));
        }
    }

    public function actionSubirArchivo() {

        Yii::app()->session['itemsFueraPeriodo'] = 0;
        $response = new Response();
        try {
            Yii::app()->session['cantidadOrdenesDuplicados'] = 0;
            Yii::app()->session['cantidadOrdenesActualizadas'] = 0;

            $model = new CargaOrdenesMbForm();
            $ordenesMbItems = array();
            if (isset($_POST['CargaOrdenesMbForm'])) {
                $model->attributes = $_POST['CargaOrdenesMbForm'];

                if ($model->validate()) {
                    unset(Yii::app()->session['ordenesMbItems']);

                    $filePath = Yii::app()->params['archivosOrdenesMb'];
                    $model->rutaArchivo = CUploadedFile::getInstance($model, 'rutaArchivo');
                    $model->rutaArchivo->saveAs($filePath);
                    Yii::app()->session['archivosOrdenesMb'] = $filePath;
                    Yii::app()->session['ModelForm'] = $model;

                    $operation = "r";
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
                                $ordenesMbItems = array_merge($ordenesMbItems, $dataInsert);
                                unset($dataInsert);
                            }
                            $numeroBloque ++;
                        }
                        Yii::app()->session['ordenesMbItems'] = $ordenesMbItems;
                        if (Yii::app()->session['itemsFueraPeriodo'] > 0) {
                            Yii::app()->user->setFlash('resultadoOrdenes', Yii::app()->session['itemsFueraPeriodo'] . ' registros se omitieron por estar fuera del periodo');
                        }
                    } else {
                        Yii::app()->user->setFlash('resultadoOrdenes', 'El archivo no contiene registros');
//                        $response->Message = 'El archivo no contiene registros';
//                        $response->Status = NOTICE;
                    }
                } else {
                    //echo CActiveForm::validate($model);
                    //Yii::app()->end();
                }
            }
        } catch (Exception $e) {
            $response->Message = Yii::app()->params['mensajeExcepcion'];
            $response->Status = ERROR;
            $response->ClassMessage = CLASS_MENSAJE_ERROR;
        }
        $this->render('/carga/cargaOrdenesMb', array('model' => $model));
        return;
    }

    private function getDatosMostrar($file, $start, $blockSize) {
        $dataInsert = array();
        $dataFile = $file->getDatosOrdenesMb($start, $blockSize);
        foreach ($dataFile as $row) {
//            var_dump($row['FECHACREACION']);die();
            $dateString = '';
            if (strlen($row['FECHACREACION']) == 16) {
                $date = DateTime::createFromFormat('d/m/Y H:i', $row['FECHACREACION']);
                $dateString = $date->format(FORMATO_FECHA_LONG_3);
            } else if (strlen($row['FECHACREACION']) == 19) {
                $date = DateTime::createFromFormat('d/m/Y H:i:s', $row['FECHACREACION']);
                $dateString = $date->format(FORMATO_FECHA_LONG_4);
            }
            if ($dateString != '') {
                if ($dateString >= Yii::app()->session['fechaInicioPeriodo'] && $dateString <= Yii::app()->session['fechaFinPeriodo']) {
                    $data = array(
                        'ID' => ($row['ID'] == '') ? null : $row['ID'],
                        'CONCEPTO' => ($row['CONCEPTO'] == '') ? null : $row['CONCEPTO'],
                        'CODIGO' => ($row['CODIGO'] == '') ? null : $row['CODIGO'],
                        'COMENTARIO' => ($row['COMENTARIO'] == '') ? null : $row['COMENTARIO'],
//                'FECHAVENTA' => ($row['FECHAVENTA'] == '') ? null : $row['FECHAVENTA'],
                        'FECHACREACION' => ($row['FECHACREACION'] == '') ? null : $row['FECHACREACION'],
                        'FECHADESPACHO' => ($row['FECHADESPACHO'] == '') ? null : $row['FECHADESPACHO'],
                        'TIPO' => ($row['TIPO'] == '') ? null : $row['TIPO'],
                        'ESTATUS' => ($row['ESTATUS'] == '') ? null : $row['ESTATUS'],
                        'CLIENTE' => ($row['CLIENTE'] == '') ? null : $row['CLIENTE'],
                        'CLIENTENOMBRE' => ($row['CLIENTENOMBRE'] == '') ? null : $row['CLIENTENOMBRE'],
                        'CLIENTEIDENTIFICACION' => ($row['CLIENTEIDENTIFICACION'] == '') ? null : $row['CLIENTEIDENTIFICACION'],
                        'DIRECCION' => ($row['DIRECCION'] == '') ? null : $row['DIRECCION'],
                        'LISTAPRECIOS' => ($row['LISTAPRECIOS'] == '') ? null : $row['LISTAPRECIOS'],
                        'LISTAPRECIOSNOMBRE' => ($row['LISTAPRECIOSNOMBRE'] == '') ? null : $row['LISTAPRECIOSNOMBRE'],
                        'BODEGAORIGEN' => ($row['BODEGAORIGEN'] == '') ? null : $row['BODEGAORIGEN'],
                        'BODEGAORIGENNOMBRE' => ($row['BODEGAORIGENNOMBRE'] == '') ? null : $row['BODEGAORIGENNOMBRE'],
                        'TERMINOPAGO' => ($row['TERMINOPAGO'] == '') ? null : $row['TERMINOPAGO'],
                        'TERMINOPAGONOMBRE' => ($row['TERMINOPAGONOMBRE'] == '') ? null : $row['TERMINOPAGONOMBRE'],
                        'USUARIO' => ($row['USUARIO'] == '') ? null : $row['USUARIO'],
                        'USUARIONOMBRE' => ($row['USUARIONOMBRE'] == '') ? null : $row['USUARIONOMBRE'],
                        'DEPARTAMENTOVENTAS' => ($row['DEPARTAMENTOVENTAS'] == '') ? null : $row['DEPARTAMENTOVENTAS'],
                        'OFICINA' => ($row['OFICINA'] == '') ? null : $row['OFICINA'],
                        'OFICINANOMBRE' => ($row['OFICINANOMBRE'] == '') ? null : $row['OFICINANOMBRE'],
                        'TIPOSECUENCIA' => ($row['TIPOSECUENCIA'] == '') ? null : $row['TIPOSECUENCIA'],
                        'IVA12BASE' => ($row['IVA12BASE'] == '') ? null : $row['IVA12BASE'],
                        'IVA12VALOR' => ($row['IVA12VALOR'] == '') ? null : $row['IVA12VALOR'],
                        'IVA0BASE' => ($row['IVA0BASE'] == '') ? null : $row['IVA0BASE'],
                        'IVA0VALOR' => ($row['IVA0VALOR'] == '') ? null : $row['IVA0VALOR'],
                        'IVA14BASE' => ($row['IVA14BASE'] == '') ? null : $row['IVA14BASE'],
                        'IVA14VALOR' => ($row['IVA14VALOR'] == '') ? null : $row['IVA14VALOR'],
                        'SUBTOTAL' => ($row['SUBTOTAL'] == '') ? null : $row['SUBTOTAL'],
                        'DESCUENTOP' => ($row['DESCUENTOP'] == '') ? null : $row['DESCUENTOP'],
                        'DESCUENTO' => ($row['DESCUENTO'] == '') ? null : $row['DESCUENTO'],
                        'IMPUESTOS' => ($row['IMPUESTOS'] == '') ? null : $row['IMPUESTOS'],
                        'OTROSCARGOS' => ($row['OTROSCARGOS'] == '') ? null : $row['OTROSCARGOS'],
                        'TOTAL' => ($row['TOTAL'] == '') ? null : $row['TOTAL'],
                        'DATOS' => ($row['DATOS'] == '') ? null : $row['DATOS'],
                        'REFERENCIA' => ($row['REFERENCIA'] == '') ? null : $row['REFERENCIA'],
                        'ESTATUSPROCESO' => ($row['ESTATUSPROCESO'] == '') ? null : $row['ESTATUSPROCESO'],
                    );
                    array_push($dataInsert, $data);

                    unset($data);
                } else {
                    Yii::app()->session['itemsFueraPeriodo'] += 1;
                }
            }
        }
//        var_dump($dataInsert);die();
        return $dataInsert;
    }

    public function actionGuardarOrdenes() {
        $response = new Response();
        $DclientesRepetidos = '';
        try {
//            if (isset($_SESSION['archivosOrdenesMb'])) {
            if (isset(Yii::app()->session['archivosOrdenesMb'])) {
//                $filePath = $_SESSION['archivosOrdenesMb'];
                $filePath = Yii::app()->session['archivosOrdenesMb'];
                $operation = "r";
//                $delimiter = ';';
//                $delimiter = $_SESSION['ModelForm']["delimitadorColumnas"]; //';';
                $delimiter = Yii::app()->session['ModelForm']["delimitadorColumnas"]; //';';
                $file = new File($filePath, $operation, $delimiter);
                $totalRows = $file->getTotalFilas();
                $totalOrdenesGuardados = 0;
                $totalOrdenesNoGuardados = 0;

                if ($totalRows > 0) {
                    $totalBloques = ceil($totalRows / TAMANIO_BLOQUE);
                    $numeroBloque = 1;
                    $tamanioBloque = TAMANIO_BLOQUE;

                    while ($numeroBloque <= intval($totalBloques)) {
                        $file = new File($filePath, $operation, $delimiter);
                        $registroInicio = (($numeroBloque - 1) * $tamanioBloque) + 1;
                        $dataInsertar = $this->getDatosGuardar($file, $registroInicio, $tamanioBloque);
                        $datosOrdenesMb = $dataInsertar['ordenesmb'];
                        if (count($datosOrdenesMb) > 0) {
                            $dbConnection = new CI_DB_active_record(null);
                            $sql = $dbConnection->insert_batch('tb_ordenes_mb', $datosOrdenesMb);
//                            var_dump($sql);die();
                            $sql = str_replace('"', '', $sql);
                            $connection = Yii::app()->db_conn;
                            $connection->active = true;
                            $transaction = $connection->beginTransaction();
                            $command = $connection->createCommand($sql);
                            $countInsert = $command->execute();

                            if ($countInsert > 0) {
                                $transaction->commit();
                                $totalOrdenesGuardados = $totalOrdenesGuardados + $countInsert;
                            } else {
                                $transaction->rollback();
                                $totalOrdenesNoGuardados = $totalOrdenesNoGuardados + $countInsert;
                            }
                            unset($datosOrdenesMb);
                            $connection->active = false;
                        }
                        $numeroBloque ++;
                    }

                    if ($totalOrdenesNoGuardados > 0) {
                        $response->Message = 'Se produjo un error en la carga del archivo';
                    } else {
//                        var_dump($_SESSION);                        die();

                        $mensaje = 'Se han cargado ' . $totalOrdenesGuardados . ' registros correctamente.';
//                        if ($_SESSION['cantidadOrdenesActualizadas'] > 0)
                        if (Yii::app()->session['cantidadOrdenesActualizadas'] > 0)
//                            $mensaje .= '<br> Se han actualizado ' . $_SESSION['cantidadOrdenesActualizadas'] . ' registros.';
                            $mensaje .= '<br> Se han actualizado ' . Yii::app()->session['cantidadOrdenesActualizadas'] . ' registros.';
//                        if ($_SESSION['cantidadOrdenesDuplicados'] > 0)
                        if (Yii::app()->session['cantidadOrdenesDuplicados'] > 0)
//                            $mensaje .= '<br> Se han omitido ' . $_SESSION['cantidadOrdenesDuplicados'] . ' registros duplicados en el archivo.';
                            $mensaje .= '<br> Se han omitido ' . Yii::app()->session['cantidadOrdenesDuplicados'] . ' registros duplicados en el archivo.';
                        $mensaje .= $response->Message = $mensaje;

                        unset(Yii::app()->session['archivosHistorialMb']);
                        unset(Yii::app()->session['ModelForm']);
                        unset(Yii::app()->session['ordenesMbItems']);
                        unset(Yii::app()->session['itemsFueraPeriodo']);
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
            $response->Message = 'Se ha producido un error';
            $response->Status = ERROR;
            $response->ClassMessage = CLASS_MENSAJE_ERROR;
        }

        $this->actionResponse(null, null, $response);
        return;
    }

    private function getDatosGuardar($file, $start, $blockSize) {
        $datos = array();
        $datosOrdenes = array();
        $archivoDatosOrdenes = $file->getDatosOrdenesMb($start, $blockSize);

        foreach ($archivoDatosOrdenes as $filaArchivo) {

            $dateString = '';
            if (strlen($filaArchivo['FECHACREACION']) == 16) {
                $date = DateTime::createFromFormat('d/m/Y H:i', $filaArchivo['FECHACREACION']);
                $dateString = $date->format(FORMATO_FECHA_LONG_3);
            } else if (strlen($filaArchivo['FECHACREACION']) == 19) {
                $date = DateTime::createFromFormat('d/m/Y H:i:s', $filaArchivo['FECHACREACION']);
                $dateString = $date->format(FORMATO_FECHA_LONG_4);
            }


//            $date = DateTime::createFromFormat('d/m/Y H:i:s', $filaArchivo['FECHACREACION']);
//            $dateString = $date->format(FORMATO_FECHA_LONG_4);

            if ($dateString >= Yii::app()->session['fechaInicioPeriodo'] && $dateString <= Yii::app()->session['fechaFinPeriodo']) {

                $existeBdd = OrdenesMbModel::model()->findByAttributes(array('o_id' => $filaArchivo['ID']));
                if ($existeBdd) {
                    $existeBdd->delete();
//                $_SESSION['cantidadOrdenesActualizadas'] += 1;
                    Yii::app()->session['cantidadOrdenesActualizadas'] += 1;
                }

                $exisArray = false;
                //verifica si el item esta ya en el array, si esta el valor de exisarray 
                //cambia a true y luego si exisarray es true se detiene el proceso porque no es necesario seguir buscando
                foreach ($datosOrdenes as $item) {
                    $exisArray = in_array($filaArchivo['ID'], $item);
                    if ($exisArray)
                        break;
                }

                if (!$exisArray) {
//                var_dump($filaArchivo['FECHACREACION']);die();
                    $fechaCreacion = DateTime::createFromFormat('d/m/Y H:i:s', $filaArchivo['FECHACREACION']);

                    $sfechaCreacion = $fechaCreacion->format(FORMATO_FECHA_LONG);

                    $fechaDespacho = DateTime::createFromFormat('d/m/Y H:i:s', $filaArchivo['FECHADESPACHO']);
                    $sfechaDespacho = $fechaDespacho->format(FORMATO_FECHA_LONG);

                    $data = array(
                        //''o_cod' => ($row[''] == '') ? null : $row[''],
                        'o_id' => ($filaArchivo['ID'] == '') ? null : $filaArchivo['ID'],
                        'pg_id' => Yii::app()->session['idPeriodoAbierto'],
                        'o_concepto' => ($filaArchivo['CONCEPTO'] == '') ? null : $filaArchivo['CONCEPTO'],
                        'o_codigo_mb' => ($filaArchivo['CODIGO'] == '') ? null : $filaArchivo['CODIGO'],
                        'o_comentario' => ($filaArchivo['COMENTARIO'] == '') ? null : $filaArchivo['COMENTARIO'],
//                    'o_fch_venta' => ($filaArchivo['FECHAVENTA'] == '') ? null : $filaArchivo['FECHAVENTA'],
                        'o_fch_creacion' => ($filaArchivo['FECHACREACION'] == '') ? null : $sfechaCreacion,
                        'o_fch_despacho' => ($filaArchivo['FECHADESPACHO'] == '') ? null : $sfechaDespacho,
                        'o_tipo' => ($filaArchivo['TIPO'] == '') ? null : $filaArchivo['TIPO'],
                        'o_estatus' => ($filaArchivo['ESTATUS'] == '') ? null : $filaArchivo['ESTATUS'],
                        'o_cod_cliente' => ($filaArchivo['CLIENTE'] == '') ? null : $filaArchivo['CLIENTE'],
                        'o_nom_cliente' => ($filaArchivo['CLIENTENOMBRE'] == '') ? null : $filaArchivo['CLIENTENOMBRE'],
                        'o_id_cliente' => ($filaArchivo['CLIENTEIDENTIFICACION'] == '') ? null : $filaArchivo['CLIENTEIDENTIFICACION'],
                        'o_direccion' => ($filaArchivo['DIRECCION'] == '') ? null : $filaArchivo['DIRECCION'],
                        'o_lista_precio' => ($filaArchivo['LISTAPRECIOS'] == '') ? null : $filaArchivo['LISTAPRECIOS'],
                        'o_nom_lista_precio' => ($filaArchivo['LISTAPRECIOSNOMBRE'] == '') ? null : $filaArchivo['LISTAPRECIOSNOMBRE'],
                        'o_bodega_origen' => ($filaArchivo['BODEGAORIGEN'] == '') ? null : $filaArchivo['BODEGAORIGEN'],
                        'o_nom_bodega_origen' => ($filaArchivo['BODEGAORIGENNOMBRE'] == '') ? null : $filaArchivo['BODEGAORIGENNOMBRE'],
                        'o_termino_pago' => ($filaArchivo['TERMINOPAGO'] == '') ? null : $filaArchivo['TERMINOPAGO'],
                        'o_nom_termino_pago' => ($filaArchivo['TERMINOPAGONOMBRE'] == '') ? null : $filaArchivo['TERMINOPAGONOMBRE'],
                        'o_usuario' => ($filaArchivo['USUARIO'] == '') ? null : $filaArchivo['USUARIO'],
                        'o_nom_usuario' => ($filaArchivo['USUARIONOMBRE'] == '') ? null : $filaArchivo['USUARIONOMBRE'],
                        'o_departamento_ventas' => ($filaArchivo['DEPARTAMENTOVENTAS'] == '') ? null : $filaArchivo['DEPARTAMENTOVENTAS'],
                        'o_oficina' => ($filaArchivo['OFICINA'] == '') ? null : $filaArchivo['OFICINA'],
                        'o_nom_oficina' => ($filaArchivo['OFICINANOMBRE'] == '') ? null : $filaArchivo['OFICINANOMBRE'],
                        'o_tipo_secuencia' => ($filaArchivo['TIPOSECUENCIA'] == '') ? null : $filaArchivo['TIPOSECUENCIA'],
                        'o_iva_12_base' => ($filaArchivo['IVA12BASE'] == '') ? null : $filaArchivo['IVA12BASE'],
                        'o_iva_12_valor' => ($filaArchivo['IVA12VALOR'] == '') ? null : $filaArchivo['IVA12VALOR'],
                        'o_iva_0_base' => ($filaArchivo['IVA0BASE'] == '') ? null : $filaArchivo['IVA0BASE'],
                        'o_iva_0_valor' => ($filaArchivo['IVA0VALOR'] == '') ? null : $filaArchivo['IVA0VALOR'],
                        'o_iva_14_base' => ($filaArchivo['IVA14BASE'] == '') ? null : $filaArchivo['IVA14BASE'],
                        'o_iva_14_valor' => ($filaArchivo['IVA14VALOR'] == '') ? null : $filaArchivo['IVA14VALOR'],
                        'o_subtotal' => ($filaArchivo['SUBTOTAL'] == '') ? null : $filaArchivo['SUBTOTAL'],
                        'o_porcentaje_descuento' => ($filaArchivo['DESCUENTOP'] == '') ? null : $filaArchivo['DESCUENTOP'],
                        'o_descuento' => ($filaArchivo['DESCUENTO'] == '') ? null : $filaArchivo['DESCUENTO'],
                        'o_impuestos' => ($filaArchivo['IMPUESTOS'] == '') ? null : $filaArchivo['IMPUESTOS'],
                        'o_otros_cargos' => ($filaArchivo['OTROSCARGOS'] == '') ? null : $filaArchivo['OTROSCARGOS'],
                        'o_total' => ($filaArchivo['TOTAL'] == '') ? null : $filaArchivo['TOTAL'],
                        'o_datos' => ($filaArchivo['DATOS'] == '') ? null : $filaArchivo['DATOS'],
                        'o_referencia' => ($filaArchivo['REFERENCIA'] == '') ? null : $filaArchivo['REFERENCIA'],
                        'o_estado_proceso' => ($filaArchivo['ESTATUSPROCESO'] == '') ? null : $filaArchivo['ESTATUSPROCESO'],
                        'o_fch_ingreso' => date(FORMATO_FECHA_LONG),
                        'o_fch_modificacion' => date(FORMATO_FECHA_LONG),
                        'o_fch_desde' => date(FORMATO_FECHA_LONG),
                        'o_fch_hasta' => date(FORMATO_FECHA_LONG),
                        'o_usr_ing_mod' => Yii::app()->user->id
                    );

                    array_push($datosOrdenes, $data);
                    unset($data);
                } else {
//                $_SESSION['cantidadOrdenesDuplicados'] += 1;
                    Yii::app()->session['cantidadOrdenesDuplicados'] += 1;
                }
            }
        }

        $datos['ordenesmb'] = $datosOrdenes;
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
            $response->Result = Yii::app()->session['ordenesMbItems'];
//            unset(Yii::app()->session['ordenesMbItems']);
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
