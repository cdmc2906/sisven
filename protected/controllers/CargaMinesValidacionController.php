<?php

/**
 * Description
 * @fecha 
 * @author 
 */
class CargaMinesValidacionController extends Controller {

    public $layout = LAYOUT_IMPORTAR;

    public function actionIndex() {
        if (Yii::app()->request->isAjaxRequest) {
            return;
        } else {
            unset(Yii::app()->session['minesValidacion']);
            unset(Yii::app()->session['minesReasignados']);
            unset(Yii::app()->session['minesReprocesados']);
            unset(Yii::app()->session['minesOmitidos']);
            unset(Yii::app()->session['filasArchivo']);

            $model = new CargaMinesValidacionForm ();
            $this->render('/carga/cargaMinesValidacion', array('model' => $model));
        }
    }

    public function actionSubirArchivo() {
        $response = new Response();
        try {
            $model = new CargaMinesValidacionForm();
            $minesValidacion = array();

            Yii::app()->session['minesReasignados'] = 0;
            Yii::app()->session['minesReprocesados'] = 0;
            Yii::app()->session['minesOmitidos'] = 0;
            Yii::app()->session['filasArchivo'] = 0;

            if (isset($_POST['CargaMinesValidacionForm'])) {
                $model->attributes = $_POST['CargaMinesValidacionForm'];
                if ($model->validate()) {
                    $filePath = Yii::app()->params['archivosMinesValidacion'];
                    $model->rutaArchivo = CUploadedFile::getInstance($model, 'rutaArchivo');
                    $model->rutaArchivo->saveAs($filePath);
                    Yii::app()->session['FileMinesValidacion'] = $filePath;
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
                                $minesValidacion = array_merge($minesValidacion, $dataInsert);
                                unset($dataInsert);
                            }
                            $numeroBloque ++;
                        }
                        Yii::app()->session['minesValidacion'] = $minesValidacion;
                    } else {
                        $response->Message = 'El archivo no contiene registros';
                        $response->Status = NOTICE;
                    }
                } else {
                    $response->Message = 'Debe seleccionar el archivo y el separador de columnas';
                    $response->Status = NOTICE;
                }
            }
        } catch (Exception $e) {
            $response->Message = Yii::app()->params['mensajeExcepcion'];
            $response->Status = ERROR;
            $response->ClassMessage = CLASS_MENSAJE_ERROR;
        }

        $this->render('/carga/cargaMinesValidacion', array('model' => $model));
        return;
    }

    private function getDatosMostrar($file, $start, $blockSize) {
        $dataInsert = array();
        $dataFile = $file->getDatosMinesValidacion($start, $blockSize);

        foreach ($dataFile as $row) {
            $fUsuarios = new FUsuarioCrugeModel();
            $data = array(
                'FECHA' => ($row['FECHA'] == '') ? null : $row['FECHA'],
                'BODEGA' => ($row['BODEGA'] == '') ? null : $row['BODEGA'],
                'NOMBRE_CLIENTE' => ($row['NOMBRE_CLIENTE'] == '') ? null : $row['NOMBRE_CLIENTE'],
                'CODIGO_GRUPO' => ($row['CODIGO_GRUPO'] == '') ? null : $row['CODIGO_GRUPO'],
                'DETALLE' => ($row['DETALLE'] == '') ? null : $row['DETALLE'],
                'IMEI' => ($row['IMEI'] == '') ? null : $row['IMEI'],
                'MIN' => ($row['MIN'] == '') ? null : $row['MIN'],
                'VENDEDOR' => ($row['VENDEDOR'] == '') ? null : $row['VENDEDOR'],
                'USUARIOASGINADO' => ($row['USUARIOASGINADO'] == '') ? null : $row['USUARIOASGINADO'],
//                'USUARIOASGINADO' => $nombreUsuario,
            );
            array_push($dataInsert, $data);
            unset($data);
        }

        Yii::app()->session['filasArchivo'] = count($dataInsert);
//var_dump(count($dataInsert));die();
//        var_dump($dataInsert);die();
        return $dataInsert;
    }

    public function actionGuardarMinesValidacion() {
        $response = new Response();
        try {
            if (isset(Yii::app()->session['FileMinesValidacion'])) {
                Yii::app()->session['minesValidacionDuplicados'] = 0;
                Yii::app()->session['minesReasignados'] = 0;
                Yii::app()->session['minesReprocesados'] = 0;
                Yii::app()->session['minesOmitidos'] = 0;
                $filePath = Yii::app()->session['FileMinesValidacion'];

                $operation = "r";
                $delimiter = Yii::app()->session['ModelForm']["delimitadorColumnas"]; //';';;

                $file = new File($filePath, $operation, $delimiter);
                $totalRows = $file->getTotalFilas();

                $totalMinesValidacionGuardados = 0;
                $totalMinesValidacionNoGuardados = 0;
                $totalMinesValidacionReasignados = 0;
                $totalMinesValidacionReprocesados = 0;
                $totalMinesValidacionOmitidos = 0;
                $fMinesRevision = new FMinesRevisionModel();
//                var_dump($totalRows);                die();
                if ($totalRows > 0) {

                    $fCargasInformacionRevision = new FCargasInformacionModel();
                    $numeroCargaNueva = 0;
                    $numeroCargaNueva = isset($fCargasInformacionRevision->getNumeroUltimaCarga()[0]['ultimacarga']) ? intval($fMinesRevision->getNumeroUltimaCarga()[0]['ultimacarga']) + 1 : 1;

                    $dataInsertarCarga = $this->getDatosGuardarCarga($numeroCargaNueva);
                    if (count($dataInsertarCarga) > 0) {
                        $dbConnection = new CI_DB_active_record(null);
                        $sql = $dbConnection->insert_batch('tb_carga_informacion_revision', $dataInsertarCarga);
                        $sql = str_replace('"', '', $sql);

                        $connection = Yii::app()->db_conn;
                        $connection->active = true;
                        $transaction = $connection->beginTransaction();
                        $command = $connection->createCommand($sql);
                        $countInsert = $command->execute();

                        if ($countInsert > 0) {
                            $transaction->commit();
//                            $totalMinesValidacionGuardados = $totalMinesValidacionGuardados + $countInsert;
                        } else {
                            $transaction->rollback();
//                            $totalMinesValidacionNoGuardados = $totalMinesValidacionNoGuardados + $countInsert;
                        }
                        unset($datosIndicadores);
                        $connection->active = false;
                    }

                    $totalBloques = ceil($totalRows / TAMANIO_BLOQUE);
                    $numeroBloque = 1;
                    $tamanioBloque = TAMANIO_BLOQUE;

                    while ($numeroBloque <= intval($totalBloques)) {
                        $file = new File($filePath, $operation, $delimiter);
                        $registroInicio = (($numeroBloque - 1) * $tamanioBloque) + 1;


                        $dataInsertar = $this->getDatosGuardar($file, $registroInicio, $tamanioBloque, $numeroCargaNueva);
//                        var_dump(Yii::app()->session['minesReprocesados']);die();
//                         var_dump($dataInsertar);                        die();
                        if (isset(Yii::app()->session['minesReasignados'])) {
                            $totalMinesValidacionReasignados = $totalMinesValidacionReasignados + Yii::app()->session['minesReasignados'];
                        }
//                        var_dump(Yii::app()->session['minesReprocesados']);die();
//                        var_dump(isset(Yii::app()->session['minesReprocesados']));die();
                        if (isset(Yii::app()->session['minesReprocesados'])) {
                            $totalMinesValidacionReprocesados = $totalMinesValidacionReprocesados + Yii::app()->session['minesReprocesados'];
                        }
//                        var_dump($totalMinesValidacionReprocesados );die();
                        if (isset(Yii::app()->session['minesOmitidos'])) {
                            $totalMinesValidacionOmitidos = $totalMinesValidacionOmitidos + Yii::app()->session['minesOmitidos'];
                        }

                        if (count($dataInsertar) > 0) {
                            $dbConnection = new CI_DB_active_record(null);
                            $sql = $dbConnection->insert_batch('tb_mines_validacion', $dataInsertar);
                            $sql = str_replace('"', '', $sql);

                            $connection = Yii::app()->db_conn;
                            $connection->active = true;
                            $transaction = $connection->beginTransaction();
                            $command = $connection->createCommand($sql);
                            $countInsert = $command->execute();

                            if ($countInsert > 0) {
                                $transaction->commit();
                                $totalMinesValidacionGuardados = $totalMinesValidacionGuardados + $countInsert;
                            } else {
                                $transaction->rollback();
                                $totalMinesValidacionNoGuardados = $totalMinesValidacionNoGuardados + $countInsert;
                            }
                            unset($datosIndicadores);
                            $connection->active = false;
                        }

                        $numeroBloque ++;
                    }

                    $response->Message = '<br> Registros guardados: ' . $totalMinesValidacionGuardados .
                            '<br> Registros reasignados: ' . $totalMinesValidacionReasignados .
                            '<br> Registros para reproceso: ' . $totalMinesValidacionReprocesados .
                            '<br> Registros omitidos reasignacion: ' . $totalMinesValidacionOmitidos .
                            '<br> Registros no guardados: ' . $totalMinesValidacionNoGuardados;
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

    private function getDatosGuardarCarga($numeroCarga) {
        $datosCarga = array();
        array_push($datosCarga, array(
            'cir_codigo' => $numeroCarga,
            'cir_nombre' => 'CARGA ' . $numeroCarga . ' MINES VALIDACION',
            'cir_registros_cargados' => Yii::app()->session['filasArchivo'],
            'cir_fecha_inicio' => date(FORMATO_FECHA_LONG),
            'cir_fecha_fin' => date(FORMATO_FECHA_LONG),
            'cir_estado' => 10, //ESTADO INICIADO
            'cir_tipo' => 'VALIDACION MINES',
            'cir_fecha_ingreso' => date(FORMATO_FECHA_LONG),
            'cir_fecha_modifica' => date(FORMATO_FECHA_LONG),
            'cir_cod_usuario_ing_mod' => Yii::app()->user->id,
        ));
        $datos = $datosCarga;
        return $datos;
    }

    private function getDatosGuardar($file, $start, $blockSize, $cargaActual) {
        $datos = array();
        $datosMinesValidacion = array();
        $minesValidacionRepetidos = array();
//                        var_dump('bbb');die();
        $dataFile = $file->getDatosMinesValidacion($start, $blockSize);
        foreach ($dataFile as $row) {
            $minExiste = MinesValidacionModel::model()->findByAttributes(array('miva_imei' => $row['IMEI']));
//                                    var_dump($minExiste);die();
            if (isset($minExiste)) {
                if ($minExiste['miva_estado'] == 8) { //no reasignar los ya gestionados                                    
                    //verifica que el min no este reasignado antes
                    if ($minExiste['miva_estado_reasignacion'] == 0) {

                        if ($minExiste['iduser'] != $row['USUARIOASGINADO']) {
                            $minExiste["miva_estado_reasignacion"] = 1;
                            $minExiste["miva_usario_reasignado"] = $minExiste["iduser"];
                            $minExiste["iduser"] = ($row['USUARIOASGINADO'] == '') ? null : $row['USUARIOASGINADO'];
                            $minExiste["miva_fecha_modifica"] = date(FORMATO_FECHA_LONG);
                            $minExiste["miva_cod_usuario_ing_mod"] = Yii::app()->user->id;

                            if ($minExiste->save()) {
                                Yii::app()->session['minesReasignados'] += 1;
                            }
                        } else
                            Yii::app()->session['minesOmitidos'] += 1;
                    } else {
                        Yii::app()->session['minesOmitidos'] += 1;
                    }
                } else if ($minExiste['miva_estado'] == 9) {

                    $fRevisionMines = new FRevisionMinesModel();
                    $gestionAnterior = $fRevisionMines->getUltimaGestionxIcc($minExiste['miva_imei']);

                    if ($minExiste['miva_estado_reasignacion'] == 0 && $minExiste['iduser'] != $row['USUARIOASGINADO']) {
                        $minExiste["miva_estado_reasignacion"] = 1;
                        $minExiste["miva_usario_reasignado"] = $minExiste["iduser"];
                        $minExiste["iduser"] = ($row['USUARIOASGINADO'] == '') ? null : $row['USUARIOASGINADO'];
                    }
                    if ($gestionAnterior[0]['rmva_estado_revision'] == 'Inactivo') {
                        $minExiste["miva_estado"] = 13;
                        $minExiste["miva_fecha_modifica"] = date(FORMATO_FECHA_LONG);
                        $minExiste["miva_cod_usuario_ing_mod"] = Yii::app()->user->id;

                        if ($minExiste->save()) {
                            Yii::app()->session['minesReprocesados'] += 1;
                        }
                    }
                }
            } else {
                $exisArray = false;
                foreach ($datosMinesValidacion as $item) {
                    $exisArray = in_array($row['IMEI'], $item);
                    if ($exisArray)
                        break;
                }
                if (!$exisArray) {
                    $fechaMinesValidacion = DateTime::createFromFormat('d/m/Y', $row['FECHA']);
                    $sfechaMinesValidacion = $fechaMinesValidacion->format(FORMATO_FECHA_LONG);

                    $data = array(
                        'miva_fecha' => ($row['FECHA'] == '') ? null : $sfechaMinesValidacion,
                        'cir_id' => $cargaActual,
                        'miva_carga' => $cargaActual,
                        'miva_tipo' => 'MINES VALLAS',
                        'miva_bodega' => ($row['BODEGA'] == '') ? null : $row['BODEGA'],
                        'miva_nomcli' => ($row['NOMBRE_CLIENTE'] == '') ? null : $row['NOMBRE_CLIENTE'],
                        'miva_codgrup' => ($row['CODIGO_GRUPO'] == '') ? null : $row['CODIGO_GRUPO'],
                        'miva_detalle' => ($row['DETALLE'] == '') ? null : $row['DETALLE'],
                        'miva_imei' => ($row['IMEI'] == '') ? null : $row['IMEI'],
                        'miva_min' => ($row['MIN'] == '') ? null : $row['MIN'],
                        'miva_vendedor' => ($row['VENDEDOR'] == '') ? null : $row['VENDEDOR'],
                        'miva_estado' => 8, //estado cargado
                        'miva_estado_reasignacion' => 0, //sin reasignacion
                        'miva_usario_reasignado' => '',
                        'miva_fecha_ingreso' => date(FORMATO_FECHA_LONG),
                        'miva_fecha_modifica' => date(FORMATO_FECHA_LONG),
                        'iduser' => ($row['USUARIOASGINADO'] == '') ? null : $row['USUARIOASGINADO'],
                        'miva_cod_usuario_ing_mod' => Yii::app()->user->id,
                    );

                    array_push($datosMinesValidacion, $data);
                    unset($data);
                }
            }
        }
        $datos = $datosMinesValidacion;
//        var_dump($datos);die();
        return $datos;
    }

    public function actionVerDatosArchivo() {
//        var_dump('2');die();
        if (!Yii::app()->request->isAjaxRequest) {
            $error['message'] = Yii::app()->params['msjErrorAccesoPag'];
            $error['code'] = Yii::app()->params['codErrorAccesoPag'];
            $this->render(Yii::app()->params['pagError'], $error);
        }


        $response = new Response();
        try {
//            $response->Result = $_SESSION['indicadorItems'];
            $response->Result = Yii::app()->session['minesValidacion'];
//            var_dump($_SESSION['indicadorItems'], $response->Result); die();
//            var_dump($response->Result);die();
//            unset($_SESSION['indicadorItems']);
            unset(Yii::app()->session['minesValidacion']);
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
