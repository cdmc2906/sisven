<?php

/**
 * Description
 * @fecha 
 * @author 
 */
class CargaTransferenciasMovistarController extends Controller {

    public function actionIndex() {
        if (Yii::app()->request->isAjaxRequest) {
            return;
        } else {
//            unset($_SESSION['ventasMovistarItems']);
            unset(Yii::app()->session['transferenciasMovistarItems']);
            $model = new CargaTransferenciasMovistarForm();
            $this->render('/transferenciaMovistar/cargaTransferenciasMovistar', array('model' => $model));
        }
    }

    public function actionSubirArchivo() {
        $response = new Response();
        try {
//            $_SESSION['cantidadVentasDuplicados'] = 0;
//            $_SESSION['cantidadVentasActualizadas'] = 0;
            Yii::app()->session['cantidadTransferenciasDuplicados'] = 0;
            Yii::app()->session['cantidadTransferenciasActualizadas'] = 0;

            $model = new CargaTransferenciasMovistarForm();
            $transferenciasMovistar = array();
            if (isset($_POST['CargaTransferenciasMovistarForm'])) {
                $model->attributes = $_POST['CargaTransferenciasMovistarForm'];
                if ($model->validate()) {
//                    unset($_SESSION['ventasMovistarItems']);
                    $filePath = Yii::app()->params['archivosTransferenciasMovistar'];
                    $model->rutaArchivo = CUploadedFile::getInstance($model, 'rutaArchivo');
                    $model->rutaArchivo->saveAs($filePath);
//                    $_SESSION['archivosVentasMovistar'] = $filePath;
//                    $_SESSION['ModelForm'] = $model;
                    Yii::app()->session['archivosTransferenciasMovistar'] = $filePath;
                    Yii::app()->session['ModelForm'] = $model;

//                    var_dump($model->delimitadorColumnas);                    die();
                    $operation = "r";
//                    $delimiter = ',';
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
//                            var_dump($dataInsert);                            die();
                            if (count($dataInsert) > 0) {
                                $transferenciasMovistar = array_merge($transferenciasMovistar, $dataInsert);
                                unset($dataInsert);
                            }
                            $numeroBloque ++;
                        }
//                        var_dump($transferenciasMovistar);                        die();
//                        $_SESSION['ventasMovistarItems'] = $ventasMovistar;
                        Yii::app()->session['transferenciasMovistarItems'] = $transferenciasMovistar;
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
//        var_dump($_SESSION['ordenesMbItems']);die();
//        var_dump($model);die();
        $this->render('/transferenciaMovistar/cargaTransferenciasMovistar', array('model' => $model));
        return;
    }

    private function getDatosMostrar($file, $start, $blockSize) {
        $datosMostar = array();
        $dataFile = $file->getDatosTransferenciasMovistar($start, $blockSize);
//        var_dump($dataFile);die();
        foreach ($dataFile as $row) {
            $data = array(
                'FECHA' => ($row['FECHA'] == '') ? null : $row['FECHA'],
//                'TRANSACCION' => ($row['TRANSACCION'] == '') ? null : $row['TRANSACCION'],
//                'DISTRIBUIDOR' => ($row['DISTRIBUIDOR'] == '') ? null : $row['DISTRIBUIDOR'],
                'NOMBREDISTRIBUIDOR' => ($row['NOMBREDISTRIBUIDOR'] == '') ? null : $row['NOMBREDISTRIBUIDOR'],
                'CODIGOSCL' => ($row['CODIGOSCL'] == '') ? null : $row['CODIGOSCL'],
//                'INVENTARIOANTERIORFUENTE' => ($row['INVENTARIOANTERIORFUENTE'] == '') ? null : $row['INVENTARIOANTERIORFUENTE'],
//                'INVENTARIOACTUALFUENTE' => ($row['INVENTARIOACTUALFUENTE'] == '') ? null : $row['INVENTARIOACTUALFUENTE'],
//                'TIPOSIM' => ($row['TIPOSIM'] == '') ? null : $row['TIPOSIM'],
                'ICC' => ($row['ICC'] == '') ? null : $row['ICC'],
                'MIN' => ($row['MIN'] == '') ? null : $row['MIN'],
//                'ESTADO' => ($row['ESTADO'] == '') ? null : $row['ESTADO'],
                'IDDESTINO' => ($row['IDDESTINO'] == '') ? null : $row['IDDESTINO'],
                'NOMBREDESTINO' => ($row['NOMBREDESTINO'] == '') ? null : $row['NOMBREDESTINO'],
//                'INVENTARIOANTERIORDESTINO' => ($row['INVENTARIOANTERIORDESTINO'] == '') ? null : $row['INVENTARIOANTERIORDESTINO'],
//                'INVENTARIOACTUALDESTINO' => ($row['INVENTARIOACTUALDESTINO'] == '') ? null : $row['INVENTARIOACTUALDESTINO'],
//                'CANAL' => ($row['CANAL'] == '') ? null : $row['CANAL'],
                'LOTE' => ($row['LOTE'] == '') ? null : $row['LOTE'],
//                'ZONA' => ($row['ZONA'] == '') ? null : $row['ZONA'],
            );
            array_push($datosMostar, $data);

            unset($data);
        }
//        var_dump($datosMostar);die();
        return $datosMostar;
    }

    public function actionGuardarTransferenciasMovistar() {
        $response = new Response();
        $transferenciasMovistar = '';
//        var_dump($_SESSION['ventasMovistarItems']);        die();
        try {
//        var_dump(Yii::app()->session['archivosTransferenciasMovistar']);die();
            if (isset(Yii::app()->session['archivosTransferenciasMovistar'])) {
//                $filePath = $_SESSION['archivosVentasMovistar'];
                $filePath = Yii::app()->session['archivosTransferenciasMovistar'];
//                var_dump($_SESSION['ModelForm']["delimitadorColumnas"]);die();
//                var_dump($filePath);die();

                $operation = "r";
//                $delimiter = $_SESSION['ModelForm']["delimitadorColumnas"]; //';';
                $delimiter = Yii::app()->session['ModelForm']["delimitadorColumnas"]; //';';
//                var_dump($filePath);die();
                $file = new File($filePath, $operation, $delimiter);
//                var_dump($file);                die();
                $totalRows = $file->getTotalFilas();
                $totalTransferenciasGuardadas = 0;
                $totalTransferenciasNoGuardados = 0;

                if ($totalRows > 0) {
                    $totalBloques = ceil($totalRows / TAMANIO_BLOQUE);
                    $numeroBloque = 1;
                    $tamanioBloque = TAMANIO_BLOQUE;

                    while ($numeroBloque <= intval($totalBloques)) {

                        $file = new File($filePath, $operation, $delimiter);
//var_dump($file);                die();                        
                        $registroInicio = (($numeroBloque - 1) * $tamanioBloque) + 1;
//                        var_dump($file);die();
                        $dataInsertar = $this->getDatosGuardar($file, $registroInicio, $tamanioBloque);
                        $datosTransferenciasMovistar = $dataInsertar['transferenciasMovistar'];
//                        $datosChipsDuplicados = $dataInsertar['chipsDuplicados'];
//                        var_dump($datosChipsDuplicados);                        die();
//                        var_dump($datosVentasMovistar);                        die();
                        if (count($datosTransferenciasMovistar) > 0) {
                            $dbConnection = new CI_DB_active_record(null);
                            $sql = $dbConnection->insert_batch('tb_transferencia_movistar', $datosTransferenciasMovistar);
                            $sql = str_replace('"', '', $sql);
                            $connection = Yii::app()->db_conn;
                            $connection->active = true;
                            $transaction = $connection->beginTransaction();
                            $command = $connection->createCommand($sql);
                            $countInsert = $command->execute();

                            if ($countInsert > 0) {
                                $transaction->commit();
                                $totalTransferenciasGuardadas = $totalTransferenciasGuardadas + $countInsert;
                            } else {
                                $transaction->rollback();
                                $totalTransferenciasGuardadasNoGuardados = $totalTransferenciasNoGuardados + $countInsert;
                            }
                            unset($datosTransferenciasMovistar);
                            $connection->active = false;
                        }
                        $numeroBloque ++;
                    }

                    if ($totalTransferenciasNoGuardados > 0) {
                        $response->Message = 'Se produjo un error en la carga del archivo';
                        $response->ClassMessage = CLASS_MENSAJE_ERROR;
                    } else {
//                        var_dump($_SESSION);                        die();

                        $mensaje = 'Se han cargado ' . $totalTransferenciasGuardadas . ' registros correctamente.';
//                        if ($_SESSION['cantidadVentasActualizadas'] > 0)
//                            $mensaje .= '<br> Se han actualizado ' . $_SESSION['cantidadVentasActualizadas'] . ' registros.';
//                        if ($_SESSION['cantidadVentasDuplicados'] > 0)
//                            $mensaje .= '<br> Se han omitido ' . $_SESSION['cantidadVentasDuplicados'] . ' registros duplicados en el archivo.';

                        if (Yii::app()->session['cantidadTransferenciasActualizadas'] > 0)
                            $mensaje .= '<br> Se han actualizado ' . Yii::app()->session['cantidadTransferenciasActualizadas'] . ' registros.';
                        if (Yii::app()->session['cantidadTransferenciasDuplicados'] > 0)
                            $mensaje .= '<br> Se han omitido ' . Yii::app()->session['cantidadTransferenciasDuplicados'] . ' registros duplicados en el archivo.';
                        $mensaje .= $response->Message = $mensaje;
                    }
//                    var_dump($_SESSION['chipsDuplicados']);
//                    var_dump($_SESSION['chipsDuplicados']);
//                    var_dump($mensaje);die();
                    if (isset($datosTransferenciasMovistar['minesActualizados'])) {
                        $minesActualizados = $datosTransferenciasMovistar['minesActualizados'];

//                        $_SESSION['minesActualizados'] = $minesActualizados;
                        Yii::app()->session['minesActualizados'] = $minesActualizados;
                        $response->Result = $minesActualizados;
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
        $datosTransferenciasMovistar = array();
        $datosChipsRepetidos = array();
        $datosChipsActualizados = array();

        $archivoVentasMovistar = $file->getDatosVentasMovistar($start, $blockSize);
        foreach ($archivoVentasMovistar as $row) {
            $existeBdd = TransferenciaMovistarModel::model()->findByAttributes(array('tm_icc' => trim($row['ICC'])));
            if ($existeBdd) {
                $existeBdd->delete();
//                $_SESSION['cantidadVentasActualizadas'] += 1;
                Yii::app()->session['cantidadTransferenciasActualizadas'] += 1;
                array_push($datosChipsActualizados, $row['ICC']);
            }

            $exisArray = false;
//            foreach ($datosChipsRepetidos as $itemEnBloque) {
//                $exisArray = in_array(trim($row['ICC']), $itemEnBloque);
//                if ($exisArray) {
////                    var_dump($item['vm_icc']);die();
////                    var_dump($item['vm_icc'],$row['ICC']);die();
//                    $_SESSION['cantidadVentasDuplicados'] += 1;
//                    break;
//                }
//            }

            if (!$exisArray) {
                $data = array(
                    'tm_fecha' => (trim($row['FECHA']) == '') ? null : trim($row['FECHA']),
                    'tm_codigotransferencia' => (trim($row['TRANSACCION']) == '') ? null : trim($row['TRANSACCION']),
                    'tm_iddistribuidor' => (trim($row['DISTRIBUIDOR']) == '') ? null : trim($row['DISTRIBUIDOR']),
                    'tm_nombredistribuidor' => (trim($row['NOMBREDISTRIBUIDOR']) == '') ? null : trim($row['NOMBREDISTRIBUIDOR']),
                    'tm_codigoscl' => (trim($row['CODIGOSCL']) == '') ? null : trim($row['CODIGOSCL']),
                    'tm_inventarioanteriorfuente' => (trim($row['INVENTARIOANTERIORFUENTE']) == '') ? null : trim($row['INVENTARIOANTERIORFUENTE']),
                    'tm_inventarioactualfuente' => (trim($row['INVENTARIOACTUALFUENTE']) == '') ? null : trim($row['INVENTARIOACTUALFUENTE']),
                    'tm_tiposim' => (trim($row['TIPOSIM']) == '') ? null : trim($row['TIPOSIM']),
                    'tm_icc' => (trim($row['ICC']) == '') ? null : trim($row['ICC']),
                    'tm_min' => (trim($row['MIN']) == '') ? null : trim($row['MIN']),
                    'tm_estado' => (trim($row['ESTADO']) == '') ? null : trim($row['ESTADO']),
                    'tm_iddestino' => (trim($row['IDDESTINO']) == '') ? null : trim($row['IDDESTINO']),
                    'tm_nombredestino' => (trim($row['NOMBREDESTINO']) == '') ? null : trim($row['NOMBREDESTINO']),
                    'tm_inventarioanteriordestino' => (trim($row['INVENTARIOANTERIORDESTINO']) == '') ? null : trim($row['INVENTARIOANTERIORDESTINO']),
                    'tm_inventarioactualdestino' => (trim($row['INVENTARIOACTUALDESTINO']) == '') ? null : trim($row['INVENTARIOACTUALDESTINO']),
                    'tm_canal' => (trim($row['CANAL']) == '') ? null : trim($row['CANAL']),
                    'tm_numero_lote' => (trim($row['LOTE']) == '') ? null : trim($row['LOTE']),
                    'tm_zona' => (trim($row['ZONA']) == '') ? null : trim($row['ZONA']),
                    'tm_fecha_ingreso' => date(FORMATO_FECHA_LONG),
                    'tm_fecha_modifica' => date(FORMATO_FECHA_LONG),
                    'tm_usuario_ingresa_modifica' => Yii::app()->user->id
                );

                array_push($datosTransferenciasMovistar, $data);
                unset($data);
            } else {
//                $_SESSION['cantidadVentasDuplicados'] += 1;
                Yii::app()->session['cantidadTransferenciasDuplicados'] += 1;
                array_push($datosChipsRepetidos, $row['ICC']);
            }
        }
//        if (count($datosChipsRepetidos))
//            var_dump($datosChipsRepetidos);die();

//        $_SESSION['chipsDuplicados'] = $datosChipsRepetidos;
//        $_SESSION['chipsActualizados'] = $datosChipsActualizados;
        Yii::app()->session['chipsDuplicados'] = $datosChipsRepetidos;
        Yii::app()->session['chipsActualizados'] = $datosChipsActualizados;

        $datos['transferenciasMovistar'] = $datosTransferenciasMovistar;
        $datos['minesActualizados'] = $datosChipsActualizados;
//        $datos['clientesRepetidos'] = $clientesRepetidos;
//        var_dump($datos['ordenesmb']);        die();
//        var_dump($datos['ventasMovistar']);        die();
        return $datos;
    }

    public function actionVerDatosArchivo() {
//        var_dump($_SESSION['ventasMovistarItems']);        die();
        if (!Yii::app()->request->isAjaxRequest) {
            $error['message'] = Yii::app()->params['msjErrorAccesoPag'];
            $error['code'] = Yii::app()->params['codErrorAccesoPag'];
            $this->render(Yii::app()->params['pagError'], $error);
        }

        $response = new Response();
        try {
//            if (isset($_SESSION['ventasMovistarItems'])) {
//            $response->Result = $_SESSION['ventasMovistarItems'];
            $response->Result = Yii::app()->session['transferenciasMovistarItems'];
//            unset(Yii::app()->session['transferenciasMovistarItems']);
//            }
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
