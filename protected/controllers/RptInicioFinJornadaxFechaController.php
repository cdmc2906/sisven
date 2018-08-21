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

    function ObtenerTiemposGestionTraslado(
    $accionHistorial
    , $fechagestion
    , $horaInicioGestion
    , $horaFinGestion
    , $codigoEjecutivo
    ) {
//        var_dump($accionHistorial, $fechagestion, $horaInicioGestion, $horaFinGestion, $codigoEjecutivo);        die();
        $fHistorial = new FHistorialModel();
        $historial = $fHistorial->getHistorialxVendedorxFechaxHoraInicioxHoraFin(
                $fechagestion
                , $horaInicioGestion
                , $horaFinGestion
                , $codigoEjecutivo
        );
//        var_dump($historial);die();
        unset(Yii::app()->session['tiempoGestionEjecutivo']);
        unset(Yii::app()->session['tiempoTrasladoEjecutivo']);

        unset(Yii::app()->session['semanas']);
        unset(Yii::app()->session['cantidadVisitas']);
        unset(Yii::app()->session['contadorChipsVendidos']);
        unset(Yii::app()->session['contadorClientesEfectivos']);
        unset(Yii::app()->session['contadorEncuestas']);
        unset(Yii::app()->session['contadorClientesNuevos']);

        $libreria = new Libreria();
        $totalGestion = '00:00:00';
        $totalTraslados = '00:00:00';
        $finVisitaAnterior = new DateTime('00:00:00');

        $contadorItemVisita = 0;

        $contadorChipsVendidos = 0;
        $contadorClientesEfectivos = 0;
        $contadorEncuestas = 0;
        $contadorClientesNuevos = 0;

        $clientesVisitados = array();
        $semanasEjecutivo = array();
        $s_semanasEjecutivo = '';


        foreach ($historial as $itemHistorial) {
//            var_dump($itemHistorial['accion']);die();
            switch ($itemHistorial['accion']) {
                /* 'Inicio visita' => 'Inicio visita',
                  'Orden' => 'Orden',
                  'Forma' => 'Forma',
                  'Comentario' => 'Comentario',
                  'Día inicio' => 'Dia inicio',
                  'Fin de visita' => 'Fin de visita',
                  'Día fin' => 'Dia fin',
                  'Nuevo cliente' => 'Nuevo cliente',
                  'Estatus' => 'Estatus'
                 */
                case 'Inicio visita':
                    $fechaGestion = DateTime::createFromFormat('Y-m-d H:i', $itemHistorial['FECHAVISITA'])->format(FORMATO_FECHA);
                    $inicioVisita = new DateTime('00:00:00');
                    $finVisita = new DateTime('00:00:00');

                    $latitudHistorial = 0;
                    $longitudHistorial = 0;

                    $tiempoGestion = '00:00:00';
                    $tiempoTraslado = '00:00:00';

                    if (!array_search($itemHistorial['SEMANAHISTORIAL'], $semanasEjecutivo)) {
                        array_push($semanasEjecutivo, $itemHistorial['SEMANAHISTORIAL']);
                        $s_semanasEjecutivo .= $itemHistorial['SEMANAHISTORIAL'] . ',';
                    }


                    if (!array_search($itemHistorial['CODIGOCLIENTE'], $clientesVisitados))
                        array_push($clientesVisitados, $itemHistorial['CODIGOCLIENTE']);

                    $inicioFinVisitaHistorial = $fHistorial->getInicioFinVisitaClientexEjecutivoxFecha(
                            'Inicio visita'
                            , $fechaGestion
                            , $codigoEjecutivo
                            , $itemHistorial['CODIGOCLIENTE']
                            , $itemHistorial['IDHISTORIAL']);

                    $inicioVisita = DateTime::createFromFormat(FORMATO_FECHA_LONG_4, $inicioFinVisitaHistorial[0]['HORAVISITA']);
                    $finVisita = DateTime::createFromFormat(FORMATO_FECHA_LONG_4, $inicioFinVisitaHistorial[1]['HORAVISITA']);

                    $tiempoGestion = $inicioVisita->diff($finVisita)->format("%h:%I:%S");
                    $totalGestion = $libreria->SumaHoras($totalGestion, $tiempoGestion);


                    if ($contadorItemVisita > 0) { // solo si hay mas de una visita debe haber traslado entre clientes 
                        $tiempoTraslado = $inicioVisita->diff($finVisitaAnterior)->format("%h:%I:%S");
                        $totalTraslados = $libreria->SumaHoras($totalTraslados, $tiempoTraslado);
                    }
                    $finVisitaAnterior = $finVisita;

                    $_tiempoGestion = new DateTime($tiempoGestion);
                    $horasGestion = $_tiempoGestion->format("h");
                    $minutosGestion = $_tiempoGestion->format("i");
                    $segundosGestion = $_tiempoGestion->format("s");
                    $_sTiempoGestion = $minutosGestion . "m " . $segundosGestion . "s";

                    $_tiempoTraslado = new DateTime($tiempoTraslado);
                    $horasTraslado = $_tiempoTraslado->format("h");
                    $minutosTraslado = $_tiempoTraslado->format("i");
                    $segundosTralado = $_tiempoTraslado->format("s");
                    $_sTiempoTraslado = $minutosTraslado . "m " . $segundosTralado . "s";
                    $contadorItemVisita++;
                    break;
                case 'Orden':
                    $contadorChipsVendidos += $itemHistorial['CHIPS'];
                    $contadorClientesEfectivos += 1;

                    break;
                case 'Forma':
                    $contadorEncuestas += 1;

                    break;
                case 'Nuevo cliente':
                    $contadorEncuestas += 1;

                    break;

                default:
                    break;
            }
        }#Fin iteracion items historial
        Yii::app()->session['tiempoGestionEjecutivo'] = $totalGestion;
        Yii::app()->session['tiempoTrasladoEjecutivo'] = $totalTraslados;

        Yii::app()->session['semanas'] = $s_semanasEjecutivo;
        Yii::app()->session['cantidadVisitas'] = count($clientesVisitados);
        Yii::app()->session['contadorChipsVendidos'] = $contadorChipsVendidos;
        Yii::app()->session['contadorClientesEfectivos'] = $contadorClientesEfectivos;
        Yii::app()->session['contadorEncuestas'] = $contadorEncuestas;
        Yii::app()->session['contadorClientesNuevos'] = $contadorClientesNuevos;

        return;
    }

    public function actionConsultarReporte() {
        $datosGrid = array();
        $datosGridJornada = array();
        $datosGridVisitas = array();
        $response = new Response();
        $solicitarLogin = true;
        $mensaje = '';
        try {
//            $model = new ReporteInicioFinJornadaxFechaForm();
//            if (isset($_POST['ReporteInicioFinJornadaxFechaForm'])) {
            $model = new RptResumenDiarioHistorialForm();
//            var_dump($model);die();
//            var_dump(isset($_POST['RptResumenDiarioHistorialForm']));die();
            if (isset($_POST['RptResumenDiarioHistorialForm'])) {
//                $model->attributes = $_POST['ReporteInicioFinJornadaxFechaForm'];
                $model->attributes = $_POST['RptResumenDiarioHistorialForm'];

                $cEjecutivos = new FEjecutivoModel();
                $reporteModel = new ReportesModel();
                $fRuta = new FRutaModel();
                $fHistorial = new FHistorialModel();

                $accion = 'Inicio Visita';
                $ejecutivos = $cEjecutivos->getEjecutivosXGrupoXEstado($model['tipoUsuarioJornada'], 1);
                $libreria = new Libreria();

//                                var_dump($model);die();
                foreach ($ejecutivos as $ejecutivo) {
                    $det = $this->ObtenerTiemposGestionTraslado(
                            'Inicio visita'
                            , $model->fechaInicioFinJornada
                            , $model->horaInicioGestionJornada
                            , $model->horaFinGestionJornada
                            , $ejecutivo['e_usr_mobilvendor']
                    );

//                        var_dump(Yii::app()->session['tiempoGestionEjecutivo'] ,Yii::app()->session['tiempoTrasladoEjecutivo']);
//                        die();
                    $cResumenDiarioHistorialMB = new FResumenDiarioHistorialModel();
                    $inicioJornadaEjecutivo = $reporteModel->getInicioJornadaxFecha(
                            $ejecutivo['e_usr_mobilvendor']
                            , $model->fechaInicioFinJornada
                            , $model->horaInicioGestionJornada
                            , $model->horaFinGestionJornada
                    );

                    $finJornadaEjecutivo = $reporteModel->getFinJornadaxUsuarioxFecha(
                            $ejecutivo['e_usr_mobilvendor']
                            , $model->fechaInicioFinJornada
                            , $model->horaInicioGestionJornada
                            , $model->horaFinGestionJornada
                    );
                    $diaGestion = date("w", strtotime($model->fechaInicioFinJornada));
                    $ruta_dia_gestion = "R" . $diaGestion . '-' . $ejecutivo['e_iniciales'];
                    $comentarioDiaSupervisor = '';
                    $totalClientesRuta = $fRuta->getTotalClientesxRutaxEjecutivoxDia($ejecutivo['e_iniciales'], $diaGestion + 1)[0]["TOTALCLIENTES"];

                    $visitasValidasRuta = $fHistorial->getCantidadVisitasxEjecutivoxFecha($accion, $ejecutivo['e_usr_mobilvendor'], $model->fechaInicioFinJornada, $ruta_dia_gestion);

                    if (count($visitasValidasRuta) == 0) {
                        $cumplimientoEjecutivo = '0';
                    } else {
                        if ($totalClientesRuta > 0)
                            $cumplimientoEjecutivo = ceil((intval($visitasValidasRuta[0]['visitas_en_ruta']) / $totalClientesRuta) * 100) . '%';
                        else
                            $cumplimientoEjecutivo = 'NA';
                    }

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

//                    Yii::app()->session['semanas'] = $semanasEjecutivo;
//                    Yii::app()->session['cantidadVisitas'] = count($clientesVisitados);
//                    Yii::app()->session['contadorChipsVendidos'] = $contadorChipsVendidos;
//                    Yii::app()->session['contadorClientesEfectivos'] = $contadorClientesEfectivos;
//                    Yii::app()->session['contadorEncuestas'] = $contadorEncuestas;
//                    Yii::app()->session['contadorClientesNuevos'] = $contadorClientesNuevos;

                    $infoJornada = array(
                        'FECHA' => $model->fechaInicioFinJornada,
                        'EJECUTIVO' => $ejecutivo['e_nombre'],
//                            'CUMPLIMIENTO' => $cumplimientoEjecutivo,
                        'INICIOPRIMERAVISITA' => (count($inicioJornadaEjecutivo) > 0) ? $entrada->format("H:i") : "00:00",
                        'FINALULTIMAVISITA' => (count($finJornadaEjecutivo) > 0) ? $salida->format("H:i") : "00:00",
                        'TOTALTIEMPO' => $_sTiempoGestion,
                        'TIEMPOGESTION' => Yii::app()->session['tiempoGestionEjecutivo'],
                        'TIEMPOTRASLADO' => Yii::app()->session['tiempoTrasladoEjecutivo'],
                        'SEMANAS' => Yii::app()->session['semanas'],
                        'VISITAS' => Yii::app()->session['cantidadVisitas'],
                        'NUEVOS' => Yii::app()->session['contadorClientesNuevos'],
                        'EFECTIVOS' => Yii::app()->session['contadorClientesEfectivos'],
                        'ENCUESTAS' => Yii::app()->session['contadorEncuestas'],
                        'VENTA' => Yii::app()->session['contadorChipsVendidos'],
                    );

                    array_push($datosGridJornada, $infoJornada);
                    unset($infoJornada);

                    $cantidad = $fHistorial->getCantidadClientesVisitadosxEjecutivoxFecha($ejecutivo['e_usr_mobilvendor'], $model->fechaInicioFinJornada);
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
                        if ($model['tipoUsuarioJornada'] == 1) {
//                                $mensaje = "";
                            $mensaje = "No ha realizado la revisión individual de los ejecutivos en la fecha seleccionada";
                        }
                    }
                }

                $datosGrid['infoJornada'] = $datosGridJornada;
                $datosGrid['infoVisitas'] = $datosGridVisitas;

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
                        'INICIO_PRIMERA_VISITA' => (isset($item['INICIOPRIMERAVISITA'])) ? $item['INICIOPRIMERAVISITA'] : '',
                        'FINAL_ULTIMA_VISITA' => (isset($item['FINALULTIMAVISITA'])) ? $item['FINALULTIMAVISITA'] : '',
                        'TOTAL_TIEMPO' => (isset($item['TOTALTIEMPO'])) ? $item['TOTALTIEMPO'] : '',
                        'TIEMPO_GESTION' => (isset($item['TIEMPOGESTION'])) ? $item['TIEMPOGESTION'] : '',
                        'TIEMPO_TRALADO' => (isset($item['TIEMPOTRASLADO'])) ? $item['TIEMPOTRASLADO'] : '',
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
