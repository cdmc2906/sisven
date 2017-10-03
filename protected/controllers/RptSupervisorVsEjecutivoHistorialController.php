<?php

/**
 * Description
 * @fecha 
 * @author 
 */
class RptSupervisorVsEjecutivoHistorialController extends Controller {

    public function actionIndex() {
        Yii::app()->user->setFlash('resultadoGuardar', null);
        if (Yii::app()->request->isAjaxRequest) {
            return;
        } else {
            Yii::app()->session['RptSupervisorVsEjecutivoHistorialForm '] = '';
            $model = new RptSupervisorVsEjecutivoHistorialForm ();
            $this->render('/historialmb/rptSupervisorVsEjecutivoHistorial', array('model' => $model));
        }
    }

    public function actionRevisarHistorial() {
        $response = new Response();
        try {
            $model = new RptSupervisorVsEjecutivoHistorialForm();
//            var_dump($_POST['RptSupervisorVsEjecutivoHistorialForm']);die();
            if (isset($_POST['RptSupervisorVsEjecutivoHistorialForm'])) {
                if ($model->validate()) {
                    $model->attributes = $_POST['RptSupervisorVsEjecutivoHistorialForm'];
                    $fReportes = new ReportesModel();
//                var_dump($model);die();
                    $datosVisitas = $fReportes->getUsuariosGestionxFecha(
                            $model->fechagestion
                            , $model->accionHistorial
                            , GRUPO_SUPERVISORES
                            , $model->horaInicioGestion
                            , $model->horaFinGestion);

                    $response->Message = "Historial revisado exitosamente";
                    $response->Status = SUCCESS;
                    $response->Result = $datosVisitas;
                }//fin model->validate
                else {
                    $response->Message = "Debe seleccionar todos los filtros";
                    $response->ClassMessage = CLASS_MENSAJE_NOTICE;
//                $response->Result = $datos; // $datosGrid;
                }
            }
        } catch (Exception $e) {
            $response->Message = Yii::app()->params['mensajeExcepcion'];
            $response->Status = ERROR;
            $response->ClassMessage = CLASS_MENSAJE_ERROR;
        }
        $this->actionResponse(null, null, $response);
        return;
    }

    public function actionCargarGridDetalleRuta() {
        $reporteModel = new ReportesModel();

        $response = new Response();
        $data = $reporteModel->getGestionxUsuarioxFecha(
                $_POST['ejecutivo']
                , $_POST['fechaGestion']
                , $_POST['accionHistorial']
                , $_POST['horaInicio']
                , $_POST['horaFin']);
        $response->Result = $data;
        $this->actionResponse(null, null, $response);
        return;
    }

