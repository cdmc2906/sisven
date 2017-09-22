<?php

/**
 * Description
 * @fecha 
 * @author 
 */
class CargaCoordenadasClientesController extends Controller {

    public function actionIndex() {
        if (Yii::app()->request->isAjaxRequest) {
            return;
        } else {
            unset(Yii::app()->session['coordenadasClientes']);
            $model = new CargaCoordenadasClientesForm();
            $this->render('/cliente/cargaCoordenadasClientes', array('model' => $model));
        }
    }

    public function actionSubirArchivo() {

        $response = new Response();
        try {
            $model = new CargaCoordenadasClientesForm();
            $coordenadasClientes = array();

            if (isset($_POST['CargaCoordenadasClientesForm'])) {
                $model->attributes = $_POST['CargaCoordenadasClientesForm'];
                if ($model->validate()) {

                    unset(Yii::app()->session['coordenadasClientes']);
                    $filePath = Yii::app()->params['archivosCoordenadasClientes'];
                    $model->rutaArchivo = CUploadedFile::getInstance($model, 'rutaArchivo');
                    $model->rutaArchivo->saveAs($filePath);
                    Yii::app()->session['archivosCoordenadasClientes'] = $filePath;
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
//                            var_dump($dataInsert);die();
                            if (count($dataInsert) > 0) {
                                $coordenadasClientes = array_merge($coordenadasClientes, $dataInsert);
                                unset($dataInsert);
                            }
                            $numeroBloque ++;
                        }
                        Yii::app()->session['coordenadasClientes'] = $coordenadasClientes;
//                        unlink($filePath);
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
//        var_dump($_SESSION['historialMbItems']);die();
        $this->render('/cliente/cargaCoordenadasClientes', array('model' => $model));
        return;
    }

    private function getDatosMostrar($file, $start, $blockSize) {
        $datosArchivoCoordenadasCliente = array();
        $dataFile = $file->getDatosClientes($start, $blockSize);
        foreach ($dataFile as $row) {
            $data = array(
                'CODIGO' => ($row['CODIGO'] == '') ? null : $row['CODIGO'],
                'CLIENTENOMBRE' => ($row['CLIENTENOMBRE'] == '') ? null : $row['CLIENTENOMBRE'],
                'LATITUD' => ($row['LATITUD'] == '') ? null : $row['LATITUD'],
                'LONGITUD' => ($row['LONGITUD'] == '') ? null : $row['LONGITUD'],
            );
            array_push($datosArchivoCoordenadasCliente, $data);
            unset($data);
        }
        return $datosArchivoCoordenadasCliente;
    }

    public function actionGuardarCoordenadasClientes() {
        $response = new Response();
        $DclientesRepetidos = '';
        try {
//            var_dump(Yii::app()->session['coordenadasClientes']);die();
            if (isset(Yii::app()->session['coordenadasClientes'])) {
                $filePath = Yii::app()->session['archivosCoordenadasClientes'];

                $operation = "r";
//                $delimiter = ';';
                $delimiter = Yii::app()->session['ModelForm']["delimitadorColumnas"]; //';';
//                var_dump($delimiter);die();
//                var_dump($filePath);die();
                $file = new File($filePath, $operation, $delimiter);
                $totalRows = $file->getTotalFilas();
                
                $totalCoordenadasClientesGuardados = 0;
                $totalCoordenadasClientesNoGuardados = 0;
//                var_dump('jajajja');die();
                if ($totalRows > 0) {
                    $totalBloques = ceil($totalRows / TAMANIO_BLOQUE);
                    $numeroBloque = 1;
                    $tamanioBloque = TAMANIO_BLOQUE;

                    while ($numeroBloque <= intval($totalBloques)) {
                        $file = new File($filePath, $operation, $delimiter);
                        $registroInicio = (($numeroBloque - 1) * $tamanioBloque) + 1;
                        
                        $dataInsertar = $this->getDatosGuardar($file, $registroInicio, $tamanioBloque);
                        $datosCoordenadasClientesGuardar = $dataInsertar['coordenadasClientes'];
//                        var_dump($datosCoordenadasClientesGuardar);die();
                        
                        if (count($datosCoordenadasClientesGuardar) > 0) {
                            $dbConnection = new CI_DB_active_record(null);
                            $sql = $dbConnection->insert_batch('tb_cliente', $datosCoordenadasClientesGuardar);
                            $sql = str_replace('"', '', $sql);
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
                        $response->Message = 'Se han cargado ' . $totalCoordenadasClientesGuardados . ' registros correctamente.';
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
        $datosCoordenadasClientes = array();
        $clientesRepetidos = array();

        $dataFile = $file->getDatosClientes($start, $blockSize);
//        var_dump($dataFile);die();
        foreach ($dataFile as $row) {
            $existeBdd = ClienteModel::model()->findByAttributes(array('cli_codigo_cliente' => $row['CODIGO']));
//            var_dump($existeBdd);die();
            if ($existeBdd) {
                $existeBdd->delete();
                Yii::app()->session['cantidadClientesActualizados'] += 1;
            }
            $exisArray = false;

            foreach ($datosCoordenadasClientes as $item) {
                $exisArray = in_array($row['CODIGO'], $item);
                if ($exisArray)
                    break;
            }
            if (!$exisArray) {
                $data = array(
                    'cli_codigo_cliente' => ($row['CODIGO'] == '') ? null : $row['CODIGO'],
                    'cli_nombre_cliente' => ($row['CLIENTENOMBRE'] == '') ? null : $row['CLIENTENOMBRE'],
                    'cli_latitud' => ($row['LATITUD'] == '') ? null : $row['LATITUD'],
                    'cli_longitud' => ($row['LONGITUD'] == '') ? null : $row['LONGITUD'],
                    'cli_estado' => 1,
                    'cli_fecha_ingreso' => date(FORMATO_FECHA_LONG),
                    'cli_fecha_modificacion' => date(FORMATO_FECHA_LONG),
                    'cli_usuario_ingresa_modifica' => Yii::app()->user->id

                );

                array_push($datosCoordenadasClientes, $data);
                unset($data);
            } else {
                Yii::app()->session['itemClientesDuplicadoArchivo'] = Yii::app()->session['itemClientesDuplicadoArchivo'] + 1;
            }
        }
        $datos['coordenadasClientes'] = $datosCoordenadasClientes;
//        $datos['clientesRepetidos'] = $clientesRepetidos;
//        var_dump($datos['coordenadasClientes']);        die();
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
            $response->Result = Yii::app()->session['coordenadasClientes'];
//            var_dump(Yii::app()->session['coordenadasClientes']);die();
//            unset(Yii::app()->session['coordenadasClientes']);
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
