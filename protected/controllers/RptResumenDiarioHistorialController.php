<?php

/**
 * Description
 * @fecha 
 * @author 
 */
class RptResumenDiarioHistorialController extends Controller {

    public function actionIndex() {
        if (Yii::app()->request->isAjaxRequest) {
            return;
        } else {
            $_SESSION['ejecutivo'] = '';
            $model = new RptResumenDiarioHistorialForm();
            $this->render('/historialmb/rptResumenDiarioHistorial', array('model' => $model));
        }
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
    public function Harvestine1($lat1, $long1, $lat2, $long2) {

        //Distancia en kilometros en 1 grado distancia.
        //Distancia en millas nauticas en 1 grado distancia: $mn = 60.098;
        //Distancia en millas en 1 grado distancia: 69.174;
        //Solo aplicable a la tierra, es decir es una constante que cambiaria en la luna, marte... etc.
        $km = 111.302;

        //1 Grado = 0.01745329 Radianes    
        $degtorad = 0.01745329;

        //1 Radian = 57.29577951 Grados
        $radtodeg = 57.29577951;

        //La formula que calcula la distancia en grados en una esfera, 
        //llamada formula de Harvestine. 
        //Para mas informacion hay que mirar en Wikipedia
        //http://es.wikipedia.org/wiki/F%C3%B3rmula_del_Haversine
        $dlong = ($long1 - $long2);
        $dvalue = (sin($lat1 * $degtorad) * sin($lat2 * $degtorad)) + (cos($lat1 * $degtorad) * cos($lat2 * $degtorad) * cos($dlong * $degtorad));
        $dd = acos($dvalue) * $radtodeg;

        return round(($dd * $km), 2);
    }

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
            if (isset($_POST['RptResumenDiarioHistorialForm'])) {
                $model->attributes = $_POST['RptResumenDiarioHistorialForm'];
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

                        $latitudCliente = str_replace(',', '.', $cliente[0]['cli_latitud']);
                        $longitudCliente = str_replace(',', '.', $cliente[0]['cli_longitud']);

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

                    $resumenRuta = array(
                        'NIVEL-CUMPLIMIENTO' => ($nivelCumplimiento == null) ? "0%" : number_format($nivelCumplimiento, 2) . "%",
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

    public function actionGuardarHistorial() {
        $response = new Response();
        $datosResumenRevision = array();
        $datosDetalleRevision = array();
        $totalDetallesGuardados = 0;
        $totalDetallesOmitidos = 0;
        $totalResumenGuardados = 0;
        $totalResumenOmitidos = 0;

        try {
            if (isset($_SESSION['revisionhistorialitem'])) {
                $datosDetalleRevisionHistorial = $_SESSION['detallerevisionhistorialitem'];
                $datosResumenRevisionHistorial = $_SESSION['resumenrevisionhistorialitem'];
                if (count($datosDetalleRevisionHistorial) > 0) {
                    foreach ($datosDetalleRevisionHistorial as $row) {
                        $data = array(
                            //''rh_id' => ($row[''] == '') ? null : $row[''],
                            'rh_item' => 'HISTORIAL',
//                            'rh_fecha_item' => $sfechaItem,
                            'rh_fecha_item' => ($row['FECHARUTA'] == '') ? null : $row['FECHARUTA'],
                            'rh_fecha_revision' => ($row['FECHAREVISION'] == '') ? null : $row['FECHAREVISION'],
                            'rh_codigo_vendedor' => ($row['CODEJECUTIVO'] == '') ? null : $row['CODEJECUTIVO'],
                            'rh_cod_cliente' => ($row['CODIGOCLIENTE'] == '') ? null : $row['CODIGOCLIENTE'],
                            'rh_ruta_visita' => ($row['RUTAUSADA'] == '') ? null : $row['RUTAUSADA'],
                            'rh_orden_visita' => ($row['SECUENCIAVISITA'] == '') ? null : $row['SECUENCIAVISITA'],
                            'rh_ruta_ejecutivo' => ($row['RUTACLIENTE'] == '') ? null : $row['RUTACLIENTE'],
                            'rh_secuencia_ruta' => ($row['SECUENCIARUTA'] == '') ? null : $row['SECUENCIARUTA'],
                            'rh_observacion_ruta' => ($row['ESTADOREVISIONR'] == '') ? null : $row['ESTADOREVISIONR'],
                            'rh_observacion_secuencia' => ($row['ESTADOREVISIONS'] == '') ? null : $row['ESTADOREVISIONS'],
                            'rh_chips_compra' => ($row['CHIPSCOMPRADOS'] == '') ? null : $row['CHIPSCOMPRADOS'],
                            'rh_estado' => 'INGRESADO',
                            'rh_fecha_ingreso' => date(FORMATO_FECHA_LONG),
                            'rh_fecha_modificacion' => date(FORMATO_FECHA_LONG),
                            'rh_usuario_revisa' => Yii::app()->user->id
                        );
                        array_push($datosDetalleRevision, $data);
                        unset($data);
                    }// fin iteracion filas detalle revision
                    if (count($datosDetalleRevision) > 0) {
                        $dbConnection = new CI_DB_active_record(null);
                        $sql = $dbConnection->insert_batch('tb_control_historial_ruta', $datosDetalleRevision);
                        $sql = str_replace('"', '', $sql);
                        $connection = Yii::app()->db_conn;
                        $connection->active = true;
                        $transaction = $connection->beginTransaction();
                        $command = $connection->createCommand($sql);
                        $countInsert = $command->execute();
                        if ($countInsert > 0) {
                            $transaction->commit();
                            $totalDetallesGuardados += 1;
                        } else {
                            $transaction->rollback();
                            $totalDetallesOmitidos += 1;
                        }
                        unset($datosDetalleRevision);
                        $connection->active = false;
                    }

                    if (count($datosResumenRevisionHistorial) > 0) {
                        foreach ($datosResumenRevisionHistorial as $row) {
//                        var_dump($row);                        die();
                            $data = array(
                                //''rh_id' => ($row[''] == '') ? null : $row[''],
                                'rrh_cod_ejecutivo' => ($row['EJECUTIVO'] == '') ? null : $row['EJECUTIVO'],
                                'rrh_fecha_historial' => ($row['FECHA_HISTORIAL'] == null) ? '0001/01/01' : $row['FECHA_HISTORIAL'],
                                'rrh_parametro' => ($row['PARAMETRO'] == null) ? 0 : $row['PARAMETRO'],
                                'rrh_valor' => ($row['VALOR'] == null) ? 0 : $row['VALOR'],
                                'rrh_fecha_ingreso' => date(FORMATO_FECHA_LONG),
                                'rrh_fecha_modificacion' => date(FORMATO_FECHA_LONG),
                                'rrh_usuario_ingresa_modifica' => Yii::app()->user->id,
                            );
                            array_push($datosResumenRevision, $data);
                            unset($data);
                        }//fin iteracion filas resumen
                        if (count($datosResumenRevision) > 0) {
                            $dbConnection = new CI_DB_active_record(null);
                            $sql = $dbConnection->insert_batch('tb_resumen_historial', $datosResumenRevision);
                            $sql = str_replace('"', '', $sql);
                            $connection = Yii::app()->db_conn;
                            $connection->active = true;
                            $transaction = $connection->beginTransaction();
                            $command = $connection->createCommand($sql);
                            $countInsert = $command->execute();
                            if ($countInsert > 0) {
                                $transaction->commit();
                                $totalResumenGuardados += 1;
                            } else {
                                $transaction->rollback();
                                $totalResumenOmitidos += 1;
                            }
                            unset($datosResumenRevision);
                            $connection->active = false;
                        }
                    }//fin control numero de registros resumens



                    $response->Message = 'Se han cargado ' . $totalDetallesGuardados . ' registros detalles correctamente.\n';
                    $response->Message = 'Se han cargado ' . $totalResumenGuardados . ' registros resumen correctamente.';
                    $response->Message = '\n\nSe han omitido ' . $totalDetallesOmitidos . ' detalles y ' . $totalResumenOmitidos . ' resumen omitidos.';
                } else {
                    $response->Message = 'No existen registros para guardar';
                    $response->Status = NOTICE;
                }
            }
        } catch (Exception $e) {
            $response->Message = 'Se ha producido un error';
            $response->Status = ERROR;
            $response->ClassMessage = CLASS_MENSAJE_ERROR;
        }

        $this->actionResponse(null, null, $response);
        return;
    }

    public function actionVerDatosArchivo() {
//        if (!Yii::app()->request->isAjaxRequest) {
//            $error['message'] = Yii::app()->params['msjErrorAccesoPag'];
//            $error['code'] = Yii::app()->params['codErrorAccesoPag'];
//            $this->render(Yii::app()->params['pagError'], $error);
//        }
//
//        $response = new Response();
//        try {
//            $response->Result = $_SESSION['indicadorItems'];
//            unset($_SESSION['indicadorItems']);
//        } catch (Exception $e) {
//            $mensaje = array(
//                'code' => $e->getCode(),
//                'error' => $e->getMessage(),
//                'file' => $e->getFile(),
//                'line' => $e->getLine()
//            );
//
//            $response->Message = Yii::app()->params['mensajeExcepcion'];
//            $response->Status = ERROR;
//        }
//
//        $this->actionResponse(null, null, $response);
        return;
    }

    private function actionResponse($view = 'error', $model = null, $response = null) {
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
