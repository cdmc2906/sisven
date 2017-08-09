<?php

/**
 * Description
 * @fecha 
 * @author 
 */
class RptResumenDiarioHistorialController extends Controller {

    public function actionIndex() {
        Yii::app()->user->setFlash('resultadoGuardar', null);
        if (Yii::app()->request->isAjaxRequest) {
            return;
        } else {
            $_SESSION['RptResumenDiarioHistorialForm'] = '';
            $model = new RptResumenDiarioHistorialForm();
            $this->render('/historialmb/rptResumenDiarioHistorial', array('model' => $model));
        }
    }

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
    function haversineGreatCircleDistance(
    $latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo) {
        // convert from degrees to radians
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

    public function actionRevisarHistorial() {
        $datos = array();
        $datosDetalleGrid = array();
        $datosResumenGrid = array();
        $datosResumenGridIzquierda = array();
        $datosResumenGridDerecha = array();

        $_totalVentaDia = 0;
        $_totalVentaRuta = 0;
        $_totalVentaFueraRuta = 0;
        $_totalClientesVenta = 0;

        $datosResumenGridGeneral = array();
        $datosResumenGridVisitas = array();
        $datosResumenGridVisitasValidasInvalidas = array();
        $datosResumenGridPrimeraUltimaVisita = array();
        $datosResumenGridVentas = array();
//        $_SESSION['ejecutivo']='';
        $response = new Response();
        try {
            $model = new RptResumenDiarioHistorialForm();
            if (isset($_POST['RptResumenDiarioHistorialForm'])) {
                $model->attributes = $_POST['RptResumenDiarioHistorialForm'];
                $_SESSION['ModelForm'] = $model;
                Yii::app()->session['ModelForm'] = $model;

                if ($model->validate()) {

                    $ejecutivo = EjecutivoModel::model()->findAllByAttributes(array('e_usr_mobilvendor' => $model->ejecutivo));
                    $fila = 1;
                    $fHistorial = new FHistorialModel();
                    $fOrden = new FOrdenModel();
                    $fRuta = new FRutaModel();
//                    var_dump($model);die();
                    $historial = $fHistorial->getHistorialxVendedorxFechaxHoraInicioxHoraFin($model->fechagestion, $model->horaInicioGestion, $model->horaFinGestion, $ejecutivo[0]['e_usr_mobilvendor']);
//                    var_dump(count($historial) );die();

                    if (count($historial)) {
                        $primeraVisita = $fHistorial->getPrimeraVisitaxEjecutivoxFechaxHoraInicioxHoraFin($model->fechagestion, $model->horaInicioGestion, $model->horaFinGestion, $ejecutivo[0]['e_usr_mobilvendor'])[0]['RESULTADO'];
                        $ultimaVisita = $fHistorial->getUltimaVisitaxEjecutivoxFechaxHoraInicioxHoraFin($model->fechagestion, $model->horaInicioGestion, $model->horaFinGestion, $ejecutivo[0]['e_usr_mobilvendor'])[0]['RESULTADO'];

                        $dia = date("w", strtotime($model->fechagestion));
                        $ruta_dia_gestion = "R" . $dia . '-' . $ejecutivo[0]['e_iniciales'];

                        $rsTotalClientesRuta = $fRuta->getTotalClientesxRutaxEjecutivoxDia($ejecutivo[0]['e_iniciales'], $dia + 1);
                        $totalClientesRuta = $rsTotalClientesRuta[0]["TOTALCLIENTES"];

                        $nivelCumplimiento = 0;
                        $totalVisitasEfectuadas = 0;
                        $clientesNoVisitados = $fRuta->getTotalClientesNoVisitadosxRutaxEjecutivo($ejecutivo[0]['e_iniciales'], $dia + 1, $model->fechagestion, $ejecutivo[0]['e_usr_mobilvendor'])[0]['CLIENTESNOVISITADOS'];
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

                        $rsTotales = new FRutaModel();
                        $diaSemana = date('w', strtotime($model->fechagestion));
                        if ($diaSemana == 5) {

                            $_totalVentaViernes = intval($rsTotales->getTotalChipsVentaDia($ejecutivo[0]['e_iniciales'], $dia + 1, $model->fechagestion, $ejecutivo[0]['e_usr_mobilvendor'])[0]['RESPUESTA']);
                            $_totalVentaRutaViernes = intval($rsTotales->getTotalChipsVentaRuta($ejecutivo[0]['e_iniciales'], $dia + 1, $model->fechagestion, $ejecutivo[0]['e_usr_mobilvendor'])[0]['RESPUESTA']);
                            $_totalVentaFueraRutaViernes = intval($rsTotales->getTotalChipsVentaFueraRuta($ejecutivo[0]['e_iniciales'], $dia + 1, $model->fechagestion, $ejecutivo[0]['e_usr_mobilvendor'])[0]['RESPUESTA']);
                            $_totalClientesVentaViernes = intval($rsTotales->getTotalClientesVenta($ejecutivo[0]['e_iniciales'], $dia + 1, $model->fechagestion, $ejecutivo[0]['e_usr_mobilvendor'])[0]['RESPUESTA']);

                            $_totalVentaFinSemana = intval($rsTotales->getTotalChipsVentaFinSemana($ejecutivo[0]['e_iniciales'], $dia + 1, $model->fechagestion, $ejecutivo[0]['e_usr_mobilvendor'])[0]['RESPUESTA']);
                            $_totalVentaRutaFinSemana = intval($rsTotales->getTotalChipsVentaFinSemana($ejecutivo[0]['e_iniciales'], $dia + 1, $model->fechagestion, $ejecutivo[0]['e_usr_mobilvendor'])[0]['RESPUESTA']);
                            $_totalClientesVentaFinSemana = intval($rsTotales->getTotalClientesVentaFinSemana($ejecutivo[0]['e_iniciales'], $dia + 1, $model->fechagestion, $ejecutivo[0]['e_usr_mobilvendor'])[0]['RESPUESTA']);

                            $_totalVentaDia = $_totalVentaViernes + $_totalVentaFinSemana;
                            $_totalVentaRuta = $_totalVentaRutaViernes + $_totalVentaRutaFinSemana;
                            $_totalVentaFueraRuta = $_totalVentaFueraRutaViernes;
                            $_totalClientesVenta = $_totalClientesVentaViernes + $_totalClientesVentaFinSemana;
                        } else {
                            $_totalVentaDia = intval($rsTotales->getTotalChipsVentaDia($ejecutivo[0]['e_iniciales'], $dia + 1, $model->fechagestion, $ejecutivo[0]['e_usr_mobilvendor'])[0]['RESPUESTA']);
                            $_totalVentaRuta = intval($rsTotales->getTotalChipsVentaRuta($ejecutivo[0]['e_iniciales'], $dia + 1, $model->fechagestion, $ejecutivo[0]['e_usr_mobilvendor'])[0]['RESPUESTA']);
                            $_totalVentaFueraRuta = intval($rsTotales->getTotalChipsVentaFueraRuta($ejecutivo[0]['e_iniciales'], $dia + 1, $model->fechagestion, $ejecutivo[0]['e_usr_mobilvendor'])[0]['RESPUESTA']);
                            $_totalClientesVenta = intval($rsTotales->getTotalClientesVenta($ejecutivo[0]['e_iniciales'], $dia + 1, $model->fechagestion, $ejecutivo[0]['e_usr_mobilvendor'])[0]['RESPUESTA']);
                        }
                        $visitasValidas = 0;
                        $visitasInvalidas = 0;

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

                            $distancia = $this->haversineGreatCircleDistance($latitudCliente, $longitudCliente, $latitudHistorial, $longitudHistorial);
                            if ($model->precisionVisitas != 0) {
                                if ($distancia <= $model->precisionVisitas) {
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

//                            if ($visitaRepetida) {
//                                $estadoRevisionRuta = 'Visita fuera ruta repetida';
//                                $visitasFueraRuta -= 1;
//                            } else {
//                                $estadoRevisionRuta = 'Visita fuera de ruta';
//                                if ($visitaValida)
//                                    $visitasFueraRuta += 1;
//                            }

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

                        foreach ($datosResumenGrid as $key => $filaGrid) {
                            foreach ($filaGrid as $clave => $valor) {
                                $resumenRuta = array(
                                    'EJECUTIVO' => $ejecutivo[0]['e_usr_mobilvendor'],
                                    'FECHA_HISTORIAL' => $model->fechagestion,
                                    'PARAMETRO' => $clave,
                                    'VALOR' => strval($valor),
                                    'SEMANA' => strval($this->weekOfMonth($model->fechagestion)),
                                );

                                if ($clave == 'PORCENTAJE-CUMPLIMIENTO' || $clave == 'TOTAL-VENTA-REPORTADA')
                                    array_push($datosResumenGridGeneral, $resumenRuta);
                                if ($clave == 'CLIENTES-RUTA' || $clave == 'VISITAS-EFECTUADAS-EN-RUTA' || $clave == 'CLIENTES-NO-VISITADOS' || $clave == 'VISITAS-FUERA-RUTA' || $clave == 'VISITAS-REPETIDAS')
                                    array_push($datosResumenGridVisitas, $resumenRuta);
                                if ($clave == 'CLIENTES-VENTA' || $clave == 'CANTIDAD-VENTA-RUTA' || $clave == 'CANTIDAD-VENTA-FUERA-RUTA')
                                    array_push($datosResumenGridVentas, $resumenRuta);

                                array_push($datosResumenGridIzquierda, $resumenRuta);
                                unset($resumenRuta);
                            }//fin iteracion valores en fila
                        }//fin iteracion filas resumen
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

                        $response->Message = "Historial revisado exitosamente";
                        $response->Status = SUCCESS;
                        $response->Result = $datos; // $datosGrid;
                    }
                    else {
                        $response->Message = "No existen datos para los filtros usados";
                        $response->ClassMessage = CLASS_MENSAJE_NOTICE;
//                $response->Result = $datos; // $datosGrid;
                    }
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

    public function actionGuardarRevision() {
        $response = new Response();

        $model = new RptResumenDiarioHistorialForm();

        $datosDetalleRevisionDiarioGuardar = array();
        $totalDetallesGuardados = 0;
        $totalDetallesOmitidos = 0;

        $datosResumenRevisionDiarioGuardar = array();
        $totalResumenGuardados = 0;
        $totalResumenOmitidos = 0;
        $mensaje = '';
        try {
            $comentarioSupervisor = $_POST['RptResumenDiarioHistorialForm']['comentarioSupervision'];
//            if (strlen($comentarioSupervisor) > 0) {
            if (true) {
                if (isset(Yii::app()->session['detallerevisionhistorialitem']) && isset(Yii::app()->session['resumenrevisionhistorialitem'])) {

                    $fechagestion = Yii::app()->session['ModelForm']['fechagestion'];
                    $ejecutivo = Yii::app()->session['ModelForm']['ejecutivo'];
                    $consultasResumenDH = new FResumenDiarioHistorialModel();
                    $cantidadRegistrosResumen = intval($consultasResumenDH->getCantidadResumenxVendedorxFecha($fechagestion, $ejecutivo)[0]['registrosResumen']);

                    $registrosIguales = $consultasResumenDH->getItemResumenxVendedorxFecha($fechagestion, $ejecutivo);
                    if ($cantidadRegistrosResumen > 0) {
                        foreach ($registrosIguales as $itemBorrar) {
                            $existeBdd = ResumenHistorialDiarioModel::model()->findByAttributes(
                                    array(
                                        'rhd_fecha_historial' => $itemBorrar['rhd_fecha_historial'],
                                        'rhd_cod_ejecutivo' => $itemBorrar['rhd_cod_ejecutivo']
                                    )
                            );
                            if (isset($existeBdd)) {
                                $existeBdd->delete();
                            }
                        }
                    }
                    $consultasDetalleDH = new FDetalleDiarioHistorialModel();
                    $cantidadRegistrosDetalle = intval($consultasDetalleDH->getCantidadDetallexVendedorxFecha($fechagestion, $ejecutivo)[0]['registrosDetalle']);
                    $registrosIgualesDetalle = $consultasDetalleDH->getItemDetallexVendedorxFecha($fechagestion, $ejecutivo);
                    if ($cantidadRegistrosDetalle > 0) {

                        foreach ($registrosIgualesDetalle as $itemBorrar) {
                            $existeBdd = DetalleHistorialDiarioModel::model()->findByAttributes(
                                    array(
                                        'rh_fecha_ruta' => $itemBorrar['rh_fecha_ruta'],
                                        'rh_codigo_vendedor' => $itemBorrar['rh_codigo_vendedor']
                            ));
                            if (isset($existeBdd)) {
                                $existeBdd->delete();
                            }
                        }
                    }

                    $datosDetalleRevisionHistorial = Yii::app()->session['detallerevisionhistorialitem'];
                    $precisionVisita = Yii::app()->session['ModelForm']['precisionVisitas'];
                    if (count($datosDetalleRevisionHistorial) > 0) {
                        foreach ($datosDetalleRevisionHistorial as $row) {
                            $data = array(
                                'rh_fecha_item' => ($row['FECHARUTA'] == '') ? null : $row['FECHARUTA'],
                                'rh_fecha_revision' => ($row['FECHAREVISION'] == '') ? null : $row['FECHAREVISION'],
                                'rh_fecha_ruta' => ($row['FECHARUTA'] == '') ? null : $row['FECHARUTA'],
                                'rh_codigo_vendedor' => ($row['CODEJECUTIVO'] == '') ? null : $row['CODEJECUTIVO'],
                                'rh_cod_cliente' => ($row['CODIGOCLIENTE'] == '') ? null : $row['CODIGOCLIENTE'],
                                'rh_cliente' => ($row['CLIENTE'] == '') ? null : $row['CLIENTE'],
                                'rh_ruta_visita' => ($row['RUTAUSADA'] == '') ? null : $row['RUTAUSADA'],
                                'rh_orden_visita' => ($row['SECUENCIAVISITA'] == '') ? null : $row['SECUENCIAVISITA'],
                                'rh_ruta_ejecutivo' => ($row['RUTACLIENTE'] == '') ? null : $row['RUTACLIENTE'],
                                'rh_secuencia_ruta' => ($row['SECUENCIARUTA'] == '') ? null : $row['SECUENCIARUTA'],
                                'rh_observacion_ruta' => ($row['ESTADOREVISIONR'] == '') ? null : $row['ESTADOREVISIONR'],
                                'rh_observacion_secuencia' => ($row['ESTADOREVISIONS'] == '') ? null : $row['ESTADOREVISIONS'],
                                'rh_chips_compra' => ($row['CHIPSCOMPRADOS'] == '') ? null : $row['CHIPSCOMPRADOS'],
                                'rh_metros' => ($row['METROS'] == '') ? null : $row['METROS'],
                                'rh_validacion' => ($row['VALIDACION'] == '') ? null : $row['VALIDACION'],
                                'rh_precision' => ($precisionVisita == '') ? 0 : $precisionVisita,
                                'rh_latitud_cliente' => ($row['LATITUDC'] == '') ? null : $row['LATITUDC'],
                                'rh_longitud_cliente' => ($row['LONGITUDC'] == '') ? null : $row['LONGITUDC'],
                                'rh_latitud_historial' => ($row['LATITUDH'] == '') ? null : $row['LATITUDH'],
                                'rh_longitud_historial' => ($row['LONGITUDH'] == '') ? null : $row['LONGITUDH'],
                                'rh_estado' => 'INGRESADO',
                                'rh_fecha_ingreso' => date(FORMATO_FECHA_LONG),
                                'rh_fecha_modificacion' => date(FORMATO_FECHA_LONG),
                                'rh_usuario_revisa' => Yii::app()->user->id
                            );
                            array_push($datosDetalleRevisionDiarioGuardar, $data);
                            unset($data);
                        }// fin iteracion filas detalle revision

                        if (count($datosDetalleRevisionDiarioGuardar) > 0) {
                            $dbConnection = new CI_DB_active_record(null);
                            $sql = $dbConnection->insert_batch('tb_detalle_historial_diario', $datosDetalleRevisionDiarioGuardar);
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
                            unset($datosDetalleRevisionDiarioGuardar);
                            $connection->active = false;
                        }

                        if ($totalDetallesGuardados > 0)
                            $mensaje .= '<br>Se han cargado ' . $totalDetallesGuardados . ' registros detalles correctamente.';
                        if ($totalDetallesOmitidos > 0)
                            $mensaje .= '<br>Se han omitido ' . $totalDetallesOmitidos . ' detalles omitidos.';
                    }

                    $datosResumenRevisionHistorial = Yii::app()->session['resumenrevisionhistorialitem'];
                    if (count($datosResumenRevisionHistorial) > 0) {
                        foreach ($datosResumenRevisionHistorial as $row) {
                            $data = array(
                                'rhd_cod_ejecutivo' => ($row['EJECUTIVO'] == '') ? -1 : $row['EJECUTIVO'],
                                'rhd_fecha_historial' => ($row['FECHA_HISTORIAL'] == '') ? null : $row['FECHA_HISTORIAL'],
                                'rhd_parametro' => ($row['PARAMETRO'] == '') ? null : $row['PARAMETRO'],
                                'rhd_valor' => ($row['VALOR'] == '') ? 0 : $row['VALOR'],
                                'rhd_semana' => ($row['SEMANA'] == '') ? 0 : $row['SEMANA'],
                                'rhd_observacion_supervisor' => (strlen(trim($comentarioSupervisor)) > 0) ? 'Comentario no ingresado' : trim($comentarioSupervisor),
                                'rhd_usuario_supervisor' => Yii::app()->user->id,
                                'rhd_fecha_ingreso_observacion' => date(FORMATO_FECHA_LONG),
                                'rhd_fecha_modifica_observacion' => date(FORMATO_FECHA_LONG),
                                'rhd_fecha_ingreso' => date(FORMATO_FECHA_LONG),
                                'rhd_fecha_modificacion' => date(FORMATO_FECHA_LONG),
                                'rhd_usuario_ingresa_modifica' => Yii::app()->user->id
                            );
                            array_push($datosResumenRevisionDiarioGuardar, $data);
                            unset($data);
                        }// fin iteracion filas resumen revision
                        if (count($datosResumenRevisionDiarioGuardar) > 0) {
                            $dbConnection = new CI_DB_active_record(null);
                            $sql = $dbConnection->insert_batch('tb_resumen_historial_diario', $datosResumenRevisionDiarioGuardar);
                            $sql = str_replace('"', '', $sql);
                            $connection = Yii::app()->db_conn;
                            $connection->active = true;
                            $transaction = $connection->beginTransaction();
                            $command = $connection->createCommand($sql);
                            $countInsertResumen = $command->execute();
                            if ($countInsertResumen > 0) {
                                $transaction->commit();
                                $totalResumenGuardados = $countInsertResumen;
                            } else {
                                $transaction->rollback();
                                $totalResumenOmitidos += 1;
                            }
                            unset($datosResumenRevisionDiarioGuardar);
                            $connection->active = false;
                        }

                        if ($totalResumenGuardados > 0)
                            $mensaje .= '<br>Se han guardado ' . $totalResumenGuardados . ' registros resumen correctamente.';
                        if ($totalResumenOmitidos > 0)
                            $mensaje .= '<br>Se han omitido ' . $totalResumenOmitidos . ' resumenes.';
                    }
                } else {
                    $mensaje = 'No existen registros para guardar';
                }
            } else {
                $mensaje = 'Debe ingresar un comentario sobre el resultado del analisis';
            }
        } catch (Exception $e) {
            $mensaje = 'Se ha producido un error al guardar los registros';
        }
        Yii::app()->user->setFlash('resultadoGuardar', $mensaje);
        $returnUri = '/sisven/RptResumenDiarioHistorial/';
        Yii::app()->clientScript->registerMetaTag("" . INTERVALO_REFRESCO_AUTOMATICO . ";url={$returnUri}", null, 'refresh');
        $this->render('/historialmb/rptResumenDiarioHistorial', array('model' => $model));
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
            $datos = Yii::app()->session['detallerevisionhistorialitem'];
//            var_dump($datos);die();
            foreach ($datos as $value) {
                $dat = array(
//                    'FECHAREVISION' => $value['FECHAREVISION'],
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
                    'METROS' => $value['METROS'],
                    'VALIDACION' => $value['VALIDACION'],
                    'LATITUD_CLIENTE' => $value['LATITUDC'],
                    'LONGITUD_CLIENTE' => $value['LONGITUDC'],
                    'LATITUD_VISITA' => $value['LATITUDH'],
                    'LONGITUD_VISITA' => $value['LONGITUDH'],
                );
                array_push($revisionRuta, $dat);
            }

            $NombreArchivo = "reporte_detalle_revision_ruta";
            $NombreHoja = "reporte_detalle_revision_ruta";

            $autor = "Tececab"; //$_SESSION['CUENTA'];
            $titulo = "reporte_detalle_revision_ruta";
            $tema = "reporte_detalle_revision_ruta";
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
