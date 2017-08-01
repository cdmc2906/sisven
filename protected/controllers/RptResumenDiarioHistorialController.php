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
//        $_SESSION['ejecutivo']='';
        $response = new Response();
        try {
            $model = new RptResumenDiarioHistorialForm();
//            var_dump($_POST);                die();
            if (isset($_POST['RptResumenDiarioHistorialForm'])) {
                $model->attributes = $_POST['RptResumenDiarioHistorialForm'];
                $_SESSION['ModelForm'] = $model;
//                var_dump($_SESSION['ModelForm']);die();
                if ($model->validate()) {
                    $ejecutivo = EjecutivoModel::model()->findAllByAttributes(array('e_usr_mobilvendor' => $model->ejecutivo));
                    $fila = 1;
                    $fHistorial = new FHistorialModel();
                    $fOrden = new FOrdenModel();
                    $fRuta = new FRutaModel();

                    $historial = $fHistorial->getHistorialxVendedorxFecha($model->fechagestion, $ejecutivo[0]['e_usr_mobilvendor']);
                    $dia = date("w", strtotime($model->fechagestion));
                    $rsTotalClientesRuta = $fRuta->getTotalClientesxRutaxEjecutivoxDia($ejecutivo[0]['e_iniciales'], $dia + 1);
                    $totalClientesRuta = $rsTotalClientesRuta[0]["TOTALCLIENTES"];

                    $nivelCumplimiento = 0;
                    $totalVisitasEfectuadas = 0;
                    $rsclientesNoVisitados = $fRuta->getTotalClientesNoVisitadosxRutaxEjecutivo($ejecutivo[0]['e_iniciales'], $dia + 1, $model->fechagestion, $ejecutivo[0]['e_usr_mobilvendor']);
                    $clientesNoVisitados = $rsclientesNoVisitados[0]['CLIENTESNOVISITADOS'];
                    $visitasRuta = 0;
                    $visitasValidasRuta = 0;
                    $visitasFueraRuta = 0;
                    $cantidadVentaRuta = 0;
                    $cantidadVentaFueraRuta = 0;
                    $clientesConVenta = 0;
                    $totalVentaReportada = 0;
                    $visitaRepetida = false;

                    $visitaValida = false;

                    $visitasValidas = 0;
                    $visitasInvalidas = 0;

                    foreach ($historial as $itemHistorial) {

                        $cliente = ClienteModel::model()->findAllByAttributes(array('cli_codigo_cliente' => $itemHistorial['CODIGOCLIENTE']));
                        if (count($cliente) > 0) {
//                            var_dump($cliente[0]['cli_codigo_cliente']);
                            $latitudCliente = str_replace(',', '.', $cliente[0]['cli_latitud']);
                            $longitudCliente = str_replace(',', '.', $cliente[0]['cli_longitud']);
                        } else {
                            $latitudCliente = 0;
                            $longitudCliente = 0;
                        }
                        $latitudHistorial = floatval(str_replace(",", ".", $itemHistorial['LATITUD']));
                        $longitudHistorial = floatval(str_replace(",", ".", $itemHistorial['LONGITUD']));

                        $distancia = $this->haversineGreatCircleDistance($latitudCliente, $longitudCliente, $latitudHistorial, $longitudHistorial);
//                        var_dump(number_format($distancia, 2, '.',''));die();
//                        var_dump(floatval(MAXMETROSVISITAVALIDA),floatval(MINMETROSVISITAVALIDA),$distancia ,$distancia >= floatval(MAXMETROSVISITAVALIDA) || $distancia <= floatval(MINMETROSVISITAVALIDA));die();
                        if ($distancia <= $model->precisionVisitas) {
                            $visitasValidas += 1;
                            $visitaValida = true;
                        } else {
                            $visitasInvalidas += 1;
                            $visitaValida = false;
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
                        if ($itemHistorial['RUTAVISITA'] == $rutaCliente) {
                            foreach ($datosDetalleGrid as $item) {
                                if (in_array($itemHistorial['CODIGOCLIENTE'], $item)) {
                                    $visitaRepetida = true;
                                    break;
                                }
                            }
                            if ($visitaRepetida) {
                                $estadoRevisionRuta = 'Visita en ruta repetida';
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
                        $nivelCumplimiento = ($visitasValidasRuta / $totalClientesRuta) * 100;

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
//                    var_dump($datosDetalleGrid);                    die();

                    $resumenRuta = array(
                        'PORCENTAJE-CUMPLIMIENTO' => ($nivelCumplimiento == null) ? "0%" : number_format($nivelCumplimiento, 2) . "%",
                        'VISITAS-EFECTUADAS' => ($totalVisitasEfectuadas == null) ? 0 : $totalVisitasEfectuadas,
                        'CLIENTES-RUTA' => ($totalClientesRuta == null) ? 0 : $totalClientesRuta,
                        'CLIENTES-NO-VISITADOS' => ($clientesNoVisitados == null) ? 0 : $clientesNoVisitados,
                        'VISITAS-VALIDAS-RUTA' => ($visitasValidasRuta == null) ? 0 : $visitasValidasRuta,
                        'VISITAS-FUERA-RUTA' => ($visitasFueraRuta == null) ? 0 : $visitasFueraRuta,
                        'CANTIDAD-VENTA-RUTA' => ($cantidadVentaRuta == null) ? 0 : $cantidadVentaRuta,
                        'CANTIDAD-VENTA-FUERA-RUTA' => ($cantidadVentaFueraRuta == null) ? 0 : $cantidadVentaFueraRuta,
                        'CLIENTES-VENTA' => ($clientesConVenta == null) ? 0 : $clientesConVenta,
                        'TOTAL-VENTA-REPORTADA' => ($totalVentaReportada == null) ? 0 : $totalVentaReportada,
                    );
                    array_push($datosResumenGrid, $resumenRuta);
                    unset($resumenRuta);

                    foreach ($datosResumenGrid as $key => $filaGrid) {
//                        var_dump($filaGrid);die();
                        foreach ($filaGrid as $clave => $valor) {
                            $resumenRuta = array(
                                'EJECUTIVO' => $ejecutivo[0]['e_usr_mobilvendor'],
                                'FECHA_HISTORIAL' => $model->fechagestion,
                                'PARAMETRO' => $clave,
                                'VALOR' => $valor,
                                'SEMANA' => strval($this->weekOfMonth($model->fechagestion)),
                            );

                            array_push($datosResumenGridIzquierda, $resumenRuta);
                            unset($resumenRuta);
                        }//fin iteracion valores en fila
                    }//fin iteracion filas resumen
                    $datos['resumenIzquierda'] = $datosResumenGridIzquierda;

                    $resumenRutaDerecha = array('VISITA' => 'Validas', 'CANTIDAD' => $visitasValidas);
                    array_push($datosResumenGridDerecha, $resumenRutaDerecha);
                    unset($resumenRutaDerecha);

                    $resumenRutaDerecha = array('VISITA' => 'Invalidas', 'CANTIDAD' => $visitasInvalidas);
                    array_push($datosResumenGridDerecha, $resumenRutaDerecha);
                    unset($resumenRutaDerecha);

//                    var_dump($datosResumenGridDerecha);                    die();
                    $datos['resumenDerecha'] = $datosResumenGridDerecha;

//                    var_dump($datos['resumenDerecha']);                    die();
                    $_SESSION['detallerevisionhistorialitem'] = $datosDetalleGrid;
                    $_SESSION['resumenrevisionhistorialitem'] = $datosResumenGridIzquierda;
                    $response->Message = "Historial revisado exitosamente";
                    $response->Status = SUCCESS;
                    $response->Result = $datos; // $datosGrid;
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
            if (isset($_SESSION['detallerevisionhistorialitem']) && isset($_SESSION['resumenrevisionhistorialitem'])) {

                $fechagestion = $_SESSION['ModelForm']['fechagestion'];
                $ejecutivo = $_SESSION['ModelForm']['ejecutivo'];

                $consultasResumenDH = new FResumenDiarioHistorialModel();
                $cantidadRegistrosResumen = intval($consultasResumenDH->getCantidadResumenxVendedorxFecha($fechagestion, $ejecutivo)[0]['registrosResumen']);
                $registrosIguales = $consultasResumenDH->getItemResumenxVendedorxFecha($fechagestion, $ejecutivo);
//                var_dump($registrosIguales);                die();
                if ($cantidadRegistrosResumen > 0) {
                    foreach ($registrosIguales as $itemBorrar) {
//                        var_dump($itemBorrar['codigo']);                        die();
                        $existeBdd = ResumenHistorialDiarioModel::model()->findByAttributes(
                                array('rhd_codigo' => $itemBorrar['codigo']));
//                        var_dump($existeBdd);die();
                        if (isset($existeBdd)) {
                            $existeBdd->delete();
                        }
                    }
                }
//                var_dump(2);die();
                $consultasDetalleDH = new FDetalleDiarioHistorialModel();
//                var_dump(3);die();
                $cantidadRegistrosDetalle = intval($consultasDetalleDH->getCantidadDetallexVendedorxFecha($fechagestion, $ejecutivo)[0]['registrosDetalle']);
//                var_dump($cantidadRegistrosDetalle);                die();
                $registrosIgualesDetalle = $consultasDetalleDH->getItemDetallexVendedorxFecha($fechagestion, $ejecutivo);
//                var_dump($registrosIgualesDetalle);                die();
                if ($cantidadRegistrosDetalle > 0) {

                    foreach ($registrosIgualesDetalle as $itemBorrar) {
//                        var_dump($itemBorrar['codigo']);                        die();
                        $existeBdd = DetalleHistorialDiarioModel::model()->findByAttributes(
                                array('rh_id' => $itemBorrar['codigo']));
                        if (isset($existeBdd)) {
                            $existeBdd->delete();
                        }
                    }
                }

                $datosDetalleRevisionHistorial = $_SESSION['detallerevisionhistorialitem'];
                $precisionVisita = $_SESSION['ModelForm']['precisionVisitas'];
                if (count($datosDetalleRevisionHistorial) > 0) {
//                if (false) {
                    foreach ($datosDetalleRevisionHistorial as $row) {
                        $data = array(
//                            'rh_fecha_item' => ($row[''] == '') ? null : $row['0'],
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

                $datosResumenRevisionHistorial = $_SESSION['resumenrevisionhistorialitem'];
//                var_dump($datosResumenRevisionHistorial);                die();
                var_dump($_POST);                die();
                $comentarioSupervisor = $_SESSION['ModelForm']['comentarioSupervision'];
//                var_dump($precisionVisita,$comentarioSupervisor);die();
                if (count($datosResumenRevisionHistorial) > 0) {
//                    var_dump($datosResumenRevisionHistorial[0]['VALOR']);die();
                    foreach ($datosResumenRevisionHistorial as $row) {
                        $data = array(
                            //'rhd_codigo' => ($row[''] == '') ? null : $row['0'],
                            'rhd_cod_ejecutivo' => ($row['EJECUTIVO'] == '') ? -1 : $row['EJECUTIVO'],
                            'rhd_fecha_historial' => ($row['FECHA_HISTORIAL'] == '') ? null : $row['FECHA_HISTORIAL'],
                            'rhd_parametro' => ($row['PARAMETRO'] == '') ? null : $row['PARAMETRO'],
                            'rhd_valor' => ($row['VALOR'] == '') ? 0 : $row['VALOR'],
                            'rhd_semana' => ($row['SEMANA'] == '') ? 0: $row['SEMANA'],
                            'rhd_observacion_supervisor' => (trim($comentarioSupervisor) == null) ? '' : trim($comentarioSupervisor),
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
//                    var_dump($datosResumenRevisionDiarioGuardar);die();
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
//                $response->Message = $mensaje;
//                $response->Status = SUCCESS;
//                $response->ClassMessage = CLASS_MENSAJE_SUCCESS;
            } else {
                $mensaje = 'No existen registros para guardar';
//                $response->Message = $mensaje;
//                $response->Status = NOTICE;
//                $response->ClassMessage = CLASS_MENSAJE_NOTICE;
            }
        } catch (Exception $e) {
            $mensaje = 'Se ha producido un error';
//            $response->Message = 'Se ha producido un error';
//            $response->Status = ERROR;
//            $response->ClassMessage = CLASS_MENSAJE_ERROR;
        }
        $mensaje .= "<br><br>***** Esta pagina se recargara en " . INTERVALO_REFRESCO_AUTOMATICO . " segundos *****";
        Yii::app()->user->setFlash('resultadoGuardar', $mensaje);
        $returnUri = '/sisven/RptResumenDiarioHistorial/';
        Yii::app()->clientScript->registerMetaTag("" . INTERVALO_REFRESCO_AUTOMATICO . ";url={$returnUri}", null, 'refresh');
//        Yii::app()->user->setFlash('resultadoGuardar', null);
        $this->render('/historialmb/rptResumenDiarioHistorial', array('model' => $model));

//        $this->actionResponse(null, null, $response);
        return;
    }

    private function actionResponse($view = 'error', $model = null, $response = null) {
//        var_dump($view,$model);die();
//        var_dump($model);die();
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
//            var_dump($_SESSION['detallerevisionhistorialitem']);die();
            $datos = $_SESSION['detallerevisionhistorialitem']; // $_SESSION['historialitem'];
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
