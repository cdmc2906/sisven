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
            $model = new RptResultadosRevisionMinesForm();
            $this->render('/reportes/rptResultadosRevisionMines', array('model' => $model));
        }
    }

    public function actionMostrarCargas() {
        $response = new Response();
        unset(Yii::app()->session['resultadosxCarga']);
        unset(Yii::app()->session['minesSinGestionxCarga']);
        unset(Yii::app()->session['numeroCargaSeleccionada']);

        $fRevisionMines = new FCargasInformacionModel();
        $cargas = $fRevisionMines->getDatosCargas();
        $response->Result = $cargas;
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
        Yii::app()->session['minesSinGestionxCarga'] = $this->DetalleMinesSinGestion($_POST["numeroCarga"]);

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

    private function actionResponse($view = 'error', $model = null, $response = null) {
        if (Yii::app()->request->isAjaxRequest) {
            echo json_encode($response);
        } else {
            $this->render($view, $model);
        }
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
            $datosUsuarios = array();

            $fechasGestion = $fRevisionMines->getFechasGestionxCarga(Yii::app()->session['numeroCargaSeleccionada']);
            $usuarios = $fRevisionMines->getUsuariosGestionxCarga(Yii::app()->session['numeroCargaSeleccionada']);

            foreach ($usuarios as $usuario) {
                $dataUsuario = $fRevisionMines->getCantidadGestionxUsuarioxCargaxAgrupadoFecha($usuario ['idusuario'], Yii::app()->session['numeroCargaSeleccionada']);
                $datosUsuarios[$usuario['idusuario']] = $dataUsuario;
            }
            $dat = array();

            foreach ($datosUsuarios as $clave => $datosUsuario) {
                if ($clave == 13)
                    $dat = $datosUsuario;
            }
            var_dump($dat);
            die();


            $NombreArchivo = "reporte_ordenes_x_fecha";
            $NombreHoja = "reporte_ordenes_x_fecha";

            $autor = "Tececab"; //$_SESSION['CUENTA'];
            $titulo = "reporte_ordenes_x_fecha";
            $tema = "reporte_ordenes_x_fecha";
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

            $excel->Mapeo($reporteOrdenesxFecha);

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

    public function actionGenerarResumenResultados() {
//        var_dump($startDate." ".$endDate);die();
        $response = new Response();
        try {
            $formData = new ReporteOrdenesxFechaForm();
            $formData->fechaOrdenesInicio = $startDate;
            $formData->fechaOrdenesFin = $endDate;
//        var_dump($formData->fechaOrdenesFin);die();
            $reporteModel = new ReportesModel();

            $data = $reporteModel->getTotalesOrdenesxFecha($formData);

            $reporteOrdenesxFecha = array();
            foreach ($data as $value) {
                $datos = array(
                    'EJECUTIVO' => $value['EJECUTIVO'],
//                    'CLIENTE' => $value['CLIENTE'],
                    'CHIPS' => $value['TOTALORDENES'],
                    'PERIODO' => $value['PERIODO'],
                );
                array_push($reporteOrdenesxFecha, $datos);
            }
//            var_dump($reporteOrdenesxFecha);die();
            $NombreArchivo = "reporte_ordenes_x_fecha";
            $NombreHoja = "reporte_ordenes_x_fecha";

            $autor = "Tececab"; //$_SESSION['CUENTA'];
            $titulo = "reporte_ordenes_x_fecha";
            $tema = "reporte_ordenes_x_fecha";
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

            $excel->Mapeo($reporteOrdenesxFecha);

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

    public function actionGenerateExcel($startDate, $endDate) {
//        var_dump($startDate." ".$endDate);die();
        $response = new Response();
        try {
            $formData = new ReporteOrdenesxFechaForm();
            $formData->fechaOrdenesInicio = $startDate;
            $formData->fechaOrdenesFin = $endDate;
//        var_dump($formData->fechaOrdenesFin);die();
            $reporteModel = new ReportesModel();

            $data = $reporteModel->getTotalesOrdenesxFecha($formData);

            $reporteOrdenesxFecha = array();
            foreach ($data as $value) {
                $datos = array(
                    'EJECUTIVO' => $value['EJECUTIVO'],
//                    'CLIENTE' => $value['CLIENTE'],
                    'CHIPS' => $value['TOTALORDENES'],
                    'PERIODO' => $value['PERIODO'],
                );
                array_push($reporteOrdenesxFecha, $datos);
            }
//            var_dump($reporteOrdenesxFecha);die();
            $NombreArchivo = "reporte_ordenes_x_fecha";
            $NombreHoja = "reporte_ordenes_x_fecha";

            $autor = "Tececab"; //$_SESSION['CUENTA'];
            $titulo = "reporte_ordenes_x_fecha";
            $tema = "reporte_ordenes_x_fecha";
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

            $excel->Mapeo($reporteOrdenesxFecha);

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

    public function actionConsultarReporte() {
        if (!Yii::app()->request->isAjaxRequest) {
            $error['message'] = Yii::app()->params['msjErrorAccesoPag'];
            $error['code'] = Yii::app()->params['codErrorAccesoPag'];
            $this->render(Yii::app()->params['pagError'], $error);
        }

        $response = new Response();
        try {
            $model = new ReporteOrdenesxFechaForm();

            if (isset($_POST['ReporteOrdenesxFechaForm'])) {

                $model->attributes = $_POST['ReporteOrdenesxFechaForm'];
                if ($model->validate()) {
                    $reporteModel = new ReportesModel();

//                    var_dump($model['tipoReporte']);die();
                    $grupoEjecutivos = '';
                    switch ($model['tipoReporte']) {
                        case 1: $grupoEjecutivos = GRUPO_EJECUTIVOS_ZONA;
                            break;
                        case 2: $grupoEjecutivos = GRUPO_SUPERVISORES;
                            break;
                        case 3: $grupoEjecutivos = GRUPO_SERVICIO_CLIENTE;
                            break;
                        default:$grupoEjecutivos = GRUPO_TODOS;
                            break;
                    }
//                    var_dump($grupoEjecutivos);die();
                    $data = $reporteModel->getTotalOrdenesxFecha($model, $grupoEjecutivos);
                    $response->Result = $data;
                } else {
                    echo CActiveForm::validate($model);
                    Yii::app()->end();
                }
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
        return;
    }

    public function actionCargarGridDetalle() {
        $reporteModel = new ReportesModel();

        $response = new Response();
//        var_dump($_POST['ejecutivo'], $_POST['fechaInicio'], $_POST['fechaFin']);        die();
        $data = $reporteModel->getOrdenesxEjecutivoxFecha($_POST['ejecutivo'], $_POST['fechaInicio'], $_POST['fechaFin']);
//        var_dump($data);die();
        $response->Result = $data;
//var_dump($response);die();
        $this->actionResponse(null, null, $response);
        return;
    }

}
