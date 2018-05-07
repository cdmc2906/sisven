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
    public function VerificarHistorialDiarioUsuario(
    $ejecutivoSeleccionado
    , $fechagestion
    , $accionHistorial
    , $horaInicioGestion
    , $horaFinGestion
    , $precisionVisitas
    , $semanaRevision
    ) {
        Yii::app()->user->setFlash('resultadoGuardarRevisionAviso', null);
        Yii::app()->user->setFlash('resultadoGuardarRevisionOK', null);

        unset(Yii::app()->session['detalleRevisionGuardar']);
        unset(Yii::app()->session['resumenRevisionGuardar']);

        $response = new Response();
        $datos = array();
        $datosDetalleGrid = array();
        $datosResumenGrid = array();
        $datosResumenRevisionHistorial = array();

        $coordenadasClientes = array();
        $coordenadasVisitas = array();
        $itemCoordenadaCliente = array();
        $itemCoordenadaVisita = array();

        $_totalVentaDia = 0;
        $_totalVentaRuta = 0;
        $_totalVentaFueraRuta = 0;
        $_totalClientesVenta = 0;

        $detalleTiemposGestion = array();
        $codigosInicios = array();

        $datosResumenGridGeneral = array();
        $datosResumenGridVisitas = array();
        $datosResumenGridVisitasValidasInvalidas = array();
        $datosResumenGridPrimeraUltimaVisita = array();
        $datosResumenGridVentas = array();
        $datosResumenGridTiempos = array();

        unset(Yii::app()->session['coordenadasClientes']);
        unset(Yii::app()->session['coordenadasVisitas']);

        $fComentarioSupervision = new FComentariosSupervisionModel ();
        $comentarioSupervisor = $fComentarioSupervision->getComentariosSupervisionxEjecutivoxFecha($ejecutivoSeleccionado, $fechagestion);

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

        $detalleRevisionGuardado = DetalleRevisionHistorialModel::model()->findAllByAttributes(
                array('drh_codigo_ejecutivo' => $ejecutivoSeleccionado,
                    'drh_fecha_ruta' => $fechagestion,
                    'drh_semana' => $semanaRevision,
        ));
        $fechaGestion_ = $fechagestion . ' 00:00:00';
        if ($fechaGestion_ >= Yii::app()->session['fechaInicioPeriodo'] && $fechaGestion_ <= Yii::app()->session['fechaFinPeriodo']) {
            $datos['activarGuardar'] = true;
        } else {
            $datos['activarGuardar'] = false;
        }

        if (count($detalleRevisionGuardado) == 0) {
            $ejecutivo = EjecutivoModel::model()->findAllByAttributes(array('e_usr_mobilvendor' => $ejecutivoSeleccionado));
            $fila = 1;
            $fHistorial = new FHistorialModel();
            $fOrden = new FOrdenModel();
            $fRuta = new FRutaModel();

            if (isset($ejecutivo[0]['e_usr_mobilvendor'])) {
                $historial = $fHistorial->getHistorialxVendedorxFechaxHoraInicioxHoraFinSemana(
                        $accionHistorial
                        , $fechagestion
                        , $horaInicioGestion
                        , $horaFinGestion
                        , $ejecutivo[0]['e_usr_mobilvendor']
                        , $semanaRevision
                );
            }

            if (isset($historial)) {
                if (count($historial) > 0) {
                    $diaGestion = date("w", strtotime($fechagestion));

                    $nivelCumplimiento = 0;
                    $totalVisitasEfectuadas = 0;
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
                    $visitasValidas = 0;
                    $visitasInvalidas = 0;
                    $totalGestion = '00:00:00';
                    $totalTraslados = '00:00:00';
                    $detalleRevisionGuardar = array();

                    $rsTotales = new FRutaModel();
                    $latitudClienteAnterior = 0;
                    $longitudClienteAnterior = 0;
                    $ultimoCodigoHistorial = 1;

                    $totalClientesRuta = $fRuta->getTotalClientesxRutaxEjecutivoxDiaxSemana($ejecutivo[0]['e_iniciales'], $diaGestion + 1, $semanaRevision)[0]["TOTALCLIENTES"];
                    $finVisitaAnterior = new DateTime('00:00:00');

                    foreach ($historial as $itemHistorial) {

                        $inicioVisita = new DateTime('00:00:00');
                        $finVisita = new DateTime('00:00:00');

                        $latitudHistorial = 0;
                        $longitudHistorial = 0;

                        $tiempoGestion = '00:00:00';
                        $tiempoTraslado = '00:00:00';

                        $cliente = ClienteModel::model()->findAllByAttributes(array('cli_codigo_cliente' => $itemHistorial['CODIGOCLIENTE']));

                        #INICIO REVISION DE COORDENADAS Y DISTANCIA ENTRE CLIENTE ANTERIOR Y CLIENTE ACTUAL Y DISTANCIA ENTRE EJECUTIVO Y CLIENTE
                        #CASO SI EXISTE EL CLIENTE
                        if (count($cliente) > 0) {
                            $latitudCliente = str_replace(',', '.', $cliente[0]['cli_latitud']);
                            $longitudCliente = str_replace(',', '.', $cliente[0]['cli_longitud']);

                            $latitudHistorial = str_replace(',', '.', $itemHistorial['LATITUD']);
                            $longitudHistorial = str_replace(',', '.', $itemHistorial['LONGITUD']);

                            $distanciaEntreEjecutivoCliente = number_format($this->DistanciaEntreCoordenadas(
                                            $itemHistorial["LATITUD"]
                                            , $itemHistorial["LONGITUD"]
                                            , $latitudCliente
                                            , $longitudCliente), 2, '.', '');

                            #SE VERIFICA SI LAS COORDENADAS DEL CLIENTE ANTERIOR SON IGUAL A CERO
                            if ($latitudClienteAnterior == 0 && $latitudClienteAnterior == 0) {
                                #SE CUENTA LA CANTIDAD DE REGISTROS EN LA GESTION REVISADOS ANTES
                                #SI ES MAYOR A CERO ENTONCES EL CLIENTE ANTERIOR NO TENIA CORDENADAS
                                if (count($detalleTiemposGestion) > 0)
                                    $distanciaEntreCliente = 0;
                                #SI NO HAY CLIENTES ANTES, ENTONCES SE ESTA ANALIZANDO AL PRIMER CLIENTE GESTIONADO
                                else
                                    $distanciaEntreCliente = 0;
                            }
                            #ESTE CASO ES EL QUE APLICARIA PARA TODOS LOS CLIENTES QUE TENGAN COORDENADAS A PARTIR DEL SEGUNDO CLIENTE GESTIONADO
                            else {
                                $distanciaEntreCliente = number_format($this->DistanciaEntreCoordenadas(
                                                $latitudCliente
                                                , $longitudCliente
                                                , $latitudClienteAnterior
                                                , $longitudClienteAnterior), 2, '.', '');
                            }

                            if ($itemHistorial["LATITUD"] == 0 && $itemHistorial["LONGITUD"] == 0)
                                $distanciaEntreEjecutivoCliente = 'Sin coordenadas ejecutivo';
                        }
                        #CASO QUE NO EXISTE EL CLIENTE
                        else {
                            $latitudCliente = 0;
                            $longitudCliente = 0;

                            if ($itemHistorial["LATITUD"] == 0 && $itemHistorial["LONGITUD"] == 0)
                                $distanciaEntreEjecutivoCliente = 'Sin coordenadas cliente y supervisor';
                            else
                                $distanciaEntreEjecutivoCliente = 'Sin coordenadas cliente';
                        }
                        #FIN REVISION DE COORDENADAS Y DISTANCIA ENTRE CLIENTE ANTERIOR Y CLIENTE ACTUAL Y DISTANCIA ENTRE EJECUTIVO Y CLIENTE
                        #INICIO OBTENER COORDENADAS PARA MAPA GOOGLE
                        $itemCoordenadaCliente = array(
                            'LATITUD' => $latitudCliente,
                            'LONGITUD' => $longitudCliente,
                            'LABEL' => $itemHistorial['CODIGOCLIENTE']
                        );
                        array_push($coordenadasClientes, $itemCoordenadaCliente);
                        unset($itemCoordenadaCliente);

                        $itemCoordenadaVisita = array(
                            'LATITUD' => floatval(str_replace(",", ".", $itemHistorial['LATITUD'])),
                            'LONGITUD' => floatval(str_replace(",", ".", $itemHistorial['LONGITUD'])),
                            'LABEL' => $itemHistorial['CODIGOCLIENTE']
                        );
                        array_push($coordenadasVisitas, $itemCoordenadaVisita);
                        unset($itemCoordenadaVisita);
                        #FIN OBTENER COORDENADAS PARA MAPA GOOGLE
                        #INICIO VALIDACION VISITA (DENTRO RANGO PRESICION VISITA)
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
                        #FIN VALIDACION VISITA (DENTRO RANGO PRESICION VISITA)
                        #INICIO CALCULO TIEMPO GESTION
                        $fechaGestion = DateTime::createFromFormat('Y-m-d H:i', $itemHistorial['FECHAVISITA'])->format(FORMATO_FECHA);

                        $inicioVisitaHistorial = $fHistorial->getInicioFinVisitaClientexEjecutivoxFecha(
                                'Inicio visita'
                                , $fechaGestion
                                , $ejecutivo[0]['e_usr_mobilvendor']
                                , $itemHistorial['CODIGOCLIENTE']
                                , $itemHistorial['IDHISTORIAL']);

                        $finVisitaHistorial = $fHistorial->getInicioFinVisitaClientexEjecutivoxFecha(
                                'Fin de visita'
                                , $fechaGestion
                                , $ejecutivo[0]['e_usr_mobilvendor']
                                , $itemHistorial['CODIGOCLIENTE']
                                , $inicioVisitaHistorial[0]['IDHISTORIAL']);

                        if (isset($inicioVisitaHistorial[0]))
                            $inicioVisita = new DateTime($inicioVisitaHistorial[0]["HORAVISITA"]);
                        if (isset($finVisitaHistorial[0]))
                            $finVisita = new DateTime($finVisitaHistorial[0]["HORAVISITA"]);

                        $tiempoGestion = $inicioVisita->diff($finVisita)->format("%h:%I:%S");
                        $totalGestion = $this->SumaHoras($totalGestion, $tiempoGestion);

                        if (count($detalleTiemposGestion) > 0) {
                            $tiempoTraslado = $inicioVisita->diff($finVisitaAnterior)->format("%h:%I:%S");
                            $totalTraslados = $this->SumaHoras($totalTraslados, $tiempoTraslado);
                        }
                        $finVisitaAnterior = $finVisita;
                        #FIN CALCULO TIEMPOS DE GESTION
                        #INICIO ANALISIS DE RUTA
                        if (isset($cliente[0]['cli_latitud']) && $cliente[0]['cli_longitud']) {
                            $latitudClienteAnterior = str_replace(',', '.', $cliente[0]['cli_latitud']);
                            $longitudClienteAnterior = str_replace(',', '.', $cliente[0]['cli_longitud']);

                            if (isset($inicioVisitaHistorial[0]))
                                $ultimoCodigoHistorial = $inicioVisitaHistorial[0]['IDHISTORIAL'];
                        }

                        array_push($codigosInicios, array('cod' => $ultimoCodigoHistorial, 'pdv' => $itemHistorial['CODIGOCLIENTE']));

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

                        $ruta = $fRuta->getRutaxClientexSemana($itemHistorial['CODIGOCLIENTE'], $ejecutivo[0]['e_iniciales'], $semanaRevision);
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

                        $ruta_dia_gestion = "R" . $diaGestion . '-' . $ejecutivo[0]['e_iniciales'];

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
                        $nivelCumplimiento = ($totalClientesRuta > 0) ? round(($visitasValidasRuta / $totalClientesRuta) * 100) : 0;

                        #FIN ANALISIS DE RUTA
                        #CONCATENACION DE NOMBRE CLIENTES, PARA QUE NO SE MUESTRE EL NOMBRE COMPLETO POR ESPACIO EN IMPRESION
                        $nombre = array();
                        $nombre = explode(' ', $itemHistorial['NOMBRECLIENTE']);
                        $primerApellido = $nombre[0];
                        $nombre1 = (isset($nombre[1]) && strlen($nombre[1]) > 0) ? $nombre[1] : '';
                        $primerNombre = (isset($nombre[2]) && strlen($nombre[2]) > 0) ? $nombre[2] : $nombre1;

                        #INICIO CARGA DE DATOS PARA REPORTE DETALLE
                        $revisionRuta = array(
                            'FECHAREVISION' => date(FORMATO_FECHA),
                            'FECHARUTA' => $itemHistorial['FECHAVISITA'],
                            'CODEJECUTIVO' => $ejecutivo[0]->e_usr_mobilvendor,
                            'EJECUTIVO' => $ejecutivo[0]->e_nombre,
                            'CODIGOCLIENTE' => $itemHistorial['CODIGOCLIENTE'],
                            'CLIENTE' => $primerApellido . ' ' . $primerNombre,
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
                        if (isset($cliente[0]['cli_latitud']) && $cliente[0]['cli_longitud']) {
                            $latitudClienteAnterior = str_replace(',', '.', $cliente[0]['cli_latitud']);
                            $longitudClienteAnterior = str_replace(',', '.', $cliente[0]['cli_longitud']);

                            if (isset($inicioVisitaHistorial[0]))
                                $ultimoCodigoHistorial = $inicioVisitaHistorial[0]['IDHISTORIAL'];
                        }

                        array_push($datosDetalleGrid, $revisionRuta);
                        unset($revisionRuta);

                        #FIN CARGA DE DATOS PARA REPORTE DETALLE
                        #INICIO CARGA DE DATOS PARA REPORTE TIEMPOS GESTION
                        $dat = array(
                            'FECHA_GESTION' => $itemHistorial['FECHAVISITA'],
                            'CODIGO_CLIENTE' => $itemHistorial['CODIGOCLIENTE'],
                            'CLIENTE' => $primerApellido . ' ' . $primerNombre,
                            'RUTA' => $itemHistorial['RUTAVISITA'],
                            'INICIO_VISITA' => $inicioVisita->format(FORMATO_HORA),
                            'FIN_VISITA' => $finVisita->format(FORMATO_HORA),
                            'T_GESTION' => $tiempoGestion,
                            'T_TRASLADO' => $tiempoTraslado,
                            'DISTANCIA_EJECUTIVO_CLIENTE' => $distanciaEntreEjecutivoCliente,
                            'DISTANCIA_CLIENTES' => isset($distanciaEntreCliente) ? $distanciaEntreCliente : 0,
                        );

                        array_push($detalleTiemposGestion, $dat);
                        unset($dat);
                        #FIN CARGA DE DATOS PARA REPORTE TIEMPOS GESTION
                        #INICIO CARGA DE DATOS PARA GUARDADO DE REGISTROS EN BDD
                        $itemDetalleRevisionGuardar = array(
                            'drh_tipo_historial' => 'REV_HISTORIAL_DIARIO',
                            'pg_id' => Yii::app()->session['idPeriodoAbierto'],
                            'drh_semana' => $semanaRevision,
                            'drh_fecha_revision' => date(FORMATO_FECHA_LONG_4),
                            'drh_fecha_ruta' => $itemHistorial['FECHAVISITA'],
                            'drh_codigo_ejecutivo' => $ejecutivo[0]->e_usr_mobilvendor,
                            'drh_nombre_ejecutivo' => $ejecutivo[0]->e_nombre,
                            'drh_codigo_cliente' => $itemHistorial['CODIGOCLIENTE'],
                            'drh_nombre_cliente' => $primerApellido . ' ' . $primerNombre,
                            'drh_ruta_usada' => $itemHistorial['RUTAVISITA'],
                            'drh_secuencia_visita' => $fila,
                            'drh_ruta_cliente' => $rutaCliente,
                            'drh_secuencia_ruta' => $secuenciaRutaCliente,
                            'drh_estado_revision_ruta' => $estadoRevisionRuta . $mensajeRevision,
                            'drh_estado_revision_sec' => $estadoRevisionS,
                            'drh_cantidad_chips_venta' => $chips,
                            'drh_metros' => number_format($distancia, 2, '.', ''),
                            'drh_precision_usada' => $precisionVisitas,
                            'drh_validacion' => ($visitaValida == true) ? "VALIDA" : "INVALIDA",
                            'drh_latitud_cliente' => $latitudCliente,
                            'drh_longitud_cliente' => $longitudCliente,
                            'drh_latitud_visita' => $latitudHistorial,
                            'drh_longitud_visita' => $longitudHistorial,
                            'drh_inicio_visita' => $inicioVisita->format(FORMATO_HORA),
                            'drh_fin_visita' => $finVisita->format(FORMATO_HORA),
                            'drh_tiempo_gestion' => $tiempoGestion,
                            'drh_tiempo_traslado' => $tiempoTraslado,
                            'drh_distancia_cli_eje' => $distanciaEntreEjecutivoCliente,
                            'drh_distancia_cli_anterior' => isset($distanciaEntreCliente) ? $distanciaEntreCliente : 0,
                            'drh_fch_ingreso' => date(FORMATO_FECHA_LONG),
                            'drh_fch_modifica' => date(FORMATO_FECHA_LONG),
                            'drh_cod_usr_ing_mod' => Yii::app()->user->id,
                        );
//                        var_dump($itemDetalleRevisionGuardar);die();
                        array_push($detalleRevisionGuardar, $itemDetalleRevisionGuardar);
                        unset($dat);

                        #FIN CARGA DE DATOS PARA GUARDADO DE REGISTROS EN BDD
                        #Fin iteracion items historial
                    }
                    $datos['detalle'] = $datosDetalleGrid;
                    Yii::app()->session['detalleRevisionGuardar'] = $detalleRevisionGuardar;

                    //IMPRESION DE TOTALES AL FINAL DEL REPORTE TIEMPOS GESTION
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

                    array_push($detalleTiemposGestion, $dat);
                    unset($dat);
                    Yii::app()->session['tiemposGestionEjecutivo'] = $detalleTiemposGestion;
                    //IMPRESION DE TOTALES AL FINAL DEL REPORTE TIEMPOS GESTION
                    #INICIO GENERARION DE RESULTADOS ANALISIS
                    #GENERACION DE DATOS DE VISITAS
                    $clientesNoVisitados = $fRuta->getTotalClientesNoVisitadosxRutaxEjecutivo(
                                    $ejecutivo[0]['e_iniciales']
                                    , $diaGestion + 1 // las rutas en mobilvendor tienen los dias iniciando en 0 para el domingo
                                    , $fechagestion
                                    , $ejecutivo[0]['e_usr_mobilvendor'])[0]['CLIENTESNOVISITADOS'];

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
                    $mesAnterior = date("m", strtotime(date("Y-m-t", strtotime(date('Y-m-d', strtotime($fechagestion . ' - 1 days'))))));
                    $mesGestion = date("m", strtotime($fechagestion));

                    #GENERACION DE DATOS DE VENTAS
                    //VENTAS DE FIN DE MES
                    if ($mesAnterior[0] == $mesGestion - 1) {
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
                    }
                    //VENTAS MES NORMAL
                    else {
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

                    #GENERACION DE REPORTE ANALISIS RUTA
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
                        'VISITAS-VALIDAS' => $visitasValidas,
                        'VISITAS-INVALIDAS' => $visitasInvalidas,
                        'PRIMERA-VISITA' => $primeraVisita,
                        'ULTIMA-VISITA' => $ultimaVisita,
                    );
                    array_push($datosResumenGrid, $resumenRuta);
                    unset($resumenRuta);
//                    Yii::app()->session['resultadosRevision'] = $datosResumenGrid;

                    $datosResumenGuardar = array();

                    $iteradorOrdenResumen = 0;
                    foreach ($datosResumenGrid as $key => $filaGrid) {
                        foreach ($filaGrid as $clave => $valor) {
                            $resumenRuta = array(
                                'EJECUTIVO' => $ejecutivo[0]['e_usr_mobilvendor'],
                                'FECHA_HISTORIAL' => $fechagestion,
                                'PARAMETRO' => $clave,
                                'VALOR' => strval($valor),
                                'SEMANA' => strval($this->weekOfMonth($fechagestion)),
                            );
                            $itemResumenRutaGuardar = array(
                                'pg_id ' => Yii::app()->session['idPeriodoAbierto'],
                                'rhd_cod_ejecutivo' => $ejecutivo[0]['e_usr_mobilvendor'],
                                'rhd_fecha_historial' => $fechagestion,
                                'rhd_parametro' => $clave,
                                'rhd_valor' => strval($valor),
                                'rhd_semana' => strval($this->weekOfMonth($fechagestion)),
                                'rhd_tipo' => 'RES_REV_HISTORIAL_DIARIO',
                                'rhd_estado' => 4,
                                'rhd_orden' => $iteradorOrdenResumen,
                                'rhd_fecha_ingreso' => date(FORMATO_FECHA_LONG),
                                'rhd_fecha_modificacion' => date(FORMATO_FECHA_LONG),
                                'rhd_usuario_ingresa_modifica' => Yii::app()->user->id,
                            );

                            if ($clave == 'PORCENTAJE-CUMPLIMIENTO' ||
                                    $clave == 'TOTAL-VENTA-REPORTADA')
                                array_push($datosResumenGridGeneral, $resumenRuta);

                            if ($clave == 'CLIENTES-RUTA' ||
                                    $clave == 'VISITAS-EFECTUADAS-EN-RUTA' ||
                                    $clave == 'CLIENTES-NO-VISITADOS' ||
                                    $clave == 'VISITAS-FUERA-RUTA' ||
                                    $clave == 'VISITAS-REPETIDAS')
                                array_push($datosResumenGridVisitas, $resumenRuta);

                            if ($clave == 'CLIENTES-VENTA' ||
                                    $clave == 'CANTIDAD-VENTA-RUTA' ||
                                    $clave == 'CANTIDAD-VENTA-FUERA-RUTA')
                                array_push($datosResumenGridVentas, $resumenRuta);

                            if ($clave == 'TOTAL-GESTION' ||
                                    $clave == 'TOTAL-TRASLADO')
                                array_push($datosResumenGridTiempos, $resumenRuta);

                            array_push($datosResumenRevisionHistorial, $resumenRuta);
                            unset($resumenRuta);

                            array_push($datosResumenGuardar, $itemResumenRutaGuardar);
                            unset($itemResumenRutaGuardar);
                            $iteradorOrdenResumen++;
                        }//fin iteracion valores en fila
                    }//fin iteracion filas resumen
                    Yii::app()->session['resumenRevisionGuardar'] = $datosResumenGuardar;

                    $datos['resumenGeneral'] = $datosResumenGridGeneral;
                    $datos['resumenVisitas'] = $datosResumenGridVisitas;
                    $datos['resumenVentas'] = $datosResumenGridVentas;
                    $datos['resumenTiempos'] = $datosResumenGridTiempos;

                    $resumenRutaDerecha = array('PARAMETRO' => 'Validas', 'VALOR' => $visitasValidas);
                    array_push($datosResumenGridVisitasValidasInvalidas, $resumenRutaDerecha);
                    unset($resumenRutaDerecha);

                    $resumenRutaDerecha = array('PARAMETRO' => 'Invalidas', 'VALOR' => $visitasInvalidas);
                    array_push($datosResumenGridVisitasValidasInvalidas, $resumenRutaDerecha);
                    unset($resumenRutaDerecha);

                    $datos['resumenVisitasValidasInvalidas'] = $datosResumenGridVisitasValidasInvalidas;

                    $resumenPrimeraUltima = array('PARAMETRO' => 'Primera Visita', 'VALOR' => $primeraVisita);
                    array_push($datosResumenGridPrimeraUltimaVisita, $resumenPrimeraUltima);
                    unset($resumenPrimeraUltima);
                    $resumenPrimeraUltima = array('PARAMETRO' => 'Ultima Visita', 'VALOR' => $ultimaVisita);
                    array_push($datosResumenGridPrimeraUltimaVisita, $resumenPrimeraUltima);
                    unset($resumenPrimeraUltima);
                    $datos['resumenPrimeraUltima'] = $datosResumenGridPrimeraUltimaVisita;

                    $datos['coordenadasClientes'] = $coordenadasClientes;
                    $datos['coordenadasVisitas'] = $coordenadasVisitas;

                    Yii::app()->session['detallerevisionhistorialitem'] = $datosDetalleGrid;
                    Yii::app()->session['resumenrevisionhistorialitem'] = $datosResumenRevisionHistorial;


                    $datos['estadoGeneracion'] = true;
                    $response->Message = "Historial revisado exitosamente";
                    $response->Status = SUCCESS;
                    $response->Result = $datos;
                }
                else {
                    $response->Message = "No existen datos para los filtros usados";
                    $response->ClassMessage = CLASS_MENSAJE_NOTICE;
                    $response->Result = $datos['estadoGeneracion'] = false;

                    unset(Yii::app()->session['detalleRevisionGuardar']);
                    unset(Yii::app()->session['resumenRevisionGuardar']);

                    unset(Yii::app()->session['tiemposGestionEjecutivo']);
                    unset(Yii::app()->session['resultadosRevision']);
                    unset(Yii::app()->session['detallerevisionhistorialitem']);
                    unset(Yii::app()->session['resumenrevisionhistorialitem']);
                }
            } else {
                $response->Message = "Error al generar historial - L689";
                $response->ClassMessage = CLASS_MENSAJE_ERRORE_;
                $response->Result = $datos['estadoGeneracion'] = false;

                unset(Yii::app()->session['detalleRevisionGuardar']);
                unset(Yii::app()->session['resumenRevisionGuardar']);

                unset(Yii::app()->session['tiemposGestionEjecutivo']);
                unset(Yii::app()->session['resultadosRevision']);
                unset(Yii::app()->session['detallerevisionhistorialitem']);
                unset(Yii::app()->session['resumenrevisionhistorialitem']);
            }
        } else {
            //INICIO RECUPERACION DETALLES GESTION
            foreach ($detalleRevisionGuardado as $itemDetalleRevisionGuardado) {
                $revisionRuta = array(
                    'FECHAREVISION' => $itemDetalleRevisionGuardado["drh_fecha_revision"],
                    'FECHARUTA' => $itemDetalleRevisionGuardado["drh_fecha_ruta"],
                    'CODEJECUTIVO' => $itemDetalleRevisionGuardado["drh_codigo_ejecutivo"],
                    'EJECUTIVO' => $itemDetalleRevisionGuardado["drh_nombre_ejecutivo"],
                    'CODIGOCLIENTE' => $itemDetalleRevisionGuardado["drh_codigo_cliente"],
                    'CLIENTE' => $itemDetalleRevisionGuardado["drh_nombre_cliente"],
                    'RUTAUSADA' => $itemDetalleRevisionGuardado["drh_ruta_usada"],
                    'SECUENCIAVISITA' => $itemDetalleRevisionGuardado["drh_secuencia_visita"],
                    'RUTACLIENTE' => $itemDetalleRevisionGuardado["drh_ruta_cliente"],
                    'SECUENCIARUTA' => $itemDetalleRevisionGuardado["drh_secuencia_ruta"],
                    'ESTADOREVISIONR' => $itemDetalleRevisionGuardado["drh_estado_revision_ruta"],
                    'ESTADOREVISIONS' => $itemDetalleRevisionGuardado["drh_estado_revision_sec"],
                    'CHIPSCOMPRADOS' => $itemDetalleRevisionGuardado["drh_cantidad_chips_venta"],
                    'METROS' => number_format($itemDetalleRevisionGuardado["drh_metros"], 2, '.', ''),
                    'VALIDACION' => $itemDetalleRevisionGuardado["drh_validacion"],
                    'LATITUDC' => number_format($itemDetalleRevisionGuardado["drh_latitud_cliente"], 6, '.', ''),
                    'LONGITUDC' => number_format($itemDetalleRevisionGuardado["drh_longitud_cliente"], 6, '.', ''),
                    'LATITUDH' => number_format($itemDetalleRevisionGuardado["drh_latitud_visita"], 6, '.', ''),
                    'LONGITUDH' => number_format($itemDetalleRevisionGuardado["drh_longitud_visita"], 6, '.', ''),
                );
                array_push($datosDetalleGrid, $revisionRuta);
                unset($revisionRuta);
                #INICIO OBTENER COORDENADAS PARA MAPA GOOGLE
                $itemCoordenadaCliente = array(
                    'LATITUD' => $itemDetalleRevisionGuardado["drh_latitud_cliente"],
                    'LONGITUD' => $itemDetalleRevisionGuardado["drh_longitud_cliente"],
                    'LABEL' => 'C_' . $itemDetalleRevisionGuardado["drh_codigo_cliente"]
                );
                array_push($coordenadasClientes, $itemCoordenadaCliente);
                unset($itemCoordenadaCliente);

                $itemCoordenadaVisita = array(
                    'LATITUD' => $itemDetalleRevisionGuardado["drh_latitud_visita"],
                    'LONGITUD' => $itemDetalleRevisionGuardado["drh_longitud_visita"],
                    'LABEL' => 'V_' . $itemDetalleRevisionGuardado["drh_codigo_cliente"]
                );
                array_push($coordenadasVisitas, $itemCoordenadaVisita);
                unset($itemCoordenadaVisita);
                #FIN OBTENER COORDENADAS PARA MAPA GOOGLE

                $revisionTiemposGestion = array(
                    'FECHA_GESTION' => $itemDetalleRevisionGuardado["drh_fecha_revision"],
                    'CODIGO_CLIENTE' => $itemDetalleRevisionGuardado["drh_codigo_cliente"],
                    'CLIENTE' => $itemDetalleRevisionGuardado["drh_nombre_cliente"],
                    'RUTA' => $itemDetalleRevisionGuardado["drh_ruta_usada"],
                    'INICIO_VISITA' => $itemDetalleRevisionGuardado["drh_inicio_visita"],
                    'FIN_VISITA' => $itemDetalleRevisionGuardado["drh_fin_visita"],
                    'T_GESTION' => $itemDetalleRevisionGuardado["drh_tiempo_gestion"],
                    'T_TRASLADO' => $itemDetalleRevisionGuardado["drh_tiempo_traslado"],
                    'DISTANCIA_EJECUTIVO_CLIENTE' => $itemDetalleRevisionGuardado["drh_distancia_cli_eje"],
                    'DISTANCIA_CLIENTES' => $itemDetalleRevisionGuardado["drh_distancia_cli_anterior"],
                );

                array_push($detalleTiemposGestion, $revisionTiemposGestion);
                unset($revisionTiemposGestion);
            }

            $datos['coordenadasClientes'] = $coordenadasClientes;
            $datos['coordenadasVisitas'] = $coordenadasVisitas;

            $datos['detalle'] = $datosDetalleGrid;
            Yii::app()->session['detallerevisionhistorialitem'] = $datosDetalleGrid;

            $totalGestionGuardado = ResumenHistorialDiarioModel::model()->findAllByAttributes(
                    array('rhd_cod_ejecutivo' => $ejecutivoSeleccionado,
                        'rhd_fecha_historial' => $fechagestion,
                        'rhd_parametro' => 'TOTAL-GESTION'
            ));
            $totalTrasladoGuardado = ResumenHistorialDiarioModel::model()->findAllByAttributes(
                    array('rhd_cod_ejecutivo' => $ejecutivoSeleccionado,
                        'rhd_fecha_historial' => $fechagestion,
                        'rhd_parametro' => 'TOTAL-TRASLADO'
            ));

            $dat = array(
                'FECHA_GESTION' => '',
                'CODIGO_CLIENTE' => '',
                'CLIENTE' => '',
                'RUTA' => '',
                'INICIO_VISITA' => '',
                'FIN_VISITA' => 'TOTALES: ',
                'T_GESTION' => isset($totalGestionGuardado[0]) ? $totalGestionGuardado[0]["rhd_valor"] : 'Error obtener resumen',
                'T_TRASLADO' => isset($totalTrasladoGuardado[0]) ? $totalTrasladoGuardado[0]["rhd_valor"] : 'Error obtener resumen',
                'DISTANCIA_EJECUTIVO_CLIENTE' => '',
                'DISTANCIA_CLIENTES' => '',
            );

            array_push($detalleTiemposGestion, $dat);
            unset($dat);

            Yii::app()->session['tiemposGestionEjecutivo'] = $detalleTiemposGestion;
            //FIN RECUPERACION DETALLES GESTION
            //RECUPERACION DE RESUMEN GESTION
            $resumenRevisionGuardado = ResumenHistorialDiarioModel::model()->findAllByAttributes(
                    array('rhd_cod_ejecutivo' => $ejecutivoSeleccionado,
                        'rhd_fecha_historial' => $fechagestion));

            foreach ($resumenRevisionGuardado as $itemResumenRevisionGuardado) {

                $resumenRuta = array(
                    'EJECUTIVO' => $itemResumenRevisionGuardado["rhd_cod_ejecutivo"],
                    'FECHA_HISTORIAL' => $itemResumenRevisionGuardado["rhd_fecha_historial"],
                    'PARAMETRO' => $itemResumenRevisionGuardado["rhd_parametro"],
                    'VALOR' => strval($itemResumenRevisionGuardado["rhd_valor"]),
                    'SEMANA' => strval($itemResumenRevisionGuardado["rhd_semana"]),
                );
                $clave = $itemResumenRevisionGuardado["rhd_parametro"];

                if ($clave == 'PORCENTAJE-CUMPLIMIENTO' ||
                        $clave == 'TOTAL-VENTA-REPORTADA') {
                    array_push($datosResumenGridGeneral, $resumenRuta);
                } elseif ($clave == 'CLIENTES-RUTA' ||
                        $clave == 'VISITAS-EFECTUADAS-EN-RUTA' ||
                        $clave == 'CLIENTES-NO-VISITADOS' ||
                        $clave == 'VISITAS-FUERA-RUTA' ||
                        $clave == 'VISITAS-REPETIDAS') {
                    array_push($datosResumenGridVisitas, $resumenRuta);
                } elseif ($clave == 'CLIENTES-VENTA' ||
                        $clave == 'CANTIDAD-VENTA-RUTA' ||
                        $clave == 'CANTIDAD-VENTA-FUERA-RUTA') {
                    array_push($datosResumenGridVentas, $resumenRuta);
                } elseif ($clave == 'TOTAL-GESTION' ||
                        $clave == 'TOTAL-TRASLADO') {
                    array_push($datosResumenGridTiempos, $resumenRuta);
                } elseif ($clave == 'VISITAS-VALIDAS' ||
                        $clave == 'VISITAS-INVALIDAS') {
                    array_push($datosResumenGridVisitasValidasInvalidas, $resumenRuta);
                } else {
                    ////Esto es la condicion de este else 
                    //($clave == 'PRIMERA-VISITA' ||$clave == 'ULTIMA-VISITA') 
                    array_push($datosResumenGridPrimeraUltimaVisita, $resumenRuta);
                }
                array_push($datosResumenRevisionHistorial, $resumenRuta);
                unset($resumenRuta);
            } //fin iteracion resumen recuperado

            Yii::app()->session['resumenrevisionhistorialitem'] = $datosResumenRevisionHistorial;

            $datos['resumenGeneral'] = $datosResumenGridGeneral;
            $datos['resumenVisitas'] = $datosResumenGridVisitas;
            $datos['resumenVentas'] = $datosResumenGridVentas;
            $datos['resumenTiempos'] = $datosResumenGridTiempos;
            $datos['resumenVisitasValidasInvalidas'] = $datosResumenGridVisitasValidasInvalidas;
            $datos['resumenPrimeraUltima'] = $datosResumenGridPrimeraUltimaVisita;
            $datos['activarGuardar'] = false;
            $datos['estadoGeneracion'] = true;

            $response->Message = "**** - Historial recuperado exitosamente - ****";
            $response->Status = SUCCESS;
            $response->Result = $datos;
        }
        return $response;
    }

    function GuardarDetallesHistorialEjecutivo() {
        $mensaje = '';
        try {
            if (count(Yii::app()->session['detalleRevisionGuardar']) > 0) {
                $totalDetallesGuardados = 0;
                $totalDetallesOmitidos = 0;

                $dbConnection = new CI_DB_active_record(null);
                $sql = $dbConnection->insert_batch('tb_detalle_revision_historial', Yii::app()->session['detalleRevisionGuardar']);
                $sql = str_replace('"', '', $sql);
                $connection = Yii::app()->db_conn;
                $connection->active = true;
                $transaction = $connection->beginTransaction();
                $command = $connection->createCommand($sql);
                $countInsertDetalles = $command->execute();
                if ($countInsertDetalles > 0) {
                    $transaction->commit();
                    $totalDetallesGuardados = $countInsertDetalles;
                } else {
                    $transaction->rollback();
                    $totalDetallesOmitidos += 1;
                }
                $connection->active = false;

                if ($totalDetallesOmitidos > 0) {
                    $mensaje = 'La revision ha sido guardada con errores';
                    Yii::app()->user->setFlash('resultadoGuardarRevisionAviso', $mensaje);
                } else {
                    $mensaje = 'La revision ha sido guardada exitosamente';
                    Yii::app()->user->setFlash('resultadoGuardarRevisionOK', $mensaje);
                }
            }
        } catch (Exception $e) {
            $mensaje = 'Se ha producido un error al guardar los registros';
        }
        return $mensaje;
    }

    function GuardarResumenHistorialEjecutivo() {
        $mensaje = '';
        try {
            if (count(Yii::app()->session['resumenRevisionGuardar']) > 0) {
                $totalResumenGuardados = 0;
                $totalResumenOmitidos = 0;

                $dbConnectionRes = new CI_DB_active_record(null);
                $sql = $dbConnectionRes->insert_batch('tb_resumen_historial_diario', Yii::app()->session['resumenRevisionGuardar']);
                $sql = str_replace('"', '', $sql);
                $connection = Yii::app()->db_conn;
                $connection->active = true;
                $transaction = $connection->beginTransaction();
                $command = $connection->createCommand($sql);
                $countInsertDetalles = $command->execute();
                if ($countInsertDetalles > 0) {
                    $transaction->commit();
                    $totalResumenGuardados = $countInsertDetalles;
                } else {
                    $transaction->rollback();
                    $totalResumenOmitidos += 1;
                }

                if ($totalResumenOmitidos > 0) {
                    $mensaje = 'La revision ha sido guardada con errores';
                    Yii::app()->user->setFlash('resultadoGuardarRevisionAviso', $mensaje);
                } else {
                    $mensaje = 'La revision ha sido guardada exitosamente';
                    Yii::app()->user->setFlash('resultadoGuardarRevisionOK', $mensaje);
                }
            }
        } catch (Exception $e) {
            $mensaje = 'Se ha producido un error al guardar los registros';
        }
        return $mensaje;
    }

}
