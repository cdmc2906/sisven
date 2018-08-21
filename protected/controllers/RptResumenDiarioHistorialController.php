<?php

/**
 * Description
 * @fecha 
 * @author 
 */
class RptResumenDiarioHistorialController extends Controller {

    public $layout = LAYOUT_FILTRO_GRID;

    public function actionIndex() {
        Yii::app()->user->setFlash('resultadoGuardar', null);
        Yii::app()->user->setFlash('resultadoGuardarRevisionAviso', null);
        Yii::app()->user->setFlash('resultadoGuardarRevisionAviso', null);

        if (Yii::app()->request->isAjaxRequest) {
            return;
        } else {
            Yii::app()->session['RptResumenDiarioHistorialForm'] = '';

            unset(Yii::app()->session['detalleRevisionGuardar']);
            unset(Yii::app()->session['resumenRevisionGuardar']);

            unset(Yii::app()->session['tiemposGestionEjecutivo']);
            unset(Yii::app()->session['resultadosRevision']);
            unset(Yii::app()->session['detallerevisionhistorialitem']);
            unset(Yii::app()->session['resumenrevisionhistorialitem']);

            $model = new RptResumenDiarioHistorialForm();
            $this->render('/reportes/rptResumenDiarioHistorial', array('model' => $model));
        }
    }