    public function actionCargarInformes() {
//        $time = strtotime("2017-09-01 00:00:00");


        $datosInformes = array();
        $response = new Response();

        $datosResumenGridCumplimientoSupervisor = array();
        $datosResumenGridVisitasSupervisor = array();
        $datosGridCumplimientoSupervisor = array();
        $datosGridVisitasSupervisor = array();
        $datosGridVisitasVISupervisor = array();
        $datosGridSupervisor = array();

        $primeraVisitaSupervisor = '';
        $ultimaVisitaSupervisor = '';
//        $cantidadClientesVisitadosSupervisor = 0;
        $cantidadClientesNoVisitadosSupervisor = 0;
        $tiempoGestionSupervisor = '';

        $datosResumenGridCumplimientoEjecutivo = array();
        $datosResumenGridVisitasEjecutivo = array();
        $datosGridCumplimientoEjecutivo = array();
        $datosGridVisitasEjecutivo = array();
        $datosGridVisitasVIEjecutivo = array();
        $datosGridEjecutivo = array();
        $clientesVisitadosEjecutivoRuta = 0;

        $datosVisitasSupervisor = array();
        $datosVisitasEjecutivo = array();

        $datosGridDetalleSupervisorEjecutivo = array();

        $reporteModel = new ReportesModel();
        $fRutas = new FRutaModel();
        $fHistorial = new FHistorialModel();
        $fLibreria = new Libreria();

        $cumplimientoCoordenadasValidasSupervisor = 0;
        $visitasSupervisorValidas = 0;
        $visitasSupervisorInvalidas = 0;
        $visitasSupervisorRepetidas = 0;
        $visitaSupervisorRepetida = false;

        $cumplimientoCoordenadasValidasEjecutivo = 0;
        $visitasEjecutivoValidas = 0;
        $visitasEjecutivoInvalidas = 0;
        $visitasEjecutivoRepetidas = 0;
        $visitaEjecutivoRepetida = false;

        $primeraVisitaEjecutivo = '';
        $ultimaVisitaEjecutivo = '';
        $cantidadClientesVisitadosEjecutivo = 0;
        $cantidadClientesNoVisitadosEjecutivo = 0;
        $tiempoGestionEjecutivo = '';

        $itemGridDetalleSupervisorEjecutivo = array();

        $historialSupervisor = $fHistorial->getHistorialxVendedorxFechaxHoraInicioxHoraFinxRuta($_POST['accionHistorial'], $_POST['fechaGestion'], $_POST['horaInicio'], $_POST['horaFin'], $_POST['supervisor'], $_POST['rutaEjecutivo']);
        $ejecutivo = EjecutivoModel::model()->findAllByAttributes(array('e_iniciales' => $_POST['ejecutivo']));

        if (strlen($_POST['diaRuta']) == 1 || strlen($_POST['diaRuta']) == 2) {
            $clientesxRuta = intval($fRutas->getTotalClientesxRutaxEjecutivoxDia($_POST['ejecutivo'], $_POST['diaRuta'] + 1)[0]['TOTALCLIENTES']);
            $clientesVisitadosSupervisorRuta = intval($fHistorial->getCantidadVisitasxEjecutivoxFechaxHoraInicioxHoraFin($_POST['accionHistorial'], $_POST['supervisor'], $_POST['fechaGestion'], $_POST['rutaEjecutivo'], $_POST['horaInicio'], $_POST['horaFin'])[0]['VISITASENRUTA']);
            $cumplimientoRutaSupervisor = round(($clientesVisitadosSupervisorRuta / $clientesxRuta) * 100);
            $cantidadClientesNoVisitadosSupervisor = $fRutas->getTotalClientesNoVisitadosxRutaxEjecutivo($_POST['ejecutivo'], $_POST['diaRuta'] + 1, $_POST['fechaGestion'], $_POST['supervisor'])[0]['CLIENTESNOVISITADOS'];
//            $cantidadClientesNoVisitadosEjecutivo = $fRutas->getTotalClientesNoVisitadosxRutaxEjecutivo($_POST['ejecutivo'], $_POST['diaRuta'] + 1, $_POST['fechaGestion'], $ejecutivo[0]['e_usr_mobilvendor'])[0]['CLIENTESNOVISITADOS'];

            $primeraVisitaEjecutivo = $fHistorial->getPrimeraVisitaxEjecutivoxFechaxHoraInicioxHoraFin($_POST['accionHistorial'], $_POST['fechaGestion'], $_POST['horaInicio'], $_POST['horaFin'], $ejecutivo[0]['e_usr_mobilvendor'])[0]['RESULTADO'];
            $ultimaVisitaEjecutivo = $fHistorial->getUltimaVisitaxEjecutivoxFechaxHoraInicioxHoraFin($_POST['accionHistorial'], $_POST['fechaGestion'], $_POST['horaInicio'], $_POST['horaFin'], $ejecutivo[0]['e_usr_mobilvendor'])[0]['RESULTADO'];
            $inicioE = new DateTime($primeraVisitaEjecutivo);
            $finE = new DateTime($ultimaVisitaEjecutivo);
            $tiempoGestionEjecutivo = $inicioE->diff($finE)->format("%hh %im");
        }

        $primeraVisitaSupervisor = $fHistorial->getPrimeraVisitaxEjecutivoxFechaxHoraInicioxHoraFin($_POST['accionHistorial'], $_POST['fechaGestion'], $_POST['horaInicio'], $_POST['horaFin'], $_POST['supervisor'])[0]['RESULTADO'];
        $ultimaVisitaSupervisor = $fHistorial->getUltimaVisitaxEjecutivoxFechaxHoraInicioxHoraFin($_POST['accionHistorial'], $_POST['fechaGestion'], $_POST['horaInicio'], $_POST['horaFin'], $_POST['supervisor'])[0]['RESULTADO'];
        $inicio = new DateTime($primeraVisitaSupervisor);
        $fin = new DateTime($ultimaVisitaSupervisor);
        $tiempoGestionSupervisor = $inicio->diff($fin)->format("%hh %im");

        foreach ($historialSupervisor as $itemHistorialSupervisor) {
            $latitudCliente = 0;
            $longitudCliente = 0;
            $latitudEjecutivo = 0;
            $longitudEjecutivo = 0;
            $visitaRepetida = false;

            foreach ($datosGridDetalleSupervisorEjecutivo as $item) {
                if (in_array($itemHistorialSupervisor['CODIGOCLIENTE'], $item)) {
                    $visitaRepetida = true;
                    break;
                }
            }
            if (strlen($_POST['diaRuta']) == 1 || strlen($_POST['diaRuta']) == 2) {
                $dia_menos_siete_dias = date('Y-m-d', strtotime($_POST['fechaGestion'] . ' - 7 days'));
                $fechaInicioRango = date('Y-m-d', strtotime("last Monday", strtotime($dia_menos_siete_dias)));
                $fechaFinRango = $_POST['fechaGestion'];
                $dia = 1;
                $fecha = $_POST['fechaGestion'];
                $nombreDia = '';
                switch ($dia) {
                    case 1:
                        $nombreDia = 'last Monday';
                        break;
                    case 2:
                        $nombreDia = 'last Tuesday';
                        break;
                    case 3:
                        $nombreDia = 'last Wenesday';
                        break;
                    case 4:
                        $nombreDia = 'last Thursday';
                        break;
                    case 5:
                        $nombreDia = 'last Friday';
                        break;
                    case 6:
                        $nombreDia = 'last Saturday';
                        break;
                    case 7:
                        $nombreDia = 'last Sunday';
                        break;
                }

                $visitaEjecutivo = $fHistorial->getDatosUltimaVisitaxEjecutivoxAccionxCodClientexFechaInicioxFechaFinxHoraInicioxHoraFinxRuta(
                        $ejecutivo[0]['e_usr_mobilvendor'], $_POST['accionHistorial'], $itemHistorialSupervisor['CODIGOCLIENTE']
                        , $fechaInicioRango, $fechaFinRango, $_POST['horaInicio'], $_POST['horaFin'], $_POST['rutaEjecutivo']);

                if (isset($visitaEjecutivo[0])) {
//                    if ($visitaRepetida)
//                        $clientesVisitadosEjecutivoRuta -= 1;
//                    else
                    $clientesVisitadosEjecutivoRuta += 1;

                    $latitudEjecutivo = $visitaEjecutivo[0]['LATITUDEJECUTIVO'];
                    $longitudEjecutivo = $visitaEjecutivo[0]['LONGITUDEJECUTIVO'];

                    $visitaValidaEjecutivo = false;
                    $cliente = ClienteModel::model()->findAllByAttributes(array('cli_codigo_cliente' => $itemHistorialSupervisor['CODIGOCLIENTE']));
                    if (count($cliente) > 0) {
                        $latitudCliente = str_replace(',', '.', $cliente[0]['cli_latitud']);
                        $longitudCliente = str_replace(',', '.', $cliente[0]['cli_longitud']);
                    } else {
                        $latitudCliente = 0;
                        $longitudCliente = 0;
                    }
                    $distanciaEntreEjecutivoCliente = $fLibreria->DistanciaEntreCoordenadas(
                            $latitudEjecutivo
                            , $longitudEjecutivo
                            , $latitudCliente
                            , $longitudCliente);

                    $distanciaEntreSupervisorEjecutivo = $fLibreria->DistanciaEntreCoordenadas(
                            $itemHistorialSupervisor["LATITUD"]
                            , $itemHistorialSupervisor["LONGITUD"]
                            , $latitudEjecutivo
                            , $longitudEjecutivo);

                    if (intval($_POST['precision']) != 0) {
                        if ($distanciaEntreEjecutivoCliente <= intval($_POST['precision'])) {
                            $visitasEjecutivoValidas += 1;
                            $visitaValidaEjecutivo = true;
                        } else {
                            $visitasEjecutivoInvalidas += 1;
                            $visitaInvalidaEjecutivo = false;
                        }
                    } else {
                        $visitasEjecutivoValidas += 1;
                        $visitaValidaEjecutivo = true;
                    }
                } else {
                    $cantidadClientesNoVisitadosEjecutivo += 1;
                }

                $visitaValidaSupervisor = false;
                $cliente = ClienteModel::model()->findAllByAttributes(array('cli_codigo_cliente' => $itemHistorialSupervisor['CODIGOCLIENTE']));
                if (count($cliente) > 0) {
                    $latitudCliente = str_replace(',', '.', $cliente[0]['cli_latitud']);
                    $longitudCliente = str_replace(',', '.', $cliente[0]['cli_longitud']);
                } else {
                    $latitudCliente = 0;
                    $longitudCliente = 0;
                }
                $distanciaEntreSupervisorCliente = $fLibreria->DistanciaEntreCoordenadas(
                        $itemHistorialSupervisor["LATITUD"]
                        , $itemHistorialSupervisor["LONGITUD"]
                        , $latitudCliente
                        , $longitudCliente);

                if (intval($_POST['precision']) != 0) {
                    if ($distanciaEntreSupervisorCliente <= intval($_POST['precision'])) {
                        if (!$visitaRepetida) {
                            $visitasSupervisorValidas += 1;
                            $visitaValidaSupervisor = true;
                        }
                    } else {
                        $visitasSupervisorInvalidas += 1;
                        $visitaInvalidaSupervisor = false;
                    }
                } else {
                    $visitasSupervisorValidas += 1;
                    $visitaValidaSupervisor = true;
                }
            }

            $itemGridDetalleSupervisorEjecutivo = array(
                'FECHAGESTION' => (isset($itemHistorialSupervisor['FECHAVISITA'])) ? $itemHistorialSupervisor['FECHAVISITA'] : 'NA',
                'CODIGOCLIENTE' => (isset($itemHistorialSupervisor['CODIGOCLIENTE'])) ? $itemHistorialSupervisor['CODIGOCLIENTE'] : 'NA',
                'CLIENTE' => (isset($itemHistorialSupervisor['NOMBRECLIENTE'])) ? $itemHistorialSupervisor['NOMBRECLIENTE'] : 'NA',
                'METROSS' => (isset($distanciaEntreSupervisorCliente) == true) ? round($distanciaEntreSupervisorCliente) : 0,
                'ESTADOS' => (isset($visitaValidaSupervisor) && $visitaValidaSupervisor == true) ? "VALIDA" : "INVALIDA",
                'METROSE' => (isset($distanciaEntreEjecutivoCliente) == true) ? round($distanciaEntreEjecutivoCliente) : 0,
                'ESTADOE' => (isset($visitaValidaEjecutivo) && $visitaValidaEjecutivo == true) ? "VALIDA" : "INVALIDA",
                'DISTANCIA_SC' => (isset($distanciaEntreSupervisorCliente)) ? round($distanciaEntreSupervisorCliente) : 'NA',
                'DISTANCIA_EC' => (isset($distanciaEntreEjecutivoCliente)) ? round($distanciaEntreEjecutivoCliente) : 'NA',
                'DISTANCIA_SE' => (isset($distanciaEntreSupervisorEjecutivo)) ? round($distanciaEntreSupervisorEjecutivo) : 'NA',
                'LATITUD_CLIENTE' => $latitudCliente,
                'LONGITUD_CLIENTE' => $longitudCliente,
                'LATITUD_SUPERVISOR' => $itemHistorialSupervisor["LATITUD"],
                'LONGITUD_SUPERVISOR' => $itemHistorialSupervisor["LONGITUD"],
                'LATITUD_EJECUTIVO' => $latitudEjecutivo,
                'LONGITUD_EJECUTIVO' => $longitudEjecutivo,
            );
            array_push($datosGridDetalleSupervisorEjecutivo, $itemGridDetalleSupervisorEjecutivo);
            unset($itemGridDetalleSupervisorEjecutivo);
        }//fin de iteracion historial supervisor

        $datosInformes['gridDetalleSupervisorEjecutivo'] = $datosGridDetalleSupervisorEjecutivo;
        Yii::app()->session['gridDetalleSupervisorEjecutivo'] = $datosGridDetalleSupervisorEjecutivo;

        if (strlen($_POST['diaRuta']) == 1 || strlen($_POST['diaRuta']) == 2) {

            $cumplimientoRutaEjecutivo = round(($clientesVisitadosEjecutivoRuta / $clientesxRuta) * 100);
            $cumplimientoCoordenadasValidasSupervisor = round(($visitasSupervisorValidas / $clientesVisitadosSupervisorRuta) * 100);
            $cumplimientoCoordenadasValidasEjecutivo = round(($visitasEjecutivoValidas / $clientesVisitadosEjecutivoRuta) * 100);

            $resumenCumplimientoSupervisor = array(
                'PRIMERA-VISITA' => ($primeraVisitaSupervisor == null) ? "ERROR" : $primeraVisitaSupervisor,
                'ULTIMA-VISITA' => ($ultimaVisitaSupervisor == null) ? "ERROR" : $ultimaVisitaSupervisor,
                'TIEMPO-GESTION' => ($tiempoGestionSupervisor == null) ? "0" : $tiempoGestionSupervisor,
                '%-CUMPLIMIENTO_RUTA' => ($cumplimientoRutaSupervisor == null) ? "0%" : $cumplimientoRutaSupervisor . "%",
                '%-CUMPLIMIENTO_COORD' => ($cumplimientoCoordenadasValidasSupervisor == null) ? "0%" : $cumplimientoCoordenadasValidasSupervisor . "%",
            );
            $resumenCumplimientoEjecutivo = array(
                'PRIMERA-VISITA' => '',
                'ULTIMA-VISITA' => '',
                'PRIMERA-VISITA' => ($primeraVisitaEjecutivo == null) ? "ERROR" : $primeraVisitaSupervisor,
                'ULTIMA-VISITA' => ($ultimaVisitaEjecutivo == null) ? "ERROR" : $ultimaVisitaSupervisor,
                'TIEMPO-GESTION' => ($tiempoGestionEjecutivo == null) ? "0" : $tiempoGestionEjecutivo,
                '%-CUMPLIMIENTO_RUTA' => ($cumplimientoRutaEjecutivo == null) ? "0%" : $cumplimientoRutaEjecutivo . "%",
                '%-CUMPLIMIENTO_COORD' => ($cumplimientoCoordenadasValidasEjecutivo == null) ? "0%" : $cumplimientoCoordenadasValidasEjecutivo . "%",
            );
            array_push($datosResumenGridCumplimientoEjecutivo, $resumenCumplimientoEjecutivo);
            unset($resumenCumplimientoEjecutivo);
        } else {

            $resumenCumplimientoSupervisor = array(
                'PRIMERA-VISITA' => ($primeraVisitaSupervisor == null) ? "ERROR" : $primeraVisitaSupervisor,
                'ULTIMA-VISITA' => ($ultimaVisitaSupervisor == null) ? "ERROR" : $ultimaVisitaSupervisor,
                'TIEMPO-GESTION' => ($tiempoGestionSupervisor == null) ? "0" : $tiempoGestionSupervisor,
            );
        }
        array_push($datosResumenGridCumplimientoSupervisor, $resumenCumplimientoSupervisor);
        unset($resumenCumplimientoSupervisor);

        foreach ($datosResumenGridCumplimientoSupervisor as $key => $filaGrid) {
            foreach ($filaGrid as $clave => $valor) {
                $resumenRutaCumplimientoSupervisor = array(
                    'PARAMETRO' => $clave,
                    'VALOR' => strval($valor),
                );
                array_push($datosGridCumplimientoSupervisor, $resumenRutaCumplimientoSupervisor);
                unset($resumenRutaCumplimientoSupervisor);
            }//fin iteracion valores en fila
        }//fin iteracion filas resumen

        foreach ($datosResumenGridCumplimientoEjecutivo as $key => $filaGrid) {
            foreach ($filaGrid as $clave => $valor) {
                $resumenRutaCumplimientoEjecutivo = array(
                    'PARAMETRO' => $clave,
                    'VALOR' => strval($valor),
                );
                array_push($datosGridCumplimientoEjecutivo, $resumenRutaCumplimientoEjecutivo);
                unset($resumenRutaCumplimientoEjecutivo);
            }//fin iteracion valores en fila
        }//fin iteracion filas resumen

        $datosInformes['gridCumplimientoSupervisor'] = $datosGridCumplimientoSupervisor;
        $datosInformes['gridCumplimientoEjecutivo'] = $datosGridCumplimientoEjecutivo;

        if (strlen($_POST['diaRuta']) == 1 || strlen($_POST['diaRuta']) == 2) {
            $resumenVisitasSupervisor = array(
                'CLIENTES-RUTA' => ($clientesxRuta == null) ? 0 : $clientesxRuta,
                'CLIENTES-VISITADOS' => ($clientesVisitadosSupervisorRuta == null) ? 0 : $clientesVisitadosSupervisorRuta,
                'CLIENTES-NO-VISITADOS' => ($cantidadClientesNoVisitadosSupervisor == null) ? 0 : $cantidadClientesNoVisitadosSupervisor,
            );
            array_push($datosResumenGridVisitasSupervisor, $resumenVisitasSupervisor);
            unset($resumenVisitasSupervisor);

            $resumenVisitasEjecutivo = array(
                'CLIENTES-VIS_SUP' => ($clientesVisitadosSupervisorRuta == null) ? 0 : $clientesVisitadosSupervisorRuta,
                'CLIENTES-VISITADOS' => ($clientesVisitadosEjecutivoRuta == null) ? 0 : $clientesVisitadosEjecutivoRuta,
                'CLIENTES-NO-VISITADOS' => ($cantidadClientesNoVisitadosEjecutivo == null) ? 0 : $cantidadClientesNoVisitadosEjecutivo,
            );
            array_push($datosResumenGridVisitasEjecutivo, $resumenVisitasEjecutivo);
            unset($resumenVisitasEjecutivo);
        }

        foreach ($datosResumenGridVisitasSupervisor as $key => $filaGrid) {
            foreach ($filaGrid as $clave => $valor) {
                $resumenRutaVisitaSupervisor = array(
                    'PARAMETRO' => $clave,
                    'VALOR' => strval($valor),
                );
                array_push($datosGridVisitasSupervisor, $resumenRutaVisitaSupervisor);
                unset($resumenRutaVisitaSupervisor);
            }//fin iteracion valores en fila
        }//fin iteracion filas resumen

        foreach ($datosResumenGridVisitasEjecutivo as $key => $filaGrid) {
            foreach ($filaGrid as $clave => $valor) {
                $resumenRutaVisitaEjecutivo = array(
                    'PARAMETRO' => $clave,
                    'VALOR' => strval($valor),
                );
                array_push($datosGridVisitasEjecutivo, $resumenRutaVisitaEjecutivo);
                unset($resumenRutaVisitaEjecutivo);
            }//fin iteracion valores en fila
        }//fin iteracion filas resumen

        $datosInformes['gridVisitasSupervisor'] = $datosGridVisitasSupervisor;
        $datosInformes['gridVisitasEjecutivo'] = $datosGridVisitasEjecutivo;

        $resumenValidasInvalidasSupervisor = array('VISITA' => 'Validas', 'CANTIDAD' => $visitasSupervisorValidas);
        array_push($datosGridVisitasVISupervisor, $resumenValidasInvalidasSupervisor);
        unset($resumenValidasInvalidasSupervisor);
        $resumenValidasInvalidasSupervisor = array('VISITA' => 'Invalidas', 'CANTIDAD' => $visitasSupervisorInvalidas);
        array_push($datosGridVisitasVISupervisor, $resumenValidasInvalidasSupervisor);
        unset($resumenValidasInvalidasSupervisor);
        $datosInformes['resumenVisitasValidasInvalidasSupervisor'] = $datosGridVisitasVISupervisor;

        $resumenValidasInvalidasEjecutivo = array('VISITA' => 'Validas', 'CANTIDAD' => $visitasEjecutivoValidas);
        array_push($datosGridVisitasVIEjecutivo, $resumenValidasInvalidasEjecutivo);
        unset($resumenValidasInvalidasEjecutivo);

        $resumenValidasInvalidasEjecutivo = array('VISITA' => 'Invalidas', 'CANTIDAD' => $visitasEjecutivoInvalidas);
        array_push($datosGridVisitasVIEjecutivo, $resumenValidasInvalidasEjecutivo);
        unset($resumenValidasInvalidasEjecutivo);
        $datosInformes['resumenVisitasValidasInvalidasEjecutivo'] = $datosGridVisitasVIEjecutivo;

        $response->Result = $datosInformes;

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

    public function actionGenerateExcel() {
        $response = new Response();
        try {
            $revisionRuta = array();
//        var_dump(Yii::app()->session['detallerevisionhistorialitem']);            die();
//            $datos = $_SESSION['detallerevisionhistorialitem']; // $_SESSION['historialitem'];
            $datos = Yii::app()->session['gridDetalleSupervisorEjecutivo'];
//            var_dump($datos);            die();
            foreach ($datos as $itemHistorialSupervisor) {
//                var_dump($itemHistorialSupervisor);                die();
                $dat = array(
                    'FECHA GESTION' => $itemHistorialSupervisor['FECHAGESTION'],
                    'CODIGO_CLIENTE' => $itemHistorialSupervisor['CODIGOCLIENTE'],
                    'CLIENTE' => $itemHistorialSupervisor['CLIENTE'],
                    'DISTANCIA_SUPERVISOR_CLIENTE' => $itemHistorialSupervisor['METROSS'],
                    'ESTADO_VISITA_SUPERVISOR' => $itemHistorialSupervisor['ESTADOS'],
                    'DISTANCIA_EJECUTIVO_CLIENTE' => $itemHistorialSupervisor['METROSE'],
                    'ESTADO_VISITA_EJECUTIVO' => $itemHistorialSupervisor['ESTADOE'],
//                    'DISTANCIA_SC' => $itemHistorialSupervisor['DISTANCIA_SC'],
//                    'DISTANCIA_EC' => $itemHistorialSupervisor['DISTANCIA_EC'],
                    'DISTANCIA_SUPERVISOR_EJECUTIVO' => $itemHistorialSupervisor['DISTANCIA_SE'],
                    'LATITUD_CLIENTE' => $itemHistorialSupervisor['LATITUD_CLIENTE'],
                    'LONGITUD_CLIENTE' => $itemHistorialSupervisor['LONGITUD_CLIENTE'],
                    'LATITUD_SUPERVISOR' => $itemHistorialSupervisor['LATITUD_SUPERVISOR'],
                    'LONGITUD_SUPERVISOR' => $itemHistorialSupervisor['LONGITUD_SUPERVISOR'],
                    'LATITUD_EJECUTIVO' => $itemHistorialSupervisor['LATITUD_EJECUTIVO'],
                    'LONGITUD_EJECUTIVO' => $itemHistorialSupervisor['LONGITUD_EJECUTIVO']
                );
                array_push($revisionRuta, $dat);
            }
//            var_dump($revisionRuta);die();
            $NombreArchivo = "reporte_supervisor_vs_ejecutivo";
            $NombreHoja = "reporte_supervisor_vs_ejecutivo";

            $autor = "Tececab"; //$_SESSION['CUENTA'];
            $titulo = "reporte_supervisor_vs_ejecutivo";
            $tema = "reporte_supervisor_vs_ejecutivo";
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

    public function actionGenerateExcelResumen() {
        $response = new Response();
        try {
            $revisionRuta = array();
            $datosResumenDiario = Yii::app()->session['resumenrevisionhistorialitem'];

            foreach ($datosResumenDiario as $value) {
                $dat = array(
                    'PARAMETRO' => $value['PARAMETRO'],
                    'VALOR' => $value['VALOR'],
                    'FECHA_GESTION' => strval(Yii::app()->session['ModelForm']['fechagestion']),
                    'EJECUTIVO' => strval(Yii::app()->session['ModelForm']['ejecutivo'])
                );
                array_push($revisionRuta, $dat);
            }

            $NombreArchivo = "reporte_resumen_revision_ruta";
            $NombreHoja = "reporte_resumen_revision_ruta";

            $autor = "Tececab"; //$_SESSION['CUENTA'];
            $titulo = "reporte_resumen_revision_ruta";
            $tema = "reporte_resumen_revision_ruta";
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
