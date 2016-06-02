<?php

class ReporteVentasConsumosxMesController extends Controller {

    public function actionIndex() {
        if (Yii::app()->request->isAjaxRequest) {
            return;
        } else {

            $model = new ReporteVentasConsumosxMesForm();

            $this->render('/reportes/rptVentasConsumosxMes', array('model' => $model));
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
            $model = new ReporteVentasConsumosxMesForm();

            if (isset($_POST['ReporteVentasConsumosxMesForm'])) {

                $model->attributes = $_POST['ReporteVentasConsumosxMesForm'];

                if ($model->validate()) {
                    $reporteModel = new ReportesModel();
                    $data = $reporteModel->getVentasConsumosxMes($model);
//                    var_dump($data);die();
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

    public function actionGenerateExcel($mes) {

        $response = new Response();
        try {
            $formData = new ReporteVentasConsumosxMesForm();
            $formData->mes = $mes;
            $reporteModel = new ReportesModel();

            $data = $reporteModel->getVentasConsumosxMes($formData);

            $registrosPago = array();
            foreach ($data as $value) {
                $datos = array(
                    'VENDEDOR' => $value['VENDEDOR'],
                    'VENTAS' => $value['VENTAS'],
                    'CONSUMO' => $value['CONSUMO'],
                );
                array_push($registrosPago, $datos);
            }

            $NombreArchivo = "ReporteVentasConsumosxMes";
            $NombreHoja = "reporte";

            $autor = "Christian"; //$_SESSION['CUENTA'];
            $titulo = "Reporte";
            $tema = "Reporte";
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

            $excel->Mapeo($registrosPago);

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
