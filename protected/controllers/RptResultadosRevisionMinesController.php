<?php

class RptResultadosRevisionMinesController extends Controller {

    public $layout = LAYOUT_FILTRO_GRID;

    public function actionIndex() {
        if (Yii::app()->request->isAjaxRequest) {
            return;
        } else {
            unset(Yii::app()->session['resultadosxCarga']);
            unset(Yii::app()->session['minesSinGestionxCarga']);
            unset(Yii::app()->session['numeroCargaSeleccionada']);
            unset(Yii::app()->session['resultadosxPeriodo']);

            $model = new RptResultadosRevisionMinesForm();
            $this->render('/reportes/rptResultadosRevisionMines', array('model' => $model));
        }
    }

    public function actionCargasxMes() {
        $response = new Response();
        unset(Yii::app()->session['resultadosxCarga']);
        unset(Yii::app()->session['minesSinGestionxCarga']);
        unset(Yii::app()->session['numeroCargaSeleccionada']);
        unset(Yii::app()->session['resultadosxPeriodo']);

        $fRevisionMines = new FCargasInformacionModel();
        $cargas = $fRevisionMines->getDatosPeriodosCargas();
        $response->Result = $cargas;
        $this->actionResponse(null, null, $response);
        return;
    }

    public function actionMostrarCargas() {
        $response = new Response();
        unset(Yii::app()->session['resultadosxCarga']);
        unset(Yii::app()->session['minesSinGestionxCarga']);
        unset(Yii::app()->session['numeroCargaSeleccionada']);

        $fCargas = new FCargasInformacionModel();
        $fRevisionMines = new FRevisionMinesModel();
        Yii::app()->session['resultadosxPeriodo'] = $fRevisionMines->getResultadosxPeriodo($_POST['mesCarga']);
        $resultados['cargas'] = $fCargas->getDatosCargasxMes($_POST['mesCarga']);
        $response->Result = $resultados;
        $this->actionResponse(null, null, $response);
        return;
    }

    public function actionMostrarDetallesCarga() {
        $response = new Response();

        $fRevisionMines = new FRevisionMinesModel();

        Yii::app()->session['numeroCargaSeleccionada'] = $_POST["numeroCarga"];

        $resultados['resultados'] = $fRevisionMines->getResultadosxCarga($_POST["numeroCarga"]);
        Yii::app()->session['resultadosxCarga'] = $resultados['resultados'];

        $resultados['gestionxAgente'] = $this->DetalleAsignacionesCarga($_POST["numeroCarga"]);
        $resultados['tiemposxGestion'] = $this->DetalleTiemposGestionCarga($_POST["numeroCarga"]);

        $minesSinGEstion = array();
        $minesSinGEstion = $this->DetalleMinesSinGestion($_POST["numeroCarga"]);
        Yii::app()->session['minesSinGestionxCarga'] = $minesSinGEstion;
        $resultados['minessingestion'] = $minesSinGEstion;

        $response->Result = $resultados;
        $this->actionResponse(null, null, $response);
        return;
    }

    private function DetalleMinesSinGestion($numeroCarga) {
        $asignaciones = array();

        $fMinesValidacion = new FMinesRevisionModel();

        $asignaciones = $fMinesValidacion->getMinesSinGestionarxCarga($numeroCarga);

        return $asignaciones;
    }

    private function DetalleAsignacionesCarga($numeroCarga) {
        $asignaciones = array();

        $fMinesValidacion = new FMinesRevisionModel();
        foreach ($fMinesValidacion->getUsuariosxCarga($numeroCarga) as $usuarioCarga) {

            $asignados = intval($fMinesValidacion->getCantidadMinesAsignadosxUsuarioxCarga($usuarioCarga['codigo'], $numeroCarga));
            $reAsignados = intval($fMinesValidacion->getCantidadMinesReAsignadosxUsuarioxCarga($usuarioCarga['codigo'], $numeroCarga));
            $gestionados = intval($fMinesValidacion->getCantidadMinesGestionadosxUsuarioxCarga($usuarioCarga['codigo'], $numeroCarga)[0]['gestionados']);

            $dato = array(
                'AGENTE' => $usuarioCarga['nombreusuario'],
                'ASIGNACION' => $asignados,
                'REASIGNACION' => $reAsignados,
                'GESTIONYTD' => $gestionados,
                'PENDIENTES' => ($asignados + $reAsignados) - $gestionados,
            );
            array_push($asignaciones, $dato);
            unset($dato);
        }
        return $asignaciones;
    }

