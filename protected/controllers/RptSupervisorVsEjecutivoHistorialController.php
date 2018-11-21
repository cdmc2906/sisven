<?php

/**
 * Description
 * @fecha 
 * @author 
 */
class RptSupervisorVsEjecutivoHistorialController extends Controller {

    public $layout = LAYOUT_FILTRO_GRID;

    public function actionIndex() {
        Yii::app()->user->setFlash('resultadoGuardar', null);
        if (Yii::app()->request->isAjaxRequest) {
            return;
        } else {
            Yii::app()->session['RptSupervisorVsEjecutivoHistorialForm '] = '';
            $model = new RptSupervisorVsEjecutivoHistorialForm ();
            $this->render('/reportes/rptSupervisorVsEjecutivoHistorial', array('model' => $model));
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
                            , GRUPO_SUPERVISORES_MOVI
                            , $model->horaInicioGestion
                            , $model->horaFinGestion);
//                    var_dump($datosVisitas);die();
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
        Yii::app()->session['filaSeleccionada'] = $_POST;

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
        $clientesVisitadosSupervisorRuta = 0;
        $clientesVisitadosRepetidosSupervisor = 0;
        $tiempoGestionSupervisor = '';

        $datosResumenGridCumplimientoEjecutivo = array();
        $datosResumenGridVisitasEjecutivo = array();
        $datosGridCumplimientoEjecutivo = array();
        $datosGridVisitasEjecutivo = array();
        $datosGridVisitasVIEjecutivo = array();
        $datosGridEjecutivo = array();
        $codigosClienteVisitados = array();
        $codVisitadosSupervisor = array();
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

        foreach ($historialSupervisor as $itemHistorialSupervisor) {
            $latitudCliente = 0;
            $longitudCliente = 0;
            $latitudEjecutivo = 0;
            $longitudEjecutivo = 0;

            $visitaRepetida = false;

            $distanciaEntreSupervisorCliente = 0;
            $distanciaEntreSupervisorEjecutivo = 0;
            $distanciaEntreEjecutivoCliente = 0;

            #CONTROL DE SI EL DIA DE LA RUTA SELECCIONADA EN EL GRID ES DE SUPERVISOR O DE EJECUTIVO 
            #EJECUTIVO TIENE 1 DIGITO DEL 1 AL 6 O LONGITUD 1, EJEMPLO R1-JCL
            #SUPERVISOR NO TIENE DIGITOS, EJEMPLO R-RGUA
            $cliente = ClienteModel::model()->findAllByAttributes(array('cli_codigo_cliente' => $itemHistorialSupervisor['CODIGOCLIENTE']));

            if (strlen($_POST['diaRuta']) == 1 || strlen($_POST['diaRuta']) == 2) {

                #IDENTIFICA EL INICIO DEL RANGO DE VERIFICACIÓN DE LA VISITA PARA EL EJECUTIVO
                $dia_menos_siete_dias = date('Y-m-d', strtotime($_POST['fechaGestion'] . ' - 7 days'));
                $fechaInicioRango = date('Y-m-d', strtotime("last Monday", strtotime($dia_menos_siete_dias)));

                #SE SUMA UN DIA PARA QUE EN LA CONSULTA SE INCLUIA EL DIA QUE HIZO LA GESTION EL SUPERVISOR
                $fechaFinRango = date('Y-m-d', strtotime($_POST['fechaGestion'] . ' + 1 days'));

                $visitaEjecutivo = $fHistorial->getDatosUltimaVisitaxEjecutivoxAccionxCodClientexFechaInicioxFechaFinxHoraInicioxHoraFinxRuta(
                        $ejecutivo[0]['e_usr_mobilvendor']
                        , $_POST['accionHistorial']
                        , $itemHistorialSupervisor['CODIGOCLIENTE']
                        , $fechaInicioRango
                        , $fechaFinRango
                        , $_POST['horaInicio']
                        , $_POST['horaFin']
                        , $_POST['rutaEjecutivo']);
//                var_dump($visitaEjecutivo[0]["h_fecha"]);die();
                #INICIO VALIDACION DE VISITA EJECUTIVO A CLIENTE
                if (isset($visitaEjecutivo[0])) {
                    #LA FECHA DE LA ULTIMA VISITA SE ACTUALIZA EN CADA REGISTRO HASTA EL FINAL QUEDARA CON LA ULTIMA FECHA DE VISITA
                    $ultimaVisitaEjecutivo = DateTime::createFromFormat('Y-m-d H:i:s', $visitaEjecutivo[0]["h_fecha"])->format(FORMATO_HORA_2);

                    if ($primeraVisitaEjecutivo == '')
                        $primeraVisitaEjecutivo = DateTime::createFromFormat('Y-m-d H:i:s', $visitaEjecutivo[0]["h_fecha"])->format(FORMATO_HORA_2);

                    $clientesVisitadosEjecutivoRuta += 1;

                    $latitudEjecutivo = $visitaEjecutivo[0]['LATITUDEJECUTIVO'];
                    $longitudEjecutivo = $visitaEjecutivo[0]['LONGITUDEJECUTIVO'];

                    $visitaValidaEjecutivo = false;

                    if (count($cliente) > 0) {
                        $latitudCliente = str_replace(',', '.', $cliente[0]['cli_latitud']);
                        $longitudCliente = str_replace(',', '.', $cliente[0]['cli_longitud']);

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
                    }
                } else {
                    $cantidadClientesNoVisitadosEjecutivo += 1;
                }
                #FIN VALIDACION DE VISITA EJECUTIVO A CLIENTE

                if (count($cliente) > 0) {
                    $latitudCliente = str_replace(',', '.', $cliente[0]['cli_latitud']);
                    $longitudCliente = str_replace(',', '.', $cliente[0]['cli_longitud']);
                    $distanciaEntreSupervisorCliente = $fLibreria->DistanciaEntreCoordenadas(
                            $itemHistorialSupervisor["LATITUD"]
                            , $itemHistorialSupervisor["LONGITUD"]
                            , $latitudCliente
                            , $longitudCliente);
                    $clientesVisitadosSupervisorRuta += 1;
                    array_push($codVisitadosSupervisor, $itemGridDetalleSupervisorEjecutivo = array('CODIGO' => $itemHistorialSupervisor['CODIGOCLIENTE']));
                }

                if (count($codigosClienteVisitados) > 0) {
                    foreach ($codigosClienteVisitados as $item) {
                        if (in_array($itemHistorialSupervisor['CODIGOCLIENTE'], $item)) {
                            $visitaRepetida = true;
                            break;
                        }
                    }
                }

                $visitaValidaSupervisor = false;
                if (intval($_POST['precision']) != 0) {
                    if ($distanciaEntreSupervisorCliente <= intval($_POST['precision'])) {
                        if (!$visitaRepetida) {
                            $visitasSupervisorValidas += 1;
                            $visitaValidaSupervisor = true;
                        } else {
                            $clientesVisitadosRepetidosSupervisor += 1;
                        }
                    } else {
                        $visitasSupervisorInvalidas += 1;
                        $visitaInvalidaSupervisor = false;
                    }
                } else {
                    if (!$visitaRepetida) {
                        $visitasSupervisorValidas += 1;
                        $visitaValidaSupervisor = true;
                    } else {
                        $clientesVisitadosRepetidosSupervisor += 1;
                    }
                }

                $itemGridDetalleSupervisorEjecutivo = array(
                    'FECHAGESTIONS' => (isset($itemHistorialSupervisor['FECHAVISITA'])) ? $itemHistorialSupervisor['FECHAVISITA'] : 'NA',
                    'FECHAGESTIONE' => (isset($visitaEjecutivo[0]["h_fecha"])) ? DateTime::createFromFormat('Y-m-d H:i:s', $visitaEjecutivo[0]["h_fecha"])->format(FORMATO_FECHA_LONG_3) : 'No gestionado en periodo',
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

                array_push($codigosClienteVisitados, $itemGridDetalleSupervisorEjecutivo = array('CODIGO' => $itemHistorialSupervisor['CODIGOCLIENTE']));
            }#FIN CONTROL DE DIA RUTA SELECCIONADA
        }//fin de iteracion historial supervisor
//        var_dump($codVisitadosSupervisor);die();
        /* CONTROL DE SI EL DIA DE LA RUTA SELECCIONADA EN EL GRID ES DE SUPERVISOR O DE EJECUTIVO 
          EJECUTIVO TIENE 1 DIGITO DEL 1 AL 6 O LONGITUD 1, EJEMPLO R1-JCL
          SUPERVISOR NO TIENE DIGITOS, EJEMPLO R-RGUA */
        if (strlen($_POST['diaRuta']) == 1 || strlen($_POST['diaRuta']) == 2) {
            $clientesxRuta = intval($fRutas->getTotalClientesxRutaxEjecutivoxDia($_POST['ejecutivo'], $_POST['diaRuta'] + 1)[0]['TOTALCLIENTES']);
//            var_dump($clientesxRuta,$clientesVisitadosSupervisorRuta);die();
            $cumplimientoRutaSupervisor = round(($clientesVisitadosSupervisorRuta / $clientesxRuta) * 100);
            $cantidadClientesNoVisitadosSupervisor = $fRutas->getTotalClientesNoVisitadosxRutaxEjecutivo($_POST['ejecutivo'], $_POST['diaRuta'] + 1, $_POST['fechaGestion'], $_POST['supervisor'])[0]['CLIENTESNOVISITADOS'];

            if ($primeraVisitaEjecutivo == '')
                $primeraVisitaEjecutivo = 'Sin gestion';

            if ($ultimaVisitaEjecutivo == '')
                $ultimaVisitaEjecutivo = 'Sin gestion';

            if ($primeraVisitaEjecutivo != 'Sin gestion' || $ultimaVisitaEjecutivo != 'Sin gestion') {
                $inicioE = new DateTime($primeraVisitaEjecutivo);
                $finE = new DateTime($ultimaVisitaEjecutivo);
                $tiempoGestionEjecutivo = $inicioE->diff($finE)->format("%hh %im");
            } else
                $tiempoGestionEjecutivo = 'Sin gestion';
        }

        $primeraVisitaSupervisor = $fHistorial->getPrimeraVisitaxEjecutivoxFechaxHoraInicioxHoraFin(
                        $_POST['accionHistorial']
                        , $_POST['fechaGestion']
                        , $_POST['horaInicio']
                        , $_POST['horaFin']
                        , $_POST['supervisor'])[0]['RESULTADO'];
        $ultimaVisitaSupervisor = $fHistorial->getUltimaVisitaxEjecutivoxFechaxHoraInicioxHoraFin(
                        $_POST['accionHistorial']
                        , $_POST['fechaGestion']
                        , $_POST['horaInicio']
                        , $_POST['horaFin']
                        , $_POST['supervisor'])[0]['RESULTADO'];
        $inicio = new DateTime($primeraVisitaSupervisor);
        $fin = new DateTime($ultimaVisitaSupervisor);
        $tiempoGestionSupervisor = $inicio->diff($fin)->format("%hh %im");

        $datosInformes['gridDetalleSupervisorEjecutivo'] = $datosGridDetalleSupervisorEjecutivo;
        Yii::app()->session['gridDetalleSupervisorEjecutivo'] = $datosGridDetalleSupervisorEjecutivo;

        #CONTROL DE SI EL DIA DE LA RUTA SELECCIONADA EN EL GRID ES DE SUPERVISOR O DE EJECUTIVO 
        #EJECUTIVO TIENE 1 DIGITO DEL 1 AL 6 O LONGITUD 1, EJEMPLO R1-JCL
        #SUPERVISOR NO TIENE DIGITOS, EJEMPLO R-RGUA
        if (strlen($_POST['diaRuta']) == 1 || strlen($_POST['diaRuta']) == 2) {
            $cumplimientoCoordenadasValidasSupervisor = ($clientesVisitadosSupervisorRuta > 0) ? round(($visitasSupervisorValidas / $clientesVisitadosSupervisorRuta) * 100) : 0;
            $resumenCumplimientoSupervisor = array(
                'PRIMERA-VISITA' => ($primeraVisitaSupervisor == null) ? "ERROR" : $primeraVisitaSupervisor,
                'ULTIMA-VISITA' => ($ultimaVisitaSupervisor == null) ? "ERROR" : $ultimaVisitaSupervisor,
                'TIEMPO-GESTION' => ($tiempoGestionSupervisor == null) ? "0" : $tiempoGestionSupervisor,
                '%-CUMPLIMIENTO_RUTA' => ($cumplimientoRutaSupervisor == null) ? "0%" : $cumplimientoRutaSupervisor . "%",
                '%-CUMPLIMIENTO_COORD' => ($cumplimientoCoordenadasValidasSupervisor == null) ? "0%" : $cumplimientoCoordenadasValidasSupervisor . "%",
            );
            $resumenVisitasSupervisor = array(
                'CLIENTES-RUTA' => ($clientesxRuta == null) ? 0 : $clientesxRuta,
                'CLIENTES-VISITADOS' => ($clientesVisitadosSupervisorRuta == null) ? 0 : $clientesVisitadosSupervisorRuta,
                'CLIENTES-NO-VISITADOS' => ($cantidadClientesNoVisitadosSupervisor == null) ? 0 : $cantidadClientesNoVisitadosSupervisor,
                'CLIENTES-VISITA_REPETIDA' => ($clientesVisitadosRepetidosSupervisor == null) ? 0 : $clientesVisitadosRepetidosSupervisor,
            );
            array_push($datosResumenGridVisitasSupervisor, $resumenVisitasSupervisor);
            unset($resumenVisitasSupervisor);

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
            $datosInformes['gridVisitasSupervisor'] = $datosGridVisitasSupervisor;

//            var_dump($clientesVisitadosEjecutivoRuta,$clientesxRuta);die();
            $cumplimientoRutaEjecutivo = ($clientesxRuta > 0) ? round(($clientesVisitadosEjecutivoRuta / $clientesxRuta) * 100) : 0;
            $cumplimientoCoordenadasValidasEjecutivo = ($clientesVisitadosEjecutivoRuta > 0) ? round(($visitasEjecutivoValidas / $clientesVisitadosSupervisorRuta) * 100) : 0;
            $resumenCumplimientoEjecutivo = array(
                'PRIMERA-VISITA' => ($primeraVisitaEjecutivo == null) ? "ERROR" : $primeraVisitaEjecutivo,
                'ULTIMA-VISITA' => ($ultimaVisitaEjecutivo == null) ? "ERROR" : $ultimaVisitaEjecutivo,
                'TIEMPO-GESTION' => ($tiempoGestionEjecutivo == null) ? "0" : $tiempoGestionEjecutivo,
                '%-CUMPLIMIENTO_RUTA' => ($cumplimientoRutaEjecutivo == null) ? "0%" : $cumplimientoRutaEjecutivo . "%",
                '%-CUMPLIMIENTO_COORD' => ($cumplimientoCoordenadasValidasEjecutivo == null) ? "0%" : $cumplimientoCoordenadasValidasEjecutivo . "%",
            );
            array_push($datosResumenGridCumplimientoEjecutivo, $resumenCumplimientoEjecutivo);
            unset($resumenCumplimientoEjecutivo);

            $resumenVisitasEjecutivo = array(
                'CLIENTES-VIS_SUP' => ($clientesVisitadosSupervisorRuta == null) ? 0 : $clientesVisitadosSupervisorRuta,
                'CLIENTES-VISITADOS' => ($clientesVisitadosEjecutivoRuta == null) ? 0 : $clientesVisitadosEjecutivoRuta,
                'CLIENTES-NO-VISITADOS' => ($cantidadClientesNoVisitadosEjecutivo == null) ? 0 : $cantidadClientesNoVisitadosEjecutivo,
            );
            array_push($datosResumenGridVisitasEjecutivo, $resumenVisitasEjecutivo);
            unset($resumenVisitasEjecutivo);
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
            $datosInformes['gridVisitasEjecutivo'] = $datosGridVisitasEjecutivo;
        } else {
            $resumenCumplimientoSupervisor = array(
                'PRIMERA-VISITA' => ($primeraVisitaSupervisor == null) ? "ERROR" : $primeraVisitaSupervisor,
                'ULTIMA-VISITA' => ($ultimaVisitaSupervisor == null) ? "ERROR" : $ultimaVisitaSupervisor,
                'TIEMPO-GESTION' => ($tiempoGestionSupervisor == null) ? "ERROR" : $tiempoGestionSupervisor,
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
        $datosInformes['gridCumplimientoSupervisor'] = $datosGridCumplimientoSupervisor;

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
        $datosInformes['gridCumplimientoEjecutivo'] = $datosGridCumplimientoEjecutivo;

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
                    'FECHA GESTION S' => $itemHistorialSupervisor['FECHAGESTIONS'],
                    'FECHA GESTION E' => $itemHistorialSupervisor['FECHAGESTIONE'],
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
                unset($dat);
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

    public function actionGenerateExcelDetalleSupervisor() {

        try {
            $response = new Response();
            $fLibreria = new Libreria();

            $fHistorial = new FHistorialModel();
            $detalleGestionSupervisor = array();
            $datosFilaSupervisor = Yii::app()->session['filaSeleccionada'];
//            var_dump($datosFilaSupervisor);die();
            $detalleHistorial = $fHistorial->getHistorialxVendedorxFecha(
                    $datosFilaSupervisor["accionHistorial"]
                    , $datosFilaSupervisor["fechaGestion"]
                    , $datosFilaSupervisor["ejecutivo"]);
            $ultimoCodigoHistorial = 1;
            $totalGestion = '00:00:00';
            $totalTraslados = '00:00:00';
            $tiempoTraslado = '00:00:00';
            $tiempoGestion = '00:00:00';
            $distanciaSupCliente = '';

            foreach ($detalleHistorial as $itemHistorialSupervisor) {
//                var_dump($itemHistorialSupervisor);                die();
                $cliente = ClienteModel::model()->findAllByAttributes(array('cli_codigo_cliente' => $itemHistorialSupervisor['CODIGOCLIENTE']));
                if (count($cliente) > 0) {
                    $latitudCliente = str_replace(',', '.', $cliente[0]['cli_latitud']);
                    $longitudCliente = str_replace(',', '.', $cliente[0]['cli_longitud']);
                    $distanciaEntreSupervisorCliente = $fLibreria->DistanciaEntreCoordenadas(
                            $itemHistorialSupervisor["LATITUD"]
                            , $itemHistorialSupervisor["LONGITUD"]
                            , $latitudCliente
                            , $longitudCliente);
                    $distanciaSupCliente = number_format($distanciaEntreSupervisorCliente, 2, '.', '');
                    if ($itemHistorialSupervisor["LATITUD"] == 0 && $itemHistorialSupervisor["LONGITUD"] == 0)
                        $distanciaSupCliente = 'Sin coordenadas supervisor';
                } else {
                    $latitudCliente = 0;
                    $longitudCliente = 0;

                    if ($itemHistorialSupervisor["LATITUD"] == 0 && $itemHistorialSupervisor["LONGITUD"] == 0)
                        $distanciaSupCliente = 'Sin coordenadas cliente y supervisor';
                    else
                        $distanciaSupCliente = 'Sin coordenadas cliente';
                }

                $fechaGestion = DateTime::createFromFormat('Y-m-d H:i:s', $itemHistorialSupervisor['FECHAVISITA'])->format(FORMATO_FECHA);

                $inicioVisita = $fHistorial->getInicioFinVisitaClientexEjecutivoxFecha('Inicio visita', $fechaGestion, $datosFilaSupervisor["ejecutivo"], $itemHistorialSupervisor['CODIGOCLIENTE'], $ultimoCodigoHistorial);
                $finVisita = $fHistorial->getInicioFinVisitaClientexEjecutivoxFecha('Fin de visita', $fechaGestion, $datosFilaSupervisor["ejecutivo"], $itemHistorialSupervisor['CODIGOCLIENTE'], $ultimoCodigoHistorial);

                $nombre = array();
                $nombre = explode(' ', $itemHistorialSupervisor['NOMBRECLIENTE']);
                $primerApellido = $nombre[0];
                $primerNombre = (isset($nombre[2]) && strlen($nombre[2]) > 0) ? $nombre[2] : $nombre[1];
                $dat = array(
                    'FECHA_GESTION' => $itemHistorialSupervisor['FECHAVISITA'],
                    'CODIGO_CLIENTE' => $itemHistorialSupervisor['CODIGOCLIENTE'],
                    'CLIENTE' => $primerApellido . ' ' . $primerNombre, //$itemHistorialSupervisor['NOMBRECLIENTE'],
                    'RUTA' => $itemHistorialSupervisor['RUTAVISITA'],
                    'INICIO_VISITA' => $inicioVisita[0]['HORAVISITA'],
                    'FIN_VISITA' => $finVisita[0]['HORAVISITA'],
                    'T_GESTION' => '',
                    'T_TRASLADO' => '',
                    'DISTANCIA_CLIENTE_SUP' => $distanciaSupCliente,
                    'DISTANCIA_CLIENTES' => '',
                );
                $ultimoCodigoHistorial = $inicioVisita[0]['IDHISTORIAL'];
                array_push($detalleGestionSupervisor, $dat);
                unset($dat);
            }

            $columnasCentrar = array();
            array_push($columnasCentrar, array('NUMCOLUMNA' => '3')); #RUTA
            array_push($columnasCentrar, array('NUMCOLUMNA' => '4')); #INICIO_VISITA
            array_push($columnasCentrar, array('NUMCOLUMNA' => '5')); #FIN_VISITA
            array_push($columnasCentrar, array('NUMCOLUMNA' => '6')); #T_GESTION
            array_push($columnasCentrar, array('NUMCOLUMNA' => '7')); #T_TRASLADO
            array_push($columnasCentrar, array('NUMCOLUMNA' => '8')); #DISTANCIA_CLIENTE_SUP
            array_push($columnasCentrar, array('NUMCOLUMNA' => '9')); #DISTANCIA_CLIENTES
//            var_dump($columnasCentrar);die();

            for ($iterador = 0; $iterador < count($detalleGestionSupervisor); $iterador++) {
                $inicioVisita = new DateTime($detalleGestionSupervisor[$iterador]["INICIO_VISITA"]);
                $finVisita = new DateTime($detalleGestionSupervisor[$iterador]["FIN_VISITA"]);

                $tiempoGestion = $inicioVisita->diff($finVisita)->format("%h:%I:%S");
                $detalleGestionSupervisor[$iterador]["T_GESTION"] = $tiempoGestion;
                if ($iterador >= 1) {
                    $finVisitaAnterior = new DateTime($detalleGestionSupervisor[$iterador - 1]["FIN_VISITA"]);
                    $tiempoTraslado = $inicioVisita->diff($finVisitaAnterior)->format("%h:%I:%S");
                    $detalleGestionSupervisor[$iterador]["T_TRASLADO"] = $tiempoTraslado;
                    $totalTraslados = $fLibreria->SumaHoras($totalTraslados, $tiempoTraslado);

                    $cliente = ClienteModel::model()->findAllByAttributes(array('cli_codigo_cliente' => $detalleGestionSupervisor[$iterador]["CODIGO_CLIENTE"]));
                    if (count($cliente) > 0) {
                        $latitudCliente = str_replace(',', '.', $cliente[0]['cli_latitud']);
                        $longitudCliente = str_replace(',', '.', $cliente[0]['cli_longitud']);
                        $clienteAnterior = ClienteModel::model()->findAllByAttributes(array('cli_codigo_cliente' => $detalleGestionSupervisor[$iterador - 1]["CODIGO_CLIENTE"]));
                        if (count($clienteAnterior) > 0) {
                            $latitudClienteAnterior = str_replace(',', '.', $clienteAnterior[0]['cli_latitud']);
                            $longitudClienteAnterior = str_replace(',', '.', $clienteAnterior[0]['cli_longitud']);
                            $distanciaEntreCliente = $fLibreria->DistanciaEntreCoordenadas(
                                    $latitudCliente
                                    , $longitudCliente
                                    , $latitudClienteAnterior
                                    , $longitudClienteAnterior
                            );

                            if ($latitudCliente == 0 && $longitudCliente == 0)
                                $detalleGestionSupervisor[$iterador]["DISTANCIA_CLIENTES"] = 'Sin coordenadas cliente';
                            else
                                $detalleGestionSupervisor[$iterador]["DISTANCIA_CLIENTES"] = number_format($distanciaEntreCliente, 2, '.', '');
                        } else {
                            $latitudClienteAnterior = 0;
                            $longitudClienteAnterior = 0;
                            if ($latitudClienteAnterior == 0 && $longitudClienteAnterior == 0)
                                $detalleGestionSupervisor[$iterador]["DISTANCIA_CLIENTES"] = 'Sin coordenadas cliente';
                        }
                    } else {
                        $latitudCliente = 0;
                        $longitudCliente = 0;
                        if ($latitudCliente == 0 && $longitudCliente == 0)
                            $detalleGestionSupervisor[$iterador]["DISTANCIA_CLIENTES"] = 'Sin coordenadas cliente';
                    }
                }
                $totalGestion = $fLibreria->SumaHoras($totalGestion, $tiempoGestion);
            }
            $dat = array(
                'FECHA_GESTION' => '', 'CODIGO_CLIENTE' => '', 'CLIENTE' => '', 'RUTA' => '', 'INICIO_VISITA' => '',
                'FIN_VISITA' => 'TOTALES: ',
                'T_GESTION' => $totalGestion,
                'T_TRASLADO' => $totalTraslados,
                'DISTANCIA_CLIENTE_SUP' => '',
            );
            array_push($detalleGestionSupervisor, $dat);
            unset($dat);
//            var_dump(strtotime($totalGestion), count($detalleHistorial));            die();
            $StotalGestion = DateTime::createFromFormat('H:i:s', $totalGestion)->format(FORMATO_HORA);
//            var_dump($StotalGestion);die();
//            var_dump($totalGestion, count($detalleHistorial), gmdate("H:i:s", strtotime($StotalGestion) / count($detalleHistorial)));            die();
//            $promedioGestion = $totalGestion / count($itemHistorialSupervisor);
//            $promedioTraslado = $totalTraslados / count($itemHistorialSupervisor);
//            $dat = array(
//                'FECHA_GESTION' => '', 'CODIGO_CLIENTE' => '', 'CLIENTE' => '', 'RUTA' => '', 'INICIO_VISITA' => '',
//                'FIN_VISITA' => 'TOTALES: ',
//                'T_GESTION' => $totalGestion,
//                'T_TRASLADO' => $totalTraslados,
//                'DISTANCIA_CLIENTE_SUP' => '',
//            );
//            array_push($detalleGestionSupervisor, $dat);
//            unset($dat);

            $NombreArchivo = "rpt_detalle_visitas_supervisor";
            $NombreHoja = "rpt_detalle_visitas_supervisor";

            $autor = "Tececab"; //$_SESSION['CUENTA'];
            $titulo = "rpt_detalle_visitas_supervisor";
            $tema = "rpt_detalle_visitas_supervisor";
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

            $encabezadoImprimir = 'DETALLE GESTION  ' . $datosFilaSupervisor["fechaGestion"] . ' - ' . $datosFilaSupervisor["nombreEjecutivo"];
            $footerImprimir = Yii::app()->user->name . ' - ' . date('Y/m/d h:i');

            $excel->Mapeo($detalleGestionSupervisor, $encabezadoImprimir, $footerImprimir, $columnasCentrar);

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
