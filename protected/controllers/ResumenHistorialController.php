<?php

/**
 * Description
 * @fecha 
 * @author 
 */
class ResumenHistorialController extends Controller {

    public function actionIndex() {
        if (Yii::app()->request->isAjaxRequest) {
            return;
        } else {
            $model = new RevisionHistorialForm();
            $this->render('/historialmb/resumenhistorial', array('model' => $model));
        }
    }

    public function actionResumenHistorial() {

        $datosGrid = array();
        $response = new Response();
        try {
            $model = new ResumenHistorialForm();
            if (isset($_POST['ResumenHistorialForm'])) {
                $model->attributes = $_POST['ResumenHistorialForm'];
                if ($model->validate()) {
//                  Esta consulta sirve para traer solo el campo id_Vend en el resultado de la consulta
//                  $vendedores = VendedorModel::model()->findAll(array('select' => 'ID_VEND'));
//                    $porcentaje = RangoComisionModel::model()->find($criteria);
//                    $vendedores = VendedorModel::model()->findAll(array('order' => 'NOMBRE_VEND'));
                    $ejecutivo = EjecutivoModel::model()->findAllByAttributes(
                            array('e_usr_mobilvendor' => $model->ejecutivo));

                    $fila = 1;
                    $fHistorial = new FHistorialModel();
                    $fOrden = new FOrdenModel();
                    $frutamodel = new FRutaModel();

                    $historial = $fHistorial->getHistorialxVendedorxFechaxHoraInicioxHoraFin($model->fechagestion, $ejecutivo[0]['e_usr_mobilvendor']);

                    $dia = date("w", strtotime($model->fechagestion));

                    foreach ($historial as $itemHistorial) {
                        $estadoRevision = '';
                        $ruta = $frutamodel->getRutaxCliente($itemHistorial['CODIGOCLIENTE'], $ejecutivo[0]['e_iniciales']);
                        if (count($ruta) == 0) {
                            $rutaCliente = "SIN RUTA";
                            $secuenciaRutaCliente = "SIN SECUENCIA";
                        } else {
                            $rutaCliente = $ruta[0]['RUTA'];
                            $secuenciaRutaCliente = $ruta[0]['SECUENCIA'];
                        }

                        if ($itemHistorial['RUTAVISITA'] == $rutaCliente) {
                            $estadoRevision = 'Ruta ok';
                        } else {
                            $estadoRevision = 'Otra ruta';
                        }
                        
                        if ($fila== $secuenciaRutaCliente) {
                            $estadoRevisionS = 'Secuencia OK';
                        } else {
                            $estadoRevisionS = 'Otra secuencia';
                        }
                        
                        $date = new DateTime($itemHistorial['FECHAVISITA']);
                        $fechaHistorial = $date->format('Y-m-d H:i:s');

                        $cantidadChips = $fOrden->getChipsxClientexFecha($itemHistorial['CODIGOCLIENTE'], $fechaHistorial);
                        $chips = $cantidadChips[0]['CHIPS'];

                        foreach ($datosGrid as $item) {
//                            var_dump($item['CHIPSCOMPRADOS'], intval($item['CHIPSCOMPRADOS']), intval($item['CHIPSCOMPRADOS']) > 0);                            die();
                            if (in_array($itemHistorial['CODIGOCLIENTE'], $item) && intval($item['CHIPSCOMPRADOS']) > 0) {
//                                var_dump($chips);die();
                                $chips = "0";
//                                break;
                            }
                        }
                        $revisionRuta = array(
                            'FECHAREVISION' => date(FORMATO_FECHA),
                            'FECHARUTA' => $itemHistorial['FECHAVISITA'],
                            'EJECUTIVO' => $ejecutivo[0]->e_nombre,
                            'CODIGOCLIENTE' => $itemHistorial['CODIGOCLIENTE'],
                            'RUTAUSADA' => $itemHistorial['RUTAVISITA'],
                            'SECUENCIAVISITA' => $fila,
                            'RUTACLIENTE' => $rutaCliente,
                            'SECUENCIARUTA' => $secuenciaRutaCliente,
                            'ESTADOREVISIONR' => $estadoRevision,
                            'ESTADOREVISIONS' => $estadoRevisionS,
                            'CHIPSCOMPRADOS' => $chips,
                        );
                        $fila = $fila + 1;
                        array_push($datosGrid, $revisionRuta);
                        unset($revisionRuta);
                    }
                }
                $_SESSION['historialitem'] = $datosGrid;
                $response->Message = "Historial revisado exitosamente";
                $response->Status = SUCCESS;
                $response->Result = $datosGrid;
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
            $response->Result = $_SESSION['indicadorItems'];
            unset($_SESSION['indicadorItems']);
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
            $datos = $_SESSION['historialitem'];
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
                    'ESTADOREVISIONR' => $value['ESTADOREVISIONR'],
                    'ESTADOREVISIONS' => $value['ESTADOREVISIONS'],
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
