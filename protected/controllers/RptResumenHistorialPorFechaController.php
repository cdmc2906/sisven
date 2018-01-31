<?php

/**
 * Description
 * @fecha 
 * @author 
 */
class RptResumenHistorialPorFechaController extends Controller {

    public $layout = LAYOUT_FILTRO_GRID;

    public function actionIndex() {
        if (Yii::app()->request->isAjaxRequest) {
            return;
        } else {
            $model = new RptResumenHistorialPorFechaForm();
            $this->render('/reportes/rptResumenHistorialPorFecha', array('model' => $model));
        }
    }

    public function actionGenerarReporte() {
        $response = new Response();
        try {
            $model = new RptResumenHistorialPorFechaForm();
            unset(Yii::app()->session['fechasRevisadas']);
            unset(Yii::app()->session['reporteConPrecision']);
            unset(Yii::app()->session['reporteSinPrecision']);
            unset(Yii::app()->session['precision']);
            unset(Yii::app()->session['ejecutivo']);
            unset(Yii::app()->session['fechaInicio']);
            unset(Yii::app()->session['fechaFin']);
            if (isset($_POST['RptResumenHistorialPorFechaForm'])) {
                $model->attributes = $_POST['RptResumenHistorialPorFechaForm'];
//                var_dump($model->attributes);die();
                if ($model->validate()) {
                    $datosRevisiones = array();
                    $fechasRevisadas = array();
                    $parametrosAlmacenados = array();
                    $reporteConPrecision = array();
                    $fila = array();
                    $valoresHistorial = '';
                    $libreria = new Libreria();
                    $fHistorial = new FHistorialModel();


                    $date1 = new DateTime($model->fechaInicioGestion);
                    $date2 = new DateTime($model->fechaFinGestion);
                    $diff = $date1->diff($date2);

                    if ($diff->days <= MAXIMO_DIAS_REPORTE_HISTORIAL) {

                        $fResumenHistorial = new FResumenDiarioHistorialModel();
                        $datosRevisiones = $fResumenHistorial->getDatosRevisionesEjecutivo(
                                $model->fechaInicioGestion
                                , $model->fechaFinGestion
                                , $model->ejecutivo);

                        foreach ($datosRevisiones as $item) {
//                            if ($item['tipo'] == 1)
                            array_push($fechasRevisadas, $item["fecha_gestion"]);
//                            else if ($item['tipo'] == 2)
//                                array_push($parametrosAlmacenados, $item["indicador"]);
                        }
//                        var_dump($fechasRevisadas);die();
                        $datosResumenGrid = array();

                        $reporteConPrecision = array();
                        foreach ($fechasRevisadas as $fechaGestion) {
                            $cantidadEventosHistorial = $fHistorial->getCantidadClientesVisitadosxEjecutivoxFecha($model->ejecutivo, $fechaGestion);
                            if (intval($cantidadEventosHistorial)) {
                                $libreriaA = $libreria->VerificarHistorialDiarioUsuario(
                                        $model->ejecutivo
                                        , $fechaGestion
                                        , $model->accionHistorial
                                        , $model->horaInicioGestion
                                        , $model->horaFinGestion
                                        , $model->precisionVisitas);
//                                var_dump(Yii::app()->session['resumenGestionDiaria']);die();
                                $datosResumenGrid = Yii::app()->session['resumenGestionDiaria'];
//                                var_dump($datosResumenGrid);                                die();
                                array_push($reporteConPrecision, $datosResumenGrid);
                                unset($datosResumenGrid);
                            }
                        }

                        $reporteSinPrecision = array();
//                        var_dump($model->precisionVisitas);                        die();
                        if (intval($model->precisionVisitas) > 0) {
                            foreach ($fechasRevisadas as $fechaGestion) {
                                $cantidadEventosHistorial = $fHistorial->getCantidadClientesVisitadosxEjecutivoxFecha($model->ejecutivo, $fechaGestion);
                                if (intval($cantidadEventosHistorial)) {
                                    $libreriaA = $libreria->VerificarHistorialDiarioUsuario(
                                            $model->ejecutivo
                                            , $fechaGestion
                                            , $model->accionHistorial
                                            , $model->horaInicioGestion
                                            , $model->horaFinGestion
                                            , 0);
                                    $datosResumenGrid = Yii::app()->session['resumenGestionDiaria'];
                                    array_push($reporteSinPrecision, $datosResumenGrid);
                                    unset($datosResumenGrid);
                                }
                            }
                        }
//                        var_dump($reporteConPrecision);die();   
                        Yii::app()->session['fechasRevisadas'] = $fechasRevisadas;
                        Yii::app()->session['reporteConPrecision'] = $reporteConPrecision;
                        Yii::app()->session['reporteSinPrecision'] = $reporteSinPrecision;
//                        echo '<script>var reporteGenerado = \'true\';</script>';
                        Yii::app()->session['precision'] = $model->precisionVisitas;
                        Yii::app()->session['ejecutivo'] = $model->ejecutivo;
                        Yii::app()->session['fechaInicio'] = $model->fechaInicioGestion;
                        Yii::app()->session['fechaFin'] = $model->fechaFinGestion;
                        $response->Message = "Reporte generado correctamente";
                        $response->ClassMessage = CLASS_MENSAJE_SUCCESS;
                    } else {
                        $response->Message = "Debe seleccionar un rango de fechas menor o igual a " . MAXIMO_DIAS_REPORTE_HISTORIAL . " dias de diferencia";
                        $response->ClassMessage = CLASS_MENSAJE_NOTICE;
                    }
                } else {
                    $response->Message = "Debe seleccionar todos los filtros";
                    $response->ClassMessage = CLASS_MENSAJE_NOTICE;
//                $response->Result = $datos; // $datosGrid;
                }
            }
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

    public function actionRevisarHabilitarExportarExcel() {
        $response = new Response();
        $reporteConPrecision = Yii::app()->session['reporteConPrecision'];
        if (count($reporteConPrecision) > 0)
            $data = 1;
        else
            $data = 0;

        $response->Result = $data;
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

    public function actionGenerateExcel() {
        $response = new Response();
        try {
            $fechasRevisadas = Yii::app()->session['fechasRevisadas'];
            $reporteConPrecision = Yii::app()->session['reporteConPrecision'];
            $reporteSinPrecision = Yii::app()->session['reporteSinPrecision'];

            $ejecutivo = Yii::app()->session['ejecutivo'];
            $precisionVisitas = Yii::app()->session['precision'];
            $fechaInicioGestion = Yii::app()->session['fechaInicio'];
            $fechaFinGestion = Yii::app()->session['fechaFin'];
//            var_dump(count($reporteConPrecision));            die();
            if (count($reporteConPrecision) > 0) {
                $NombreArchivo = "resumen_Historial_Ejecutivo";
                $NombreHoja = "resumen_Historial_Ejecutivo";

                $autor = "Tececab"; //$_SESSION['CUENTA'];
                $titulo = "resumenHistorialEjecutivo";
                $tema = "Reporte Tececab";
                $keywords = "office 2007";

                $excel = new excel();
                $encabezadoImprimir = 'RESUMEN SEMANAL DEL' . $fechaInicioGestion . ' AL  ' . $fechaFinGestion . ' - ' . $ejecutivo;
                $footerImprimir = Yii::app()->user->name . ' - ' . date('Y/m/d h:i A');
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
                $excel->MapeoCustomizadoHistorial($fechasRevisadas, COLUMNAS_RESUMEN_HISTORIAL, $reporteConPrecision, $reporteSinPrecision, $precisionVisitas, $ejecutivo, $encabezadoImprimir, $footerImprimir);
                $excel->CrearArchivo('Excel2007', $NombreArchivo);
                $excel->GuardarArchivo();
            } else {
                $response->Message = 'Debe generar el reporte';
                $response->Status = ERROR;
            }
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
