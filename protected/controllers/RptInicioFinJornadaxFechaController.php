<?php

class RptInicioFinJornadaxFechaController extends Controller {

    public $layout = LAYOUT_FILTRO_GRID;

    public function actionIndex() {
        if (Yii::app()->request->isAjaxRequest) {
            return;
        } else {
            $model = new ReporteInicioFinJornadaxFechaForm();
            $this->render('/reportes/rptInicioFinJornadaxFecha', array('model' => $model));
        }
    }

    public function actionConsultarReporte() {
        $datosGrid = array();
        $datosGridJornada = array();
        $datosGridVisitas = array();
        $response = new Response();
        $solicitarLogin = true;
        $mensaje = '';
        try {
            $model = new ReporteInicioFinJornadaxFechaForm();
            if (isset($_POST['ReporteInicioFinJornadaxFechaForm'])) {
                $model->attributes = $_POST['ReporteInicioFinJornadaxFechaForm'];
                if ($model->validate()) {

//                    var_dump($model['tipoUsuario']);die();
                    $cEjecutivos = new FEjecutivoModel();
                    $reporteModel = new ReportesModel();
                    $fRuta = new FRutaModel();
                    $fHistorial = new FHistorialModel();
                    $fComentarioSupervisor = new FComentariosSupervisionModel();
                    $fComentarioOficina = new FComentariosOficinaModel();

                    $accion = 'Inicio Visita';
                    $ejecutivos = $cEjecutivos->getEjecutivosXGrupoXEstado($model['tipoUsuario'], 1);

                    foreach ($ejecutivos as $ejecutivo) {
                        $cResumenDiarioHistorialMB = new FResumenDiarioHistorialModel();
                        $inicioJornadaEjecutivo = $reporteModel->getInicioJornadaxFecha(
                                $ejecutivo['e_usr_mobilvendor']
                                , $model->fechaInicioFinJornadaInicio
                                , $model->horaInicioGestion
                                , $model->horaFinGestion
                        );

                        $finJornadaEjecutivo = $reporteModel->getFinJornadaxUsuarioxFecha(
                                $ejecutivo['e_usr_mobilvendor']
                                , $model->fechaInicioFinJornadaInicio
                                , $model->horaInicioGestion
                                , $model->horaFinGestion
                        );
                        $diaGestion = date("w", strtotime($model->fechaInicioFinJornadaInicio));
                        $ruta_dia_gestion = "R" . $diaGestion . '-' . $ejecutivo['e_iniciales'];
                        $comentarioDiaSupervisor = '';
                        $totalClientesRuta = $fRuta->getTotalClientesxRutaxEjecutivoxDia($ejecutivo['e_iniciales'], $diaGestion + 1)[0]["TOTALCLIENTES"];

                        $visitasValidasRuta = $fHistorial->getCantidadVisitasxEjecutivoxFecha($accion, $ejecutivo['e_usr_mobilvendor'], $model->fechaInicioFinJornadaInicio, $ruta_dia_gestion);

                        if (count($visitasValidasRuta) == 0) {
                            $cumplimientoEjecutivo = '0';
                        } else {
                            if ($totalClientesRuta > 0)
                                $cumplimientoEjecutivo = ceil((intval($visitasValidasRuta[0]['visitas_en_ruta']) / $totalClientesRuta) * 100) . '%';
                            else
                                $cumplimientoEjecutivo = 'NA';
                        }
                        $comentarioSupervision = $fComentarioSupervisor->getComentarioSupervisionxEjecutivoxFecha($ejecutivo['e_usr_mobilvendor'], $model->fechaInicioFinJornadaInicio);
                        $comentarioOficina = '';

                        if (isset($inicioJornadaEjecutivo[0]) > 0)
                            $entrada = new DateTime($inicioJornadaEjecutivo[0]["HORA"]);
                        else
                            $entrada = '00:00:00';

                        if (isset($finJornadaEjecutivo[0]) > 0)
                            $salida = new DateTime($finJornadaEjecutivo[0]["HORA"]);
                        else
                            $salida = '00:00:00';
//                        $tiempoGestion = $inicioVisita->diff($finVisita)->format("%h:%I:%S");
                        $tiempoGestion = (count($inicioJornadaEjecutivo) > 0 && (count($finJornadaEjecutivo) > 0)) ? $entrada->diff($salida)->format("%h:%I") : "00:00";
                        $_tiempoGestion = new DateTime($tiempoGestion);
                        $horasGestion = $_tiempoGestion->format("h");
                        $minutosGestion = $_tiempoGestion->format("i");
                        $segundosGestion = $_tiempoGestion->format("s");
//                        $_sTiempoGestion = $minutosGestion . "m " . $segundosGestion . "s";
                        $_sTiempoGestion = $horasGestion . "h " . $minutosGestion . "m";

                        $infoJornada = array(
                            'FECHA' => $model->fechaInicioFinJornadaInicio,
                            'EJECUTIVO' => $ejecutivo['e_nombre'],
//                            'CUMPLIMIENTO' => $cumplimientoEjecutivo,
                            'INICIOPRIMERAVISITA' => (count($inicioJornadaEjecutivo) > 0) ? $entrada->format("H:i") : "00:00",
                            'FINALULTIMAVISITA' => (count($finJornadaEjecutivo) > 0) ? $salida->format("H:i") : "00:00",
                            'TIEMPOGESTION' => $_sTiempoGestion,
                            'COMENTARIOS' => (isset($comentarioSupervision[0])) ? $comentarioSupervision[0]['cs_comentario'] : '',
                            'COMENTARIOO' => '',
                        );

                        array_push($datosGridJornada, $infoJornada);
                        unset($infoJornada);

                        $cantidad = $fHistorial->getCantidadClientesVisitadosxEjecutivoxFecha($ejecutivo['e_usr_mobilvendor'], $model->fechaInicioFinJornadaInicio);
//                        var_dump($cantidad['VISITAS']);die();
                        if ($cantidad['TODAS'] != 0) {
                            $infoVisitas = array(
                                'EJECUTIVO' => $ejecutivo['e_nombre'],
                                'VISITAS' => (isset($cantidad['VISITAS'])) ? intval($cantidad['VISITAS']) : 0,
                                'VISITASDUPLICADAS' => (isset($cantidad['REPETIDAS'])) ? intval($cantidad['REPETIDAS']) : 0,
                                'TOTALVISITAS' => (isset($cantidad['TODAS'])) ? intval($cantidad['TODAS']) : 0,
                            );

                            array_push($datosGridVisitas, $infoVisitas);
                            unset($infoVisitas);
                            $mensaje = "Detalle generado correctamente";
                        } else {
                            if ($model['tipoUsuario'] == 1) {
//                                $mensaje = "";
                                $mensaje = "No ha realizado la revisión individual de los ejecutivos en la fecha seleccionada";
                            }
                        }
                    }
                }

                $datosGrid['infoJornada'] = $datosGridJornada;
                $datosGrid['infoVisitas'] = $datosGridVisitas;
//                    var_dump($datosGrid);die();

                $_SESSION['revisionJornada'] = $datosGrid;
                Yii::app()->session['revisionJornada'] = $datosGridJornada;
                $response->Message = $mensaje;
                $response->Status = SUCCESS;
                $response->Result = $datosGrid;
//                    var_dump($response);die();
            } else {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
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
        $this->actionResponse(null, null, $response);
//        var_dump($response);        die();
        return;
    }

    private function actionResponse($view = 'error', $model = null, $response = null) {
//        var_dump(Yii::app()->request->isAjaxRequest);die();
        if (Yii::app()->request->isAjaxRequest) {

//            var_dump( ($response));die();
//            var_dump(json_encode($response), json_last_error());die();
            echo json_encode($response);
        } else {
            $this->render($view, $model);
        }
    }

    public function actionGenerateExcel($startDate) {
        $datosGrid = array();
        $response = new Response();
        try {
            if (isset(Yii::app()->session['revisionJornada']) && count(Yii::app()->session['revisionJornada']) > 0) {
                $revisionJornadas = Yii::app()->session['revisionJornada'];
                foreach ($revisionJornadas as $item) {
//                    foreach ($items as $item) {
                    $infoJornadas = array(
                        'EJECUTIVO' => (isset($item['EJECUTIVO'])) ? $item['EJECUTIVO'] : '',
//                        'CUMPLIMIENTO' => (isset($item['CUMPLIMIENTO'])) ? $item['CUMPLIMIENTO'] : '',
                        'INICIO_PRIMERA_VISITA' => (isset($item['INICIOPRIMERAVISITA'])) ? $item['INICIOPRIMERAVISITA'] : '',
                        'FINAL_ULTIMA_VISITA' => (isset($item['FINALULTIMAVISITA'])) ? $item['FINALULTIMAVISITA'] : '',
                        'TIEMPO_GESTION' => (isset($item['TIEMPOGESTION'])) ? $item['TIEMPOGESTION'] : '',
                        'COMENTARIO_SUPERVISOR' => (isset($item['COMENTARIOS'])) ? $item['COMENTARIOS'] : '',
                        'COMENTARIO_OFICINA' => (isset($item['COMENTARIOO'])) ? $item['COMENTARIOO'] : '',
                    );
                    array_push($datosGrid, $infoJornadas);
                    unset($infoJornadas);
//                    }
                }
                $NombreArchivo = "reporte_inicio_fin_x_fecha";
                $NombreHoja = "reporte_inicio_fin_x_fecha";

                $autor = "Tececab"; //$_SESSION['CUENTA'];
                $titulo = "reporte_inicio_fin_x_fecha";
                $tema = "reporte_inicio_fin_x_fecha";
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

                $excel->Mapeo($datosGrid);

                $excel->CrearArchivo('Excel2007', $NombreArchivo);
                $excel->GuardarArchivo();
            } else {
                
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
