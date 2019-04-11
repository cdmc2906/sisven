<?php

/**
 * Description
 * @fecha 
 * @author 
 */
class CargaClientesController extends Controller {

    public $layout = LAYOUT_IMPORTAR;

    public function actionIndex() {
        if (Yii::app()->request->isAjaxRequest) {
            return;
        } else {
            unset(Yii::app()->session['datosClientes']);
            $model = new CargaClientesForm();
            $this->render('/carga/cargaClientes', array('model' => $model));
        }
    }

    public function actionSubirArchivo() {

        $response = new Response();
        try {
            $model = new CargaClientesForm();
            $datosClientes = array();

            unset(Yii::app()->session['cantidadClientesActualizados']);
            unset(Yii::app()->session['itemClientesDuplicadoArchivo']);

            if (isset($_POST['CargaClientesForm'])) {
                $model->attributes = $_POST['CargaClientesForm'];

                if ($model->validate()) {

                    unset(Yii::app()->session['datosClientes']);
                    $filePath = Yii::app()->params['archivosClientes'];
                    $model->rutaArchivo = CUploadedFile::getInstance($model, 'rutaArchivo');
                    $model->rutaArchivo->saveAs($filePath);
                    Yii::app()->session['archivoClientes'] = $filePath;
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

                            $dataInsert = $file->getDatosClientes($registroInicio, $tamanioBloque);

                            if (count($dataInsert) > 0) {
                                $datosClientes = array_merge($datosClientes, $dataInsert);
                                unset($dataInsert);
                            }
                            $numeroBloque ++;
                        }
                        Yii::app()->session['datosClientes'] = $datosClientes;
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
        $this->render('/carga/cargaClientes', array('model' => $model));
        return;
    }

    public function actionGuardarClientes() {
        $response = new Response();
        $DclientesRepetidos = '';
        try {
//            var_dump(Yii::app()->session['datosClientes']);die();
            if (isset(Yii::app()->session['datosClientes'])) {
                $filePath = Yii::app()->session['archivoClientes'];

                $operation = "r";
                $delimiter = Yii::app()->session['ModelForm']["delimitadorColumnas"]; //';';
                $file = new File($filePath, $operation, $delimiter);
                $totalRows = $file->getTotalFilas();

                $totalCoordenadasClientesGuardados = 0;
                $totalCoordenadasClientesNoGuardados = 0;

                if ($totalRows > 0) {
                    $totalBloques = ceil($totalRows / TAMANIO_BLOQUE);
                    $numeroBloque = 1;
                    $tamanioBloque = TAMANIO_BLOQUE;

                    while ($numeroBloque <= intval($totalBloques)) {
                        $file = new File($filePath, $operation, $delimiter);
                        $registroInicio = (($numeroBloque - 1) * $tamanioBloque) + 1;

                        $dataInsertar = $this->getDatosGuardar($file, $registroInicio, $tamanioBloque);
                        $datosCoordenadasClientesGuardar = $dataInsertar['datosClientesNuevos'];

                        if (count($datosCoordenadasClientesGuardar) > 0) {
                            $dbConnection = new CI_DB_active_record(null);
                            $sql = $dbConnection->insert_batch('tb_cliente', $datosCoordenadasClientesGuardar);
                            $sql = str_replace('"', '', $sql);
//                            var_dump($sql);die();
                            $connection = Yii::app()->db_conn;
                            $connection->active = true;
                            $transaction = $connection->beginTransaction();
                            $command = $connection->createCommand($sql);
                            $countInsert = $command->execute();


                            if ($countInsert > 0) {
                                $transaction->commit();
                                $totalCoordenadasClientesGuardados = $totalCoordenadasClientesGuardados + $countInsert;
                            } else {
                                $transaction->rollback();
                                $totalCoordenadasClientesNoGuardados = $totalCoordenadasClientesNoGuardados + $countInsert;
                            }
                            unset($datosCoordenadasClientesGuardar);
                            $connection->active = false;
                        }

                        $numeroBloque ++;
                    }

                    if ($totalCoordenadasClientesNoGuardados > 0) {
                        $response->Message = 'Se produjo un error en la carga del archivo';
                    } else {
                        $mensaje = '';
                        if ($totalCoordenadasClientesGuardados > 0)
                            $mensaje .= 'Se han creado ' . $totalCoordenadasClientesGuardados . ' registros.<br/>';

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
        $datos = array();
        $datosClientesNuevos = array();

        $dataFile = $file->getDatosClientes($start, $blockSize);
        foreach ($dataFile as $cliente) {
//            var_dump($cliente);die();
            $date = DateTime::createFromFormat('d/m/Y H:i:s', $cliente['CLI_CREADO']);
            $dateString = '';
            if ($date !== FALSE) {
                $dateString = $date->format(FORMATO_FECHA_LONG);
            }

//            $date = DateTime::createFromFormat('d/m/Y H:i:s', $cliente['CLI_CREADO']);
//                    $dateString = $date->format(FORMATO_FECHA_LONG);
            $existeBdd = ClienteModel::model()->findByAttributes(array('cli_codigo_cliente' => $cliente['CLI_CODIGO_CLIENTE']));
//          
//              var_dump($existeBdd);die();

            if ($existeBdd) {
//                $existeBdd["cli_codigo"] = $cliente['CLI_CODIGO'];
                $existeBdd["cli_tipo_de_identificacion"] = $cliente['CLI_TIPO_DE_IDENTIFICACION'];
                $existeBdd["cli_identificacion"] = $cliente['CLI_IDENTIFICACION'];
                $existeBdd["cli_nombre_cliente"] = $cliente['CLI_NOMBRE_CLIENTE'];
                $existeBdd["cli_nombre_de_compania"] = $cliente['CLI_NOMBRE_DE_COMPANIA'];
                $existeBdd["cli_nombre_comercial"] = $cliente['CLI_NOMBRE_COMERCIAL'];
                $existeBdd["cli_contacto"] = $cliente['CLI_CONTACTO'];
                $existeBdd["cli_moneda"] = $cliente['CLI_MONEDA'];
                $existeBdd["cli_moneda_nombre"] = $cliente['CLI_MONEDA_NOMBRE'];
                $existeBdd["cli_tipo_de_negocio"] = $cliente['CLI_TIPO_DE_NEGOCIO'];
                $existeBdd["cli_tipo_de_negocio_nombre"] = $cliente['CLI_TIPO_DE_NEGOCIO_NOMBRE'];
                $existeBdd["cli_subcanal"] = $cliente['CLI_SUBCANAL'];
                $existeBdd["cli_subcanal_nombre"] = $cliente['CLI_SUBCANAL_NOMBRE'];
                $existeBdd["cli_lista_de_precios"] = $cliente['CLI_LISTA_DE_PRECIOS'];
                $existeBdd["cli_lista_de_precios_nombre"] = $cliente['CLI_LISTA_DE_PRECIOS_NOMBRE'];
                $existeBdd["cli_lista_de_precios_2"] = $cliente['CLI_LISTA_DE_PRECIOS_2'];
                $existeBdd["cli_lista_de_precios_2_nombre"] = $cliente['CLI_LISTA_DE_PRECIOS_2_NOMBRE'];
                $existeBdd["cli_termino_de_pago"] = $cliente['CLI_TERMINO_DE_PAGO'];
                $existeBdd["cli_termino_de_pago_nombre"] = $cliente['CLI_TERMINO_DE_PAGO_NOMBRE'];
                $existeBdd["cli_metodo_de_pago"] = $cliente['CLI_METODO_DE_PAGO'];
                $existeBdd["cli_metodo_de_pago_nombre"] = $cliente['CLI_METODO_DE_PAGO_NOMBRE'];
                $existeBdd["cli_grupo"] = $cliente['CLI_GRUPO'];
                $existeBdd["cli_grupo_nombre"] = $cliente['CLI_GRUPO_NOMBRE'];
                $existeBdd["cli_usuario"] = $cliente['CLI_USUARIO'];
                $existeBdd["cli_usuario_nombre"] = $cliente['CLI_USUARIO_NOMBRE'];
                $existeBdd["cli_comentario"] = $cliente['CLI_COMENTARIO'];
                $existeBdd["cli_objetivo_de_venta"] = $cliente['CLI_OBJETIVO_DE_VENTA'];
                $existeBdd["cli_maximo_descuento_porcentaje"] = floatval($cliente['CLI_MAXIMO_DESCUENTO_PORCENTAJE']);
                $existeBdd["cli_retencion_porcentaje"] = floatval($cliente['CLI_RETENCION_PORCENTAJE']);
                $existeBdd["cli_tiene_credito"] = $cliente['CLI_TIENE_CREDITO'];
                $existeBdd["cli_estatus"] = $cliente['CLI_ESTATUS'];
                $existeBdd["cli_latitud"] = 0;
                $existeBdd["cli_longitud"] = 0;
//                $existeBdd["cli_creado"] = $cliente['CLI_CREADO'];
                $existeBdd["cli_creado_por"] = $cliente['CLI_CREADO_POR'];
                $existeBdd["cli_fecha_modificacion"] = date(FORMATO_FECHA_LONG);
                $existeBdd["cli_usuario_ingresa_modifica"] = Yii::app()->user->id;

//                var_dump($existeBdd);die();
//                var_dump($existeBdd);die();
                $existeBdd->save();
                Yii::app()->session['cantidadClientesActualizados'] += 1;
            } else {
                $exisArray = false;
                foreach ($datosClientesNuevos as $item) {
                    $exisArray = in_array($cliente['CLI_CODIGO_CLIENTE'], $item);
                    if ($exisArray)
                        break;
                }
                if (!$exisArray) {
//                    $date = DateTime::createFromFormat('d/m/Y H:i:s', $cliente['CLI_CREADO']);
//                    $dateString = $date->format(FORMATO_FECHA_LONG);
                    $data = array(
                        'cli_codigo_cliente' => $cliente['CLI_CODIGO_CLIENTE'],
                        'cli_tipo_de_identificacion' => $cliente['CLI_TIPO_DE_IDENTIFICACION'],
                        'cli_identificacion' => $cliente['CLI_IDENTIFICACION'],
                        'cli_nombre_cliente' => $cliente['CLI_NOMBRE_CLIENTE'],
                        'cli_nombre_de_compania' => $cliente['CLI_NOMBRE_DE_COMPANIA'],
                        'cli_nombre_comercial' => $cliente['CLI_NOMBRE_COMERCIAL'],
                        'cli_contacto' => $cliente['CLI_CONTACTO'],
                        'cli_moneda' => $cliente['CLI_MONEDA'],
                        'cli_moneda_nombre' => $cliente['CLI_MONEDA_NOMBRE'],
                        'cli_tipo_de_negocio' => $cliente['CLI_TIPO_DE_NEGOCIO'],
                        'cli_tipo_de_negocio_nombre' => $cliente['CLI_TIPO_DE_NEGOCIO_NOMBRE'],
                        'cli_subcanal' => $cliente['CLI_SUBCANAL'],
                        'cli_subcanal_nombre' => $cliente['CLI_SUBCANAL_NOMBRE'],
                        'cli_lista_de_precios' => $cliente['CLI_LISTA_DE_PRECIOS'],
                        'cli_lista_de_precios_nombre' => $cliente['CLI_LISTA_DE_PRECIOS_NOMBRE'],
                        'cli_lista_de_precios_2' => $cliente['CLI_LISTA_DE_PRECIOS_2'],
                        'cli_lista_de_precios_2_nombre' => $cliente['CLI_LISTA_DE_PRECIOS_2_NOMBRE'],
                        'cli_termino_de_pago' => $cliente['CLI_TERMINO_DE_PAGO'],
                        'cli_termino_de_pago_nombre' => $cliente['CLI_TERMINO_DE_PAGO_NOMBRE'],
                        'cli_metodo_de_pago' => $cliente['CLI_METODO_DE_PAGO'],
                        'cli_metodo_de_pago_nombre' => $cliente['CLI_METODO_DE_PAGO_NOMBRE'],
                        'cli_grupo' => $cliente['CLI_GRUPO'],
                        'cli_grupo_nombre' => $cliente['CLI_GRUPO_NOMBRE'],
                        'cli_usuario' => $cliente['CLI_USUARIO'],
                        'cli_usuario_nombre' => $cliente['CLI_USUARIO_NOMBRE'],
                        'cli_comentario' => $cliente['CLI_COMENTARIO'],
                        'cli_objetivo_de_venta' => $cliente['CLI_OBJETIVO_DE_VENTA'],
                        'cli_maximo_descuento_porcentaje' => floatval($cliente['CLI_MAXIMO_DESCUENTO_PORCENTAJE']),
                        'cli_retencion_porcentaje' => floatval($cliente['CLI_RETENCION_PORCENTAJE']),
                        'cli_tiene_credito' => $cliente['CLI_TIENE_CREDITO'],
                        'cli_estatus' => $cliente['CLI_ESTATUS'],
                        'cli_creado' => $dateString,
                        'cli_creado_por' => $cliente['CLI_CREADO_POR'],
                        'cli_latitud' => 0,
                        'cli_longitud' => 0,
                        'cli_estado' => 1,
                        'cli_fecha_ingreso' => date(FORMATO_FECHA_LONG),
                        'cli_fecha_modificacion' => date(FORMATO_FECHA_LONG),
                        'cli_usuario_ingresa_modifica' => Yii::app()->user->id
                    );

                    array_push($datosClientesNuevos, $data);
                    unset($data);
                } else {
                    Yii::app()->session['itemClientesDuplicadoArchivo'] = Yii::app()->session['itemClientesDuplicadoArchivo'] + 1;
                }
            }
        }
        $datos['datosClientesNuevos'] = $datosClientesNuevos;
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
            $response->Result = Yii::app()->session['datosClientes'];
//            var_dump(Yii::app()->session['datosClientes']);die();
//            unset(Yii::app()->session['datosClientes']);
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
