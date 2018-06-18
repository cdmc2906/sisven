<?php

/**
 * Description
 * @fecha 
 * @author 
 */
class CargaHistorialMbController extends Controller {

    public $layout = LAYOUT_IMPORTAR;

    public function actionIndex() {
        if (Yii::app()->request->isAjaxRequest) {
            return;
        } else {
            unset(Yii::app()->session['historialMbItems']);
            $model = new CargaHistorialMbForm();
            $this->render('/carga/cargaHistorialMb', array('model' => $model));
        }
    }

    public function actionSubirArchivo() {

        Yii::app()->session['itemsFueraPeriodo'] = 0;
        $response = new Response();
        try {

            $model = new CargaHistorialMbForm();
            $historialMbItems = array();
            if (isset($_POST['CargaHistorialMbForm'])) {
                $model->attributes = $_POST['CargaHistorialMbForm'];

                if ($model->validate()) {
                    unset(Yii::app()->session['historialMbItems']);

                    $filePath = Yii::app()->params['archivosHistorialMb'];
                    $model->rutaArchivo = CUploadedFile::getInstance($model, 'rutaArchivo');
                    $model->rutaArchivo->saveAs($filePath);
                    Yii::app()->session['archivosHistorialMb'] = $filePath;
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
//                            var_dump($dataInsert);die();
                            if (count($dataInsert) > 0) {
                                $historialMbItems = array_merge($historialMbItems, $dataInsert);
                                unset($dataInsert);
                            }
                            $numeroBloque ++;
                        }
                        Yii::app()->session['historialMbItems'] = $historialMbItems;
                        if (Yii::app()->session['itemsFueraPeriodo'] > 0) {
                            Yii::app()->user->setFlash('resultadoHistorial', Yii::app()->session['itemsFueraPeriodo'] . ' registros se omitieron por estar fuera del periodo');
                        }
                    } else {
                        Yii::app()->user->setFlash('resultadoHistorial', 'El archivo no contiene registros');
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
        $this->render('/carga/cargaHistorialMb', array('model' => $model));
        return;
    }

    private function getDatosMostrar($file, $start, $blockSize) {
        $dataInsert = array();
        $dataFile = $file->getDatosHistorialMb($start, $blockSize);

        foreach ($dataFile as $row) {
//        var_dump($row['FECHA']);DIE();
            $date = DateTime::createFromFormat('d/m/Y H:i:s', $row['FECHA']);
            $dateString = $date->format(FORMATO_FECHA_LONG_4);
            if ($dateString >= Yii::app()->session['fechaInicioPeriodo'] && $dateString <= Yii::app()->session['fechaFinPeriodo']) {
                $data = array(
                    'ID' => ($row['ID'] == '') ? null : $row['ID'],
                    'FECHA' => ($row['FECHA'] == '') ? null : $row['FECHA'],
                    'USUARIO' => ($row['USUARIO'] == '') ? null : $row['USUARIO'],
                    'USUARIONOMBRE' => ($row['USUARIONOMBRE'] == '') ? null : $row['USUARIONOMBRE'],
                    'RUTA' => ($row['RUTA'] == '') ? null : $row['RUTA'],
                    'RUTANOMBRE' => ($row['RUTANOMBRE'] == '') ? null : $row['RUTANOMBRE'],
                    'SEMANA' => ($row['SEMANA'] == '') ? null : $row['SEMANA'],
                    'DIA' => ($row['DIA'] == '') ? null : $row['DIA'],
                    'CLIENTE' => ($row['CLIENTE'] == '') ? null : $row['CLIENTE'],
                    'CLIENTENOMBRE' => ($row['CLIENTENOMBRE'] == '') ? null : $row['CLIENTENOMBRE'],
                    'DIRECCION' => ($row['DIRECCION'] == '') ? null : $row['DIRECCION'],
                    'ACCION' => ($row['ACCION'] == '') ? null : $row['ACCION'],
                    'CODIGO' => ($row['CODIGO'] == '') ? null : $row['CODIGO'],
                    'CODIGOCOMENTARIO' => ($row['CODIGOCOMENTARIO'] == '') ? null : $row['CODIGOCOMENTARIO'],
                    'COMENTARIO' => ($row['COMENTARIO'] == '') ? null : $row['COMENTARIO'],
                    'MONTO' => ($row['MONTO'] == '') ? null : $row['MONTO'],
                    'LATITUD' => ($row['LATITUD'] == '') ? null : $row['LATITUD'],
                    'LONGITUD' => ($row['LONGITUD'] == '') ? null : $row['LONGITUD'],
                    'ROMPERSECUENCIA' => ($row['ROMPERSECUENCIA'] == '') ? null : $row['ROMPERSECUENCIA'],
                );
                array_push($dataInsert, $data);

                unset($data);
            } else {
                Yii::app()->session['itemsFueraPeriodo'] += 1;
            }
        }
        return $dataInsert;
    }

    public function actionGuardarHistorial() {
        $response = new Response();
        $DclientesRepetidos = '';
        $mensaje = '';
        try {
//            if (isset($_SESSION['archivosHistorialMb'])) {
            if (isset(Yii::app()->session['archivosHistorialMb'])) {
//                $filePath = $_SESSION['archivosHistorialMb'];
                $filePath = Yii::app()->session['archivosHistorialMb'];

                $operation = "r";
                $delimiter = Yii::app()->session['ModelForm']["delimitadorColumnas"]; //';';
                $file = new File($filePath, $operation, $delimiter);
                $totalRows = $file->getTotalFilas();

                $totalHistorialGuardados = 0;
                $totalHistorialNoGuardados = 0;

                if ($totalRows > 0) {
                    $totalBloques = ceil($totalRows / TAMANIO_BLOQUE);
                    $numeroBloque = 1;
                    $tamanioBloque = TAMANIO_BLOQUE;

                    while ($numeroBloque <= intval($totalBloques)) {
                        $file = new File($filePath, $operation, $delimiter);
                        $registroInicio = (($numeroBloque - 1) * $tamanioBloque) + 1;
                        $dataInsertar = $this->getDatosGuardar($file, $registroInicio, $tamanioBloque);
                        $datosHistorialMb = $dataInsertar['historialmb'];

                        if (count($datosHistorialMb) > 0) {
                            $dbConnection = new CI_DB_active_record(null);
                            
                            $sql = $dbConnection->insert_batch('tb_historial_mb', $datosHistorialMb);
//                            var_dump($sql);die();
                            $sql = str_replace('"', '', $sql);
                            
                            $connection = Yii::app()->db_conn;
                            $connection->active = true;
                            $transaction = $connection->beginTransaction();
                            $command = $connection->createCommand($sql);
                            $countInsert = $command->execute();

                            if ($countInsert > 0) {
                                $transaction->commit();
                                $totalHistorialGuardados = $totalHistorialGuardados + $countInsert;
                            } else {

                                $transaction->rollback();
                                $totalHistorialNoGuardados = $totalHistorialNoGuardados + $countInsert;
                            }
                            unset($datosHistorialMb);
                            $connection->active = false;
                        }
                        $numeroBloque ++;
                    }

                    if ($totalHistorialNoGuardados > 0) {
                        $mensaje = 'Se produjo un error en la carga del archivo';
                    } else {
                        if ($totalHistorialGuardados > 0)
                            $mensaje = 'Se han cargado ' . $totalHistorialGuardados . ' registros correctamente.';
                        if ($totalHistorialNoGuardados > 0)
                            $mensaje .= 'Existen ' . $totalHistorialNoGuardados . ' registros no guardados.';
                        unset(Yii::app()->session['archivosHistorialMb']);
                        unset(Yii::app()->session['ModelForm']);
                        unset(Yii::app()->session['historialMbItems']);
                        unset(Yii::app()->session['itemsFueraPeriodo']);
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
        $datosHistorial = array();
        $clientesRepetidos = array();

        Yii::app()->session['itemHistorialDuplicado'] = 0;
        $dataFile = $file->getDatosHistorialMb($start, $blockSize);
        // agregar 
        foreach ($dataFile as $row) {

            $date = DateTime::createFromFormat('d/m/Y H:i:s', $row['FECHA']);
            $dateString = $date->format(FORMATO_FECHA_LONG_4);

            if (
                    $dateString >= Yii::app()->session['fechaInicioPeriodo'] &&
                    $dateString <= Yii::app()->session['fechaFinPeriodo']) {
                $existeBdd = HistorialMbModel::model()->findByAttributes(array('h_id' => $row['ID']));
                if ($existeBdd) {
                    $existeBdd->delete();
                    Yii::app()->session['cantidadHistorialActualizados'] += 1;
                }
                $exisArray = false;

                foreach ($datosHistorial as $item) {
                    $exisArray = in_array($row['ID'], $item);
                    if ($exisArray)
                        break;
                }
                if (!$exisArray) {

                    $date = DateTime::createFromFormat('d/m/Y H:i:s', $row['FECHA']);
                    $dateString = $date->format(FORMATO_FECHA_LONG);

                    $data = array(
                        'h_id' => ($row['ID'] == '') ? null : $row['ID'],
                        'pg_id' => Yii::app()->session['idPeriodoAbierto'],
                        'h_fecha' => ($row['FECHA'] == '') ? null : $dateString,
                        'h_usuario' => ($row['USUARIO'] == '') ? null : $row['USUARIO'],
                        'h_usuario_nombre' => ($row['USUARIONOMBRE'] == '') ? null : $row['USUARIONOMBRE'],
                        'h_ruta' => ($row['RUTA'] == '') ? null : $row['RUTA'],
                        'h_ruta_nombre' => ($row['RUTANOMBRE'] == '') ? null : $row['RUTANOMBRE'],
                        'h_semana' => ($row['SEMANA'] == ''||$row['SEMANA'] == 'NULL'||$row['SEMANA'] == 'null') ? 0 : $row['SEMANA'],
                        'h_dia' => ($row['DIA'] == ''||$row['DIA'] == 'NULL'||$row['DIA'] == 'null') ? 0 : $row['DIA'],
                        'h_cod_cliente' => ($row['CLIENTE'] == '') ? null : $row['CLIENTE'],
                        'h_nom_cliente' => ($row['CLIENTENOMBRE'] == '') ? null : $row['CLIENTENOMBRE'],
                        'h_direccion' => ($row['DIRECCION'] == '') ? null : $row['DIRECCION'],
                        'h_accion' => ($row['ACCION'] == '') ? null : $row['ACCION'],
                        'h_cod_accion' => ($row['CODIGO'] == '') ? null : $row['CODIGO'],
                        'h_cod_comentario' => ($row['CODIGOCOMENTARIO'] == '') ? null : $row['CODIGOCOMENTARIO'],
                        'h_comentario' => ($row['COMENTARIO'] == '') ? null : $row['COMENTARIO'],
                        'h_monto' => ($row['MONTO'] == '') ? null : str_replace(',', '.', $row['MONTO']),
                        'h_latitud' => ($row['LATITUD'] == '') ? null : str_replace(',', '.', $row['LATITUD']),
                        'h_longitud' => ($row['LONGITUD'] == '') ? null : str_replace(',', '.', $row['LONGITUD']),
                        'h_romper_secuencia' => ($row['ROMPERSECUENCIA'] == '') ? null : $row['ROMPERSECUENCIA'],
                        'h_fch_ingreso' => date(FORMATO_FECHA_LONG),
                        'h_fch_modificacion' => date(FORMATO_FECHA_LONG),
                        'h_fch_desde' => date(FORMATO_FECHA_LONG),
                        'h_fch_hasta' => date(FORMATO_FECHA_LONG),
                        'h_usr_ing_mod' => Yii::app()->user->id
                    );

                    array_push($datosHistorial, $data);
                    unset($data);
                } else {
//                $_SESSION['itemHistorialDuplicado'] = $_SESSION['itemHistorialDuplicado'] + 1;
                    Yii::app()->session['itemHistorialDuplicado'] = Yii::app()->session['itemHistorialDuplicado'] + 1;
                }
            }
        }
        $datos['historialmb'] = $datosHistorial;
//                var_dump($datos);die();
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
            $response->Result = Yii::app()->session['historialMbItems'];
//            unset(Yii::app()->session['historialMbItems']);
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
