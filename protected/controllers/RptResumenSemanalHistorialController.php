<?php

/**
 * Description
 * @fecha 
 * @author 
 */
class RptResumenSemanalHistorialController extends Controller {

    public function actionIndex() {
        if (Yii::app()->request->isAjaxRequest) {
            return;
        } else {
            $_SESSION['ejecutivo'] = '';
            $model = new RptResumenSemanalHistorialForm();
            $this->render('/historialmb/rptResumenSemanalHistorial', array('model' => $model));
        }
    }

    public function weekOfMonth($date) {
        $firstOfMonth = date("Y-m-01", strtotime($date));
        return intval(date("W", strtotime($date))) - intval(date("W", strtotime($firstOfMonth))) + 1;
    }

    public function actionRevisarHistorial() {
        $datosSemanas = array();
        $itemsSemana1 = array();
        $itemsSemana2 = array();
        $itemsSemana3 = array();
        $itemsSemana4 = array();
        $itemsSemana5 = array();
        $response = new Response();
        try {
            $model = new RptResumenSemanalHistorialForm();
            if (isset($_POST['RptResumenSemanalHistorialForm'])) {
                $model->attributes = $_POST['RptResumenSemanalHistorialForm'];
                if ($model->validate()) {
//                    var_dump($model);                    die();
                    /* anio
                     * mes
                     * ejecutivo
                     */
                    $primerDiaMes = date("Y-m-01", strtotime($model->anio . '-' . $model->mes . '-01'));
                    $ultimoDiaMes = date("Y-m-t", strtotime($model->anio . '-' . $model->mes . '-01'));

//                    $primeraSemanaMes = $this->weekOfMonth($primerDiaMes);
                    $ultimaSemanaMes = $this->weekOfMonth($ultimoDiaMes);
//                    $semanasMes = $this->weekOfMonth($ultimoDiaMes) - $this->weekOfMonth($primerDiaMes);
                    $consultaItemResumenDiario = new FResumenDiarioHistorialModel();

//                    for ($semana = 1; $semana <= $ultimaSemanaMes; $semana++) {
                    $semana = 1;
                    {

                        $itemResumenDiario = $consultaItemResumenDiario->getItemResumenxVendedorxRangoFechaxSemana($primerDiaMes, $ultimoDiaMes, $model->ejecutivo, $semana);
//                        var_dump($itemResumenDiario);die();
//                        if (count($itemResumenDiario) > 0) {
                        {

//                            $datosSemanas["semana" . $semana] = $itemResumenDiario;
//                            $data = json_encode($itemResumenDiario, true);
                        }
                    }

//                    $data = json_decode(file_get_contents('FilmDataSet.json'), true);
//                    var_dump($datosSemanas);die();
//                    var_dump($primeraSemanaMes,$ultimaSemanaMes);die();
//                    var_dump($resumenesDiarios);                    die();
//                    var_dump($model->anio);                    die();
                }//fin model->validate

                $response->Message = "Historial revisado exitosamente";
                $response->Status = SUCCESS;
                $response->Result = $datosSemanas; // $datosGrid;
            }
        } catch (Exception $e) {
            $response->Message = Yii::app()->params['mensajeExcepcion'];
            $response->Status = ERROR;
            $response->ClassMessage = CLASS_MENSAJE_ERROR;
        }
        $this->actionResponse(null, null, $response);
        return;
    }