    private function DetalleTiemposGestionCarga($numeroCarga) {
        $detalleTiempos = array();

        $fCargaMines = new FCargasInformacionModel();
        $fRMinesRevision = new FMinesRevisionModel();
        $fechaUltimaRevisionxCarga = new FRevisionMinesModel();

        $fechaCarga = $fCargaMines->getFechaCargaxCarga($numeroCarga);
        $_fechaCarga = DateTime::createFromFormat('Y-m-d', $fechaCarga[0]['FECHA']);

        foreach ($fRMinesRevision->getUsuariosxCarga($numeroCarga) as $usuarioCarga) {

            $cantidadAsignados = intval($fRMinesRevision->getCantidadMinesAsignadosxUsuarioxCarga($usuarioCarga['codigo'], $numeroCarga));
            $reAsignados = intval($fRMinesRevision->getCantidadMinesReAsignadosxUsuarioxCarga($usuarioCarga['codigo'], $numeroCarga));
            $cantidadGestionados = $fRMinesRevision->getCantidadMinesGestionadosxUsuarioxCarga($usuarioCarga['codigo'], $numeroCarga);
            $porGestionar = ($cantidadAsignados + $reAsignados ) - intval($cantidadGestionados[0]['gestionados']);

            $fechaUltimaGestionxCarga = $fechaUltimaRevisionxCarga->getFechaUltimaGestionxUsuarioxCarga($usuarioCarga['codigo'], $numeroCarga);

            $tiempoGestion = '';
            if (isset($fechaUltimaGestionxCarga[0]['FECHA'])) {
                $_fechaUltimaGestion = DateTime::createFromFormat('Y-m-d', $fechaUltimaGestionxCarga[0]['FECHA']);
                $tiempoGestion = $_fechaCarga->diff($_fechaUltimaGestion)->format('%d dia(s)');
            } else
                $tiempoGestion = 'Sin gestion';

            $dato = array(
                'AGENTE' => $usuarioCarga['nombreusuario'],
                'FECHACARGA' => isset($fechaCarga[0]) ? $fechaCarga[0]['FECHA'] : 'Error',
                'FECHAFIN' => isset($fechaUltimaGestionxCarga[0]) ? $fechaUltimaGestionxCarga[0]['FECHA'] : 'Sin gestion',
                'TIEMPO' => $tiempoGestion,
                'ESTADO' => ($porGestionar == 0) ? 'FINALIZADO' : 'EN PROCESO',
            );
            array_push($detalleTiempos, $dato);
            unset($dato);
        }
//        die();
        return $detalleTiempos;
    }

    public function actionReasignarMines() {
        $reporteModel = new ReportesModel();

        $response = new Response();
        $minesReasignar = $_POST['minesReasignar'];
        $agenteReasignar = $_POST['agenteAsignar'];
//        var_dump($minesReasignar,$agenteReasignar);die();
        foreach ($minesReasignar as $min) {
//            var_dump(trim($min, "'"));die();
            $minExiste = MinesValidacionModel::model()->findByAttributes(array('miva_imei' => trim($min, "'")));
//            var_dump($minExiste);die();
            if (isset($minExiste)) {
                if ($minExiste['iduser'] != $agenteReasignar) {
                    $minExiste["miva_estado_reasignacion"] = 1;
                    $minExiste["miva_usario_reasignado"] = $minExiste["iduser"];
                    $minExiste["iduser"] = $agenteReasignar;
                    $minExiste["miva_fecha_modifica"] = date(FORMATO_FECHA_LONG);
                    $minExiste["miva_cod_usuario_ing_mod"] = Yii::app()->user->id;
                    if ($minExiste->save()) {
                        Yii::app()->session['minesReasignados'] += 1;
                    }
                } else
                    Yii::app()->session['minesOmitidos'] += 1;
            } else {
                $response->Message = 'No se pudo encontrar el min';
            }
        }

        $fRevisionMines = new FRevisionMinesModel();

//        Yii::app()->session['numeroCargaSeleccionada'] = $_POST["numeroCarga"];

        $resultados['gestionxAgente'] = $this->DetalleAsignacionesCarga(Yii::app()->session['numeroCargaSeleccionada']);

        $minesSinGEstion = $this->DetalleMinesSinGestion(Yii::app()->session['numeroCargaSeleccionada']);
        Yii::app()->session['minesSinGestionxCarga'] = $minesSinGEstion;
        $resultados['minessingestion'] = $minesSinGEstion;

        $response->Result = $resultados;
        $this->actionResponse(null, null, $response);
        return;
    }

