<?php

class ReporteInicioFinJornadaxFechaController extends Controller {

    public function actionIndex() {
        if (Yii::app()->request->isAjaxRequest) {
            return;
        } else {

            $model = new ReporteInicioFinJornadaxFechaForm();

            $this->render('/reportes/rptInicioFinJornadaxFecha', array('model' => $model));
        }
    }

    public function actionConsultarReporte() {
        $datosGrid = array();
        $response = new Response();
        try {
            $model = new ReporteInicioFinJornadaxFechaForm();
            if (isset($_POST['ReporteInicioFinJornadaxFechaForm'])) {
                $model->attributes = $_POST['ReporteInicioFinJornadaxFechaForm'];
                if ($model->validate()) {
                    $ejecutivos = EjecutivoModel::model()->findAllByAttributes(array('e_estado' => 1));
                    $reporteModel = new ReportesModel();

                    foreach ($ejecutivos as $ejecutivo) {
                        $inicioJornadaEjecutivo = $reporteModel->getInicioJornadaxFecha($ejecutivo->e_usr_mobilvendor, $model->fechaInicioFinJornadaInicio);
                        $finJornadaEjecutivo = $reporteModel->getFinJornadaxUsuarioxFecha($ejecutivo->e_usr_mobilvendor, $model->fechaInicioFinJornadaInicio);

//                        var_dump(count ($inicioJornadaEjecutivo));die();
                        if (count($inicioJornadaEjecutivo) > 0)
                            $entrada = new DateTime($inicioJornadaEjecutivo[0]["HORA"]);
                        else
                            $entrada = "00:00";

                        if (count($finJornadaEjecutivo) > 0)
                            $salida = new DateTime($finJornadaEjecutivo[0]["HORA"]);
                        else
                            $salida = "00:00";

                        if ((count($inicioJornadaEjecutivo) > 0) && (count($finJornadaEjecutivo) > 0)) {
                            $diferencia = $entrada->diff($salida);
                            $infoClientes = array(
                                'EJECUTIVO' => $ejecutivo->e_nombre,
                                'INICIOPRIMERAVISITA' => $entrada->format("H:i"),
                                'FINALULTIMAVISITA' => $salida->format("H:i"),
                                'TIEMPOGESTION' => $diferencia->format("%H:%i"),
                            );
                        } else {
                            $diferencia = "00:00";
                            $infoClientes = array(
                                'EJECUTIVO' => $ejecutivo->e_nombre,
                                'INICIOPRIMERAVISITA' => $entrada,
                                'FINALULTIMAVISITA' => $salida,
                                'TIEMPOGESTION' => $diferencia,
                            );
                            
                        }

//                        $infoClientes = array(
//                            'EJECUTIVO' => $ejecutivo->e_nombre,
//                            'INICIOPRIMERAVISITA' => $entrada->format("H:i"),
//                            'FINALULTIMAVISITA' => $salida->format("H:i"),
//                            'TIEMPOGESTION' => $diferencia->format("%H:%i"),
//                        );
                        array_push($datosGrid, $infoClientes);
                        unset($infoClientes);
                    }
                }
                $_SESSION['historialitem'] = $datosGrid;
                $response->Result = $datosGrid;
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
        return;
    }

    public function actionGenerateExcel($startDate) {
//        var_dump($startDate);die();
        $datosGrid = array();
        $response = new Response();
        try {
            $model = new ReporteInicioFinJornadaxFechaForm();
            $model->fechaInicioFinJornadaInicio = $startDate;
//        var_dump($formData->fechaOrdenesFin);die();
            $reporteModel = new ReportesModel();

            $ejecutivos = EjecutivoModel::model()->findAllByAttributes(array('e_estado' => 1));
            $reporteModel = new ReportesModel();
//var_dump($model);die();
            foreach ($ejecutivos as $ejecutivo) {
                $inicioJornadaEjecutivo = $reporteModel->getInicioJornadaxFecha($ejecutivo->e_usr_mobilvendor, $model->fechaInicioFinJornadaInicio);
                $finJornadaEjecutivo = $reporteModel->getFinJornadaxUsuarioxFecha($ejecutivo->e_usr_mobilvendor, $model->fechaInicioFinJornadaInicio);

                $entrada = new DateTime($inicioJornadaEjecutivo[0]["HORA"]);
                $salida = new DateTime($finJornadaEjecutivo[0]["HORA"]);

                $diferencia = $entrada->diff($salida);
                $infoClientes = array(
                    'EJECUTIVO' => $ejecutivo->e_nombre,
                    'INICIOPRIMERAVISITA' => $entrada->format("H:i"),
                    'FINALULTIMAVISITA' => $salida->format("H:i"),
                    'TIEMPOGESTION' => $diferencia->format("%H:%i"),
                );
                array_push($datosGrid, $infoClientes);
                unset($infoClientes);
            }
//            var_dump($datosGrid);die();
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

            $excel->Mapeo($datosGrid);

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
