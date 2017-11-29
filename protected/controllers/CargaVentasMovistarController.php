<?php

/**
 * Description
 * @fecha 
 * @author 
 */
class CargaVentasMovistarController extends Controller {

    public function actionIndex() {
        if (Yii::app()->request->isAjaxRequest) {
            return;
        } else {
//            unset($_SESSION['ventasMovistarItems']);
            unset(Yii::app()->session['ventasMovistarItems']);
            $model = new CargaVentasMovistarForm();
            $this->render('/carga/cargaVentasMovistar', array('model' => $model));
        }
    }

    public function actionSubirArchivo() {
        $response = new Response();
        try {
//            $_SESSION['cantidadVentasDuplicados'] = 0;
//            $_SESSION['cantidadVentasActualizadas'] = 0;
            Yii::app()->session['cantidadVentasDuplicados'] = 0;
            Yii::app()->session['cantidadVentasActualizadas'] = 0;

            $model = new CargaVentasMovistarForm();
            $ventasMovistar = array();
            if (isset($_POST['CargaVentasMovistarForm'])) {
                $model->attributes = $_POST['CargaVentasMovistarForm'];
                if ($model->validate()) {
//                    unset($_SESSION['ventasMovistarItems']);
                    $filePath = Yii::app()->params['archivosVentasMovistar'];
                    $model->rutaArchivo = CUploadedFile::getInstance($model, 'rutaArchivo');
                    $model->rutaArchivo->saveAs($filePath);
//                    $_SESSION['archivosVentasMovistar'] = $filePath;
//                    $_SESSION['ModelForm'] = $model;
                    Yii::app()->session['archivosVentasMovistar'] = $filePath;
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
                                $ventasMovistar = array_merge($ventasMovistar, $dataInsert);
                                unset($dataInsert);
                            }
                            $numeroBloque ++;
                        }
//                        var_dump($ventasMovistar);                        die();
//                        $_SESSION['ventasMovistarItems'] = $ventasMovistar;
                        Yii::app()->session['ventasMovistarItems'] = $ventasMovistar;
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
        $this->render('/carga/cargaVentasMovistar', array('model' => $model));
        return;
    }

    private function getDatosMostrar($file, $start, $blockSize) {
        $datosMostar = array();
        $dataFile = $file->getDatosVentasMovistar($start, $blockSize);
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

    public function actionGuardarVentasMovistar() {
        $response = new Response();
        $ventasMovistar = '';
//        var_dump($_SESSION['ventasMovistarItems']);        die();
        try {
//            if (isset($_SESSION['archivosVentasMovistar'])) {
            if (isset(Yii::app()->session['archivosVentasMovistar'])) {
//                $filePath = $_SESSION['archivosVentasMovistar'];
                $filePath = Yii::app()->session['archivosVentasMovistar'];
//                var_dump($_SESSION['ModelForm']["delimitadorColumnas"]);die();
//                var_dump($filePath);die();

                $operation = "r";
//                $delimiter = $_SESSION['ModelForm']["delimitadorColumnas"]; //';';
                $delimiter = Yii::app()->session['ModelForm']["delimitadorColumnas"]; //';';
//                var_dump($filePath);die();
                $file = new File($filePath, $operation, $delimiter);
//                var_dump($file);                die();
                $totalRows = $file->getTotalFilas();
                $totalVentasGuardadas = 0;
                $totalVentasNoGuardados = 0;

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
                        $datosVentasMovistar = $dataInsertar['ventasMovistar'];
//                        $datosChipsDuplicados = $dataInsertar['chipsDuplicados'];
//                        var_dump($datosChipsDuplicados);                        die();
//                        var_dump($datosVentasMovistar);                        die();
                        if (count($datosVentasMovistar) > 0) {
                            $dbConnection = new CI_DB_active_record(null);
                            $sql = $dbConnection->insert_batch('tb_venta_movistar', $datosVentasMovistar);
                            $sql = str_replace('"', '', $sql);
                            $connection = Yii::app()->db_conn;
                            $connection->active = true;
                            $transaction = $connection->beginTransaction();
                            $command = $connection->createCommand($sql);
                            $countInsert = $command->execute();

                            if ($countInsert > 0) {
                                $transaction->commit();
                                $totalVentasGuardadas = $totalVentasGuardadas + $countInsert;
                            } else {
                                $transaction->rollback();
                                $totalVentasNoGuardados = $totalVentasNoGuardados + $countInsert;
                            }
                            unset($datosVentasMovistar);
                            $connection->active = false;
                        }
                        $numeroBloque ++;
                    }

                    if ($totalVentasNoGuardados > 0) {
                        $response->Message = 'Se produjo un error en la carga del archivo';
                        $response->ClassMessage = CLASS_MENSAJE_ERROR;
                    } else {
//                        var_dump($_SESSION);                        die();

                        $mensaje = 'Se han cargado ' . $totalVentasGuardadas . ' registros correctamente.';
//                        if ($_SESSION['cantidadVentasActualizadas'] > 0)
//                            $mensaje .= '<br> Se han actualizado ' . $_SESSION['cantidadVentasActualizadas'] . ' registros.';
//                        if ($_SESSION['cantidadVentasDuplicados'] > 0)
//                            $mensaje .= '<br> Se han omitido ' . $_SESSION['cantidadVentasDuplicados'] . ' registros duplicados en el archivo.';

                        if (Yii::app()->session['cantidadVentasActualizadas'] > 0)
                            $mensaje .= '<br> Se han actualizado ' . Yii::app()->session['cantidadVentasActualizadas'] . ' registros.';
                        if (Yii::app()->session['cantidadVentasDuplicados'] > 0)
                            $mensaje .= '<br> Se han omitido ' . Yii::app()->session['cantidadVentasDuplicados'] . ' registros duplicados en el archivo.';
                        $mensaje .= $response->Message = $mensaje;
                    }
//                    var_dump($_SESSION['chipsDuplicados']);
//                    var_dump($_SESSION['chipsDuplicados']);
//                    var_dump($mensaje);die();
                    if (isset($datosVentasMovistar['minesActualizados'])) {
                        $minesActualizados = $datosVentasMovistar['minesActualizados'];

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
        $datosVentasMovistar = array();
        $datosChipsRepetidos = array();
        $datosChipsActualizados = array();

        $archivoVentasMovistar = $file->getDatosVentasMovistar($start, $blockSize);
        foreach ($archivoVentasMovistar as $row) {
            $existeBdd = VentaMovistarModel::model()->findByAttributes(array('vm_icc' => trim($row['ICC'])));
            if ($existeBdd) {
                $existeBdd->delete();
//                $_SESSION['cantidadVentasActualizadas'] += 1;
                Yii::app()->session['cantidadVentasActualizadas'] += 1;
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
                    'vm_fecha' => (trim($row['FECHA']) == '') ? null : trim($row['FECHA']),
                    'vm_transaccion' => (trim($row['TRANSACCION']) == '') ? null : trim($row['TRANSACCION']),
                    'vm_distribuidor' => (trim($row['DISTRIBUIDOR']) == '') ? null : trim($row['DISTRIBUIDOR']),
                    'vm_nombredistribuidor' => (trim($row['NOMBREDISTRIBUIDOR']) == '') ? null : trim($row['NOMBREDISTRIBUIDOR']),
                    'vm_codigoscl' => (trim($row['CODIGOSCL']) == '') ? null : trim($row['CODIGOSCL']),
                    'vm_inventarioanteriorfuente' => (trim($row['INVENTARIOANTERIORFUENTE']) == '') ? null : trim($row['INVENTARIOANTERIORFUENTE']),
                    'vm_inventarioactualfuente' => (trim($row['INVENTARIOACTUALFUENTE']) == '') ? null : trim($row['INVENTARIOACTUALFUENTE']),
                    'vm_tiposim' => (trim($row['TIPOSIM']) == '') ? null : trim($row['TIPOSIM']),
                    'vm_icc' => (trim($row['ICC']) == '') ? null : trim($row['ICC']),
                    'vm_min' => (trim($row['MIN']) == '') ? null : trim($row['MIN']),
                    'vm_estado' => (trim($row['ESTADO']) == '') ? null : trim($row['ESTADO']),
                    'vm_iddestino' => (trim($row['IDDESTINO']) == '') ? null : trim($row['IDDESTINO']),
                    'vm_nombredestino' => (trim($row['NOMBREDESTINO']) == '') ? null : trim($row['NOMBREDESTINO']),
                    'vm_inventarioanteriordestino' => (trim($row['INVENTARIOANTERIORDESTINO']) == '') ? null : trim($row['INVENTARIOANTERIORDESTINO']),
                    'vm_inventarioactualdestino' => (trim($row['INVENTARIOACTUALDESTINO']) == '') ? null : trim($row['INVENTARIOACTUALDESTINO']),
                    'vm_canal' => (trim($row['CANAL']) == '') ? null : trim($row['CANAL']),
                    'vm_lote' => (trim($row['LOTE']) == '') ? null : trim($row['LOTE']),
                    'vm_zona' => (trim($row['ZONA']) == '') ? null : trim($row['ZONA']),
                    'vm_fecha_ingreso' => date(FORMATO_FECHA_LONG),
                    'vm_fecha_modificacion' => date(FORMATO_FECHA_LONG),
                    'vm_usuario_ingresa_modifica' => Yii::app()->user->id
                );

                array_push($datosVentasMovistar, $data);
                unset($data);
            } else {
//                $_SESSION['cantidadVentasDuplicados'] += 1;
                Yii::app()->session['cantidadVentasDuplicados'] += 1;
                array_push($datosChipsRepetidos, $row['ICC']);
            }
        }
//        if (count($datosChipsRepetidos))
//            var_dump($datosChipsRepetidos);die();

//        $_SESSION['chipsDuplicados'] = $datosChipsRepetidos;
//        $_SESSION['chipsActualizados'] = $datosChipsActualizados;
        Yii::app()->session['chipsDuplicados'] = $datosChipsRepetidos;
        Yii::app()->session['chipsActualizados'] = $datosChipsActualizados;

        $datos['ventasMovistar'] = $datosVentasMovistar;
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
            $response->Result = Yii::app()->session['ventasMovistarItems'];
//            unset($_SESSION['ventasMovistarItems']);
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
