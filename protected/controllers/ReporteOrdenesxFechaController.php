<?php

class ReporteOrdenesxFechaController extends Controller {

    public $layout = LAYOUT_FILTRO_GRID;

    public function actionIndex() {
        if (Yii::app()->request->isAjaxRequest) {
            return;
        } else {

            $model = new ReporteOrdenesxFechaForm();

            $this->render('/reportes/rptOrdenesxFecha', array('model' => $model));
        }
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
                        case 1: $grupoEjecutivos = GRUPO_EJECUTIVOS_ZONA_MOVI;
                            break;
                        case 2: $grupoEjecutivos = GRUPO_SUPERVISORES_MOVI;
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

    private function actionResponse($view = 'error', $model = null, $response = null) {
        if (Yii::app()->request->isAjaxRequest) {
            echo json_encode($response);
        } else {
            $this->render($view, $model);
        }
    }

    public function actionCargarGridDetalle() {
        $reporteModel = new ReportesModel();

        $response = new Response();
        $data = $reporteModel->getOrdenesxEjecutivoxFecha($_POST['ejecutivo'], $_POST['fechaInicio'], $_POST['fechaFin']);
        $response->Result = $data;
        $this->actionResponse(null, null, $response);
        return;
    }

    public function actionActualizarPedido() {

        $response = new Response();
        $ordenModel = new FOrdenModel();

        $cantidad = $_POST['TOTALORDENES'];
        $nuevaIvaBase = $cantidad;
        $nuevaIvaValor = $cantidad * Yii::app()->params['ivadoce'];
        $nuevoSubtotal = $cantidad;
        $nuevoImpuestos = $cantidad * Yii::app()->params['ivadoce'];
        $nuevoTotal = $cantidad * Yii::app()->params['ivaincdoce'];
        $usuarioMod = Yii::app()->user->id;
        $fechaMod = date(FORMATO_FECHA_LONG);

        $respuestaActualizacion = $ordenModel->getActualizarOrden(
                $_POST['CODIGOORDEN']
                , $_POST['ORDEN']
                , $nuevaIvaBase
                , $nuevaIvaValor
                , $nuevoSubtotal
                , $nuevoImpuestos
                , $nuevoTotal
                , $usuarioMod
                , $fechaMod);
        if ($respuestaActualizacion > 0) {
            $response->Message = 'Actualización correcta';
            $response->Status = NOTICE;
        } else {
            $response->Message = 'Actualizacion fallida';
            $response->Status = ERROR;
        }

//        var_dump($respuestaActualizacion);        die();
        return;
    }

    public function actionEliminarPedido() {

        $response = new Response();
        $ordenModel = new FOrdenModel();

        $respuestaActualizacion = $ordenModel->getEliminarOrden($_POST['CODIGOORDEN'], $_POST['ORDEN']);

        if ($respuestaActualizacion > 0) {
            $response->Message = 'Eliminacion correcta';
            $response->Status = NOTICE;
        } else {
            $response->Message = 'Eliminacionfallida';
            $response->Status = ERROR;
        }

//        var_dump($respuestaActualizacion);        die();
        return;
    }

}
