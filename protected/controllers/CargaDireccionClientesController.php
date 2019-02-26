<?php

/**
 * Description
 * @fecha 
 * @author 
 */
class CargaDireccionClientesController extends Controller {

    public $layout = LAYOUT_IMPORTAR;

    public function actionIndex() {
        if (Yii::app()->request->isAjaxRequest) {
            return;
        } else {
            unset(Yii::app()->session['datosDireccionClientes']);
            $model = new CargaDireccionClientesForm();
            $this->render('/carga/cargaDireccionClientes', array('model' => $model));
        }
    }

    public function actionSubirArchivo() {

        $response = new Response();
        try {
            $model = new CargaDireccionClientesForm();
            $datosDireccionCliente = array();

            unset(Yii::app()->session['datosDireccionClientes']);
            unset(Yii::app()->session['cantidadClientesActualizados']);
            unset(Yii::app()->session['itemClientesDuplicadoArchivo']);

            if (isset($_POST['CargaDireccionClientesForm'])) {
                $model->attributes = $_POST['CargaDireccionClientesForm'];

                if ($model->validate()) {

                    unset(Yii::app()->session['datosDireccionClientes']);
                    $filePath = Yii::app()->params['archivosDireccionClientes'];
                    $model->rutaArchivo = CUploadedFile::getInstance($model, 'rutaArchivo');
                    $model->rutaArchivo->saveAs($filePath);
                    Yii::app()->session['archivosDireccionClientes'] = $filePath;
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
//                            $registroInicio = 2; //(($numeroBloque - 1) * $tamanioBloque) + 1;

                            $dataInsert = $file->getDireccionClientes($registroInicio, $tamanioBloque);
//                            var_dump($dataInsert);die();
                            if (count($dataInsert) > 0) {
                                $datosDireccionCliente = array_merge($datosDireccionCliente, $dataInsert);
                                unset($dataInsert);
                            }
                            $numeroBloque ++;
                        }
//                        var_dump($datosDireccionCliente);                        die();
                        Yii::app()->session['datosDireccionClientes'] = $datosDireccionCliente;
                    } else {
                        $response->Message = 'El archivo no contiene registros';
                        $response->Status = NOTICE;
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
        $this->render('/carga/cargaDireccionClientes', array('model' => $model));
        return;
    }

    public function actionGuardarDireccionClientes() {
        $response = new Response();
        $DclientesRepetidos = '';
        try {
//            var_dump(Yii::app()->session['datosDireccionClientes']);die();
            if (isset(Yii::app()->session['datosDireccionClientes'])) {
                $filePath = Yii::app()->session['archivosDireccionClientes'];

                $operation = "r";
                $delimiter = Yii::app()->session['ModelForm']["delimitadorColumnas"]; //';';
                $file = new File($filePath, $operation, $delimiter);
//                var_dump(Yii::app()->session['datosDireccionClientes'],$file);die();
                $totalRows = $file->getTotalFilas();

                $totalDireccionClientesGuardados = 0;
                $totalCoordenadasClientesNoGuardados = 0;

                if ($totalRows > 0) {
                    $totalBloques = ceil($totalRows / TAMANIO_BLOQUE);
                    $numeroBloque = 1;
                    $tamanioBloque = TAMANIO_BLOQUE;

                    while ($numeroBloque <= intval($totalBloques)) {
                        $file = new File($filePath, $operation, $delimiter);
                        $registroInicio = (($numeroBloque - 1) * $tamanioBloque) + 1;

                        $dataInsertar = $this->getDatosGuardar($file, $registroInicio, $tamanioBloque);
                        $datosDireccionClientesGuardar = $dataInsertar['datosClientesNuevos'];

                        if (count($datosDireccionClientesGuardar) > 0) {
                            $dbConnection = new CI_DB_active_record(null);
                            $sql = $dbConnection->insert_batch('tb_cliente_direccion', $datosDireccionClientesGuardar);
                            $sql = str_replace('"', '', $sql);
//                            var_dump($sql);die();
                            $connection = Yii::app()->db_conn;
                            $connection->active = true;
                            $transaction = $connection->beginTransaction();
                            $command = $connection->createCommand($sql);
                            $countInsert = $command->execute();


                            if ($countInsert > 0) {
                                $transaction->commit();
                                $totalDireccionClientesGuardados = $totalDireccionClientesGuardados + $countInsert;
                            } else {
                                $transaction->rollback();
                                $totalCoordenadasClientesNoGuardados = $totalCoordenadasClientesNoGuardados + $countInsert;
                            }
                            unset($datosDireccionClientesGuardar);
                            $connection->active = false;
                        }

                        $numeroBloque ++;
                    }

                    if ($totalCoordenadasClientesNoGuardados > 0) {
                        $response->Message = 'Se produjo un error en la carga del archivo';
                    } else {
                        $mensaje = '';
                        if ($totalDireccionClientesGuardados > 0)
                            $mensaje .= 'Se han creado ' . $totalDireccionClientesGuardados . ' registros.<br/>';

                        if (Yii::app()->session['cantidadClientesActualizados'])
                            $mensaje .= 'Se han actualizado ' . Yii::app()->session['cantidadClientesActualizados'] . ' registros.<br/>';

                        if (Yii::app()->session['itemClientesDuplicadoArchivo'])
                            $mensaje .= 'Se han omitido ' . Yii::app()->session['itemClientesDuplicadoArchivo'] . ' registros duplicados.<br/>';

                        $response->Message = $mensaje;
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
//        var_dump($file,$start,$blockSize);die();
        $datos = array();
        $datosDireccionClientesNuevos = array();

        $dataFile = $file->getDireccionClientes($start, $blockSize);
        foreach ($dataFile as $cliente) {
//            var_dump($cliente);            die();
            $provincia = '';
            $canton = '';
            $parroquia = '';

            if ($cliente['DCLI_GEO_AREA_DESCRIPCION_RECORRIDO'] != 'null') {
                $datosGeograficos = explode('/', $cliente['DCLI_GEO_AREA_DESCRIPCION_RECORRIDO'], 3);
//                var_dump($cliente['DCLI_GEO_AREA_DESCRIPCION_RECORRIDO']);
//                var_dump($datosGeograficos);                die();

                $provincia = isset($datosGeograficos[0]) ? trim($datosGeograficos[0]) : '';
                $canton = isset($datosGeograficos[1]) ? trim($datosGeograficos[1]) : '';
                $parroquia = isset($datosGeograficos[2]) ? trim($datosGeograficos[2]) : '';
            }
            $existeBdd = ClienteDireccionModel::model()->findByAttributes(array('dcli_cliente' => $cliente['DCLI_CLIENTE'], 'dcli_codigo' => $cliente['DCLI_CODIGO']));
//            var_dump($existeBdd);die();
            if ($existeBdd) {
//                $existeBdd["dcli_codigo"] = $cliente['DCLI_CODIGO'];
//                $existeBdd["dcli_cliente"] = $cliente['DCLI_CLIENTE'];

                $existeBdd["dcli_cliente_nombre"] = $cliente['DCLI_CLIENTE_NOMBRE'];
                $existeBdd["dcli_cliente_identificacion"] = $cliente['DCLI_CLIENTE_IDENTIFICACION'];
                $existeBdd["dcli_cliente_comentario"] = $cliente['DCLI_CLIENTE_COMENTARIO'];
                $existeBdd["dcli_oficina"] = $cliente['DCLI_OFICINA'];
                $existeBdd["dcli_oficina_nombre"] = $cliente['DCLI_OFICINA_NOMBRE'];
                $existeBdd["dcli_codigo_de_barras"] = $cliente['DCLI_CODIGO_DE_BARRAS'];
                $existeBdd["dcli_descripcion"] = $cliente['DCLI_DESCRIPCION'];
                $existeBdd["dcli_contacto"] = $cliente['DCLI_CONTACTO'];
                $existeBdd["dcli_geo_area"] = $cliente['DCLI_GEO_AREA'];
                $existeBdd["dcli_geo_area_nombre"] = $cliente['DCLI_GEO_AREA_NOMBRE'];
                $existeBdd["dcli_geo_area_codigo_recorrido"] = $cliente['DCLI_GEO_AREA_CODIGO_RECORRIDO'];
                $existeBdd["dcli_geo_area_descripcion_recorrido"] = $cliente['DCLI_GEO_AREA_DESCRIPCION_RECORRIDO'];
                $existeBdd["dcli_provincia"] = $provincia;
                $existeBdd["dcli_canton"] = $canton;
                $existeBdd["dcli_parroquia"] = $parroquia;
                $existeBdd["dcli_calle_principal"] = $cliente['DCLI_CALLE_PRINCIPAL'];
                $existeBdd["dcli_nomenclatura"] = $cliente['DCLI_NOMENCLATURA'];
                $existeBdd["dcli_calle_secundaria"] = $cliente['DCLI_CALLE_SECUNDARIA'];
                $existeBdd["dcli_referencia"] = $cliente['DCLI_REFERENCIA'];
                $existeBdd["dcli_codigo_postal"] = $cliente['DCLI_CODIGO_POSTAL'];
                $existeBdd["dcli_telefono"] = $cliente['DCLI_TELEFONO'];
                $existeBdd["dcli_fax"] = $cliente['DCLI_FAX'];
                $existeBdd["dcli_email"] = $cliente['DCLI_EMAIL'];
                $existeBdd["dcli_latitud"] = strval($cliente['DCLI_LATITUD']) == 'null' ? 0 : floatval($cliente['DCLI_LATITUD']);
                $existeBdd["dcli_longitud"] = strval($cliente['DCLI_LONGITUD']) == 'null' ? 0 : floatval($cliente['DCLI_LONGITUD']);
                $date = DateTime::createFromFormat('d/m/Y H:i:s', $cliente['DCLI_ULTIMA_VISITA']);
                $dateString = '';
                if ($date !== FALSE) {
                    $dateString = $date->format(FORMATO_FECHA_LONG);
                }
                $existeBdd["dcli_ultima_visita"] = $dateString;
                $existeBdd["dcli_estado_de_localizacion"] = $cliente['DCLI_ESTADO_DE_LOCALIZACION'];

//                $existeBdd["dcli_fecha_ingreso"] = date(FORMATO_FECHA_LONG);
                $existeBdd["dcli_fecha_modifica"] = date(FORMATO_FECHA_LONG);
//                $existeBdd["dcli_usr_ingresa"] = Yii::app()->user->id;
                $existeBdd["dcli_usr_modifica"] = Yii::app()->user->id;

//                var_dump($existeBdd);die();
//                var_dump($existeBdd);die();
                $existeBdd->save();
                Yii::app()->session['cantidadClientesActualizados'] += 1;
            } else {
                $exisArray = false;
//                foreach ($datosDireccionClientesNuevos as $item) {
//                    $exisArray = in_array($cliente['DCLI_CLIENTE'], $item);
//                    if ($exisArray)
//                        break;
//                }
                if (!$exisArray) {
                    $date = DateTime::createFromFormat('d/m/Y H:i:s', $cliente['DCLI_ULTIMA_VISITA']);
                    $dateString = '';
                    if ($date !== FALSE) {
                        $dateString = $date->format(FORMATO_FECHA_LONG);
                    }

                    $data = array(
                        'dcli_codigo' => $cliente['DCLI_CODIGO'],
                        'dcli_cliente' => $cliente['DCLI_CLIENTE'],
                        'dcli_cliente_nombre' => $cliente['DCLI_CLIENTE_NOMBRE'],
                        'dcli_cliente_identificacion' => $cliente['DCLI_CLIENTE_IDENTIFICACION'],
                        'dcli_cliente_comentario' => $cliente['DCLI_CLIENTE_COMENTARIO'],
                        'dcli_oficina' => $cliente['DCLI_OFICINA'],
                        'dcli_oficina_nombre' => $cliente['DCLI_OFICINA_NOMBRE'],
                        'dcli_codigo_de_barras' => $cliente['DCLI_CODIGO_DE_BARRAS'],
                        'dcli_descripcion' => $cliente['DCLI_DESCRIPCION'],
                        'dcli_contacto' => $cliente['DCLI_CONTACTO'],
                        'dcli_geo_area' => $cliente['DCLI_GEO_AREA'],
                        'dcli_geo_area_nombre' => $cliente['DCLI_GEO_AREA_NOMBRE'],
                        'dcli_geo_area_codigo_recorrido' => $cliente['DCLI_GEO_AREA_CODIGO_RECORRIDO'],
                        'dcli_geo_area_descripcion_recorrido' => $cliente['DCLI_GEO_AREA_DESCRIPCION_RECORRIDO'],
                        'dcli_provincia' => $provincia,
                        'dcli_canton' => $canton,
                        'dcli_parroquia' => $parroquia,
                        'dcli_calle_principal' => $cliente['DCLI_CALLE_PRINCIPAL'],
                        'dcli_nomenclatura' => $cliente['DCLI_NOMENCLATURA'],
                        'dcli_calle_secundaria' => $cliente['DCLI_CALLE_SECUNDARIA'],
                        'dcli_referencia' => $cliente['DCLI_REFERENCIA'],
                        'dcli_codigo_postal' => $cliente['DCLI_CODIGO_POSTAL'],
                        'dcli_telefono' => $cliente['DCLI_TELEFONO'],
                        'dcli_fax' => $cliente['DCLI_FAX'],
                        'dcli_email' => $cliente['DCLI_EMAIL'],
                        'dcli_latitud' => strval($cliente['DCLI_LATITUD']) == 'null' ? 0 : floatval($cliente['DCLI_LATITUD']),
                        'dcli_longitud' => strval($cliente['DCLI_LONGITUD']) == 'null' ? 0 : floatval($cliente['DCLI_LONGITUD']),
                        'dcli_ultima_visita' => $dateString,
                        'dcli_estado_de_localizacion' => $cliente['DCLI_ESTADO_DE_LOCALIZACION'],
                        'dcli_fecha_ingreso' => date(FORMATO_FECHA_LONG),
                        'dcli_fecha_modifica' => date(FORMATO_FECHA_LONG),
                        'dcli_usr_ingresa' => Yii::app()->user->id,
                        'dcli_usr_modifica' => Yii::app()->user->id,
                    );

                    array_push($datosDireccionClientesNuevos, $data);
                    unset($data);
                } else {
                    Yii::app()->session['itemClientesDuplicadoArchivo'] = Yii::app()->session['itemClientesDuplicadoArchivo'] + 1;
                }
            }
        }
        $datos['datosClientesNuevos'] = $datosDireccionClientesNuevos;
//        $datos['clientesRepetidos'] = $clientesRepetidos;
//        var_dump($datos['datosClientes']);        die();
//        var_dump($datos,Yii::app()->session['cantidadClientesActualizados']);        die();
        return $datos;
    }

    public function actionVerDatosArchivo() {
//var_dump("ss"); die();
        if (!Yii::app()->request->isAjaxRequest) {
            $error['message'] = Yii::app()->params['msjErrorAccesoPag'];
            $error['code'] = Yii::app()->params['codErrorAccesoPag'];
            $this->render(Yii::app()->params['pagError'], $error);
        }

        $response = new Response();
        try {
            $response->Result = Yii::app()->session['datosDireccionClientes'];
//            var_dump(Yii::app()->session['datosDireccionClientes']);die();
//            unset(Yii::app()->session['datosDireccionClientes']);
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
//        var_dump(json_encode($response));die();
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

}
