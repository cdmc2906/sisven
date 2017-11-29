<?php

/**
 * Description
 * @fecha 
 * @author 
 */
class RevisionRutaController extends Controller {

    public function actionIndex() {
        if (Yii::app()->request->isAjaxRequest) {
            return;
        } else {
            $model = new RevisionRutaForm();
            $this->render('/reportes/rptRevisionRuta', array('model' => $model));
        }
    }

    public function actionRevisarRuta() {

        $datosGrid = array();
        $response = new Response();
        try {
            $model = new RevisionRutaForm();
            if (isset($_POST['RevisionRutaForm'])) {
                $model->attributes = $_POST['RevisionRutaForm'];
                if ($model->validate()) {
//                  Esta consulta sirve para traer solo el campo id_Vend en el resultado de la consulta
//                  $vendedores = VendedorModel::model()->findAll(array('select' => 'ID_VEND'));
//                    $porcentaje = RangoComisionModel::model()->find($criteria);
//                    $vendedores = VendedorModel::model()->findAll(array('order' => 'NOMBRE_VEND'));
                    $ejecutivo = EjecutivoModel::model()->findAllByAttributes(
                            array('e_usr_mobilvendor' => $model->ejecutivo));

                    $frutamodel = new FRutaModel();
                    $dia = date("w", strtotime($model->fechagestion));
                    $rutaEjecutivo = $frutamodel->getRutaxEjecutivoxDia($ejecutivo[0]->e_iniciales, $dia);

                    $fila = 1;
                    $fHistorial = new FHistorialModel();
                    $fOrden = new FOrdenModel();
                    foreach ($rutaEjecutivo as $itemRuta) {
                        $estadoRevision = '';
                        $historial = $fHistorial->getHistorialVisitaxEjecutivoxClientexFecha(
                                'Inicio Visita'
                                ,$model->ejecutivo
                                , $itemRuta['CODIGOCLIENTE']
                                , $model->fechagestion);
                        if (count($historial) > 0) {
                            $fechaVisita = $historial[0]['FECHAVISITA'];
                            $rutaVisita = $historial[0]['RUTAVISITA'];
                            if ($historial[0]['RUTAVISITA'] == $itemRuta['RUTA']) {
                                $estadoRevision = 'Visitado';
                            } else {
                                $estadoRevision = 'Otra ruta';
                            }

                            $chips = $fOrden->getChipsxClientexFecha($itemRuta['CODIGOCLIENTE'], $model->fechagestion);
                            $cantidadChips = $chips[0]['CHIPS'];
                            $fila = $fila + 1;
                        } else {
                            $fechaVisita = 'No visitado';
                            $rutaVisita = 'No visitado';
                            $estadoRevision = 'No visitado';
                            $cantidadChips = '0.00';
                        }

                        $revisionRuta = array(
                            'FECHAREVISION' => date(FORMATO_FECHA),
                            'FECHARUTA' => $fechaVisita,
                            'EJECUTIVO' => $ejecutivo[0]->e_nombre,
                            'CODIGOCLIENTE' => $itemRuta['CODIGOCLIENTE'],
                            'RUTACLIENTE' => $itemRuta['RUTA'],
                            'SECUENCIARUTA' => $itemRuta['SECUENCIA'],
                            'RUTAUSADA' => (($rutaVisita != 'null') ? $rutaVisita : 'SIN RUTA'),
                            'SECUENCIAVISITA' => (($fechaVisita == 'No visitado') ? "NA" : $fila),
                            'ESTADOREVISION' => $estadoRevision,
                            'CHIPSCOMPRADOS' => $cantidadChips,
                        );
                        array_push($datosGrid, $revisionRuta);
                        unset($revisionRuta);
                    }

                    $_SESSION['rutaitem'] = $datosGrid;
                    Yii::app()->session['rutaitem'] = $datosGrid;
//                    var_dump(2);                            die();
                    $response->Message = "Ruta revisada exitosamente";
                    $response->Status = SUCCESS;
                    $response->Result = $datosGrid;
                }
            }
        } catch (Exception $e) {
            $response->Message = Yii::app()->params['mensajeExcepcion'];
            $response->Status = ERROR;
            $response->ClassMessage = CLASS_MENSAJE_ERROR;
        }
        $this->actionResponse(null, null, $response);
        return;
    }

    public function actionVerDatosArchivo() {
        if (!Yii::app()->request->isAjaxRequest) {
            $error['message'] = Yii::app()->params['msjErrorAccesoPag'];
            $error['code'] = Yii::app()->params['codErrorAccesoPag'];
            $this->render(Yii::app()->params['pagError'], $error);
        }

        $response = new Response();
        try {
//            $response->Result = $_SESSION['indicadorItems'];
            $response->Result = Yii::app()->session['indicadorItems'];
//            unset($_SESSION['indicadorItems']);
            unset(Yii::app()->session['indicadorItems']);
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

//    public function filters() {
//// return the filter configuration for this controller, e.g.:
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

    public function actionGenerateExcel() {
        $response = new Response();
        try {
            $revisionRuta = array();
            $datos = Yii::app()->session['rutaitem'];
            foreach ($datos as $value) {
                $dat = array(
                    'FECHAREVISION' => $value['FECHAREVISION'],
                    'FECHARUTA' => $value['FECHARUTA'],
                    'EJECUTIVO' => $value['EJECUTIVO'],
                    'CODIGOCLIENTE' => $value['CODIGOCLIENTE'],
                    'RUTAUSADA' => $value['RUTAUSADA'],
                    'SECUENCIAVISITA' => $value['SECUENCIAVISITA'],
                    'RUTACLIENTE' => $value['RUTACLIENTE'],
                    'SECUENCIARUTA' => $value['SECUENCIARUTA'],
                    'ESTADOREVISION' => $value['ESTADOREVISION'],
                    'CHIPSCOMPRADOS' => $value['CHIPSCOMPRADOS'],
                );
                array_push($revisionRuta, $dat);
            }

            $NombreArchivo = "reporte_revision_ruta";
            $NombreHoja = "reporte_revision_ruta";

            $autor = "Tececab"; //$_SESSION['CUENTA'];
            $titulo = "reporte_revision_ruta";
            $tema = "reporte_revision_ruta";
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

}
