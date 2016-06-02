<?php

class ReporteConsumoxFechaController extends Controller {

    public function actionIndex() {
        if (Yii::app()->request->isAjaxRequest) {
            return;
        } else {

            $model = new ReporteConsumoxFechaForm();

            $this->render('/consumo/rptConsumoxFecha', array('model' => $model));
        }
    }

    public function actionConsultarConsumoxFecha() {
        if (!Yii::app()->request->isAjaxRequest) {
            $error['message'] = Yii::app()->params['msjErrorAccesoPag'];
            $error['code'] = Yii::app()->params['codErrorAccesoPag'];
            $this->render(Yii::app()->params['pagError'], $error);
        }

        $response = new Response();
        try {
            $model = new ReporteConsumoxFechaForm();

            if (isset($_POST['ReporteConsumoxFechaForm'])) {

                $model->attributes = $_POST['ReporteConsumoxFechaForm'];

                if ($model->validate()) {
                    $reporteModel = new ReportesModel();
                    $data = $reporteModel->getConsumoxFecha($model);
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

        $response = new Response();
        try {
            $formData = new ReporteConsumoxFechaForm();
            $formData->fechaConsumoInicio = $startDate;
            $formData->fechaConsumoFin = $endDate;

            $reporteModel = new ReportesModel();

            $data = $reporteModel->getTotalPlan($formData);

            $registrosPago = array();
            foreach ($data as $value) {
                $datos = array(
                    'PLAN' => $value['nombre_plan'],
                    'TOTAL MIN' => $value['total_min'],
                    'TOTAL PAGO' => $value['total_pago'],
                );
                array_push($registrosPago, $datos);
            }

            $NombreArchivo = "Reporte";
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

//    public function filters() {
//        // return the filter configuration for this controller, e.g.:
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
}