    public function actionGuardarHistorial() {
        $response = new Response();
        $datosResumenRevision = array();
        $datosDetalleRevision = array();
        $totalDetallesGuardados = 0;
        $totalDetallesOmitidos = 0;
        $totalResumenGuardados = 0;
        $totalResumenOmitidos = 0;

        try {
            if (isset($_SESSION['revisionhistorialitem'])) {
                $datosDetalleRevisionHistorial = $_SESSION['detallerevisionhistorialitem'];
                $datosResumenRevisionHistorial = $_SESSION['resumenrevisionhistorialitem'];
                if (count($datosDetalleRevisionHistorial) > 0) {
                    foreach ($datosDetalleRevisionHistorial as $row) {
                        $data = array(
                            //''rh_id' => ($row[''] == '') ? null : $row[''],
                            'rh_item' => 'HISTORIAL',
//                            'rh_fecha_item' => $sfechaItem,
                            'rh_fecha_item' => ($row['FECHARUTA'] == '') ? null : $row['FECHARUTA'],
                            'rh_fecha_revision' => ($row['FECHAREVISION'] == '') ? null : $row['FECHAREVISION'],
                            'rh_codigo_vendedor' => ($row['CODEJECUTIVO'] == '') ? null : $row['CODEJECUTIVO'],
                            'rh_cod_cliente' => ($row['CODIGOCLIENTE'] == '') ? null : $row['CODIGOCLIENTE'],
                            'rh_ruta_visita' => ($row['RUTAUSADA'] == '') ? null : $row['RUTAUSADA'],
                            'rh_orden_visita' => ($row['SECUENCIAVISITA'] == '') ? null : $row['SECUENCIAVISITA'],
                            'rh_ruta_ejecutivo' => ($row['RUTACLIENTE'] == '') ? null : $row['RUTACLIENTE'],
                            'rh_secuencia_ruta' => ($row['SECUENCIARUTA'] == '') ? null : $row['SECUENCIARUTA'],
                            'rh_observacion_ruta' => ($row['ESTADOREVISIONR'] == '') ? null : $row['ESTADOREVISIONR'],
                            'rh_observacion_secuencia' => ($row['ESTADOREVISIONS'] == '') ? null : $row['ESTADOREVISIONS'],
                            'rh_chips_compra' => ($row['CHIPSCOMPRADOS'] == '') ? null : $row['CHIPSCOMPRADOS'],
                            'rh_estado' => 'INGRESADO',
                            'rh_fecha_ingreso' => date(FORMATO_FECHA_LONG),
                            'rh_fecha_modificacion' => date(FORMATO_FECHA_LONG),
                            'rh_usuario_revisa' => Yii::app()->user->id
                        );
                        array_push($datosDetalleRevision, $data);
                        unset($data);
                    }// fin iteracion filas detalle revision
                    if (count($datosDetalleRevision) > 0) {
                        $dbConnection = new CI_DB_active_record(null);
                        $sql = $dbConnection->insert_batch('tb_control_historial_ruta', $datosDetalleRevision);
                        $sql = str_replace('"', '', $sql);
                        $connection = Yii::app()->db_conn;
                        $connection->active = true;
                        $transaction = $connection->beginTransaction();
                        $command = $connection->createCommand($sql);
                        $countInsert = $command->execute();
                        if ($countInsert > 0) {
                            $transaction->commit();
                            $totalDetallesGuardados += 1;
                        } else {
                            $transaction->rollback();
                            $totalDetallesOmitidos += 1;
                        }
                        unset($datosDetalleRevision);
                        $connection->active = false;
                    }

                    if (count($datosResumenRevisionHistorial) > 0) {
                        foreach ($datosResumenRevisionHistorial as $row) {
//                        var_dump($row);                        die();
                            $data = array(
                                //''rh_id' => ($row[''] == '') ? null : $row[''],
                                'rrh_cod_ejecutivo' => ($row['EJECUTIVO'] == '') ? null : $row['EJECUTIVO'],
                                'rrh_fecha_historial' => ($row['FECHA_HISTORIAL'] == null) ? '0001/01/01' : $row['FECHA_HISTORIAL'],
                                'rrh_parametro' => ($row['PARAMETRO'] == null) ? 0 : $row['PARAMETRO'],
                                'rrh_valor' => ($row['VALOR'] == null) ? 0 : $row['VALOR'],
                                'rrh_fecha_ingreso' => date(FORMATO_FECHA_LONG),
                                'rrh_fecha_modificacion' => date(FORMATO_FECHA_LONG),
                                'rrh_usuario_ingresa_modifica' => Yii::app()->user->id,
                            );
                            array_push($datosResumenRevision, $data);
                            unset($data);
                        }//fin iteracion filas resumen
                        if (count($datosResumenRevision) > 0) {
                            $dbConnection = new CI_DB_active_record(null);
                            $sql = $dbConnection->insert_batch('tb_resumen_historial', $datosResumenRevision);
                            $sql = str_replace('"', '', $sql);
                            $connection = Yii::app()->db_conn;
                            $connection->active = true;
                            $transaction = $connection->beginTransaction();
                            $command = $connection->createCommand($sql);
                            $countInsert = $command->execute();
                            if ($countInsert > 0) {
                                $transaction->commit();
                                $totalResumenGuardados += 1;
                            } else {
                                $transaction->rollback();
                                $totalResumenOmitidos += 1;
                            }
                            unset($datosResumenRevision);
                            $connection->active = false;
                        }
                    }//fin control numero de registros resumens



                    $response->Message = 'Se han cargado ' . $totalDetallesGuardados . ' registros detalles correctamente.\n';
                    $response->Message = 'Se han cargado ' . $totalResumenGuardados . ' registros resumen correctamente.';
                    $response->Message = '\n\nSe han omitido ' . $totalDetallesOmitidos . ' detalles y ' . $totalResumenOmitidos . ' resumen omitidos.';
                } else {
                    $response->Message = 'No existen registros para guardar';
                    $response->Status = NOTICE;
                }
            }
        } catch (Exception $e) {
            $response->Message = 'Se ha producido un error';
            $response->Status = ERROR;
            $response->ClassMessage = CLASS_MENSAJE_ERROR;
        }

        $this->actionResponse(null, null, $response);
        return;
    }