    #REPORTES EXCEL

    public function actionGenerarExcelResultadosxPeriodo() {
        $response = new Response();
        try {
//            var_dump(Yii::app()->session['resultadosxCarga']);die();
            $reporteResultadosxCarga = array();
            $resultadosxPeriodo = Yii::app()->session['resultadosxPeriodo'];

            $NombreArchivo = "rpt_resultados_x_periodo";
            $NombreHoja = "rpt_resultados_x_periodo";

            $autor = "Tececab"; //$_SESSION['CUENTA'];
            $titulo = "rpt_resultados_x_periodo";
            $tema = "rpt_resultados_x_periodo";
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

            $excel->Mapeo($resultadosxPeriodo);

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

    public function actionGenerarExcelResultados() {
        $response = new Response();
        try {
//            var_dump(Yii::app()->session['resultadosxCarga']);die();
            $reporteResultadosxCarga = array();
            $resultadosxCarga = Yii::app()->session['resultadosxCarga'];

            $NombreArchivo = "reporte_resultados_x_carga";
            $NombreHoja = "reporte_resultados_x_carga";

            $autor = "Tececab"; //$_SESSION['CUENTA'];
            $titulo = "reporte_resultados_x_carga";
            $tema = "reporte_resultados_x_carga";
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

            $excel->Mapeo($resultadosxCarga);

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

    public function actionGenerarMinesSinGestion() {
        $response = new Response();
        try {
//            var_dump(Yii::app()->session['resultadosxCarga']);die();
            $rptMinesSinGestion = array();
            $resultadosxCarga = Yii::app()->session['minesSinGestionxCarga'];

            $NombreArchivo = "reporte_mines_sin_gestion";
            $NombreHoja = "reporte_mines_sin_gestion";

            $autor = "Tececab"; //$_SESSION['CUENTA'];
            $titulo = "reporte_mines_sin_gestion";
            $tema = "reporte_mines_sin_gestion";
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

            $excel->Mapeo($resultadosxCarga);

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

    public function actionGenerarExcelGestion() {
        $response = new Response();
        try {

            $fRevisionMines = new FRevisionMinesModel();
            $datosUsuariosxFecha = array();
            $datosUsuariosxHora = array();

            $fechasGestion = $fRevisionMines->getFechasGestionxCarga(Yii::app()->session['numeroCargaSeleccionada']);
            $horasGestion = $fRevisionMines->getHorasGestionxCarga(Yii::app()->session['numeroCargaSeleccionada']);
            $usuarios = $fRevisionMines->getUsuariosGestionxCarga(Yii::app()->session['numeroCargaSeleccionada']);

            foreach ($usuarios as $usuario) {
                $dataUsuarioFecha = $fRevisionMines->getCantidadGestionxUsuarioxCargaxAgrupadoFecha($usuario ['idusuario'], Yii::app()->session['numeroCargaSeleccionada']);
                $datosUsuariosxFecha[$usuario['idusuario']] = $dataUsuarioFecha;

                $dataUsuarioHora = $fRevisionMines->getCantidadGestionxUsuarioxCargaxAgrupadoHora($usuario ['idusuario'], Yii::app()->session['numeroCargaSeleccionada']);
                $datosUsuariosxHora[$usuario['idusuario']] = $dataUsuarioHora;
            }

            $NombreArchivo = "rpt_resumen_gestion_x_carga";
            $NombreHoja = "rpt_resumen_gestion_x_carga";

            $autor = "Tececab"; //$_SESSION['CUENTA'];
            $titulo = "rpt_resumen_gestion_x_carga";
            $tema = "rpt_resumen_gestion_x_carga";
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
            $encabezadoImprimir = 'RESUMEN GESTION POR CARGA #' . Yii::app()->session['numeroCargaSeleccionada'];
            $footerImprimir = Yii::app()->user->name . ' - ' . date('Y/m/d h:i A');

            $excel->SetNombreHojaActiva($NombreHoja);

            $excel->MapeoCustomizadoGestionValidacionMines($usuarios, $fechasGestion, $datosUsuariosxFecha, $horasGestion, $datosUsuariosxHora, $encabezadoImprimir, $footerImprimir);

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

    private function actionResponse($view = 'error', $model = null, $response = null) {
        if (Yii::app()->request->isAjaxRequest) {
            echo json_encode($response);
        } else {
            $this->render($view, $model);
        }
    }

}
