<?php

class ReporteVentasxVendedorController extends Controller {

    public function actionIndex() {
        if (Yii::app()->request->isAjaxRequest) {
            return;
        } else {

            $model = new ReporteVentasxVendedorForm();

            $this->render('/reportes/rptVentaxVendedor', array('model' => $model));
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
            $model = new ReporteVentasxVendedorForm();

            if (isset($_POST['ReporteVentasxVendedorForm'])) {

                $model->attributes = $_POST['ReporteVentasxVendedorForm'];

                if ($model->validate()) {
                    $reporteModel = new ReportesModel();
                    $data = $reporteModel->getVentasxVendedor($model);
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

    public function actionGenerateExcel($vendedor) {

        $response = new Response();
        try {
            $formData = new ReporteVentasxVendedorForm();
            $formData->vendedor = $vendedor;

            $reporteModel = new ReportesModel();
//            
            $data = $reporteModel->getVentasxVendedor($formData);
            $registrosPago = array();
            foreach ($data as $value) {
                $datos = array(
                    'MES' => $value['MES'],
                    'CHIPS VENDIDOS' => $value['CHIPS VENDIDOS'],
                    'VENDEDOR' => $value['VENDEDOR'],
                );
                array_push($registrosPago, $datos);
            }

            $NombreArchivo = "ReporteVentasxVendedor";
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
