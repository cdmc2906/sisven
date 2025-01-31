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
        unset(Yii::app()->session['resultadoEnvioMail']);
        unset(Yii::app()->session['detalleResultadoEnvioMail']);

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
                Yii::app()->session['ModlForm'] = $model;

                if (isset($_POST['periodos']) && intval($_POST['periodos']) > 0) {
                    $datosEnviarVista = array();
                    $datosVentasMes = array();
                    $datosCapilaridadMovistar = array();
                    $datosCapilaridadDelta = array();
                    $datosSellInMovistar = array();
                    $datosSellInDelta = array();

                    $periodo = PeriodoGestionModel::model()->findAllByAttributes(array('pg_id' => array($_POST['periodos'])));
                    $fVentasMovistar = new FVentasMovistarModel();
                    $duplicado = $fVentasMovistar->getDuplicado($periodo[0]['pg_fecha_inicio'], $periodo[0]['pg_fecha_fin']);
                    $concatenadoDupli = '';
                    $autocalcularDescartado = 0;

                    if (count($duplicado) == 1)
                        $autocalcularDescartado = 1;

                    $datosEnviarVista['autocalcularDescartado'] = $autocalcularDescartado;

                    foreach ($duplicado as $key => $itemdupli) {
                        if ($key < count($duplicado) - 1)
                            $concatenadoDupli .= $itemdupli['duplicado'] . '-';
                        else
                            $concatenadoDupli .= $itemdupli['duplicado'];
                    }
                    $datosEnviarVista['duplicado'] = $concatenadoDupli;

                    $capilaridades = $fVentasMovistar->getCapilaridad($periodo[0]['pg_fecha_inicio'], $periodo[0]['pg_fecha_fin'], $periodo[0]['pg_id']);
                    //                    var_dump($capilaridades);DIE();
                    //                    var_dump(3);
                    foreach ($capilaridades as $capilaridad) {
                        $pcumplimiento = intval($capilaridad["PRESUPUESTO"]) > 0 ? (intval($capilaridad["CAPILARIDAD"]) / intval($capilaridad["PRESUPUESTO"])) * 100 : 0;
                        $faltante = intval($capilaridad["PRESUPUESTO"]) - intval($capilaridad["CAPILARIDAD"]);
                        $pfaltante = intval($capilaridad["PRESUPUESTO"]) > 0 ? ((intval($capilaridad["PRESUPUESTO"]) - intval($capilaridad["CAPILARIDAD"])) / intval($capilaridad["PRESUPUESTO"])) * 100 : 0;

                        $descartar = $fVentasMovistar->getCapilaridadDescartar($capilaridad['CDGVENDEDOR'], $periodo[0]['pg_fecha_inicio'], $periodo[0]['pg_fecha_fin']);
                        //                        var_dump(4);
                        $capilaridadEjecutivo = array(
                            'BODEGA' => $capilaridad["VENDEDOR"],
                            'PRESUPUESTO' => $capilaridad["PRESUPUESTO"],
                            'CUMPLIMIENTO' => $capilaridad["CAPILARIDAD"],
                            'DESCARTAR' => isset($descartar[0]) ? intval($descartar[0]['DESCARTAR']) : 0,
                            'PCUMPLIMIENTO' => number_format($pcumplimiento, NUMERO_DECIMALES_RESULTADO, '.', '') . '%',
                            'FALTANTE' => $faltante,
                            'PFALTANTE' => number_format($pfaltante, NUMERO_DECIMALES_RESULTADO, '.', '') . '%',
                            'UVENTA' => $capilaridad["UVENTA"],
                            'VENTA' => $capilaridad["VENTA"],
                        );
                        array_push($datosCapilaridadMovistar, $capilaridadEjecutivo);
                        unset($capilaridadEjecutivo);
                    }
                    $datosEnviarVista['capilaridadMovistar'] = $datosCapilaridadMovistar;
                    Yii::app()->session['capilaridadMovistar'] = $datosCapilaridadMovistar;

                    $sellIn = $fVentasMovistar->getSellIn($periodo[0]['pg_fecha_inicio'], $periodo[0]['pg_fecha_fin'], $periodo[0]['pg_id']);
                    //                    var_dump(5);
                    foreach ($sellIn as $itemsellIn) {
                        $pcumplimiento = intval($itemsellIn["PRESUPUESTO"]) > 0 ? (intval($itemsellIn["VENTA"]) / intval($itemsellIn["PRESUPUESTO"])) * 100 : 0;
                        $faltante = intval($itemsellIn["PRESUPUESTO"]) - intval($itemsellIn["VENTA"]);
                        $pfaltante = intval($itemsellIn["PRESUPUESTO"]) > 0 ? ((intval($itemsellIn["PRESUPUESTO"]) - intval($itemsellIn["VENTA"])) / intval($itemsellIn["PRESUPUESTO"])) * 100 : 0;

                        $sellInEjecutivo = array(
                            'BODEGA' => $itemsellIn["VENDEDOR"],
                            'PRESUPUESTO' => $itemsellIn["PRESUPUESTO"],
                            'CUMPLIMIENTO' => $itemsellIn["VENTA"],
                            'PCUMPLIMIENTO' => number_format($pcumplimiento, NUMERO_DECIMALES_RESULTADO, '.', '') . '%',
                            'FALTANTE' => $faltante,
                            'PFALTANTE' => number_format($pfaltante, NUMERO_DECIMALES_RESULTADO, '.', '') . '%',
                            'VENTA' => $itemsellIn["VENTA"],
                        );
                        array_push($datosSellInMovistar, $sellInEjecutivo);
                        unset($sellInEjecutivo);
                    }
                    $datosEnviarVista['sellInMovistar'] = $datosSellInMovistar;
                    Yii::app()->session['SellInMovistar'] = $datosSellInMovistar;


                    $fVentasIndicadores = new FIndicadoresModel();

                    $capilaridades = $fVentasIndicadores->getCapilaridad($periodo[0]['pg_fecha_inicio'], $periodo[0]['pg_fecha_fin'], $periodo[0]['pg_id']);
                    //                    var_dump(6);
                    $duplicado = $fVentasIndicadores->getDuplicado($periodo[0]['pg_fecha_inicio'], $periodo[0]['pg_fecha_fin']);
                    //                    var_dump(7);
                    $concatenadoDupliDelta = '';
                    $autocalcularDescartadoDelta = 0;

                    if (count($duplicado) == 1)
                        $autocalcularDescartadoDelta = 1;

                    $datosEnviarVista['autocalcularDescartadoDelta'] = $autocalcularDescartadoDelta;

                    foreach ($duplicado as $key => $itemdupli) {
                        if ($key < count($duplicado) - 1)
                            $concatenadoDupliDelta .= $itemdupli['duplicado'] . '-';
                        else
                            $concatenadoDupliDelta .= $itemdupli['duplicado'];
                    }
                    $datosEnviarVista['duplicadoDelta'] = $concatenadoDupliDelta;

                    foreach ($capilaridades as $capilaridad) {
                        $pcumplimiento = intval($capilaridad["PRESUPUESTO"]) > 0 ? (intval($capilaridad["CAPILARIDAD"]) / intval($capilaridad["PRESUPUESTO"])) * 100 : 0;
                        $faltante = intval($capilaridad["PRESUPUESTO"]) - intval($capilaridad["CAPILARIDAD"]);
                        $pfaltante = intval($capilaridad["PRESUPUESTO"]) > 0 ? ((intval($capilaridad["PRESUPUESTO"]) - intval($capilaridad["CAPILARIDAD"])) / intval($capilaridad["PRESUPUESTO"])) * 100 : 0;
                        //                        var_dump($capilaridad);die();
                        $descartar = $fVentasIndicadores->getCapilaridadDescartar($capilaridad['CDGBODEGA'], $periodo[0]['pg_fecha_inicio'], $periodo[0]['pg_fecha_fin']);
                        //                        var_dump(8);
                        $capilaridadEjecutivo = array(
                            'D_BODEGA' => $capilaridad["VENDEDOR"],
                            'D_PRESUPUESTO' => $capilaridad["PRESUPUESTO"],
                            'D_CUMPLIMIENTO' => $capilaridad["CAPILARIDAD"],
                            'D_DESCARTAR' => isset($descartar[0]) ? intval($descartar[0]['DESCARTAR']) : 0,
                            'D_PCUMPLIMIENTO' => number_format($pcumplimiento, NUMERO_DECIMALES_RESULTADO, '.', '') . '%',
                            'D_FALTANTE' => $faltante,
                            'D_PFALTANTE' => number_format($pfaltante, NUMERO_DECIMALES_RESULTADO, '.', '') . '%',
                            'UVENTA' => $capilaridad["UVENTA"],
                            'D_VENTA' => $capilaridad["VENTA"],
                        );
                        array_push($datosCapilaridadDelta, $capilaridadEjecutivo);
                        unset($resumenRuta);
                    }
                    $datosEnviarVista['capilaridadDelta'] = $datosCapilaridadDelta;
                    Yii::app()->session['capilaridadDelta'] = $datosCapilaridadDelta;

                    $sellInIndicadores = $fVentasIndicadores->getSellIn($periodo[0]['pg_fecha_inicio'], $periodo[0]['pg_fecha_fin'], $periodo[0]['pg_id']);
                    //                    var_dump(9);
                    foreach ($sellInIndicadores as $itemSellInIndicadores) {
                        $pcumplimiento = intval($itemSellInIndicadores["PRESUPUESTO"]) > 0 ? (intval($itemSellInIndicadores["VENTA"]) / intval($itemSellInIndicadores["PRESUPUESTO"])) * 100 : 0;
                        $faltante = intval($itemSellInIndicadores["PRESUPUESTO"]) - intval($itemSellInIndicadores["VENTA"]);
                        $pfaltante = intval($itemSellInIndicadores["PRESUPUESTO"]) > 0 ? ((intval($itemSellInIndicadores["PRESUPUESTO"]) - intval($itemSellInIndicadores["VENTA"])) / intval($itemSellInIndicadores["PRESUPUESTO"])) * 100 : 0;

                        $sellInEjecutivo = array(
                            'BODEGA' => $itemSellInIndicadores["VENDEDOR"],
                            'PRESUPUESTO' => $itemSellInIndicadores["PRESUPUESTO"],
                            'CUMPLIMIENTO' => $itemSellInIndicadores["VENTA"],
                            'PCUMPLIMIENTO' => number_format($pcumplimiento, NUMERO_DECIMALES_RESULTADO, '.', '') . '%',
                            'FALTANTE' => $faltante,
                            'PFALTANTE' => number_format($pfaltante, NUMERO_DECIMALES_RESULTADO, '.', '') . '%',
                            'VENTA' => $itemSellInIndicadores["VENTA"],
                        );
                        array_push($datosSellInDelta, $sellInEjecutivo);
                        unset($sellInEjecutivo);
                    }
                    $datosEnviarVista['sellInDelta'] = $datosSellInDelta;
                    Yii::app()->session['SellInDelta'] = $datosSellInDelta;

                    $fLibreria = new Libreria();
                    $fVentas = new FVentasMovistarModel();
                    $ventas = $fVentas->getVentasMes($periodo[0]['pg_fecha_inicio'], $periodo[0]['pg_fecha_fin']);
                    //                    var_dump(10);
                    foreach ($ventas as $venta) {
                        $dat = array(
                            'BODEGA' => $venta["BODEGA"],
                            'CANTIDAD_MINES' => $venta["CANTIDAD_MINES"],
                            'FECHA_VENTA_MOVISTAR' => $venta["FECHA_VENTA_MOVISTAR"],
                        );
                        array_push($datosVentasMes, $dat);
                        unset($resumenRuta);
                    }
                    $datosEnviarVista['ventasmensual'] = $datosVentasMes;

                    //                    die();
                    //                    var_dump($datosEnviarVista['ventasmensual']);die();
                    $response->Message = "Periodo revisado exitosamente";
                    $response->Status = SUCCESS;
                    $response->Result = $datosEnviarVista;
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

    public function actionEvaluarAltasPeriodo() {
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
                    $datosAltasPeriodo = array();

                    $periodo = PeriodoGestionModel::model()->findAllByAttributes(array('pg_id' => array($_POST['periodos'])));
                    $fAltasGrp = new FAltasGrpModel();
                    $altasPeriodo = $fAltasGrp->getAltasPorPeriodo($periodo[0]['pg_fecha_inicio'], $periodo[0]['pg_fecha_fin']);

                    foreach ($altasPeriodo['detalleAltas'] as $alta) {
                        $dat = array(
                            'TIPO_CLIENTE' => $alta["TIPO_CLIENTE"],
                            'FECHA_VARCHAR' => $alta["FECHA_VARCHAR"],
                            'CIUDAD' => $alta["CIUDAD"],
                            'MIN' => $alta["MIN"],
                        );
                        array_push($datosAltasPeriodo, $dat);
                        unset($dat);
                    }
                    $datos['altasPorPeriodo'] = $datosAltasPeriodo;

                    $detalleAltasVentasTransferencias = array();
                    foreach ($altasPeriodo['detalleExportarAltas'] as $alta) {
                        $dat = array(
                            'MIN' => $alta['MIN'],
                            'PLAN' => $alta['PLAN'],
                            'FECHA_ALTA' => $alta['FECHA_ALTA'],
                            'CODIGO_VENDEDOR' => $alta['CODIGO_VENDEDOR'],
                            'CIUDAD' => $alta['CIUDAD'],
                            'ICC' => $alta['ICC'],
                            'MES_ALTA' => $alta['MES_ALTA'],
                            'MES_VENTA' => $alta['MES_VENTA'],
                            'BODEGA' => $alta['BODEGA'],
                            'VENDEDOR' => $alta['VENDEDOR'],
                            'CODIGO_CLIENTE' => $alta['CODIGO_CLIENTE'],
                            'CLIENTE' => $alta['CLIENTE'],
                            'TIPO_CLIENTE' => $alta['TIPO_CLIENTE'],
                            'TRANSFERIDO_A' => $alta['TRANSFERIDO_A'],
                            'FECHA_TRANSFERENCIA' => $alta['FECHA_TRANSFERENCIA'],
                        );
                        array_push($detalleAltasVentasTransferencias, $dat);
                        unset($dat);
                    }
                    $datos['detalleAltasVentasTransferencias'] = $detalleAltasVentasTransferencias;


                    //                    var_dump($periodo[0]['pg_fecha_fin']);die();
                    $diasMes = substr($periodo[0]['pg_fecha_fin'], 8, 2);
                    //                    var_dump($diasMes);die();
                    $datosAltasDia = array();
                    $diasInicio = new DateTime($altasPeriodo['inicioFin'][0]['INICIO']);
                    $diasFin = new DateTime($altasPeriodo['inicioFin'][0]['FIN']);
                    $dias = $diasFin->diff($diasInicio)->format('%a');
                    foreach ($altasPeriodo['altasDiarias'] as $alta) {
                        $dat = array(
                            'TIPO' => $alta["TIPO_CLIENTE"],
                            'DIAS' => intval($dias + 1),
                            'ALTADIA' => number_format(intval($alta["DIARIA"]) / intval($dias + 1), 0, '.', ''),
                            'PROYECCION' => number_format((intval($alta["DIARIA"]) / intval($dias + 1)) * intval($diasMes), 0, '.', ''),
                        );
                        array_push($datosAltasDia, $dat);
                        unset($dat);
                    }
                    //                    var_dump($datosAltasDia);die();
                    $datos['altasDiarias'] = $datosAltasDia;

                    //ALTAS FUERA DE ZONA
                    $altasFueraZona = array();
                    $altasFueraZona = $fAltasGrp->getAltasFueraZona($periodo[0]['pg_fecha_inicio'], $periodo[0]['pg_fecha_fin']);
                    foreach ($altasFueraZona as $alta) {
                        $dat = array(
                            'CIUDAD' => $alta["CIUDAD"],
                            'TIPO_CLIENTE' => $alta["TIPO_CLIENTE"],
                            'VENDEDOR' => $alta["VENDEDOR"],
                            'CODIGO_CLIENTE' => $alta["CODIGO_CLIENTE"],
                            'MES_VENTA' => $alta["MES_VENTA"],
                            'MIN' => $alta["MIN"],
                        );
                        array_push($altasFueraZona, $dat);
                        unset($dat);
                    }
                    //                    var_dump($altasFueraZona);die();
                    $datos['altasFueraZona'] = $altasFueraZona;


                    $datosAltasSinVenta = array();
                    $altasSinVenta = $fAltasGrp->getAltasSinVentaPorPeriodo($periodo[0]['pg_fecha_inicio'], $periodo[0]['pg_fecha_fin']);
                    //                    var_dump($altasSinVenta);die();
                    foreach ($altasSinVenta as $alta) {
                        $dat = array(
                            'A_CIUDAD' => $alta["A_CIUDAD"],
                            'A_MIN' => $alta["A_MIN"],
                            'A_ICC' => $alta["A_ICC"],
                            'TX_MIN' => $alta["TX_MIN"],
                            'TX_ORIGEN' => $alta["TX_ORIGEN"],
                            'TX_DESTINO' => $alta["TX_DESTINO"],
                            'TX_FECHA' => $alta["TX_FECHA"],
                            'VM_MIN' => $alta["VM_MIN"],
                            'VM_ORIGEN' => $alta["VM_ORIGEN"],
                            'VM_DESTINO' => $alta["VM_DESTINO"],
                            'VM_FECHA' => $alta["VM_FECHA"],
                        );
                        array_push($datosAltasSinVenta, $dat);
                        unset($dat);
                    }
                    $datos['altasSinVenta'] = $datosAltasSinVenta;

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
                        //        var_dump("2");die();
                        $fLibreria = new Libreria();
                        $response = $fLibreria->VerificarHistorialDiarioUsuario(
                                $model->ejecutivo,
                                $model->fechagestion,
                                $model->accionHistorial,
                                $model->horaInicioGestion,
                                $model->horaFinGestion,
                                $model->precisionVisitas,
                                $model->semanaRevision
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
                        $filtros['ejecutivo'],
                        $ruta_dia_gestion,
                        $diaGestion + 1,
                        $filtros['fechagestion'],
                        $filtros['accionHistorial'],
                        Yii::app()->session['idPeriodoAbierto']
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

    function
    ObtenerTiemposGestionTraslado(
            $accionHistorial,
            $fechagestion,
            $horaInicioGestion,
            $horaFinGestion,
            $codigoEjecutivo
    ) {

//        var_dump($accionHistorial,
//            $fechagestion,
//            $horaInicioGestion,
//            $horaFinGestion,
//            $codigoEjecutivo);die();
        $dataRetorno = array();
        $fHistorial = new FHistorialModel();
//        var_dump( $fechagestion,
//                $horaInicioGestion,
//                $horaFinGestion,
//                $codigoEjecutivo);die();
        $historial = $fHistorial->getHistorialxVendedorxFechaxHoraInicioxHoraFin(
                0,
                $accionHistorial,
                $fechagestion,
                $horaInicioGestion,
                $horaFinGestion,
                $codigoEjecutivo
        );

        $libreria = new Libreria();
        $totalGestion = '00:00:00';
        $totalTiempoTraslado = '00:00:00';
        $finVisitaAnterior = new DateTime('00:00:00');

        $contadorItemVisita = 0;

        $contadorChipsVendidos = 0;
        $contadorClientesEfectivos = 0;
        $contadorClientesCerrados = 0;
        $contadorEncuestas = 0;
        $contadorClientesNuevos = 0;
        $contadorVisitasRepetidas = 0;

        $contadorClientesPropios = 0;
        $contadorClienteTemporal = 0;
        $contadorClientesDesconocido = 0;

        $clientesVisitados = array();
        $semanasUsadasEjecutivo = array();
        $s_semanasEjecutivo = '';

        $horasGestion = "";
        $minutosGestion = "";
        $segundosGestion = "";
        $_sTiempoGestion = "";

        $detalletiempos = array();

        $cantidad_comentarios_campo = 0;
        $cantidad_comentarios_telefono = 0;

        $formatoTiempoTotalGestion = "";
        $horasTraslado = "";
        $minutosTraslado = "";
        $segundosTralado = "";
        $_sTiempoTraslado = "";

        $diaGestion = DateTime::createFromFormat(FORMATO_FECHA_3, $fechagestion)->format('w') + 1;
        $_semanaGestion = (DateTime::createFromFormat(FORMATO_FECHA_3, $fechagestion)->format('W')) % SEMANAS_GESTION;
        $semanaGestion = $_semanaGestion == 0 ? 4 : $_semanaGestion;

//        var_dump($historial);die();
        if (count($historial) > 0) {
            foreach ($historial as $itemHistorial) {
//        var_dump($itemHistorial);die();

                switch ($itemHistorial['accion']) {
                    /* 'Inicio visita' => 'Inicio visita',
                      'Orden' => 'Orden',
                      'Forma' => 'Forma',
                      'Comentario' => 'Comentario',
                      'D�a inicio' => 'Dia inicio',
                      'Fin de visita' => 'Fin de visita',
                      'D�a fin' => 'Dia fin',
                      'Nuevo cliente' => 'Nuevo cliente',
                      'Estatus' => 'Estatus'
                     */
                    case 'Inicio visita':
                        $fechaGestion = DateTime::createFromFormat(FORMATO_FECHA_LONG_4, $itemHistorial['FECHAVISITA'])->format(FORMATO_FECHA);
                        $inicioVisita = new DateTime('00:00:00');
                        $finVisita = new DateTime('00:00:00');

                        $latitudHistorial = 0;
                        $longitudHistorial = 0;

                        $tiempoGestion = '00:00:00';
                        $tiempoTraslado = '00:00:00';

                        if (array_search($itemHistorial['SEMANAHISTORIAL'], $semanasUsadasEjecutivo) === FALSE) {
                            array_push($semanasUsadasEjecutivo, $itemHistorial['SEMANAHISTORIAL']);
                            $s_semanasEjecutivo .= $itemHistorial['SEMANAHISTORIAL'] . 'a-';
                        }

                        // Verificacion de 4 caracteres iniciales del codigo de cliente para definir que tipo es
                        //  se definen clientes Movistar (TCQU), clientes Tuenti (TU) (TUCH,TUNG,TUCX,TUBL)

                        if ((substr($itemHistorial['CODIGOCLIENTE'], 0, 4) == INICIAL_CLIENTES_MOVISTAR) ||
                                (substr($itemHistorial['CODIGOCLIENTE'], 0, 2) == INICIAL_CLIENTES_TUENTI) ||
                                (substr($itemHistorial['CODIGOCLIENTE'], 0, 4) == INICIAL_CLIENTES_MOVISTAR_MANABI
                                )
                        ) {
                            if (array_search($itemHistorial['CODIGOCLIENTE'], $clientesVisitados) === FALSE) {
                                array_push($clientesVisitados, $itemHistorial['CODIGOCLIENTE']);
                                $contadorClientesPropios += 1;
                            } else {
                                $contadorVisitasRepetidas += 1;
                            }
                        } elseif (
                                substr($itemHistorial['CODIGOCLIENTE'], 0, 4) == INICIAL_CLIENTES_TEMPORAL ||
                                substr($itemHistorial['CODIGOCLIENTE'], 0, 3) == INICIAL_CLIENTES_TEMPORAL_2
                        ) {
                            $contadorClienteTemporal += 1;
                        } else {
                            $contadorClientesDesconocido += 1;
                        }


                        $inicioFinVisitaHistorial = $fHistorial->getInicioFinVisitaClientexEjecutivoxFecha(
                                'Inicio visita',
                                $fechaGestion,
                                $codigoEjecutivo,
                                $itemHistorial['CODIGOCLIENTE'],
                                $itemHistorial['IDHISTORIAL']
                        );
//                        var_dump($inicioFinVisitaHistorial);                        die();
                        $inicioVisita = DateTime::createFromFormat(FORMATO_FECHA_LONG_4, $inicioFinVisitaHistorial[0]['HORAVISITA']);
                        $finVisita = isset($inicioFinVisitaHistorial[1]['HORAVISITA']) ?
                                DateTime::createFromFormat(FORMATO_FECHA_LONG_4, $inicioFinVisitaHistorial[1]['HORAVISITA']) :
                                DateTime::createFromFormat(FORMATO_FECHA_LONG_4, $inicioFinVisitaHistorial[0]['HORAVISITA']);

                        // var_dump($in--$finVisita);die();
                        // var_dump($inicioVisita->diff($finVisita));die();
                        // var_dump($inicioVisita->diff($finVisita)->format(FORMATO_HORA_1));die();
                        $tiempoGestion = $inicioVisita->diff($finVisita)->format(FORMATO_HORA_1);
                        $totalGestion = $libreria->SumaHoras($totalGestion, $tiempoGestion);

                        if ($contadorItemVisita > 0) { // solo si hay mas de una visita debe haber traslado entre clientes 
                            $tiempoTraslado = $inicioVisita->diff($finVisitaAnterior)->format(FORMATO_HORA_1);
                            $totalTiempoTraslado = $libreria->SumaHoras($totalTiempoTraslado, $tiempoTraslado);
                        }

                        $finVisitaAnterior = $finVisita;

                        $_tiempoGestion = new DateTime($totalGestion);

                        $formatoTiempoTotalGestion = $_tiempoGestion->format(FORMATO_HORA_1);

                        $horasGestion = $_tiempoGestion->format("h") == 12 ? 0 : $_tiempoGestion->format("h");
                        $minutosGestion = $_tiempoGestion->format("i");
                        $segundosGestion = $_tiempoGestion->format("s");
                        array_push($detalletiempos, $_tiempoGestion);

                        $_sTiempoGestion = $minutosGestion . "m " . $segundosGestion . "s";

                        $_tiempoTraslado = new DateTime($totalTiempoTraslado);
                        $horasTraslado = $_tiempoTraslado->format("h");
                        $minutosTraslado = $_tiempoTraslado->format("i");
                        $segundosTralado = $_tiempoTraslado->format("s");
                        $_sTiempoTraslado = $horasTraslado . "h" . $minutosTraslado . "m " . $segundosTralado . "s";
                        $contadorItemVisita++;

                        break;
                    case 'Orden':
//                        $contadorChipsVendidos += $itemHistorial['CHIPS'];
                        $contadorClientesEfectivos += 1;

                        break;
                    case 'Forma':
                        $contadorEncuestas += 1;

                        break;
                    case 'Nuevo cliente':
                        $contadorClientesNuevos += 1;

                        break;

                    case 'Comentario':

                        $codigos_comentario_gestion_campo = explode(' ', CODIGO_COMENTARIO_GESTION_CAMPO);
                        $codigos_comentario_gestion_telefono = explode(' ', CODIGO_COMENTARIO_GESTION_TELEFONO);

                        if (in_array($itemHistorial['CODIGOCOMENTARIO'], $codigos_comentario_gestion_campo)) {
                            $cantidad_comentarios_campo += 1;
                        } elseif (in_array($itemHistorial['CODIGOCOMENTARIO'], $codigos_comentario_gestion_telefono)) {
                            $cantidad_comentarios_telefono += 1;
                        }

                        if ($itemHistorial['CODIGOCOMENTARIO'] == CODIGO_COMENTARIO_CERRADOS) {
                            $contadorClientesCerrados += 1;
                        }

                        break;

                    default:
                        break;
                }
            } #Fin iteracion items historial

            $time = ($horasGestion > 0 && $minutosGestion > 0 && $segundosGestion > 0) ? ($horasGestion * 60) + $minutosGestion + ($segundosGestion / 60) : 0;
            $promedioGestion = (floatval($contadorClientesPropios - $contadorClientesCerrados) > 0) ? $time / floatval($contadorClientesPropios - $contadorClientesCerrados) : 0;

            $FEjecutivoRuta = new FEjecutivoRutaModel();
            $clientesRuta = $FEjecutivoRuta->getTotalClientesxEjecutivoxDiaxSemanaxLineaNegocio(
                    $codigoEjecutivo
                    , $semanaGestion
                    , $diaGestion
                    , 'MOVZS');

            $dataRetorno['cantidadRepetidas'] = $contadorVisitasRepetidas;
            $dataRetorno['cantidadVisitas'] = count($clientesVisitados);
            $dataRetorno['clientesCerrados'] = $contadorClientesCerrados;
            $dataRetorno['contadorChipsVendidos'] = $contadorChipsVendidos;
            $dataRetorno['contadorClientesEfectivos'] = $contadorClientesEfectivos;
            $dataRetorno['contadorClientesNuevos'] = $contadorClientesNuevos;
            $dataRetorno['contadorEncuestas'] = $contadorEncuestas;
            $dataRetorno['nombreRuta'] = isset($clientesRuta[0]) ? $clientesRuta[0]['ruta'] : ' ';
            $dataRetorno['semanas'] = $s_semanasEjecutivo;
            $dataRetorno['tiempoGestionEjecutivo'] = $totalGestion;
//            $dataRetorno['tiempoGestionEjecutivo'] = $formatoTiempoTotalGestion;
            $dataRetorno['tiempoTrasladoEjecutivo'] = $totalTiempoTraslado;
            $dataRetorno['tiempoxCliente'] = sprintf('%02dh %02dm %02ds', $promedioGestion / 60, fmod($promedioGestion, 60), fmod($promedioGestion, 1) * 60);
            $dataRetorno['totalClientesRuta'] = isset($clientesRuta[0]) ? intval($clientesRuta[0]['totalclientes']) : 0;
            $dataRetorno['totalDesconocido'] = $contadorClientesDesconocido;
            $dataRetorno['totalPropios'] = $contadorClientesPropios;
            $dataRetorno['totalTemporal'] = $contadorClienteTemporal;
            $dataRetorno['totalVisitas'] = count($clientesVisitados) + $contadorVisitasRepetidas + $contadorClienteTemporal;

            $dataRetorno['cantidadComentariosCampo'] = $cantidad_comentarios_campo;
            $dataRetorno['cantidadComentariosTelefono'] = $cantidad_comentarios_telefono;
        }
//        var_dump($dataRetorno);die();
        return $dataRetorno;
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

                $reporteModel = new ReportesModel();
                $accion = 'Inicio Visita';

//                var_dump(Yii::app()->session['codigoUsuarioSeleccionado']);die();

                $cEjecutivos = new FEjecutivoModel();
                if ($model['tipoUsuarioJornada'] != 'SE') { //opcion SE corresponde a seleccione ejecutivo
                    //Obtener los usuarios que hicieron gesti�n el dia escogido en el filtro
                    $ejecutivos = $cEjecutivos->getEjecutivosXGrupoXEstadoXFechaGestion(
                            $model['tipoUsuarioJornada']
                            , 1
                            , $model['fechaInicioJornada']
                            , $model['fechaFinJornada']);
//                    var_dump($ejecutivos);die();
                } else {
                    //Obtener datos del usuario seleccionado 
                    $ejecutivos = $cEjecutivos->getEjecutivoFormatoXGestion(Yii::app()->session['codigoUsuarioSeleccionado']);
                }

//                var_dump($ejecutivos);die();
//                if (isset(Yii::app()->session['codigoUsuarioSeleccionado'])) {
                if (isset($ejecutivos)) {
                    $fechaEnIntervalo = $model['fechaInicioJornada'];
                    while ($fechaEnIntervalo <= $model['fechaFinJornada']) {
                        //Analizar gesti�n de cada ejecutivo    
                        foreach ($ejecutivos as $ejecutivo) {
                            $det = $this->ObtenerTiemposGestionTraslado(
                                    $accion,
                                    $fechaEnIntervalo,
                                    $model->horaInicioJornada,
                                    $model->horaFinJornada,
                                    $ejecutivo['e_usr_mobilvendor']
                            );
                            $inicioJornadaEjecutivo = $reporteModel->getInicioJornadaxFecha(
                                    $ejecutivo['e_usr_mobilvendor'],
                                    $fechaEnIntervalo,
                                    $model->horaInicioJornada,
                                    $model->horaFinJornada
                            );

                            $finJornadaEjecutivo = $reporteModel->getFinJornadaxUsuarioxFecha(
                                    $ejecutivo['e_usr_mobilvendor'],
                                    $fechaEnIntervalo,
                                    $model->horaInicioJornada,
                                    $model->horaFinJornada
                            );

                            if (isset($inicioJornadaEjecutivo[0]) > 0)
                                $entrada = new DateTime($inicioJornadaEjecutivo[0]["HORA"]);
                            else
                                $entrada = '00:00:00';

                            if (isset($finJornadaEjecutivo[0]) > 0)
                                $salida = new DateTime($finJornadaEjecutivo[0]["HORA"]);
                            else
                                $salida = '00:00:00';

                            $tiempoGestion = (count($inicioJornadaEjecutivo) > 0 && (count($finJornadaEjecutivo) > 0)) ?
//                                $entrada->diff($salida)->format("%h:%I" FORMATO_HORA_1) : "00:00";
                                    $entrada->diff($salida)->format(FORMATO_HORA_1) : "00:00:00";

                            $_tiempoGestion = new DateTime($tiempoGestion);
                            $horasGestion = $_tiempoGestion->format("h");
                            $minutosGestion = $_tiempoGestion->format("i");
                            $segundosGestion = $_tiempoGestion->format("s");
                            $_sTiempoGestion = $horasGestion . "h " . $minutosGestion . "m " . $segundosGestion . "s";

                            if (isset($det['tiempoGestionEjecutivo'])) {//controlo que el ejecutivo tenga gestion en el dia del rango 
                                $infoJornada = array(
                                    'FECHA' => $fechaEnIntervalo,
                                    'EJECUTIVO' => $ejecutivo['e_nombre'],
                                    'USR' => $ejecutivo['e_usr_mobilvendor'],
                                    //                            'CUMPLIMIENTO' => $cumplimientoEjecutivo,
                                    'INICIOPRIMERAVISITA' => (count($inicioJornadaEjecutivo) > 0) ? $entrada->format("H:i") : "00:00",
                                    'FINALULTIMAVISITA' => (count($finJornadaEjecutivo) > 0) ? $salida->format("H:i") : "00:00",
                                    'TOTALTIEMPO' => $tiempoGestion, //$_sTiempoGestion,
                                    'TOTALTIEMPOTEXTO' => $_sTiempoGestion,
                                    'TIEMPOGESTION' => $det['tiempoGestionEjecutivo'],
                                    'TIEMPOTRASLADO' => $det['tiempoTrasladoEjecutivo'],
                                    'PROMEDIOXCLIENTE' => $det['tiempoxCliente'],
                                    'SEMANAS' => ($det['semanas'] > 0) ? $det['semanas'] : '0',
                                    'VISITAS' => ($det['cantidadVisitas'] > 0) ? $det['cantidadVisitas'] : '0',
                                    'REPETIDAS' => ($det['cantidadRepetidas'] > 0) ? $det['cantidadRepetidas'] : '0',
                                    'RUTA' => $det['nombreRuta'],
                                    'ENRUTA' => $det['totalClientesRuta'],
                                    'PROPIOS' => ($det['totalPropios'] > 0) ? $det['totalPropios'] : '0',
                                    'TEMPORAL' => ($det['totalTemporal'] > 0) ? $det['totalTemporal'] : '0',
                                    'DESCONOCIDO' => ($det['totalDesconocido'] > 0) ? $det['totalDesconocido'] : '0',
                                    'CERRADOS' => ($det['clientesCerrados'] > 0) ? $det['clientesCerrados'] : '0',
                                    'TOTAL' => ($det['totalVisitas'] > 0) ? $det['totalVisitas'] : '0',
                                    'NUEVOS' => ($det['contadorClientesNuevos'] > 0) ? $det['contadorClientesNuevos'] : '0',
                                    'EFECTIVOS' => ($det['contadorClientesEfectivos'] > 0) ? $det['contadorClientesEfectivos'] : '0',
                                    'ENCUESTAS' => ($det['contadorEncuestas'] > 0) ? $det['contadorEncuestas'] : '0',
                                    'VENTA' => ($det['contadorChipsVendidos'] > 0) ? $det['contadorChipsVendidos'] : '0',
                                    'GESTION_CAMPO' => $det['cantidadComentariosCampo'],
                                    'GESTION_TELEFONICA' => $det['cantidadComentariosTelefono'],
                                );
                                array_push($datosGridJornada, $infoJornada);
                                unset($infoJornada);
                            }//fin de if control de gestion de ejecutivo en dia
                        }//fin de for iterador de ejecutivos
                        $fechaEnIntervalo = date(FORMATO_FECHA_3, strtotime($fechaEnIntervalo . "+1 day"));
                    }//fin del while iteraci�n fechas

                    $datosGrid['infoJornada'] = $datosGridJornada;

                    Yii::app()->session['revisionJornada'] = $datosGridJornada;
                    $response->Message = $mensaje;
                    $response->Status = SUCCESS;
                    $response->Result = $datosGrid;
                }// fin del if que controla que se tenga un usuario escogido
                else {
                    $response->Message = "Sin usuarios seleccionados";
                    $response->Status = NOTICE;
//                    $response->Result = $datosGrid;
                }
            } else {
                echo CActiveForm::validate($model);
                Yii::app()->end();
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
        $this->actionResponse(null, null, $response);
        //        var_dump($response);        die();
        return;
    }

    public function actionCargarPeriodosAnio() {
        $anio = $_POST['anio'];
        $periodos = PeriodoGestionModel::model()->findAllByAttributes(array('pg_anio' => array($anio), 'pg_tipo' => array('MENSUAL')));
        if (count($periodos) > 0) {
            $cmb = "<select name='periodos' id='periodos' >";
            $cmb .= "<option value='-1' >Seleccione</option>";
            $opcion = '';
            foreach ($periodos as $value) {
                $mes = Libreria::mes($value['pg_mes']);
                $opcion .= "<option value=" . $value['pg_id'] . " >" . $mes . "</option>";
            }
            $cmb .= $opcion;
        } else {
            $cmb = "<select name='periodos' id='periodos' disabled='disabled'>";
            $cmb .= "<option value='-1'>No existe informacion</option>";
        }
        $cmb .= "</select>";
        echo json_encode($cmb);
        return;
    }

    public function actionSetearEjecutivoSeleccionadoJornada() {
        $response = new Response();
        $codigoUsuarioSeleccionado = $_POST['codigoUsuarioSeleccionado'];
//        var_dump($codigoUsuarioSeleccionado);die();
        Yii::app()->session['codigoUsuarioSeleccionado'] = $codigoUsuarioSeleccionado;
//        var_dump("i got the data", Yii::app()->session['codigoUsuarioSeleccionado']); //       die();

        $response->Result = "OK";
        $this->actionResponse(null, null, $response);
        return;
    }

    public function actionGenerateExcelResumenCapilaridad() {
        $datosGrid = array();
        $response = new Response();
        try {
            if ((isset(Yii::app()->session['capilaridadMovistar']) &&
                    count(Yii::app()->session['capilaridadMovistar']) > 0)
                    or (isset(Yii::app()->session['capilaridadDelta']) &&
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

                $excel->MapeoDobleFuente($datosCapilaridadMovistar, $datosCapilaridadDelta, '', '', $columnasCentrar);

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
                    or (isset(Yii::app()->session['SellInMovistar']) &&
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

                $excel->MapeoDobleFuente($datosCapilaridadMovistar, $datosCapilaridadDelta, '', '', $columnasCentrar);

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

    public function actionBuscaPeriodos() {
        $response = new Response();
        $fPeriodos = new FPeriodoGestionModel();
        $periodos = $fPeriodos->getPeriodosMensuales();
        $response->Result = $periodos;
        unset(Yii::app()->session['inicioPeriodoSeleccionadoFZ']);
        unset(Yii::app()->session['inicioPeriodoSeleccionadoFZ']);
        unset(Yii::app()->session['resultadoEnvioMail']);
        unset(Yii::app()->session['detalleResultadoEnvioMail']);

        $this->actionResponse(null, null, $response);
        return;
    }

    public function actionMostrarDetalleTipoBodegaXPeriodo() {
        $response = new Response();
        $fResumenRevision = new FResumenPeriodoModel();

        unset(Yii::app()->session['resultadoEnvioMail']);
        unset(Yii::app()->session['detalleResultadoEnvioMail']);

        Yii::app()->session['inicioPeriodoSeleccionadoFZ'] = $_POST["inicioPeriodoFZ"];
        Yii::app()->session['finPeriodoSeleccionadoFZ'] = $_POST["finPeriodoFZ"];
        Yii::app()->session['anioPeriodoSeleccionadoFZ'] = $_POST["anioPeriodoFZ"];
        Yii::app()->session['mesPeriodoSeleccionadoFZ'] = $_POST["mesPeriodoFZ"];

        $resumenes['detallePeriodo'] = $fResumenRevision->getResumenAltasxPeriodoMensual($_POST["inicioPeriodoFZ"], $_POST["finPeriodoFZ"]);

        $response->Result = $resumenes;
        $response->Status = SUCCESS;
        $this->actionResponse(null, null, $response);
        return;
    }

    public function actionMostrarDetalleTipoBodega() {
        $response = new Response();
        $fResumenRevision = new FResumenPeriodoModel();

        unset(Yii::app()->session['resultadoEnvioMail']);
        unset(Yii::app()->session['detalleResultadoEnvioMail']);

        $resumenes['detallePeriodoTipoBodega'] = $fResumenRevision->getResumenAltasxPeriodoMensualxTipoBodega(
                Yii::app()->session['inicioPeriodoSeleccionadoFZ'],
                Yii::app()->session['finPeriodoSeleccionadoFZ'],
                $_POST["tipoBodega"]
        );

        $response->Result = $resumenes;
        $response->Status = SUCCESS;
        $this->actionResponse(null, null, $response);
        return;
    }

    public function actionMostrarDetalleXBodega() {
        $response = new Response();
        $fResumenRevision = new FResumenPeriodoModel();
        Yii::app()->session['bodegaSeleccionada'] = $_POST["bodegaSeleccionada"];
        Yii::app()->session['numBodegaSeleccionada'] = $_POST["numBodegaSeleccionada"];

        $resumenes['detallePorBodega'] = $fResumenRevision->getResumenAltasxPeriodoMensualxBodega(
                Yii::app()->session['inicioPeriodoSeleccionadoFZ'],
                Yii::app()->session['finPeriodoSeleccionadoFZ'],
                $_POST["bodegaSeleccionada"]
        );
        $resumenes['activarEnviarMail'] = count($resumenes['detallePorBodega']) > 0 ? true : false;
        unset(Yii::app()->session['resultadoEnvioMail']);
        unset(Yii::app()->session['detalleResultadoEnvioMail']);
        $response->Result = $resumenes;
        $response->Status = SUCCESS;
        $this->actionResponse(null, null, $response);
        return;
    }

    public function actionEstadoEnviarMailAltasFueraZona() {
        $response = new Response();
        $response->Result = Yii::app()->session['resultadoEnvioMail'] . '***DETALLE***' . Yii::app()->session['detalleResultadoEnvioMail'];
        $response->Status = SUCCESS;
        $this->actionResponse(null, null, $response);
        return $response;
    }

    public function actionEnviarMailAltasFueraZona() {
        $estadoEnvioMensaje = '';
        try {
            $response = new Response();
            $ejecutivo = EjecutivoModel::model()->findAllByAttributes(array('e_id_bodega_delta' => array(Yii::app()->session['numBodegaSeleccionada'])));
            //            var_dump($ejecutivo);die();
            if (isset($ejecutivo[0])) {
                if ($ejecutivo[0]['e_estado'] == 1) { //enviar mail solo a ejecutivos activos (activo=1, inactivo=0)
                    //                if (true) {
                    //                    var_dump($this->GenerarExcelAdjunto($ejecutivo));die();
                    $fResumenPeriodo = new FResumenPeriodoModel();
                    $datos = $fResumenPeriodo->getResumenAltasxPeriodoMensualxBodegaMail(
                            Yii::app()->session['inicioPeriodoSeleccionadoFZ'],
                            Yii::app()->session['finPeriodoSeleccionadoFZ'],
                            Yii::app()->session['bodegaSeleccionada']
                    );

                    $model = new MailReporteAltaFueraZonaModel();
                    $model->fechaGeneracion = date("Y-m-d");
                    $model->ejecutivo = $ejecutivo[0]['e_nombre'];
                    $model->emailTo = PRUEBA_MAIL ? MAIL : $ejecutivo[0]['e_mail_notificar'];
                    $model->periodo = Yii::app()->session['anioPeriodoSeleccionadoFZ'] . '-' . Yii::app()->session['mesPeriodoSeleccionadoFZ'];
                    $model->cantidadAltas = count($datos['excelAdjunto']);
                    $model->cantidadCiudades = $datos['ciudades'][0]['CIUDADES'];
                    //                    var_dump($model);die();
                    $NombreArchivo = "reporte_altas_fuera_zona";
                    $NombreHoja = "reporte_altas_fuera_zona";

                    $autor = "Tececab"; //$_SESSION['CUENTA'];
                    $titulo = "reporte_altas_fuera_zona";
                    $tema = "reporte_altas_fuera_zona";
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

                    $excel->MapeoDefault($datos['excelAdjunto'], '', '', '');

                    $excel->CrearArchivo('Excel2007', $NombreArchivo);
                    $archivo = PATH_FOLDER_ADJUNTOS . $NombreArchivo . mktime() . '.xlsx';
                    $excel->GuardarArchivoFolderServer($archivo);

                    Yii::app()->crugemailer->enviarReporteAltasFueraZona($model->emailTo, $model, $archivo);
                    //                    var_dump($res);die();
                    if (Yii::app()->session['resultadoEnvioMail'] == 1)
                        $estadoEnvioMensaje = 'Correo enviado correctamente a ' . $model->emailTo;
                    else
                        $estadoEnvioMensaje = 'Correo no enviado';
                    //                    $estadoEnvioMensaje = Yii::app()->session['resultadoEnvioMail'];
                } else {
                    //ejecutivo con bodega seleccionada esta inactivo
                    $estadoEnvioMensaje = 'Ejecutivo de bodega seleccionada esta inactivo. No se enviara ningun correo';
                }
            } else {
                //ejecutivo con bodega seleccionada no existe en sisven tb_ejecutivo
                $estadoEnvioMensaje = 'Ejecutivo con bodega seleccionada no existe en sisven tb_ejecutivo';
            }
        } catch (Exception $e) {
            $response->Message = Yii::app()->params['mensajeExcepcion'];
            $response->Status = ERROR;
            $response->ClassMessage = CLASS_MENSAJE_ERROR;
        }

        $response->Result = $estadoEnvioMensaje;
        $response->Status = SUCCESS;

        //        var_dump($response);        die();
        $this->actionResponse(null, null, $response);
        return;
    }

    public function actionMostrarTiemposGestionXPeriodo() {
        $response = new Response();

        $model = new RptResumenDiarioHistorialForm();
        $cEjecutivos = new FEjecutivoModel();
        $ejecutivos = $cEjecutivos->getEjecutivosXGrupoXEstado($_POST['tipoUsuarioPeriodo'], 1);
        $libreria = new Libreria();

        //        var_dump($_POST);          die();
        if ($_POST['tipoFecha'] == 'P') {
            $numMes = substr($_POST['inicioPeriodo'], 5, 2);
            $diasMes = cal_days_in_month(CAL_GREGORIAN, intval($numMes), $_POST['anioPeriodo']);
            $datosGestionPeriodoEjecutivo = array();
            $datosReporte = array();
            for ($dia = 1; $dia <= $diasMes; $dia++) {
                $fecha = $_POST['anioPeriodo'] . '-' . $numMes . '-' . $dia;
                foreach ($ejecutivos as $ejecutivo) {
                    $det = $this->ObtenerTiemposGestionTraslado(
                            'Inicio visita',
                            $fecha,
                            $_POST['horaInicioPeriodo'],
                            $_POST['horaFinPeriodo'],
                            $ejecutivo['e_usr_mobilvendor']
                    );

                    foreach ($det as $key => $itemDet) {
                        $itemReporte = array(
                            'FECHA' => $dia . '-' . $_POST["mesPeriodo"],
                            'EJECUTIVO' => $ejecutivo['e_nombre'],
                            'ACCION' => $key,
                            'VALOR_ACCION' => $itemDet,
                        );
                        array_push($datosGestionPeriodoEjecutivo, $itemReporte);
                        unset($itemReporte);
                    };
                }
            }
        } elseif ($_POST['tipoFecha'] == 'RF') {

            $datetime1 = new DateTime($_POST['inicioPeriodo']);
            $datetime2 = new DateTime($_POST['finPeriodo']);
            $interval = $datetime1->diff($datetime2);

            $numMes = substr($_POST['inicioPeriodo'], 5, 2);

            $mesEjecutivo = array();
            $datosReporte = array();

            $inicioContador = substr($_POST['inicioPeriodo'], 8, 2);
            for ($dia = $inicioContador; $dia <= ($inicioContador + intval($interval->format('%R%a'))); $dia++) {
                $fecha = $_POST['anioPeriodo'] . '-' . $numMes . '-' . $dia;
                foreach ($ejecutivos as $ejecutivo) {
                    $det = $this->ObtenerTiemposGestionTraslado(
                            'Inicio visita',
                            $fecha,
                            $_POST['horaInicioPeriodo'],
                            $_POST['horaFinPeriodo'],
                            $ejecutivo['e_usr_mobilvendor']
                    );
                    foreach ($det as $key => $itemDet) {
                        $itemReporte = array(
                            'FECHA' => $dia . '-' . $_POST["mesPeriodo"],
                            'EJECUTIVO' => $ejecutivo['e_nombre'],
                            'ACCION' => $key,
                            'VALOR_ACCION' => $itemDet,
                        );
                        array_push($mesEjecutivo, $itemReporte);
                        unset($itemReporte);
                        //                    }
                    };
                }
            }
            //            die();
        }
        $response->Result = $datosGestionPeriodoEjecutivo;
        $response->Status = SUCCESS;
        $this->actionResponse(null, null, $response);
        return;
    }

    public function actionMostrarTiemposGestionXPeriodoXEjecutivo() {
        $response = new Response();

        $model = new RptResumenDiarioHistorialForm();
        $cEjecutivos = new FEjecutivoModel();
        $ejecutivos = $cEjecutivos->getEjecutivosXUsrMobilvendor($_POST['ejecutivoSeleccionadoPeriodo'], 1);
        $libreria = new Libreria();

        if ($_POST['tipoFecha'] == 'P') {
            $numMes = substr($_POST['inicioPeriodo'], 5, 2);
            $diasMes = cal_days_in_month(CAL_GREGORIAN, intval($numMes), $_POST['anioPeriodo']);
            $mesEjecutivo = array();
            $datosReporte = array();
            for ($dia = 1; $dia <= $diasMes; $dia++) {
                $fecha = $_POST['anioPeriodo'] . '-' . $numMes . '-' . $dia;
                foreach ($ejecutivos as $ejecutivo) {
                    $det = $this->ObtenerTiemposGestionTraslado(
                            'Inicio visita',
                            $fecha,
                            $_POST['horaInicioPeriodo'],
                            $_POST['horaFinPeriodo'],
                            $ejecutivo['e_usr_mobilvendor']
                    );
                    foreach ($det as $key => $itemDet) {
                        //                    if ($key != 'tiempoGestionEjecutivo' ||
                        //                            $key != 'tiempoTrasladoEjecutivo' || 
                        //                            $key != 'semanas') {
                        $itemReporte = array(
                            'FECHA' => $dia . '-' . $_POST["mesPeriodo"],
                            'EJECUTIVO' => $ejecutivo['e_nombre'],
                            'ACCION' => $key,
                            'VALOR_ACCION' => $itemDet,
                        );
                        array_push($mesEjecutivo, $itemReporte);
                        unset($itemReporte);
                        //                    }
                    };
                }
            }
        } elseif ($_POST['tipoFecha'] == 'RF') {

            $datetime1 = new DateTime($_POST['inicioPeriodo']);
            $datetime2 = new DateTime($_POST['finPeriodo']);
            $interval = $datetime1->diff($datetime2);

            $numMes = substr($_POST['inicioPeriodo'], 5, 2);

            $mesEjecutivo = array();
            $datosReporte = array();
            //            var_dump($_POST);die();
            $inicioContador = substr($_POST['inicioPeriodo'], 8, 2);
            for ($dia = $inicioContador; $dia <= ($inicioContador + intval($interval->format('%R%a'))); $dia++) {
                $fecha = $_POST['anioPeriodo'] . '-' . $numMes . '-' . $dia;
                foreach ($ejecutivos as $ejecutivo) {
                    $det = $this->ObtenerTiemposGestionTraslado(
                            'Inicio visita',
                            $fecha,
                            $_POST['horaInicioPeriodo'],
                            $_POST['horaFinPeriodo'],
                            $ejecutivo['e_usr_mobilvendor']
                    );
                    foreach ($det as $key => $itemDet) {
                        //                    if ($key != 'tiempoGestionEjecutivo' ||
                        //                            $key != 'tiempoTrasladoEjecutivo' || 
                        //                            $key != 'semanas') {
                        $itemReporte = array(
                            'FECHA' => $dia . '-' . $_POST["mesPeriodo"],
                            'EJECUTIVO' => $ejecutivo['e_nombre'],
                            'ACCION' => $key,
                            'VALOR_ACCION' => $itemDet,
                        );
                        array_push($mesEjecutivo, $itemReporte);
                        unset($itemReporte);
                        //                    }
                    };
                }
            }
            //            die();
        }

        $response->Result = $mesEjecutivo;
        $response->Status = SUCCESS;
        $this->actionResponse(null, null, $response);
        return;
    }

    public function actionCargarEjecutivos() {

        $response = new Response();

        $fEjecutivos = new FEjecutivoModel();
        $ejecutivos = $fEjecutivos->getEjecutivosXEstadoXTipos(1, "'EZM','EZMC','EZT','SUPMC','SUPM','SUPT','D','S','SC','ST'");
        $ejecutivosD = array();

        foreach ($ejecutivos as $ejecutivo) {
            //            var_dump($ejecutivo);            die();
            $dataEjecutivos = array(
                'ID' => $ejecutivo['e_cod'],
                'CODIGO' => $ejecutivo['e_usr_mobilvendor'],
                'NOMBRE' => $ejecutivo['e_nombre'],
                'TIPO' => $ejecutivo['e_tipo'],
            );
            array_push($ejecutivosD, $dataEjecutivos);
            unset($dataEjecutivos);
        }
        //        var_dump($ejecutivosD);die();
        $response->Result = $ejecutivosD;
        $response->Status = SUCCESS;
        $this->actionResponse(null, null, $response);
        return;
    }

}
