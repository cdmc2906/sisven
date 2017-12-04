<?php

/**
 * Description
 * @fecha 
 * @author 
 */
class RptResumenHistorialPorFechaController extends Controller {

    public function actionIndex() {
        if (Yii::app()->request->isAjaxRequest) {
            return;
        } else {
            $model = new RptResumenHistorialPorFechaForm();
            $this->render('/reportes/rptResumenHistorialPorFecha', array('model' => $model));
        }
    }

    public function actionGenerarReporte() {
        $response = new Response();
        try {
            $model = new RptResumenHistorialPorFechaForm();
            if (isset($_POST['RptResumenHistorialPorFechaForm'])) {
                $model->attributes = $_POST['RptResumenHistorialPorFechaForm'];
//                var_dump($model->validate());die();
                if ($model->validate()) {

                    $datosRevisiones = array();
                    $fechasRevisadas = array();
                    $parametrosAlmacenados = array();
                    $reporte = array();
                    $fila = array();
                    $valoresHistorial = '';

                    $fResumenHistorial = new FResumenDiarioHistorialModel();
                    $datosRevisiones = $fResumenHistorial->getDatosRevisionesEjecutivo(
                            $model->fechaInicioGestion
                            , $model->fechaFinGestion
                            , $model->ejecutivo);

                    foreach ($datosRevisiones as $item) {
                        if ($item['tipo'] == 1)
                            array_push($fechasRevisadas, $item["indicador"]);
                        else if ($item['tipo'] == 2)
                            array_push($parametrosAlmacenados, $item["indicador"]);
                    }
                    Yii::app()->session['fechasRevisadas'] = $fechasRevisadas;
                    Yii::app()->session['parametrosAlmacenados'] = $parametrosAlmacenados;
                    Yii::app()->session['ejecutivo'] = $model->ejecutivo;
                    Yii::app()->session['fechaInicio'] = $model->fechaInicioGestion;
                    Yii::app()->session['fechaFin'] = $model->fechaFinGestion;
                     $response->Message = "Reporte generado correctamente";
                    $response->ClassMessage = CLASS_MENSAJE_SUCCESS;
                }
                else {
                    $response->Message = "Debe seleccionar todos los filtros";
                    $response->ClassMessage = CLASS_MENSAJE_NOTICE;
//                $response->Result = $datos; // $datosGrid;
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

    private function actionResponse($view = 'error', $model = null, $response = null) {
        if (Yii::app()->request->isAjaxRequest) {
            echo json_encode($response);
        } else {
            $this->render($view, $model);
        }
    }

    public function actionGenerateExcel() {
        $response = new Response();
        try {
            $fechasRevisadas = Yii::app()->session['fechasRevisadas'];
            $parametrosAlmacenados = Yii::app()->session['parametrosAlmacenados'];
            $ejecutivo = Yii::app()->session['ejecutivo'];
            $fechaInicioGestion = Yii::app()->session['fechaInicio'];
            $fechaFinGestion = Yii::app()->session['fechaFin'];

            $NombreArchivo = "resumen_Historial_Ejecutivo";
            $NombreHoja = "resumen_Historial_Ejecutivo";

            $autor = "Tececab"; //$_SESSION['CUENTA'];
            $titulo = "resumenHistorialEjecutivo";
            $tema = "Reporte Tececab";
            $keywords = "office 2007";

            $excel = new excel();
            $encabezadoImprimir = 'RESUMEN SEMANAL DEL' . $fechaInicioGestion . ' AL  ' . $fechaFinGestion . ' - ' . $ejecutivo;
            $footerImprimir = Yii::app()->user->name . ' - ' . date('Y/m/d h:i A');
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
            $excel->MapeoCustomizado($fechasRevisadas, $parametrosAlmacenados, $ejecutivo, $encabezadoImprimir, $footerImprimir);
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
