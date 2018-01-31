<?php

/**
 * Description
 * @fecha 
 * @author 
 */
class Libreria {

    public function weekOfMonth($date) {
        $firstOfMonth = date("Y-m-01", strtotime($date));
        return intval(date("W", strtotime($date))) - intval(date("W", strtotime($firstOfMonth))) + 1;
    }

    /**
     * Haversine Formula
     * Basado en ESTO: http://www.taringa.net/posts/hazlo-tu-mismo/14270601/PHP-Calcular-distancia-entre-dos-coordenadas.html
     * Formula para sacar distancia entre dos puntos dada la latitud y longitud de dos puntos.
     * Esta distancia tiene que estar dada en notación DECIMAL y no en SEXADECIMAL (Grados, minutos... etc)
     * @param type $latitud 1
     * @param type $longitud 1
     * @param type $latitud 2
     * @param type $longitud 2
     * @return type, Distancia en Kms, con 1 decimal de precisión
     */
    // haversineGreatCircleDistance
    public function DistanciaEntreCoordenadas(
    $latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo) {
        // convert from degrees to radians
//        var_dump($latitudeFrom,$longitudeFrom,$latitudeTo,$longitudeTo);die();
        $earthRadius = 6371000;
        $latFrom = deg2rad($latitudeFrom);
        $lonFrom = deg2rad($longitudeFrom);
        $latTo = deg2rad($latitudeTo);
        $lonTo = deg2rad($longitudeTo);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) + cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
        return $angle * $earthRadius;
    }

    // funcion que devuelve un array con los elementos de una hora

    public function parteHora($hora) {
        $horaSplit = explode(":", $hora);

        if (count($horaSplit) < 3) {
            $horaSplit[2] = 0;
        }

        return $horaSplit;
    }

    // funcion que devuelve la suma de dos horas en formato horas:minutos:segundos
    // Devuelve FALSE si se ha producido algun error
    function SumaHoras($time1, $time2) {
        list($hour1, $min1, $sec1) = $this->parteHora($time1);
        list($hour2, $min2, $sec2) = $this->parteHora($time2);

        return date('H:i:s', mktime($hour1 + $hour2, $min1 + $min2, $sec1 + $sec2));
    }

    /**
     * 
     * @param type $ejecutivo
     * @param type $fechagestion
     * @param type $accionHistorial
     * @param type $horaInicioGestion
     * @param type $horaFinGestion
     * @param type $precisionVisitas
     * @return \Response
     */
    public function VerificarHistorialDiarioUsuario($ejecutivo, $fechagestion, $accionHistorial, $horaInicioGestion, $horaFinGestion, $precisionVisitas) {

        $response = new Response();
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

        $detalleGestionEjecutivo = array();
        $codigosInicios = array();

        $datosResumenGridGeneral = array();
        $datosResumenGridVisitas = array();
        $datosResumenGridVisitasValidasInvalidas = array();
        $datosResumenGridPrimeraUltimaVisita = array();
        $datosResumenGridVentas = array();
        $datosResumenGridTiempos = array();
        unset(Yii::app()->session['coordenadasClientes']);
        unset(Yii::app()->session['coordenadasVisitas']);

//        $this = new Libreria();
//        $this = new Libreria();
        $fComentarioOficina = new FComentariosOficinaModel();

        $fComentarioSupervision = new FComentariosSupervisionModel ();
        $comentarioSupervisor = $fComentarioSupervision->getComentariosSupervisionxEjecutivoxFecha($ejecutivo, $fechagestion);

        $comentarios = '';
        if (count($comentarioSupervisor) > 0) {
            foreach ($comentarioSupervisor as $key => $comentario) {
                $comentarios .= intval($key + 1) . '.- '
                        . substr($comentario['username'], 0, 2)
                        . "-" . $comentario['fecha']
                        . "-(" . $comentario['cs_comentario']
                        . ') ' . "\n";
            }
            $datos['comentarioSupervisor'] = $comentarios;
        }

        $ejecutivo = EjecutivoModel::model()->findAllByAttributes(array('e_usr_mobilvendor' => $ejecutivo));
        $fila = 1;
        $fHistorial = new FHistorialModel();
        $fOrden = new FOrdenModel();
        $fRuta = new FRutaModel();

        if (isset($ejecutivo[0]['e_usr_mobilvendor'])) {
            $historial = $fHistorial->getHistorialxVendedorxFechaxHoraInicioxHoraFin(
                    $accionHistorial
                    , $fechagestion
                    , $horaInicioGestion
                    , $horaFinGestion
                    , $ejecutivo[0]['e_usr_mobilvendor']
            );
        }
//var_dump(count($historial));die();
        if (count($historial)) {
            #INICIO CALCULO TIEMPO GESTION
            $latitudClienteAnterior = 0;
            $longitudClienteAnterior = 0;
            $ultimoCodigoHistorial = 1;
            $finVisitaAnterior = new DateTime('00:00:00');

            $inicioVisita = new DateTime('00:00:00');
            $finVisita = new DateTime('00:00:00');

            $tiempoTraslado = '00:00:00';
            $totalGestion = '00:00:00';
            $totalTraslados = '00:00:00';
            foreach ($historial as $itemHistorialEjecutivo) {
//                                var_dump($itemHistorialEjecutivo);die();
                $cliente = ClienteModel::model()->findAllByAttributes(array('cli_codigo_cliente' => $itemHistorialEjecutivo['CODIGOCLIENTE']));
                if (count($cliente) > 0) {
                    $_latitudCliente = str_replace(',', '.', $cliente[0]['cli_latitud']);
                    $_longitudCliente = str_replace(',', '.', $cliente[0]['cli_longitud']);

                    $latitudCliente = $_latitudCliente;
                    $longitudCliente = $_longitudCliente;

                    $distanciaEntreEjecutivoCliente = $this->DistanciaEntreCoordenadas(
                            $itemHistorialEjecutivo["LATITUD"]
                            , $itemHistorialEjecutivo["LONGITUD"]
                            , $latitudCliente
                            , $longitudCliente);
                    $distanciaEntreEjecutivoCliente = number_format($distanciaEntreEjecutivoCliente, 2, '.', '');

                    $distanciaEntreCliente = $this->DistanciaEntreCoordenadas(
                            $latitudCliente
                            , $longitudCliente
                            , $latitudClienteAnterior
                            , $longitudClienteAnterior
                    );

                    if ($latitudClienteAnterior == 0 && $latitudClienteAnterior == 0) {
                        if (count($detalleGestionEjecutivo) > 0)
                            $distanciaEntreCliente = 'Sin coordenadas cliente anterior';
                        else
                            $distanciaEntreCliente = '-';
                    } else
                        $distanciaEntreCliente = number_format($distanciaEntreCliente, 2, '.', '');

                    if ($itemHistorialEjecutivo["LATITUD"] == 0 && $itemHistorialEjecutivo["LONGITUD"] == 0)
                        $distanciaEntreEjecutivoCliente = 'Sin coordenadas ejecutivo';
                } else {
                    $latitudCliente = 0;
                    $longitudCliente = 0;

                    if ($itemHistorialEjecutivo["LATITUD"] == 0 && $itemHistorialEjecutivo["LONGITUD"] == 0)
                        $distanciaEntreEjecutivoCliente = 'Sin coordenadas cliente y supervisor';
                    else
                        $distanciaEntreEjecutivoCliente = 'Sin coordenadas cliente';
                }
                $fechaGestion = DateTime::createFromFormat('Y-m-d H:i', $itemHistorialEjecutivo['FECHAVISITA'])->format(FORMATO_FECHA);

                $I = $fHistorial->getInicioFinVisitaClientexEjecutivoxFecha(
                        'Inicio visita'
                        , $fechaGestion
                        , $ejecutivo[0]['e_usr_mobilvendor']
                        , $itemHistorialEjecutivo['CODIGOCLIENTE']
                        , $itemHistorialEjecutivo['IDHISTORIAL']);

                $F = $fHistorial->getInicioFinVisitaClientexEjecutivoxFecha(
                        'Fin de visita'
                        , $fechaGestion
                        , $ejecutivo[0]['e_usr_mobilvendor']
                        , $itemHistorialEjecutivo['CODIGOCLIENTE']
                        , $I[0]['IDHISTORIAL']);

                if (isset($I[0]))
                    $inicioVisita = new DateTime($I[0]["HORAVISITA"]);
                if (isset($F[0]))
                    $finVisita = new DateTime($F[0]["HORAVISITA"]);
                $tiempoGestion = $inicioVisita->diff($finVisita)->format("%h:%I:%S");
                $totalGestion = $this->SumaHoras($totalGestion, $tiempoGestion);

//                                var_dump(count($detalleGestionEjecutivo));
                if (count($detalleGestionEjecutivo) > 0) {
                    $tiempoTraslado = $inicioVisita->diff($finVisitaAnterior)->format("%h:%I:%S");
                    $totalTraslados = $this->SumaHoras($totalTraslados, $tiempoTraslado);
                }

                $nombre = array();
                $nombre = explode(' ', $itemHistorialEjecutivo['NOMBRECLIENTE']);
                $primerApellido = $nombre[0];
//                $primerNombre =  $nombre[1];
                $nombre1 = (isset($nombre[1]) && strlen($nombre[1]) > 0) ? $nombre[1] : '';
                $primerNombre = (isset($nombre[2]) && strlen($nombre[2]) > 0) ? $nombre[2] : $nombre1;

                $dat = array(
                    'FECHA_GESTION' => $itemHistorialEjecutivo['FECHAVISITA'],
                    'CODIGO_CLIENTE' => $itemHistorialEjecutivo['CODIGOCLIENTE'],
                    'CLIENTE' => $primerApellido . ' ' . $primerNombre, //$itemHistorialSupervisor['NOMBRECLIENTE'],
                    'RUTA' => $itemHistorialEjecutivo['RUTAVISITA'],
                    'INICIO_VISITA' => $inicioVisita->format(FORMATO_HORA),
                    'FIN_VISITA' => $finVisita->format(FORMATO_HORA),
                    'T_GESTION' => $tiempoGestion,
                    'T_TRASLADO' => $tiempoTraslado,
                    'DISTANCIA_EJECUTIVO_CLIENTE' => $distanciaEntreEjecutivoCliente,
                    'DISTANCIA_CLIENTES' => isset($distanciaEntreCliente) ? $distanciaEntreCliente : 0,
                );
                $finVisitaAnterior = $finVisita;
                if (isset($cliente[0]['cli_latitud']) && $cliente[0]['cli_longitud']) {
                    $_latitudClienteAnterior = str_replace(',', '.', $cliente[0]['cli_latitud']);
                    $_longitudClienteAnterior = str_replace(',', '.', $cliente[0]['cli_longitud']);

                    $latitudClienteAnterior = $_latitudCliente;
                    $longitudClienteAnterior = $_longitudCliente;

                    if (isset($I[0]))
                        $ultimoCodigoHistorial = $I[0]['IDHISTORIAL'];
                }
//                                var_dump($dat);die();


                array_push($codigosInicios, array('cod' => $ultimoCodigoHistorial, 'pdv' => $itemHistorialEjecutivo['CODIGOCLIENTE']));
                array_push($detalleGestionEjecutivo, $dat);
                unset($dat);
            }
//                            var_dump($codigosInicios);die();
            $dat = array(
                'FECHA_GESTION' => '',
                'CODIGO_CLIENTE' => '',
                'CLIENTE' => '',
                'RUTA' => '',
                'INICIO_VISITA' => '',
                'FIN_VISITA' => 'TOTALES: ',
                'T_GESTION' => $totalGestion,
                'T_TRASLADO' => $totalTraslados,
                'DISTANCIA_EJECUTIVO_CLIENTE' => '',
                'DISTANCIA_CLIENTES' => '',
            );
//                            die();
            array_push($detalleGestionEjecutivo, $dat);
            unset($dat);
//                            var_dump($detalleGestionEjecutivo);die();
            Yii::app()->session['tiemposGestionEjecutivo'] = $detalleGestionEjecutivo;

            #FIN CALCULO DE TIEMPOS GESTION
            $primeraVisita = $fHistorial->getPrimeraVisitaxEjecutivoxFechaxHoraInicioxHoraFin(
                            $accionHistorial
                            , $fechagestion
                            , $horaInicioGestion
                            , $horaFinGestion
                            , $ejecutivo[0]['e_usr_mobilvendor'])[0]['RESULTADO'];
            $ultimaVisita = $fHistorial->getUltimaVisitaxEjecutivoxFechaxHoraInicioxHoraFin(
                            $accionHistorial
                            , $fechagestion
                            , $horaInicioGestion
                            , $horaFinGestion
                            , $ejecutivo[0]['e_usr_mobilvendor'])[0]['RESULTADO'];

            $diaGestion = date("w", strtotime($fechagestion));
            $ruta_dia_gestion = "R" . $diaGestion . '-' . $ejecutivo[0]['e_iniciales'];

            $rsTotalClientesRuta = $fRuta->getTotalClientesxRutaxEjecutivoxDia($ejecutivo[0]['e_iniciales'], $diaGestion + 1);
            $totalClientesRuta = $rsTotalClientesRuta[0]["TOTALCLIENTES"];

            $nivelCumplimiento = 0;
            $totalVisitasEfectuadas = 0;
            $clientesNoVisitados = $fRuta->getTotalClientesNoVisitadosxRutaxEjecutivo(
                            $ejecutivo[0]['e_iniciales']
                            , $diaGestion + 1
                            , $fechagestion
                            , $ejecutivo[0]['e_usr_mobilvendor'])[0]['CLIENTESNOVISITADOS'];
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

            $mensajeRevision = '';

            $rsTotales = new FRutaModel();
            $mesAnterior = date("m", strtotime(date("Y-m-t", strtotime(date('Y-m-d', strtotime($fechagestion . ' - 1 days'))))));
            $mesGestion = date("m", strtotime($fechagestion));

            if ($mesAnterior[0] == $mesGestion - 1) {//VENTAS DE FIN DE MES
                if ($diaGestion == 1) {//1--> Lunes
                    $fechaViernes = date('Y-m-d', strtotime($fechagestion . ' - 3 days'));
                    $_totalVentaViernes = intval($rsTotales->getTotalChipsVentaxDiaxHoraInicioxEjecutivo($fechaViernes, $horaInicioGestion, $ejecutivo[0]['e_usr_mobilvendor'])[0]['RESPUESTA']);
                    $_totalVentaRutaViernes = intval($rsTotales->getTotalChipsVentaRuta($ejecutivo[0]['e_iniciales'], 6, $fechaViernes, $horaInicioGestion, $ejecutivo[0]['e_usr_mobilvendor'])[0]['RESPUESTA']);
                    $_totalVentaFueraRutaViernes = intval($rsTotales->getTotalChipsVentaFueraRuta($ejecutivo[0]['e_iniciales'], 6, $fechaViernes, $ejecutivo[0]['e_usr_mobilvendor'])[0]['RESPUESTA']);
                    $_totalClientesVentaViernes = intval($rsTotales->getTotalClientesVenta($fechaViernes, $ejecutivo[0]['e_usr_mobilvendor'])[0]['RESPUESTA']);

                    $_totalVentaFinSemana = intval($rsTotales->getTotalChipsVentaFinSemana($fechaViernes, $ejecutivo[0]['e_usr_mobilvendor'])[0]['RESPUESTA']);
                    $_totalVentaRutaFinSemana = intval($rsTotales->getTotalChipsVentaFinSemana($fechaViernes, $ejecutivo[0]['e_usr_mobilvendor'])[0]['RESPUESTA']);
                    $_totalClientesVentaFinSemana = intval($rsTotales->getTotalClientesVentaFinSemana($fechaViernes, $ejecutivo[0]['e_usr_mobilvendor'])[0]['RESPUESTA']);

                    $_totalVentaDiaLunes = intval($rsTotales->getTotalChipsVentaxDiaxHoraInicioxEjecutivo($fechagestion, $horaInicioGestion, $ejecutivo[0]['e_usr_mobilvendor'])[0]['RESPUESTA']);
                    $_totalVentaRutaLunes = intval($rsTotales->getTotalChipsVentaRuta($ejecutivo[0]['e_iniciales'], $diaGestion + 1, $fechagestion, $horaInicioGestion, $ejecutivo[0]['e_usr_mobilvendor'])[0]['RESPUESTA']);
                    $_totalVentaFueraRutaLunes = intval($rsTotales->getTotalChipsVentaFueraRuta($ejecutivo[0]['e_iniciales'], $diaGestion + 1, $fechagestion, $ejecutivo[0]['e_usr_mobilvendor'])[0]['RESPUESTA']);
                    $_totalClientesVentaLunes = intval($rsTotales->getTotalClientesVenta($fechagestion, $ejecutivo[0]['e_usr_mobilvendor'])[0]['RESPUESTA']);

                    $_totalVentaDia = $_totalVentaViernes + $_totalVentaFinSemana + $_totalVentaDiaLunes;
                    $_totalVentaRuta = $_totalVentaRutaViernes + $_totalVentaRutaFinSemana + $_totalVentaRutaLunes;
                    $_totalVentaFueraRuta = $_totalVentaFueraRutaViernes + $_totalVentaFueraRutaLunes;
                    $_totalClientesVenta = $_totalClientesVentaViernes + $_totalClientesVentaFinSemana + $_totalClientesVentaLunes;
                } else {
                    $fechaDiaAnterior = date('Y-m-d', strtotime($fechagestion . ' - 1 days'));

                    $_totalVentaDiaAnterior = intval($rsTotales->getTotalChipsVentaxDiaxHoraInicioxEjecutivo($fechaDiaAnterior, $horaInicioGestion, $ejecutivo[0]['e_usr_mobilvendor'])[0]['RESPUESTA']);
                    $_totalVentaRutaDiaAnterior = intval($rsTotales->getTotalChipsVentaRuta($ejecutivo[0]['e_iniciales'], $diaGestion, $fechaDiaAnterior, $horaInicioGestion, $ejecutivo[0]['e_usr_mobilvendor'])[0]['RESPUESTA']);
                    $_totalVentaFueraRutaDiaAnterior = intval($rsTotales->getTotalChipsVentaFueraRuta($ejecutivo[0]['e_iniciales'], $diaGestion, $fechaDiaAnterior, $ejecutivo[0]['e_usr_mobilvendor'])[0]['RESPUESTA']);
                    $_totalClientesVentaDiaAnterior = intval($rsTotales->getTotalClientesVenta($fechaDiaAnterior, $ejecutivo[0]['e_usr_mobilvendor'])[0]['RESPUESTA']);

                    $_totalVentaDiaE = intval($rsTotales->getTotalChipsVentaxDiaxHoraInicioxEjecutivo($fechagestion, $horaInicioGestion, $ejecutivo[0]['e_usr_mobilvendor'])[0]['RESPUESTA']);
                    $_totalVentaRutaDia = intval($rsTotales->getTotalChipsVentaRuta($ejecutivo[0]['e_iniciales'], $diaGestion + 1, $fechagestion, $horaInicioGestion, $ejecutivo[0]['e_usr_mobilvendor'])[0]['RESPUESTA']);
                    $_totalVentaFueraRutaDia = intval($rsTotales->getTotalChipsVentaFueraRuta($ejecutivo[0]['e_iniciales'], $diaGestion + 1, $fechagestion, $ejecutivo[0]['e_usr_mobilvendor'])[0]['RESPUESTA']);
                    $_totalClientesVentaDia = intval($rsTotales->getTotalClientesVenta($fechagestion, $ejecutivo[0]['e_usr_mobilvendor'])[0]['RESPUESTA']);

                    $_totalVentaDia = $_totalVentaDiaAnterior + $_totalVentaDiaE;
                    $_totalVentaRuta = $_totalVentaRutaDiaAnterior + $_totalVentaRutaDia;
                    $_totalVentaFueraRuta = $_totalVentaFueraRutaDiaAnterior + $_totalVentaFueraRutaDia;
                    $_totalClientesVenta = $_totalClientesVentaDiaAnterior + $_totalClientesVentaDia;

//                                var_dump($_totalVentaDia,$_totalVentaRuta,$_totalVentaFueraRuta,$_totalClientesVenta);die();
                }
            } else {//VENTAS MES NORMAL
                if ($diaGestion == 5) { //5-> viernes
                    $_totalVentaViernes = intval($rsTotales->getTotalChipsVentaxDiaxHoraInicioxEjecutivo($fechagestion, $horaInicioGestion, $ejecutivo[0]['e_usr_mobilvendor'])[0]['RESPUESTA']);
                    $_totalVentaRutaViernes = intval($rsTotales->getTotalChipsVentaRuta($ejecutivo[0]['e_iniciales'], $diaGestion + 1, $fechagestion, $horaInicioGestion, $ejecutivo[0]['e_usr_mobilvendor'])[0]['RESPUESTA']);
                    $_totalVentaFueraRutaViernes = intval($rsTotales->getTotalChipsVentaFueraRuta($ejecutivo[0]['e_iniciales'], $diaGestion + 1, $fechagestion, $ejecutivo[0]['e_usr_mobilvendor'])[0]['RESPUESTA']);
                    $_totalClientesVentaViernes = intval($rsTotales->getTotalClientesVenta($fechagestion, $ejecutivo[0]['e_usr_mobilvendor'])[0]['RESPUESTA']);

                    $_totalVentaFinSemana = intval($rsTotales->getTotalChipsVentaFinSemana($ejecutivo[0]['e_iniciales'], $diaGestion + 1, $fechagestion, $ejecutivo[0]['e_usr_mobilvendor'])[0]['RESPUESTA']);
                    $_totalVentaRutaFinSemana = intval($rsTotales->getTotalChipsVentaFinSemana($ejecutivo[0]['e_iniciales'], $diaGestion + 1, $fechagestion, $ejecutivo[0]['e_usr_mobilvendor'])[0]['RESPUESTA']);
                    $_totalClientesVentaFinSemana = intval($rsTotales->getTotalClientesVentaFinSemana($ejecutivo[0]['e_iniciales'], $diaGestion + 1, $fechagestion, $ejecutivo[0]['e_usr_mobilvendor'])[0]['RESPUESTA']);

                    $_totalVentaDia = $_totalVentaViernes + $_totalVentaFinSemana;
                    $_totalVentaRuta = $_totalVentaRutaViernes + $_totalVentaRutaFinSemana;
                    $_totalVentaFueraRuta = $_totalVentaFueraRutaViernes;
                    $_totalClientesVenta = $_totalClientesVentaViernes + $_totalClientesVentaFinSemana;
                } else {
                    $_totalVentaDia = intval($rsTotales->getTotalChipsVentaxDiaxHoraInicioxEjecutivo($fechagestion, $horaInicioGestion, $ejecutivo[0]['e_usr_mobilvendor'])[0]['RESPUESTA']);
                    $_totalVentaRuta = intval($rsTotales->getTotalChipsVentaRuta($ejecutivo[0]['e_iniciales'], $diaGestion + 1, $fechagestion, $horaInicioGestion, $ejecutivo[0]['e_usr_mobilvendor'])[0]['RESPUESTA']);
                    $_totalVentaFueraRuta = intval($rsTotales->getTotalChipsVentaFueraRuta($ejecutivo[0]['e_iniciales'], $diaGestion + 1, $fechagestion, $ejecutivo[0]['e_usr_mobilvendor'])[0]['RESPUESTA']);
                    $_totalClientesVenta = intval($rsTotales->getTotalClientesVenta($fechagestion, $ejecutivo[0]['e_usr_mobilvendor'])[0]['RESPUESTA']);
                }
            }
            $visitasValidas = 0;
            $visitasInvalidas = 0;

            foreach ($historial as $itemHistorial) {

                $cliente = ClienteModel::model()->findAllByAttributes(array('cli_codigo_cliente' => $itemHistorial['CODIGOCLIENTE']));
                if (count($cliente) > 0) {
                    $_latitudCliente = str_replace(',', '.', $cliente[0]['cli_latitud']);
                    $_longitudCliente = str_replace(',', '.', $cliente[0]['cli_longitud']);

                    $latitudCliente = $_latitudCliente;
                    $longitudCliente = $_longitudCliente;
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

                $distancia = $this->DistanciaEntreCoordenadas($latitudCliente, $longitudCliente, $latitudHistorial, $longitudHistorial);

                if ($precisionVisitas != 0) {
                    if ($distancia <= $precisionVisitas) {
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
                $cantidadChips = $fOrden->getChipsxClientexEjecutivoxFecha($itemHistorial['CODIGOCLIENTE'], $ejecutivo[0]['e_usr_mobilvendor'], $fechaHistorial);
                $chips = $cantidadChips[0]['CHIPS'];

                foreach ($datosDetalleGrid as $item) {
                    if (in_array($itemHistorial['CODIGOCLIENTE'], $item) && intval($item['CHIPSCOMPRADOS']) > 0) {
                        $chips = "0";
                    }
                }

                $ruta = $fRuta->getRutaxCliente($itemHistorial['CODIGOCLIENTE'], $ejecutivo[0]['e_iniciales']);
                if (count($ruta) == 0) {
                    $rutaCliente = "Sin ruta";
                    $secuenciaRutaCliente = "Sin secuencia";
                } else {
                    $rutaCliente = $ruta[0]['RUTA'];
                    $secuenciaRutaCliente = $ruta[0]['SECUENCIA'];
                    if ($chips > 0) {
                        $clientesConVenta += 1;
                    }
                    if (count($ruta) > 1)
                        $mensajeRevision .= '-Cli en varias rutas';
                }
                $visitaRepetida = false;

//                        if ($itemHistorial['RUTAVISITA'] == $rutaCliente) {
                if ($ruta_dia_gestion == $rutaCliente) {
                    foreach ($datosDetalleGrid as $item) {
                        if (in_array($itemHistorial['CODIGOCLIENTE'], $item)) {
                            $visitaRepetida = true;
                            break;
                        }
                    }

                    if ($visitaRepetida) {
                        $estadoRevisionRuta = 'Visita en ruta repetida';
//                                    $visitasValidasRuta -= 1;
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
                $nivelCumplimiento = round(($visitasValidasRuta / $totalClientesRuta) * 100);

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
                    'ESTADOREVISIONR' => $estadoRevisionRuta . $mensajeRevision,
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
                'TOTAL-GESTION' => ($totalGestion == null) ? 0 : $totalGestion,
                'TOTAL-TRASLADO' => ($totalTraslados == null) ? 0 : $totalTraslados,
            );
            array_push($datosResumenGrid, $resumenRuta);
            unset($resumenRuta);
            $datosResumenSemana = array();
            foreach ($datosResumenGrid as $key => $filaGrid) {
                foreach ($filaGrid as $clave => $valor) {
                    $resumenRuta = array(
                        'EJECUTIVO' => $ejecutivo[0]['e_usr_mobilvendor'],
                        'FECHA_HISTORIAL' => $fechagestion,
                        'PARAMETRO' => $clave,
                        'VALOR' => strval($valor),
                        'SEMANA' => strval($this->weekOfMonth($fechagestion)),
                    );
                    $resumen = array(
                        'PARAMETRO' => $clave,
                        'VALOR' => strval($valor),);
                    array_push($datosResumenSemana, $resumen);
                    unset($resumen);

                    if ($clave == 'PORCENTAJE-CUMPLIMIENTO' || $clave == 'TOTAL-VENTA-REPORTADA')
                        array_push($datosResumenGridGeneral, $resumenRuta);
                    if ($clave == 'CLIENTES-RUTA' || $clave == 'VISITAS-EFECTUADAS-EN-RUTA' || $clave == 'CLIENTES-NO-VISITADOS' || $clave == 'VISITAS-FUERA-RUTA' || $clave == 'VISITAS-REPETIDAS')
                        array_push($datosResumenGridVisitas, $resumenRuta);
                    if ($clave == 'CLIENTES-VENTA' || $clave == 'CANTIDAD-VENTA-RUTA' || $clave == 'CANTIDAD-VENTA-FUERA-RUTA')
                        array_push($datosResumenGridVentas, $resumenRuta);
                    if ($clave == 'TOTAL-GESTION' || $clave == 'TOTAL-TRASLADO')
                        array_push($datosResumenGridTiempos, $resumenRuta);

                    array_push($datosResumenGridIzquierda, $resumenRuta);
                    unset($resumenRuta);
                }//fin iteracion valores en fila
            }//fin iteracion filas resumen

            $resumenRutaDerecha = array('VISITA' => 'Validas', 'CANTIDAD' => $visitasValidas);
            array_push($datosResumenGridVisitasValidasInvalidas, $resumenRutaDerecha);
            unset($resumenRutaDerecha);
            $resumenRutaDerecha = array('VISITA' => 'Invalidas', 'CANTIDAD' => $visitasInvalidas);
            array_push($datosResumenGridVisitasValidasInvalidas, $resumenRutaDerecha);
            unset($resumenRutaDerecha);

            $resumenPrimeraUltima = array('VISITA' => 'Primera Visita', 'CANTIDAD' => $primeraVisita);
            array_push($datosResumenGridPrimeraUltimaVisita, $resumenPrimeraUltima);
            unset($resumenPrimeraUltima);
            $resumenPrimeraUltima = array('VISITA' => 'Ultima Visita', 'CANTIDAD' => $ultimaVisita);
            array_push($datosResumenGridPrimeraUltimaVisita, $resumenPrimeraUltima);
            unset($resumenPrimeraUltima);

            $resumen = array('PARAMETRO' => 'PRIMERA VISITA', 'VALOR' => $primeraVisita,);
            array_push($datosResumenSemana, $resumen);
            unset($resumen);
            $resumen = array('PARAMETRO' => 'ULTIMA VISITA', 'VALOR' => $ultimaVisita,);
            array_push($datosResumenSemana, $resumen);
            unset($resumen);

            $datos['resumenGeneral'] = $datosResumenGridGeneral;
            $datos['resumenVisitas'] = $datosResumenGridVisitas;
            $datos['resumenVentas'] = $datosResumenGridVentas;
            $datos['resumenTiempos'] = $datosResumenGridTiempos;
            $datos['resumenVisitasValidasInvalidas'] = $datosResumenGridVisitasValidasInvalidas;
            $datos['resumenPrimeraUltima'] = $datosResumenGridPrimeraUltimaVisita;
            $datos['coordenadasClientes'] = $coordenadasClientes;
            $datos['coordenadasVisitas'] = $coordenadasVisitas;

//            Yii::app()->session['resumenGestionDiaria'] = $datosResumenGrid;
//            var_dump('sss');die();
//            var_dump($datosResumenSemana);die();
            Yii::app()->session['resumenGestionDiaria'] = $datosResumenSemana;

            Yii::app()->session['resumenPrimeraUltima'] = $datosResumenGridPrimeraUltimaVisita;
            Yii::app()->session['detallerevisionhistorialitem'] = $datosDetalleGrid;
            Yii::app()->session['resumenrevisionhistorialitem'] = $datosResumenGridIzquierda;
            Yii::app()->session['coordenadasClientes'] = $coordenadasClientes;
            Yii::app()->session['coordenadasVisitas'] = $coordenadasVisitas;

            $response->Message = "Historial revisado exitosamente";
            $response->Status = SUCCESS;
            $response->Result = $datos;
        }
        else {
            $response->Message = "No existen datos para los filtros usados";
            $response->ClassMessage = CLASS_MENSAJE_NOTICE;
        }
        return $response;
    }

}
