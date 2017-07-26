<?php

/**
 * Description
 * @fecha 
 * @author 
 */
class CargaRutasMbController extends Controller {

    public function actionIndex() {
        if (Yii::app()->request->isAjaxRequest) {
            return;
        } else {
            unset($_SESSION['rutasMbItems']);
            $model = new CargaRutasMbForm();
            $this->render('/rutasmb/cargarutasmb', array('model' => $model));
        }
    }

    public function actionSubirArchivo() {

        $response = new Response();
        try {
//            var_dump("POST2");die();
            $model = new CargaRutasMbForm();
            $rutasMbItems = array();
//            var_dump($_POST);die();
            if (isset($_POST['CargaRutasMbForm'])) {
                $model->attributes = $_POST['CargaRutasMbForm'];
                if ($model->validate()) {
                    unset($_SESSION['rutasMbItems']);

                    $filePath = Yii::app()->params['archivosRutasMb'];
                    $model->rutaArchivo = CUploadedFile::getInstance($model, 'rutaArchivo');
                    $model->rutaArchivo->saveAs($filePath);
                    $_SESSION['archivosRutasMb'] = $filePath;
                    $_SESSION['ModelForm'] = $model;

                    $operation = "r";
                    $delimiter = ';';
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
                                $rutasMbItems = array_merge($rutasMbItems, $dataInsert);
                                unset($dataInsert);
                            }
                            $numeroBloque ++;
                        }
                        $_SESSION['rutasMbItems'] = $rutasMbItems;
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
//        var_dump($_SESSION['rutasMbItems']);die();
//        var_dump($model);die();
        $this->render('/rutasMb/cargarutasmb', array('model' => $model));
        return;
    }

    private function getDatosMostrar($file, $start, $blockSize) {
        $dataInsert = array();
        $dataFile = $file->getDatosRutasMb($start, $blockSize);
//        var_dump($dataFile[0]);        die();
        foreach ($dataFile as $row) {
//            if ($row['ruc'] === '1717363251') {
//                var_dump($row['direccion'], trim($row['direccion']));                die();
//            }
            $data = array(
                'RUTA' => ($row['RUTA'] == '') ? null : $row['RUTA'],
                'CLIENTE' => ($row['CLIENTE'] == '') ? null : $row['CLIENTE'],
                'NOMBRE' => ($row['NOMBRE'] == '') ? null : $row['NOMBRE'],
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
//var_dump($dataInsert);            die();
        return $dataInsert;
    }

    public function actionGuardarRutas() {
        $response = new Response();
        $rutasRepetidos = '';
        try {
            if (isset($_SESSION['archivosRutasMb'])) {
                $filePath = $_SESSION['archivosRutasMb'];

                $operation = "r";
                $delimiter = ';';
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
                    } else {
                        $response->Message = 'Se han cargado ' . $totalRutasGuardados . ' registros correctamente.';
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
        $datosRutas = array();
        $rutasRepetidos = array();
        $existeBdd = false;
        $exisArray = false;
        $_SESSION['itemRutasDuplicado'] = 0;

        $dataFile = $file->getDatosRutasMb($start, $blockSize);
        foreach ($dataFile as $row) {
            $existeBdd = RutaMbModel::model()->findByAttributes(array('r_cod_cliente' => $row['CLIENTE']));

            $exisArray = false;
            foreach ($datosRutas as $item) {
                $exisArray = in_array($row['CLIENTE'], $item);
                if ($exisArray)
                    break;
            }
            if (!$existeBdd && !$exisArray) {
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
                $_SESSION['itemrRutasDuplicado'] = $_SESSION['itemRutasDuplicado'] + 1;
            }
        }
        $datos['rutasmb'] = $datosRutas;
//        $datos['clientesRepetidos'] = $clientesRepetidos;
//        var_dump($datos['ordenesmb']);        die();
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
            $response->Result = $_SESSION['rutasMbItems'];
//            var_dump($_SESSION['historialMbItems'], $response->Result); die();

            unset($_SESSION['rutasMbItems']);
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

    public function filters() {
// return the filter configuration for this controller, e.g.:
        return array('accessControl', array('CrugeAccessControlFilter'));
    }

    public function accessRules() {
        return array(
            array('allow', // allow authenticated users to access all actions
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

}