    public function actionEvaluarPeriodo() {
        $response = new Response();
        unset(Yii::app()->session['capilaridadMovistar']);
        unset(Yii::app()->session['capilaridadDelta']);
        unset(Yii::app()->session['SellInMovistar']);
        unset(Yii::app()->session['SellInDelta']);

        try {
            $solicitarLogin = true;
            if (Yii::app()->user->id <> intval(USUARIO_INVITADO)) {
                $solicitarLogin = false;
                $model = new RptResumenDiarioHistorialForm();
                $model->attributes = $_POST['RptResumenDiarioHistorialForm'];
                Yii::app()->session['ModelForm'] = $model;

                if (isset($_POST['periodos']) && intval($_POST['periodos']) > 0) {
                    $datos = array();
                    $datosVentasMes = array();
                    $datosCapilaridadMovistar = array();
                    $datosCapilaridadDelta = array();
                    $datosSellInMovistar = array();
                    $datosSellInDelta = array();

                    $periodo = PeriodoGestionModel::model()->findAllByAttributes(array('pg_id' => array($_POST['periodos'])));
                    $fVentasMovistar = new FVentasMovistarModel();
                    $capilaridades = $fVentasMovistar->getCapilaridad($periodo[0]['pg_fecha_inicio'], $periodo[0]['pg_fecha_fin']);

                    foreach ($capilaridades as $capilaridad) {
                        $pcumplimiento = (intval($capilaridad["CAPILARIDAD"]) / intval($capilaridad["PRESUPUESTO"])) * 100;
                        $faltante = intval($capilaridad["PRESUPUESTO"]) - intval($capilaridad["CAPILARIDAD"]);
                        $pfaltante = ((intval($capilaridad["PRESUPUESTO"]) - intval($capilaridad["CAPILARIDAD"])) / intval($capilaridad["PRESUPUESTO"])) * 100;

                        $capilaridadEjecutivo = array(
                            'BODEGA' => $capilaridad["VENDEDOR"],
                            'PRESUPUESTO' => $capilaridad["PRESUPUESTO"],
                            'CUMPLIMIENTO' => $capilaridad["CAPILARIDAD"],
                            'PCUMPLIMIENTO' => number_format($pcumplimiento, NUMERO_DECIMALES_RESULTADO, '.', '') . '%',
                            'FALTANTE' => $faltante,
                            'PFALTANTE' => number_format($pfaltante, NUMERO_DECIMALES_RESULTADO, '.', '') . '%',
                            'VENTA' => $capilaridad["VENTA"],
                        );
                        array_push($datosCapilaridadMovistar, $capilaridadEjecutivo);
                        unset($capilaridadEjecutivo);
                    }
                    $datos['capilaridadMovistar'] = $datosCapilaridadMovistar;
                    Yii::app()->session['capilaridadMovistar'] = $datosCapilaridadMovistar;

                    $sellIn = $fVentasMovistar->getSellIn($periodo[0]['pg_fecha_inicio'], $periodo[0]['pg_fecha_fin']);
                    foreach ($sellIn as $itemsellIn) {
                        $pcumplimiento = (intval($itemsellIn["VENTA"]) / intval($itemsellIn["PRESUPUESTO"])) * 100;
                        $faltante = intval($itemsellIn["PRESUPUESTO"]) - intval($itemsellIn["VENTA"]);
                        $pfaltante = ((intval($itemsellIn["PRESUPUESTO"]) - intval($itemsellIn["VENTA"])) / intval($itemsellIn["PRESUPUESTO"])) * 100;

                        $sellInEjecutivo = array(
                            'BODEGA' => $itemsellIn["VENDEDOR"],
                            'PRESUPUESTO' => $itemsellIn["PRESUPUESTO"],
                            'CUMPLIMIENTO' => $itemsellIn["VENTA"],
                            'PCUMPLIMIENTO' => number_format($pcumplimiento, NUMERO_DECIMALES_RESULTADO, '.', '') . '%',
                            'FALTANTE' => $faltante,
                            'PFALTANTE' => number_format($pfaltante, NUMERO_DECIMALES_RESULTADO, '.', '') . '%',
                            'VENTA' => $capilaridad["VENTA"],
                        );
                        array_push($datosSellInMovistar, $sellInEjecutivo);
                        unset($sellInEjecutivo);
                    }
                    $datos['sellInMovistar'] = $datosSellInMovistar;
                    Yii::app()->session['SellInMovistar'] = $datosSellInMovistar;

                    $fVentasIndicadores = new FIndicadoresModel();
                    $capilaridades = $fVentasIndicadores->getCapilaridad($periodo[0]['pg_fecha_inicio'], $periodo[0]['pg_fecha_fin']);
                    foreach ($capilaridades as $capilaridad) {
                        $pcumplimiento = (intval($capilaridad["CAPILARIDAD"]) / intval($capilaridad["PRESUPUESTO"])) * 100;
                        $faltante = intval($capilaridad["PRESUPUESTO"]) - intval($capilaridad["CAPILARIDAD"]);
                        $pfaltante = ((intval($capilaridad["PRESUPUESTO"]) - intval($capilaridad["CAPILARIDAD"])) / intval($capilaridad["PRESUPUESTO"])) * 100;

                        $capilaridadEjecutivo = array(
                            'D_BODEGA' => $capilaridad["VENDEDOR"],
                            'D_PRESUPUESTO' => $capilaridad["PRESUPUESTO"],
                            'D_CUMPLIMIENTO' => $capilaridad["CAPILARIDAD"],
                            'D_PCUMPLIMIENTO' => number_format($pcumplimiento, NUMERO_DECIMALES_RESULTADO, '.', '') . '%',
                            'D_FALTANTE' => $faltante,
                            'D_PFALTANTE' => number_format($pfaltante, NUMERO_DECIMALES_RESULTADO, '.', '') . '%',
                            'D_VENTA' => $capilaridad["VENTA"],
                        );
                        array_push($datosCapilaridadDelta, $capilaridadEjecutivo);
                        unset($resumenRuta);
                    }
                    $datos['capilaridadDelta'] = $datosCapilaridadDelta;
                    Yii::app()->session['capilaridadDelta'] = $datosCapilaridadDelta;

                    $sellInIndicadores = $fVentasIndicadores->getSellIn($periodo[0]['pg_fecha_inicio'], $periodo[0]['pg_fecha_fin']);
                    foreach ($sellInIndicadores as $itemSellInIndicadores) {
                        $pcumplimiento = (intval($itemSellInIndicadores["VENTA"]) / intval($itemSellInIndicadores["PRESUPUESTO"])) * 100;
                        $faltante = intval($itemSellInIndicadores["PRESUPUESTO"]) - intval($itemSellInIndicadores["VENTA"]);
                        $pfaltante = ((intval($itemSellInIndicadores["PRESUPUESTO"]) - intval($itemSellInIndicadores["VENTA"])) / intval($itemSellInIndicadores["PRESUPUESTO"])) * 100;

                        $sellInEjecutivo = array(
                            'BODEGA' => $itemSellInIndicadores["VENDEDOR"],
                            'PRESUPUESTO' => $itemSellInIndicadores["PRESUPUESTO"],
                            'CUMPLIMIENTO' => $itemSellInIndicadores["VENTA"],
                            'PCUMPLIMIENTO' => number_format($pcumplimiento, NUMERO_DECIMALES_RESULTADO, '.', '') . '%',
                            'FALTANTE' => $faltante,
                            'PFALTANTE' => number_format($pfaltante, 2, '.', '') . '%',
                            'VENTA' => $itemSellInIndicadores["VENTA"],
                        );
                        array_push($datosSellInDelta, $sellInEjecutivo);
                        unset($sellInEjecutivo);
                    }
                    $datos['sellInDelta'] = $datosSellInDelta;
                    Yii::app()->session['SellInDelta'] = $datosSellInDelta;

                    $fLibreria = new Libreria();
                    $fVentas = new FVentasMovistarModel();
                    $ventas = $fVentas->getVentasMes($periodo[0]['pg_fecha_inicio'], $periodo[0]['pg_fecha_fin']);
                    foreach ($ventas as $venta) {
                        $dat = array(
                            'BODEGA' => $venta["BODEGA"],
                            'CANTIDAD_MINES' => $venta["CANTIDAD_MINES"],
                            'FECHA_VENTA_MOVISTAR' => $venta["FECHA_VENTA_MOVISTAR"],
                        );
                        array_push($datosVentasMes, $dat);
                        unset($resumenRuta);
                    }
                    $datos['ventasmensual'] = $datosVentasMes;


                    $response->Message = "Periodo revisado exitosamente";
                    $response->Status = SUCCESS;
                    $response->Result = $datos;
                } else {
                    $response->Message = "Debe seleccionar todos los filtros";
                    $response->Status = NOTICE;
                    $response->ClassMessage = CLASS_MENSAJE_NOTICE;
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
            $this->actionResponse(null, null, $response);
        }
//        $this->actionResponse(null, $model, $response);
//        var_dump($response);die();
        return;
    }

    public function actionRevisarHistorial() {
        $response = new Response();

        try {
            $solicitarLogin = true;
            if (Yii::app()->user->id <> intval(USUARIO_INVITADO)) {
                $solicitarLogin = false;
                $model = new RptResumenDiarioHistorialForm();
                if (isset($_POST['RptResumenDiarioHistorialForm'])) {

                    $model->attributes = $_POST['RptResumenDiarioHistorialForm'];
                    $_SESSION['ModelForm'] = $model;
                    Yii::app()->session['ModelForm'] = $model;

                    if ($model->validate() && $model["ejecutivo"] != '') {
                        $fLibreria = new Libreria();
                        $response = $fLibreria->VerificarHistorialDiarioUsuario(
                                $model->ejecutivo
                                , $model->fechagestion
                                , $model->accionHistorial
                                , $model->horaInicioGestion
                                , $model->horaFinGestion
                                , $model->precisionVisitas
                                , $model->semanaRevision
                        );
                    } else {
                        $response->Message = "Debe seleccionar todos los filtros";
                        $response->ClassMessage = CLASS_MENSAJE_NOTICE;
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
            $this->actionResponse(null, null, $response);
        }
//        $this->actionResponse(null, $model, $response);
//        var_dump($response);die();
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

    public function actionGenerateExcel() {
        $response = new Response();
        try {

            $revisionRuta = array();
            $datos = Yii::app()->session['detallerevisionhistorialitem'];
            foreach ($datos as $value) {
                $dat = array(
//                    'FECHAREVISION' => $value['FECHAREVISION'],
                    'FECHARUTA' => $value['FECHARUTA'],
                    'EJECUTIVO' => $value['EJECUTIVO'],
                    'CODIGOCLIENTE' => $value['CODIGOCLIENTE'],
                    'CLIENTE' => $value['CLIENTE'],
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
//            $datosPrimeraUltima = Yii::app()->session['resumenPrimeraUltima'];

            foreach ($datosResumenDiario as $value) {
                $dat = array(
                    'PARAMETRO' => $value['PARAMETRO'],
                    'VALOR' => $value['VALOR'],
                    'FECHA_GESTION' => strval(Yii::app()->session['ModelForm']['fechagestion']),
                    'EJECUTIVO' => strval(Yii::app()->session['ModelForm']['ejecutivo'])
                );
                array_push($revisionRuta, $dat);
            }
//            foreach ($datosPrimeraUltima as $filaGrid) {
////                var_dump($key );die();
//                $dat = array(
//                    'PARAMETRO' => $filaGrid["VISITA"],
//                    'VALOR' => $filaGrid["CANTIDAD"],
//                    'FECHA_GESTION' => strval(Yii::app()->session['ModelForm']['fechagestion']),
//                    'EJECUTIVO' => strval(Yii::app()->session['ModelForm']['ejecutivo'])
//                );
//                array_push($revisionRuta, $dat);
//            }

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

    public function actionGenerateExcelEstadoRuta() {
        $response = new Response();
        try {
            $clientesNoVisitados = array();
            $fRuta = new FRutaModel();
            $filtros = array();
            $filtros = Yii::app()->session['ModelForm'];
            if ($filtros) {
                $noVisitados = Yii::app()->session['detalleNoVisitados'];


                $NombreArchivo = "clientes_no_visitados_ruta";
                $NombreHoja = "clientes_no_visitados_ruta";

                $autor = "Tececab"; //$_SESSION['CUENTA'];
                $titulo = "clientes_no_visitados_ruta";
                $tema = "clientes_no_visitados_ruta";
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

                $columnasCentrar = array();
                array_push($columnasCentrar, array('NUMCOLUMNA' => '4')); #SEMANA
                array_push($columnasCentrar, array('NUMCOLUMNA' => '5')); #SECUENCIA_HISTORIAL
                array_push($columnasCentrar, array('NUMCOLUMNA' => '6')); #SECUENCIA_RUTA
                array_push($columnasCentrar, array('NUMCOLUMNA' => '7')); #CLIENTE
                array_push($columnasCentrar, array('NUMCOLUMNA' => '8')); #VENTA
                array_push($columnasCentrar, array('NUMCOLUMNA' => '9')); #ESTADO

                $excel->Mapeo($noVisitados, '', '', $columnasCentrar);

                $excel->CrearArchivo('Excel2007', $NombreArchivo);
                $excel->GuardarArchivo();
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

    public function actionGenerateExcelTiemposGestion() {
        $response = new Response();
        try {
            $filtros = array();
            $filtros = Yii::app()->session['ModelForm'];

            if ($filtros) {
                $ejecutivo = EjecutivoModel::model()->findAllByAttributes(array('e_usr_mobilvendor' => $filtros['ejecutivo']));

                $detalleTiemposGestion = array();
                $detalleGestionEjecutivo = Yii::app()->session['tiemposGestionEjecutivo'];
                foreach ($detalleGestionEjecutivo as $item) {
                    $dat = array(
                        'FECHA_GESTION' => $item["FECHA_GESTION"],
                        'CODIGO_CLIENTE' => $item["CODIGO_CLIENTE"],
                        'NOMBRE_CLIENTE' => $item["CLIENTE"],
                        'RUTA' => $item["RUTA"],
                        'INICIO_VISITA' => $item["INICIO_VISITA"],
                        'FIN_VISITA' => $item["FIN_VISITA"],
                        'TIEMPO_GESTION_A' => $item["T_GESTION_A"],
                        'TIEMPO_TRASLADO_A' => $item["T_TRASLADO_A"],
                        'TIEMPO_GESTION' => $item["T_GESTION"],
                        'TIEMPO_TRASLADO' => $item["T_TRASLADO"],
                        'DISTANCIA_EJE_CLIENTE' => $item["DISTANCIA_EJECUTIVO_CLIENTE"],
                        'DISTANCIA_CLIENTES' => $item["DISTANCIA_CLIENTES"],
                    );
                    array_push($detalleTiemposGestion, $dat);
                }
                $columnasCentrar = array();
                array_push($columnasCentrar, array('NUMCOLUMNA' => '3')); #RUTA
                array_push($columnasCentrar, array('NUMCOLUMNA' => '4')); #INICIO_VISITA
                array_push($columnasCentrar, array('NUMCOLUMNA' => '5')); #FIN_VISITA
                array_push($columnasCentrar, array('NUMCOLUMNA' => '6')); #T_GESTION
                array_push($columnasCentrar, array('NUMCOLUMNA' => '7')); #T_TRASLADO
                array_push($columnasCentrar, array('NUMCOLUMNA' => '8')); #DISTANCIA_CLIENTE_SUP
                array_push($columnasCentrar, array('NUMCOLUMNA' => '9')); #DISTANCIA_CLIENTES
                $NombreArchivo = "tiempos_gestion_ejecutivo";
                $NombreHoja = "tiempos_gestion_ejecutivo";

                $autor = "Tececab"; //$_SESSION['CUENTA'];
                $titulo = "tiempos_gestion_ejecutivo";
                $tema = "tiempos_gestion_ejecutivo";
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

                $encabezadoImprimir = 'DETALLE GESTION  ' . $filtros['fechagestion'] . ' - ' . $ejecutivo[0]['e_nombre'];
                $footerImprimir = Yii::app()->user->name . ' - ' . date('Y/m/d h:i A');

                $excel->Mapeo($detalleTiemposGestion, $encabezadoImprimir, $footerImprimir, $columnasCentrar);

                $excel->CrearArchivo('Excel2007', $NombreArchivo);
                $excel->GuardarArchivo();
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

    public function actionGenerateExcelNoVisitados() {
        $response = new Response();
        try {
            $clientesNoVisitados = array();
            $fRuta = new FRutaModel();
            $filtros = array();
            $filtros = Yii::app()->session['ModelForm'];
            if ($filtros) {
                $ejecutivo = EjecutivoModel::model()->findAllByAttributes(array('e_usr_mobilvendor' => $filtros['ejecutivo']));
                $diaGestion = date("w", strtotime($filtros['fechagestion']));
                $ruta_dia_gestion = "R" . $diaGestion . '-' . $ejecutivo[0]['e_iniciales'];
//                var_dump($ruta_dia_gestion);die();
                $fRutaA = $fRuta->getClientesNoVisitadosxRutaxEjecutivoxDiaxPeriodo(
                        $filtros['ejecutivo']
                        , $ruta_dia_gestion
                        , $diaGestion + 1
                        , $filtros['fechagestion']
                        , $filtros['accionHistorial']
                        , Yii::app()->session['idPeriodoAbierto']
                );
//                var_dump($fRutaA);die();
                foreach ($fRutaA as $clienteNoVisitado) {
                    $dat = array(
                        'FECHA_GESTION' => $filtros['fechagestion'],
                        'RUTA' => $ruta_dia_gestion,
                        'CODIGO EJECUTIVO' => $ejecutivo[0]['e_usr_mobilvendor'],
                        'EJECUTIVO' => $ejecutivo[0]['e_nombre'],
                        'COD_CLIENTE' => $clienteNoVisitado['r_cod_cliente'],
                        'NOMBRE CLIENTE' => $clienteNoVisitado['r_nom_cliente']
                    );
                    array_push($clientesNoVisitados, $dat);
                }

                $NombreArchivo = "clientes_no_visitados";
                $NombreHoja = "clientes_no_visitados";

                $autor = "Tececab"; //$_SESSION['CUENTA'];
                $titulo = "clientes_no_visitados";
                $tema = "clientes_no_visitados";
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

                $excel->Mapeo($clientesNoVisitados);

                $excel->CrearArchivo('Excel2007', $NombreArchivo);
                $excel->GuardarArchivo();
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
        unset(Yii::app()->session['cantidadRepetidas']);
        unset(Yii::app()->session['totalVisitas']);
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
        $contadorVisitasRepetidas = 0;

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

//                    var_dump(array_search($itemHistorial['SEMANAHISTORIAL'], $semanasEjecutivo)===FALSE);die();

                    if (array_search($itemHistorial['SEMANAHISTORIAL'], $semanasEjecutivo) === FALSE) {
                        array_push($semanasEjecutivo, $itemHistorial['SEMANAHISTORIAL']);
                        $s_semanasEjecutivo .= $itemHistorial['SEMANAHISTORIAL'] . ',';
                    }
//                    var_dump($s_semanasEjecutivo);
                    if (!array_search($itemHistorial['CODIGOCLIENTE'], $clientesVisitados))
                        array_push($clientesVisitados, $itemHistorial['CODIGOCLIENTE']);
                    else
                        $contadorVisitasRepetidas += 1;
//                    var_dump($itemHistorial['CODIGOCLIENTE']);
                    $inicioFinVisitaHistorial = $fHistorial->getInicioFinVisitaClientexEjecutivoxFecha(
                            'Inicio visita'
                            , $fechaGestion
                            , $codigoEjecutivo
                            , $itemHistorial['CODIGOCLIENTE']
                            , $itemHistorial['IDHISTORIAL']);

                    $inicioVisita = DateTime::createFromFormat(FORMATO_FECHA_LONG_4, $inicioFinVisitaHistorial[0]['HORAVISITA']);
                    $finVisita = isset($inicioFinVisitaHistorial[1]['HORAVISITA']) ? DateTime::createFromFormat(FORMATO_FECHA_LONG_4, $inicioFinVisitaHistorial[1]['HORAVISITA']) : DateTime::createFromFormat(FORMATO_FECHA_LONG_4, $inicioFinVisitaHistorial[0]['HORAVISITA']);

                    $tiempoGestion = $inicioVisita->diff($finVisita)->format("%h:%I:%S");
                    $totalGestion = $libreria->SumaHoras($totalGestion, $tiempoGestion);



                    if ($contadorItemVisita > 0) { // solo si hay mas de una visita debe haber traslado entre clientes 
                        $tiempoTraslado = $inicioVisita->diff($finVisitaAnterior)->format("%h:%I:%S");
                        $totalTraslados = $libreria->SumaHoras($totalTraslados, $tiempoTraslado);
                    }
                    $finVisitaAnterior = $finVisita;

//                    var_dump($inicioVisita, $finVisita, $tiempoGestion, $totalGestion, '\n', $inicioVisita, $finVisitaAnterior, $tiempoTraslado, $totalTraslados);

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
                    $contadorClientesNuevos += 1;

                    break;

                default:
                    break;
            }
        }#Fin iteracion items historial
        die();
//        var_dump($s_semanasEjecutivo);        die();
        Yii::app()->session['tiempoGestionEjecutivo'] = $totalGestion;
        Yii::app()->session['tiempoTrasladoEjecutivo'] = $totalTraslados;

        Yii::app()->session['semanas'] = $s_semanasEjecutivo;
        Yii::app()->session['cantidadVisitas'] = count($clientesVisitados);
        Yii::app()->session['cantidadRepetidas'] = $contadorVisitasRepetidas;
        Yii::app()->session['totalVisitas'] = count($clientesVisitados) + $contadorVisitasRepetidas;
        Yii::app()->session['contadorChipsVendidos'] = $contadorChipsVendidos;
        Yii::app()->session['contadorClientesEfectivos'] = $contadorClientesEfectivos;
        Yii::app()->session['contadorEncuestas'] = $contadorEncuestas;
        Yii::app()->session['contadorClientesNuevos'] = $contadorClientesNuevos;

        return;
    }

    public function actionObtenerTiemposGestionTraslado() {
        $datosGrid = array();
        $datosGridJornada = array();
        $datosGridVisitas = array();
        $response = new Response();
        $solicitarLogin = true;
        $mensaje = '';
        try {
            $model = new RptResumenDiarioHistorialForm();
            if (isset($_POST['RptResumenDiarioHistorialForm'])) {
                $model->attributes = $_POST['RptResumenDiarioHistorialForm'];

                $cEjecutivos = new FEjecutivoModel();
                $reporteModel = new ReportesModel();
                $fRuta = new FRutaModel();
                $fHistorial = new FHistorialModel();

                $accion = 'Inicio Visita';
                $ejecutivos = $cEjecutivos->getEjecutivosXGrupoXEstado($model['tipoUsuarioJornada'], 1);
                $libreria = new Libreria();

                foreach ($ejecutivos as $ejecutivo) {
                    $det = $this->ObtenerTiemposGestionTraslado(
                            'Inicio visita'
                            , $model->fechaInicioFinJornada
                            , $model->horaInicioGestionJornada
                            , $model->horaFinGestionJornada
                            , $ejecutivo['e_usr_mobilvendor']
                    );

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
                    $_sTiempoGestion = $horasGestion . "h " . $minutosGestion . "m";

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
                        'REPETIDAS' => Yii::app()->session['cantidadRepetidas'],
                        'TOTAL' => Yii::app()->session['totalVisitas'],
                        'NUEVOS' => Yii::app()->session['contadorClientesNuevos'],
                        'EFECTIVOS' => Yii::app()->session['contadorClientesEfectivos'],
                        'ENCUESTAS' => Yii::app()->session['contadorEncuestas'],
                        'VENTA' => Yii::app()->session['contadorChipsVendidos'],
                    );

                    array_push($datosGridJornada, $infoJornada);
                    unset($infoJornada);
                }

                $datosGrid['infoJornada'] = $datosGridJornada;

//                $_SESSION['revisionJornada'] = $datosGrid;
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

    public function actionGenerateExcelJornada() {
        $datosGrid = array();
        $response = new Response();
        try {
            if (isset(Yii::app()->session['revisionJornada']) && count(Yii::app()->session['revisionJornada']) > 0) {
                $revisionJornadas = Yii::app()->session['revisionJornada'];
//                foreach ($revisionJornadas as $item) {
////                    foreach ($items as $item) {
//                    $infoJornadas = array(
//                        'EJECUTIVO' => (isset($item['EJECUTIVO'])) ? $item['EJECUTIVO'] : '',
//                        'INICIO_PRIMERA_VISITA' => (isset($item['INICIOPRIMERAVISITA'])) ? $item['INICIOPRIMERAVISITA'] : '',
//                        'FINAL_ULTIMA_VISITA' => (isset($item['FINALULTIMAVISITA'])) ? $item['FINALULTIMAVISITA'] : '',
//                        'TOTAL_TIEMPO' => (isset($item['TOTALTIEMPO'])) ? $item['TOTALTIEMPO'] : '',
//                        'TIEMPO_GESTION' => (isset($item['TIEMPOGESTION'])) ? $item['TIEMPOGESTION'] : '',
//                        'TIEMPO_TRALADO' => (isset($item['TIEMPOTRASLADO'])) ? $item['TIEMPOTRASLADO'] : '',
//                        'COMENTARIO_SUPERVISOR' => (isset($item['COMENTARIOS'])) ? $item['COMENTARIOS'] : '',
//                        'COMENTARIO_OFICINA' => (isset($item['COMENTARIOO'])) ? $item['COMENTARIOO'] : '',
//                    );
//                    array_push($datosGrid, $infoJornadas);
//                    unset($infoJornadas);
////                    }
//                }
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

//                $excel->Mapeo($datosGrid);
                $excel->Mapeo($revisionJornadas);

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

    public function actionCargarPeriodosAnio() {
        $anio = $_POST['anio'];
        $periodos = PeriodoGestionModel::model()->findAllByAttributes(array('pg_anio' => array($anio), 'pg_tipo' => array('MENSUAL')));
        if (count($periodos) > 0) {
            $cmb = "<select name='periodos' id='periodos' >";
            $cmb .= "<option value='-1' >Seleccione un periodo</option>";
            $opcion = '';
            foreach ($periodos as $value) {
                $mes = Libreria::mes($value['pg_mes']);
                $opcion .= "<option value=" . $value['pg_id'] . " >" . $mes . "</option>";
            }
            $cmb .= $opcion;
        } else {
            $cmb = "<select name='periodos' id='periodos' disabled='disabled'>";
            $cmb .= "<option value='-1'>Seleccione un periodo</option>";
        }
        $cmb .= "</select>";
        echo json_encode($cmb);
        return;
    }

    public function actionGenerateExcelResumenCapilaridad() {
        $datosGrid = array();
        $response = new Response();
        try {
            if ((isset(Yii::app()->session['capilaridadMovistar']) &&
                    count(Yii::app()->session['capilaridadMovistar']) > 0)
                    or ( isset(Yii::app()->session['capilaridadDelta']) &&
                    count(Yii::app()->session['capilaridadDelta']) > 0)
            ) {

                $datosCapilaridadMovistar = Yii::app()->session['capilaridadMovistar'];
                $datosCapilaridadDelta = Yii::app()->session['capilaridadDelta'];
                
                $data = array(
                    'PESTANA' => 'MOVISTAR',
                    'DATA' => $datosCapilaridadMovistar,
                );
                array_push($datosGrid, $data);

                $data = array(
                    'PESTANA' => 'DELTA',
                    'DATA' => $datosCapilaridadDelta,
                );
                array_push($datosGrid, $data);
                $NombreArchivo = "reporte_resumen_capilaridad";
                $NombreHoja = "reporte_resumen_capilaridad";

                $autor = "Tececab"; //$_SESSION['CUENTA'];
                $titulo = "reporte_resumen_capilaridad";
                $tema = "reporte_resumen_capilaridad";
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

                $columnasCentrar = array();
                array_push($columnasCentrar, array('NUMCOLUMNA' => '2')); #
                array_push($columnasCentrar, array('NUMCOLUMNA' => '3')); #
                array_push($columnasCentrar, array('NUMCOLUMNA' => '4')); #
                array_push($columnasCentrar, array('NUMCOLUMNA' => '5')); #
                array_push($columnasCentrar, array('NUMCOLUMNA' => '6')); #
                array_push($columnasCentrar, array('NUMCOLUMNA' => '7')); #

                array_push($columnasCentrar, array('NUMCOLUMNA' => '10')); #
                array_push($columnasCentrar, array('NUMCOLUMNA' => '11')); #
                array_push($columnasCentrar, array('NUMCOLUMNA' => '12')); #
                array_push($columnasCentrar, array('NUMCOLUMNA' => '13')); #
                array_push($columnasCentrar, array('NUMCOLUMNA' => '14')); #
                array_push($columnasCentrar, array('NUMCOLUMNA' => '15s')); #

                $excel->MapeoDobleFuente($datosCapilaridadMovistar,$datosCapilaridadDelta, '', '', $columnasCentrar);

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
    public function actionGenerateExcelResumenSellIn() {
        $datosGrid = array();
        $response = new Response();
        try {
            if ((isset(Yii::app()->session['SellInMovistar']) &&
                    count(Yii::app()->session['SellInDelta']) > 0)
                    or ( isset(Yii::app()->session['SellInMovistar']) &&
                    count(Yii::app()->session['SellInDelta']) > 0)
            ) {

                $datosCapilaridadMovistar = Yii::app()->session['SellInMovistar'];
                $datosCapilaridadDelta = Yii::app()->session['SellInDelta'];
                
                $data = array(
                    'PESTANA' => 'MOVISTAR',
                    'DATA' => $datosCapilaridadMovistar,
                );
                array_push($datosGrid, $data);

                $data = array(
                    'PESTANA' => 'DELTA',
                    'DATA' => $datosCapilaridadDelta,
                );
                array_push($datosGrid, $data);
                $NombreArchivo = "reporte_resumen_sell-in";
                $NombreHoja = "reporte_resumen_sell-in";

                $autor = "Tececab"; //$_SESSION['CUENTA'];
                $titulo = "reporte_resumen_sell-in";
                $tema = "reporte_resumen_sell-in";
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

                $columnasCentrar = array();
                array_push($columnasCentrar, array('NUMCOLUMNA' => '2')); #
                array_push($columnasCentrar, array('NUMCOLUMNA' => '3')); #
                array_push($columnasCentrar, array('NUMCOLUMNA' => '4')); #
                array_push($columnasCentrar, array('NUMCOLUMNA' => '5')); #
                array_push($columnasCentrar, array('NUMCOLUMNA' => '6')); #
                array_push($columnasCentrar, array('NUMCOLUMNA' => '7')); #

                array_push($columnasCentrar, array('NUMCOLUMNA' => '10')); #
                array_push($columnasCentrar, array('NUMCOLUMNA' => '11')); #
                array_push($columnasCentrar, array('NUMCOLUMNA' => '12')); #
                array_push($columnasCentrar, array('NUMCOLUMNA' => '13')); #
                array_push($columnasCentrar, array('NUMCOLUMNA' => '14')); #
                array_push($columnasCentrar, array('NUMCOLUMNA' => '15s')); #

                $excel->MapeoDobleFuente($datosCapilaridadMovistar,$datosCapilaridadDelta, '', '', $columnasCentrar);

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