    public function actionVerDatosArchivo() {
//        if (!Yii::app()->request->isAjaxRequest) {
//            $error['message'] = Yii::app()->params['msjErrorAccesoPag'];
//            $error['code'] = Yii::app()->params['codErrorAccesoPag'];
//            $this->render(Yii::app()->params['pagError'], $error);
//        }
//
//        $response = new Response();
//        try {
//            $response->Result = $_SESSION['indicadorItems'];
//            unset($_SESSION['indicadorItems']);
//        } catch (Exception $e) {
//            $mensaje = array(
//                'code' => $e->getCode(),
//                'error' => $e->getMessage(),
//                'file' => $e->getFile(),
//                'line' => $e->getLine()
//            );
//
//            $response->Message = Yii::app()->params['mensajeExcepcion'];
//            $response->Status = ERROR;
//        }
//
//        $this->actionResponse(null, null, $response);
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

    public function actionGenerateExcel() {
        $response = new Response();
        try {
            $revisionRuta = array();
            $datos = $_SESSION['detallerevisionhistorialitem']; // $_SESSION['historialitem'];
            foreach ($datos as $value) {
                $dat = array(
                    'FECHAREVISION' => $value['FECHAREVISION'],
                    'FECHARUTA' => $value['FECHARUTA'],
                    'EJECUTIVO' => $value['EJECUTIVO'],
                    'CODIGOCLIENTE' => $value['CODIGOCLIENTE'],
                    'RUTAUSADA' => $value['RUTAUSADA'],
                    'SECUENCIAVISITA' => $value['SECUENCIAVISITA'],
                    'RUTACLIENTE' => $value['RUTACLIENTE'],
                    'SECUENCIARUTA' => $value['SECUENCIARUTA'],
                    'ESTADOREVISIONR' => $value['ESTADOREVISIONR'],
                    'ESTADOREVISIONS' => $value['ESTADOREVISIONS'],
                    'CHIPSCOMPRADOS' => $value['CHIPSCOMPRADOS'],
                );
                array_push($revisionRuta, $dat);
            }

            $NombreArchivo = "reporte_revision_ruta";
            $NombreHoja = "reporte_revision_ruta";

            $autor = "Tececab"; //$_SESSION['CUENTA'];
            $titulo = "reporte_revision_ruta";
            $tema = "reporte_revision_ruta";
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

            $excel->Mapeo($revisionRuta);

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

}
