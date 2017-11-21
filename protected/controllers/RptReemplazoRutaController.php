<?php

/**
 * Description
 * @fecha 
 * @author 
 */
class RptReemplazoRutaController extends Controller {

    public function actionIndex() {
        Yii::app()->user->setFlash('resultadoGuardar', null);
        if (Yii::app()->request->isAjaxRequest) {
            return;
        } else {
            Yii::app()->session['RptReemplazoRutaForm '] = '';
            $model = new RptReemplazoRutaForm ();
            $this->render('/historialmb/rptReemplazoRuta', array('model' => $model));
        }
    }

    public function actionRevisarHistorial() {
        $response = new Response();
        try {
            $model = new RptReemplazoRutaForm();
//            var_dump($_POST['RptSupervisorVsEjecutivoHistorialForm']);die();
            if (isset($_POST['RptReemplazoRutaForm'])) {
                if ($model->validate()) {
                    $model->attributes = $_POST['RptReemplazoRutaForm'];
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

        $datos = array();
        $datosDetalleGrid = array();
        $datosResumenGrid = array();
        $datosResumenGridIzquierda = array();
        $datosResumenGridDerecha = array();

        $coordenadasClientes = array();
        $coordenadasVisitas = array();
        $itemCoordenadaCliente = array();
        $itemCoordenadaVisita = array();

        $_totalVentaDia = 0;
        $_totalVentaRuta = 0;
        $_totalVentaFueraRuta = 0;
        $_totalClientesVenta = 0;

        $datosResumenGridGeneral = array();
        $datosResumenGridVisitas = array();
        $datosResumenGridVisitasValidasInvalidas = array();
        $datosResumenGridPrimeraUltimaVisita = array();
        $datosResumenGridVentas = array();

//        $modelo = new RptResumenDiarioHistorialForm ();
        $response = new Response();
        try {
            $solicitarLogin = true;
            if (Yii::app()->user->id <> intval(USUARIO_INVITADO)) {
                $solicitarLogin = false;
                $model = new RptReemplazoRutaForm();
//                if (isset($_POST['RptReemplazoRutaForm'])) {
                if (true) {
                    $libreriaFunciones = new Libreria();

                    $usuarioSupervisor = $_POST["supervisor"];
                    $inicialesEjecutivo = $_POST["ejecutivo"];
                    $rutaEjecutivo = $_POST["rutaEjecutivo"];
                    $diaRutaEjecutivo = $_POST["diaRuta"];
                    $fechaGestion = $_POST["fechaGestion"];
                    $accionHistorial = $_POST["accionHistorial"];
                    $horaInicio = $_POST["horaInicio"];
                    $horaFin = $_POST["horaFin"];
                    $precisionVisita = $_POST["precision"];


                    $fila = 1;
                    $fHistorial = new FHistorialModel();
                    $fOrden = new FOrdenModel();
                    $fRuta = new FRutaModel();
                    $visitasRutaEjecutivo = 0;
                    $ejecutivo = EjecutivoModel::model()->findAllByAttributes(array('e_iniciales' => $inicialesEjecutivo));
                    $codEjecutivo = $ejecutivo[0]['e_usr_mobilvendor'];

                    $rsRuta = new FRutaModel ();

                    $diaGestionSupervisor = $diaRutaEjecutivo;
                    $ruta_dia_gestion = $rutaEjecutivo;
                    $visitasRutaEjecutivo = intval($rsRuta->getVisitasSupervisorRutaEjecutivoxFecha(
                                    $ruta_dia_gestion
                                    , $fechaGestion
                                    , $usuarioSupervisor)[0]['CLIENTESVISITADOS']);

                    if ($visitasRutaEjecutivo > 0) {
                        $fila = 1;
                        $fHistorial = new FHistorialModel ();
                        $fOrden = new FOrdenModel ();
                        $fRuta = new FRutaModel ();
                        $historial = $fHistorial->getHistorialxSupervisorxFechaxHoraInicioxHoraFin(
                                $accionHistorial
                                , $fechaGestion
                                , $horaInicio
                                , $horaFin
                                , $usuarioSupervisor
                                , $rutaEjecutivo
                        );

                        if (count($historial)) {

                            $primeraVisita = $fHistorial->getPrimeraVisitaxEjecutivoxFechaxHoraInicioxHoraFin(
                                            $accionHistorial
                                            , $fechaGestion
                                            , $horaInicio
                                            , $horaFin
                                            , $usuarioSupervisor
                                    )[0]['RESULTADO'];
                            $ultimaVisita = $fHistorial->getUltimaVisitaxEjecutivoxFechaxHoraInicioxHoraFin(
                                            $accionHistorial
                                            , $fechaGestion
                                            , $horaInicio
                                            , $horaFin
                                            , $usuarioSupervisor
                                    )[0]['RESULTADO'];

                            $rsTotalClientesRuta = $fRuta->getTotalClientesxRutaxEjecutivoxDia(
                                    $inicialesEjecutivo
                                    , $diaRutaEjecutivo + 1
                            );
                            $totalClientesRuta = $rsTotalClientesRuta[0]["TOTALCLIENTES"];

                            $nivelCumplimiento = 0;
                            $totalVisitasEfectuadas = 0;
                            $clientesNoVisitados = $fRuta->getTotalClientesNoVisitadosxRutaxEjecutivo(
                                            $inicialesEjecutivo
                                            , $diaRutaEjecutivo + 1
                                            , $fechaGestion
                                            , $usuarioSupervisor
                                    )[0]['CLIENTESNOVISITADOS'];
                            $visitasRuta = 0;
                            $visitasValidasRuta = 0;
                            $visitasFueraRuta = 0;
                            $visitasRepetidas = 0;
                            $cantidadVentaRuta = 0;
                            $cantidadVentaFueraRuta = 0;
                            $clientesConVenta = 0;
                            $totalVentaReportada = 0;
                            $visitaRepetida = false;

                            $visitaValida = false;

                            $rsTotales = new FRutaModel ();
                            $mesAnterior = date("m", strtotime(date("Y-m-t", strtotime(date('Y-m-d', strtotime($fechaGestion . ' - 1 days'))))));
                            $mesGestion = date("m", strtotime($fechaGestion));

                            //VALIDAR SI ES FIN DE MES
                            if ($mesAnterior == $mesGestion - 1) {
                                //SI ES FIN DE MES Y ES LUNES
                                if ($diaRutaEjecutivo == 1) {//1--> Lunes
                                    $fechaViernes = date('Y-m-d', strtotime($fechaGestion . ' - 3 days'));
                                    $_totalVentaViernes = intval($rsTotales->getTotalChipsVentaDia($fechaViernes, $usuarioSupervisor)[0]['RESPUESTA']);
                                    $_totalVentaRutaViernes = intval($rsTotales->getTotalChipsVentaRuta($ejecutivo[0]['e_iniciales'], 6, $fechaViernes, $usuarioSupervisor)[0]['RESPUESTA']);
                                    $_totalVentaFueraRutaViernes = intval($rsTotales->getTotalChipsVentaFueraRuta($ejecutivo[0]['e_iniciales'], 6, $fechaViernes, $usuarioSupervisor)[0]['RESPUESTA']);
                                    $_totalClientesVentaViernes = intval($rsTotales->getTotalClientesVenta($fechaViernes, $usuarioSupervisor)[0]['RESPUESTA']);

                                    $_totalVentaFinSemana = intval($rsTotales->getTotalChipsVentaFinSemana($fechaViernes, $usuarioSupervisor)[0]['RESPUESTA']);
                                    $_totalVentaRutaFinSemana = intval($rsTotales->getTotalChipsVentaFinSemana($fechaViernes, $usuarioSupervisor)[0]['RESPUESTA']);
                                    $_totalClientesVentaFinSemana = intval($rsTotales->getTotalClientesVentaFinSemana($fechaViernes, $usuarioSupervisor)[0]['RESPUESTA']);

                                    $_totalVentaDiaLunes = intval($rsTotales->getTotalChipsVentaDia($fechaGestion, $usuarioSupervisor)[0]['RESPUESTA']);
                                    $_totalVentaRutaLunes = intval($rsTotales->getTotalChipsVentaRuta($inicialesEjecutivo, $diaRutaEjecutivo + 1, $fechaGestion, $usuarioSupervisor)[0]['RESPUESTA']);
                                    $_totalVentaFueraRutaLunes = intval($rsTotales->getTotalChipsVentaFueraRuta($inicialesEjecutivo, $diaRutaEjecutivo + 1, $fechaGestion, $usuarioSupervisor)[0]['RESPUESTA']);
                                    $_totalClientesVentaLunes = intval($rsTotales->getTotalClientesVenta($fechaGestion, $usuarioSupervisor)[0]['RESPUESTA']);

                                    $_totalVentaDia = $_totalVentaViernes + $_totalVentaFinSemana + $_totalVentaDiaLunes;
                                    $_totalVentaRuta = $_totalVentaRutaViernes + $_totalVentaRutaFinSemana + $_totalVentaRutaLunes;
                                    $_totalVentaFueraRuta = $_totalVentaFueraRutaViernes + $_totalVentaFueraRutaLunes;
                                    $_totalClientesVenta = $_totalClientesVentaViernes + $_totalClientesVentaFinSemana + $_totalClientesVentaLunes;
                                } else {
                                    //SI ES FIN DE MES EN OTRO DIA QUE NO SEA LUNES
                                    $fechaDiaAnterior = date('Y-m-d', strtotime($fechaGestion . ' - 1 days'));

                                    $_totalVentaDiaAnterior = intval($rsTotales->getTotalChipsVentaDia($fechaDiaAnterior, $usuarioSupervisor)[0]['RESPUESTA']);
                                    $_totalVentaRutaDiaAnterior = intval($rsTotales->getTotalChipsVentaRuta($inicialesEjecutivo, $diaRutaEjecutivo, $fechaDiaAnterior, $usuarioSupervisor)[0]['RESPUESTA']);
                                    $_totalVentaFueraRutaDiaAnterior = intval($rsTotales->getTotalChipsVentaFueraRuta($inicialesEjecutivo, $diaRutaEjecutivo, $fechaDiaAnterior, $usuarioSupervisor)[0]['RESPUESTA']);
                                    $_totalClientesVentaDiaAnterior = intval($rsTotales->getTotalClientesVenta($fechaDiaAnterior, $usuarioSupervisor)[0]['RESPUESTA']);

                                    $_totalVentaDiaE = intval($rsTotales->getTotalChipsVentaDia($fechaGestion, $usuarioSupervisor)[0]['RESPUESTA']);
                                    $_totalVentaRutaDia = intval($rsTotales->getTotalChipsVentaRuta($inicialesEjecutivo, $diaRutaEjecutivo + 1, $fechaGestion, $usuarioSupervisor)[0]['RESPUESTA']);
                                    $_totalVentaFueraRutaDia = intval($rsTotales->getTotalChipsVentaFueraRuta($inicialesEjecutivo, $diaRutaEjecutivo + 1, $fechaGestion, $usuarioSupervisor)[0]['RESPUESTA']);
                                    $_totalClientesVentaDia = intval($rsTotales->getTotalClientesVenta($fechaGestion, $usuarioSupervisor)[0]['RESPUESTA']);

                                    $_totalVentaDia = $_totalVentaDiaAnterior + $_totalVentaDiaE;
                                    $_totalVentaRuta = $_totalVentaRutaDiaAnterior + $_totalVentaRutaDia;
                                    $_totalVentaFueraRuta = $_totalVentaFueraRutaDiaAnterior + $_totalVentaFueraRutaDia;
                                    $_totalClientesVenta = $_totalClientesVentaDiaAnterior + $_totalClientesVentaDia;
                                }
                            } else {
                                //NO ES FIN DE MES Y ES VIERNES -> SE ANALIZA LAS VENTAS DE SABADO Y DOMINGO CONSECUTIVOS AL VIERNES
                                if ($diaGestionSupervisor == 5) { //5-> viernes
                                    $_totalVentaViernes = intval($rsTotales->getTotalChipsVentaDia($fechaGestion, $usuarioSupervisor)[0]['RESPUESTA']);
                                    $_totalVentaRutaViernes = intval($rsTotales->getTotalChipsVentaRuta($inicialesEjecutivo, $diaGestion + 1, $fechaGestion, $usuarioSupervisor)[0]['RESPUESTA']);
                                    $_totalVentaFueraRutaViernes = intval($rsTotales->getTotalChipsVentaFueraRuta($inicialesEjecutivo, $diaGestion + 1, $fechaGestion, $usuarioSupervisor)[0]['RESPUESTA']);
                                    $_totalClientesVentaViernes = intval($rsTotales->getTotalClientesVenta($fechaGestion, $usuarioSupervisor)[0]['RESPUESTA']);

                                    $_totalVentaFinSemana = intval($rsTotales->getTotalChipsVentaFinSemana($inicialesEjecutivo, $diaGestion + 1, $fechaGestion, $usuarioSupervisor)[0]['RESPUESTA']);
                                    $_totalVentaRutaFinSemana = intval($rsTotales->getTotalChipsVentaFinSemana($inicialesEjecutivo, $diaGestion + 1, $fechaGestion, $usuarioSupervisor)[0]['RESPUESTA']);
                                    $_totalClientesVentaFinSemana = intval($rsTotales->getTotalClientesVentaFinSemana($inicialesEjecutivo, $diaGestion + 1, $fechaGestion, $codEjecutivo)[0]['RESPUESTA']);

                                    $_totalVentaDia = $_totalVentaViernes + $_totalVentaFinSemana;
                                    $_totalVentaRuta = $_totalVentaRutaViernes + $_totalVentaRutaFinSemana;
                                    $_totalVentaFueraRuta = $_totalVentaFueraRutaViernes;
                                    $_totalClientesVenta = $_totalClientesVentaViernes + $_totalClientesVentaFinSemana;
                                } else {
                                    //NO ES FIN DE MES -> DIA NORMAL
                                    $_totalVentaDia = intval($rsTotales->getTotalChipsVentaDia($fechaGestion, $usuarioSupervisor)[0]['RESPUESTA']);
                                    $_totalVentaRuta = intval($rsTotales->getTotalChipsVentaRuta($inicialesEjecutivo, $diaGestionSupervisor + 1, $fechaGestion, $usuarioSupervisor)[0]['RESPUESTA']);
                                    $_totalVentaFueraRuta = intval($rsTotales->getTotalChipsVentaFueraRuta($inicialesEjecutivo, $diaGestionSupervisor + 1, $fechaGestion, $usuarioSupervisor)[0]['RESPUESTA']);
                                    $_totalClientesVenta = intval($rsTotales->getTotalClientesVenta($fechaGestion, $usuarioSupervisor)[0]['RESPUESTA']);
                                }
                            }
                            $visitasValidas = 0;
                            $visitasInvalidas = 0;
//                                var_dump($historial);die();
                            foreach ($historial as $itemHistorial) {

                                $cliente = ClienteModel::model()->findAllByAttributes(array('cli_codigo_cliente' => $itemHistorial['CODIGOCLIENTE']));
                                if (count($cliente) > 0) {
                                    $latitudCliente = str_replace(',', '.', $cliente[0]['cli_latitud']);
                                    $longitudCliente = str_replace(',', '.', $cliente[0]['cli_longitud']);
                                } else {
                                    $latitudCliente = 0;
                                    $longitudCliente = 0;
                                }
                                $latitudHistorial = floatval(str_replace(",", ".", $itemHistorial['LATITUD']));
                                $longitudHistorial = floatval(str_replace(",", ".", $itemHistorial['LONGITUD']));

                                $itemCoordenadaCliente = array(
                                    'LATITUD' => $latitudCliente,
                                    'LONGITUD' => $longitudCliente,
                                    'LABEL' => $itemHistorial['CODIGOCLIENTE']
                                );
                                array_push($coordenadasClientes, $itemCoordenadaCliente);
                                unset($itemCoordenadaCliente);
                                $itemCoordenadaVisita = array(
                                    'LATITUD' => $latitudHistorial,
                                    'LONGITUD' => $longitudHistorial,
//                                    'LABEL' => $ejecutivo[0]->e_usr_mobilvendor . '-' . $itemHistorial['CODIGOCLIENTE']
                                    'LABEL' => $itemHistorial['CODIGOCLIENTE']
                                );
                                array_push($coordenadasVisitas, $itemCoordenadaVisita);
                                unset($itemCoordenadaVisita);

                                $distancia = $libreriaFunciones->DistanciaEntreCoordenadas($latitudCliente, $longitudCliente, $latitudHistorial, $longitudHistorial);
                                if ($precisionVisita != 0) {
                                    if ($distancia <= $precisionVisita) {
                                        $visitasValidas += 1;
                                        $visitaValida = true;
                                    } else {
                                        $visitasInvalidas += 1;
                                        $visitaValida = false;
                                    }
                                } else {
                                    $visitasValidas += 1;
                                    $visitaValida = true;
                                }

                                $fechaHistorialSinFormato = new DateTime($itemHistorial['FECHAVISITA']);
                                $fechaHistorial = $fechaHistorialSinFormato->format('Y-m-d');

                                $estadoRevisionRuta = '';
                                $cantidadChips = $fOrden->getChipsxClientexEjecutivoxFecha($itemHistorial['CODIGOCLIENTE'], $usuarioSupervisor, $fechaHistorial);
                                $chips = $cantidadChips[0]['CHIPS'];

                                foreach ($datosDetalleGrid as $item) {
                                    if (in_array($itemHistorial['CODIGOCLIENTE'], $item) && intval($item['CHIPSCOMPRADOS']) > 0) {
                                        $chips = "0";
                                    }
                                }

                                $ruta = $fRuta->getRutaxCliente($itemHistorial['CODIGOCLIENTE'], $inicialesEjecutivo);
                                if (count($ruta) == 0) {
                                    $rutaCliente = "Sin ruta";
                                    $secuenciaRutaCliente = "Sin secuencia";
                                } else {
                                    $rutaCliente = $ruta[0]['RUTA'];
                                    $secuenciaRutaCliente = $ruta[0]['SECUENCIA'];
                                    if ($chips > 0) {
                                        $clientesConVenta += 1;
                                    }
                                }
                                $visitaRepetida = false;
//                                var_dump($ruta_dia_gestion ,$rutaCliente);die();
                                if ($ruta_dia_gestion == $rutaCliente) {
                                    foreach ($datosDetalleGrid as $item) {
                                        if (in_array($itemHistorial['CODIGOCLIENTE'], $item)) {
                                            $visitaRepetida = true;
                                            break;
                                        }
                                    }

                                    if ($visitaRepetida) {
                                        $estadoRevisionRuta = 'Visita en ruta repetida';
                                        $visitasValidas -= 1;
                                        $visitasRepetidas += 1;
                                    } else {
                                        $estadoRevisionRuta = 'Visita en ruta';
                                        $visitasRuta += 1;
                                        if ($visitaValida)
                                            $visitasValidasRuta += 1;
                                    }

                                    if ($chips > 0) {
                                        $cantidadVentaRuta += $chips;
                                    }
                                } else {
                                    $estadoRevisionRuta = 'Visita fuera de ruta';
                                    $visitasFueraRuta += 1;
                                    if ($chips > 0) {
                                        $cantidadVentaFueraRuta += $chips;
                                    }
                                }

                                if ($fila == $secuenciaRutaCliente) {
                                    $estadoRevisionS = 'Secuencia OK';
                                } else {
                                    $estadoRevisionS = 'Otra secuencia';
                                }

                                $totalVentaReportada = $cantidadVentaFueraRuta + $cantidadVentaRuta;
                                $totalVisitasEfectuadas = $visitasRuta + $visitasFueraRuta;
                                $nivelCumplimiento = ceil(($visitasValidasRuta / $totalClientesRuta) * 100);
//                                var_dump($visitasValidasRuta,$totalClientesRuta,$nivelCumplimiento );
                                $revisionRuta = array(
                                    'FECHAREVISION' => date(FORMATO_FECHA),
                                    'FECHARUTA' => $itemHistorial['FECHAVISITA'],
                                    'CODEJECUTIVO' => $ejecutivo[0]->e_usr_mobilvendor,
                                    'EJECUTIVO' => $ejecutivo[0]->e_nombre,
                                    'CODIGOCLIENTE' => $itemHistorial['CODIGOCLIENTE'],
                                    'CLIENTE' => $itemHistorial['NOMBRECLIENTE'],
                                    'RUTAUSADA' => $itemHistorial['RUTAVISITA'],
                                    'SECUENCIAVISITA' => $fila,
                                    'RUTACLIENTE' => $rutaCliente,
                                    'SECUENCIARUTA' => $secuenciaRutaCliente,
                                    'ESTADOREVISIONR' => $estadoRevisionRuta,
                                    'ESTADOREVISIONS' => $estadoRevisionS,
                                    'CHIPSCOMPRADOS' => $chips,
                                    'METROS' => number_format($distancia, 2, '.', ''),
                                    'VALIDACION' => ($visitaValida == true) ? "VALIDA" : "INVALIDA",
                                    'LATITUDC' => number_format($latitudCliente, 6, '.', ''),
                                    'LONGITUDC' => number_format($longitudCliente, 6, '.', ''),
                                    'LATITUDH' => number_format($latitudHistorial, 6, '.', ''),
                                    'LONGITUDH' => number_format($longitudHistorial, 6, '.', ''),
                                );
                                $fila = $fila + 1;
                                array_push($datosDetalleGrid, $revisionRuta);
                                $datos['detalle'] = $datosDetalleGrid;
                                unset($revisionRuta);
                            }// Fin iteracion items historial
//                                var_dump($datosDetalleGrid);die();
//                                die();
                            $resumenRuta = array(
                                'PORCENTAJE-CUMPLIMIENTO' => ($nivelCumplimiento == null) ? "0%" : $nivelCumplimiento . "%",
                                'TOTAL-VENTA-REPORTADA' => ($_totalVentaDia == null) ? 0 : $_totalVentaDia,
                                'CLIENTES-RUTA' => ($totalClientesRuta == null) ? 0 : $totalClientesRuta,
                                'VISITAS-EFECTUADAS-EN-RUTA' => ($visitasValidasRuta == null) ? 0 : $visitasValidasRuta,
                                'CLIENTES-NO-VISITADOS' => ($clientesNoVisitados == null) ? 0 : $clientesNoVisitados,
                                'VISITAS-FUERA-RUTA' => ($visitasFueraRuta == null) ? 0 : $visitasFueraRuta,
                                'VISITAS-REPETIDAS' => ($visitasRepetidas == null) ? 0 : $visitasRepetidas,
                                'CLIENTES-VENTA' => ($_totalClientesVenta == null) ? 0 : $_totalClientesVenta,
                                'CANTIDAD-VENTA-RUTA' => ($_totalVentaRuta == null) ? 0 : $_totalVentaRuta,
                                'CANTIDAD-VENTA-FUERA-RUTA' => ($_totalVentaFueraRuta == null) ? 0 : $_totalVentaFueraRuta,
                            );
                            array_push($datosResumenGrid, $resumenRuta);
                            unset($resumenRuta);
//                            var_dump($datosResumenGrid);die();

                            foreach ($datosResumenGrid as $key => $filaGrid) {
//                                var_dump($filaGrid);die();
                                foreach ($filaGrid as $clave => $valor) {
//                                    var_dump($codEjecutivo,$fechaGestion,$clave,$valor,$this->weekOfMonth($fechaGestion),$filaGrid);die();
                                    $resumenRuta = array(
                                        'EJECUTIVO' => $codEjecutivo,
                                        'FECHA_HISTORIAL' => $fechaGestion,
                                        'PARAMETRO' => $clave,
                                        'VALOR' => strval($valor),
                                        'SEMANA' => strval($libreriaFunciones->weekOfMonth($fechaGestion))
                                    );
//                                    var_dump($codEjecutivo,$fechaGestion,$clave,$valor);


                                    if ($clave == 'PORCENTAJE-CUMPLIMIENTO' || $clave == 'TOTAL-VENTA-REPORTADA')
                                        array_push($datosResumenGridGeneral, $resumenRuta);

//                                    var_dump($resumenRuta,$datosResumenGridGeneral);die();
                                    if ($clave == 'CLIENTES-RUTA' || $clave == 'VISITAS-EFECTUADAS-EN-RUTA' || $clave == 'CLIENTES-NO-VISITADOS' || $clave == 'VISITAS-FUERA-RUTA' || $clave == 'VISITAS-REPETIDAS')
                                        array_push($datosResumenGridVisitas, $resumenRuta);
//                                    var_dump($datosResumenGridVisitas);die();
                                    if ($clave == 'CLIENTES-VENTA' || $clave == 'CANTIDAD-VENTA-RUTA' || $clave == 'CANTIDAD-VENTA-FUERA-RUTA')
                                        array_push($datosResumenGridVentas, $resumenRuta);
//                                    var_dump($datosResumenGridVentas);die();

                                    array_push($datosResumenGridIzquierda, $resumenRuta);
                                    unset($resumenRuta);
//                                    var_dump($datosResumenGridIzquierda);die();
                                }//fin iteracion valores en fila
                            }//fin iteracion filas resumen
//                            die();

                            $datos['resumenGeneral'] = $datosResumenGridGeneral;
                            $datos['resumenVisitas'] = $datosResumenGridVisitas;
                            $datos['resumenVentas'] = $datosResumenGridVentas;

                            $resumenRutaDerecha = array('VISITA' => 'Validas', 'CANTIDAD' => $visitasValidas);
                            array_push($datosResumenGridVisitasValidasInvalidas, $resumenRutaDerecha);
                            unset($resumenRutaDerecha);
                            $resumenRutaDerecha = array('VISITA' => 'Invalidas', 'CANTIDAD' => $visitasInvalidas);
                            array_push($datosResumenGridVisitasValidasInvalidas, $resumenRutaDerecha);
                            unset($resumenRutaDerecha);
                            $datos['resumenVisitasValidasInvalidas'] = $datosResumenGridVisitasValidasInvalidas;

                            $resumenPrimeraUltima = array('VISITA' => 'Primera', 'CANTIDAD' => $primeraVisita);
                            array_push($datosResumenGridPrimeraUltimaVisita, $resumenPrimeraUltima);
                            unset($resumenPrimeraUltima);
                            $resumenPrimeraUltima = array('VISITA' => 'Ultima', 'CANTIDAD' => $ultimaVisita);
                            array_push($datosResumenGridPrimeraUltimaVisita, $resumenPrimeraUltima);
                            unset($resumenPrimeraUltima);
                            $datos['resumenPrimeraUltima'] = $datosResumenGridPrimeraUltimaVisita;

                            $_SESSION['detallerevisionhistorialitem'] = $datosDetalleGrid;
                            $_SESSION['resumenrevisionhistorialitem'] = $datosResumenGridIzquierda;

                            Yii::app()->session['detallerevisionhistorialitem'] = $datosDetalleGrid;
                            Yii::app()->session['resumenrevisionhistorialitem'] = $datosResumenGridIzquierda;

                            Yii::app()->session['resumenReemplazoRuta'] = $datosResumenGrid;

                            $datos['coordenadasClientes'] = $coordenadasClientes;
                            $datos['coordenadasVisitas'] = $coordenadasVisitas;
                            Yii::app()->session['coordenadasClientes'] = $coordenadasClientes;
                            Yii::app()->session['coordenadasVisitas'] = $coordenadasVisitas;
//                          

                            $response->Message = "Historial revisado exitosamente";
//                            var_dump($datos);                            die();
                            $response->Status = SUCCESS;
                            $response->Result = $datos; // $datosGrid;
                        }
                        else {
                            $response->Message = "No existen datos para los filtros usados";
                            $response->ClassMessage = CLASS_MENSAJE_NOTICE;
                            //$response->Result = $datos; // $datosGrid;
                        }
                    } else {
                        $response->Message = "El supervisor no ha realizado visitas en al ruta del ejecutivo seleccionado";
                        $response->ClassMessage = CLASS_MENSAJE_NOTICE;
                        //$response->Result = $datos; // $datosGrid;
                    }
                }
            }
        } catch (Exception $e) {
            $response->Message = Yii::app()->params['mensajeExcepcion'];
            $response->Status = ERROR;
            $response->ClassMessage = CLASS_MENSAJE_ERROR;
        }
        if ($solicitarLogin) {
            Yii::app()->user->setFlash('resultadoGuardar', "Por favor inicie sesion para continuar");
            $returnUri = '/' . SISTEMA . '/cruge/ui/login';
            Yii::app()->clientScript->registerMetaTag("" . INTERVALO_REFRESCO_INMEDIATO . ";url={$returnUri}", null, 'refresh');
//            $this->render('/historialmb/rptResumenDiarioHistorial', array('model' => $model));
        } else {
//            var_dump("ssss");die();
            $this->actionResponse(null, null, $response);
        }
//        $this->actionResponse(null, $model, $response);
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

    public function actionGenerateExcelResumen() {
        $response = new Response();
        try {
            $revisionRuta = array();
            $datosResumenReemplazo = Yii::app()->session['resumenReemplazoRuta'];

            foreach ($datosResumenReemplazo as $key => $filaGrid) {
                foreach ($filaGrid as $clave => $valor) {
                    $resumenRuta = array(
                        'PARAMETRO' => $clave,
                        'VALOR' => strval($valor)
                    );

                    array_push($revisionRuta, $resumenRuta);
                }
            }

            $NombreArchivo = "rpt_resumen_reemplazo_ruta";
            $NombreHoja = "rpt_resumen_reemplazo_ruta";

            $autor = "Tececab"; //$_SESSION['CUENTA'];
            $titulo = "rpt_resumen_reemplazo_ruta";
            $tema = "rpt_resumen_reemplazo_ruta";
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

    public function actionGenerateExcelDetalle() {
        $response = new Response();
        try {
            $revisionRuta = array();

            $datos =  Yii::app()->session['detallerevisionhistorialitem'];
//            var_dump($datos);die(); 
            foreach ($datos as $itemHistorialSupervisor) {
//                var_dump($itemHistorialSupervisor);                die();
                $dat = array(
                    'FECHA GESTION' => $itemHistorialSupervisor['FECHARUTA'],
                    'CODIGO_CLIENTE' => $itemHistorialSupervisor['CODIGOCLIENTE'],
                    'CLIENTE' => $itemHistorialSupervisor['CLIENTE'],
                    'DISTANCIA_SUPERVISOR_CLIENTE' => $itemHistorialSupervisor['METROS'],
                    'ESTADO_VISITA_SUPERVISOR' => $itemHistorialSupervisor['ESTADOREVISIONR'],
                    'LATITUD_CLIENTE' => $itemHistorialSupervisor['LATITUDC'],
                    'LONGITUD_CLIENTE' => $itemHistorialSupervisor['LONGITUDC'],
                    'LATITUD_SUPERVISOR' => $itemHistorialSupervisor['LATITUDH'],
                    'LONGITUD_SUPERVISOR' => $itemHistorialSupervisor['LONGITUDH'],
                );
                array_push($revisionRuta, $dat);
            }
//            var_dump($revisionRuta);die();
            $NombreArchivo = "rpt_detalle_reemplazo_ruta";
            $NombreHoja = "rpt_detalle_reemplazo_ruta";

            $autor = "Tececab"; //$_SESSION['CUENTA'];
            $titulo = "rpt_detalle_reemplazo_ruta";
            $tema = "rpt_detalle_reemplazo_ruta";
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
