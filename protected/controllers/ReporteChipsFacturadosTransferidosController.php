<?php

class ReporteChipsFacturadosTransferidosController extends Controller {

    public function actionIndex() {
        if (Yii::app()->request->isAjaxRequest) {
            return;
        } else {

            $model = new ReporteChipsFacturadosTransferidosForm();

            $this->render('/reportes/rptChipsFacturadosTransferidos', array('model' => $model));
        }
    }

    public function actionConsultarDatos() {
        $datosGrid = array();
        $datosGridFNT = array();
        $datosGridNFT = array();
        $response = new Response();
        try {
            $model = new ReporteChipsFacturadosTransferidosForm();
            if (isset($_POST['ReporteChipsFacturadosTransferidosForm'])) {
                $model->attributes = $_POST['ReporteChipsFacturadosTransferidosForm'];
//                var_dump($model->validate());die();
                if ($model->validate()) {
                    $facturadosNoTansferidos = new FChipsFacturadosModel();
                    $datosFacturadosNoTransferidos = $facturadosNoTansferidos->getChipsFacturadosNoTransferidos();

                    $noFacturadosTansferidos = new FChipsTransferidosModel();
                    $datosNoFacturadosTransferidos = $noFacturadosTansferidos->getChipsNoFacturadosTransferidos();

                    foreach ($datosFacturadosNoTransferidos as $item) {
                        $infoFacturadosNoTransferidos = array(
                            'FECHA' => $item['i_fecha'],
                            'BODEGA' => $item['i_bodega'],
                            'COD_CLIENTE' => $item['I_CODIGO_GRUPO'],
                            'CLIENTE' => $item['I_NOMBRE_CLIENTE'],
                            'ICC' => $item['i_imei'],
                            'MIN' => $item['i_min']
                        );
                        array_push($datosGridFNT, $infoFacturadosNoTransferidos);
                        unset($infoFacturadosNoTransferidos);
                    }
                    foreach ($datosNoFacturadosTransferidos as $item) {
                        $infoNoFacturadosTransferidos = array(
                            'FECHA' => $item['VM_FECHA'],
                            'EJECUTIVO' => $item['VM_NOMBREDISTRIBUIDOR'],
                            'COD_CLIENTE' => $item['VM_IDDESTINO'],
                            'CLIENTE' => $item['VM_NOMBREDESTINO'],
                            'ICC' => $item['vm_icc'],
                            'MIN' => $item['vm_min']
                        );
                        array_push($datosGridNFT, $infoNoFacturadosTransferidos);
                        unset($infoNoFacturadosTransferidos);
                    }
                }
                $_SESSION['FNT'] = $datosGridFNT;
                $_SESSION['NFT'] = $datosGridNFT;

                $datosGrid['FNT'] = $datosGridFNT;
                $datosGrid['NFT'] = $datosGridNFT;
                $response->Result = $datosGrid;
//                var_dump(count($datosGridFNT),count($datosGridNFT));die();

                if (count($datosGridFNT) == 0 && count($datosGridNFT) == 0) {
                    $response->Message = 'Facturacion cuadrada con Transferencias Movistar';
                    $response->ClassMessage = CLASS_MENSAJE_SUCCESS;

//                    $response->Status = NOTICE;
                } else {
                    $response->Message = 'Generacion de diferencias generado correctamente';
                    $response->ClassMessage = CLASS_MENSAJE_NOTICE;
//                    $response->Status = NOTICE;
                }
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

//        var_dump($response);die();
        $this->actionResponse(null, null, $response);
        return;
    }

    public function actionGenerateExcel($opcion) {
//        var_dump($opcion);die();
        $datosGrid = array();
        $datosGridFNT = array();
        $datosGridNFT = array();
        $response = new Response();
        $nombreArchivo = '';
        try {
//            var_dump($opcion);die();
            if ($opcion == 'FNT') {
                $nombreArchivo = 'facturados_no_transferidos';
//                print_r($_SESSION, TRUE);
//                $now = new DateTime();
//                var_dump($now->format('Y-m-d H:i:s'));die();    // MySQL datetime format
//                echo $now->getTimestamp();
                $facturadosNoTansferidos = new FChipsFacturadosModel();
//                var_dump('2ss');die();
                $datosFacturadosNoTransferidos = $facturadosNoTansferidos->getChipsFacturadosNoTransferidos();
//                var_dump($datosFacturadosNoTransferidos);die();
                foreach ($datosFacturadosNoTransferidos as $item) {
                    $infoFacturadosNoTransferidos = array(
                        'FECHA' => $item['i_fecha'],
                        'BODEGA' => $item['i_bodega'],
                        'COD_CLIENTE' => $item['I_CODIGO_GRUPO'],
                        'CLIENTE' => $item['I_NOMBRE_CLIENTE'],
                        'ICC' => '\'' . $item['i_imei'],
                        'MIN' => '\'' . $item['i_min']
                    );
                    array_push($datosGrid, $infoFacturadosNoTransferidos);
                    unset($infoFacturadosNoTransferidos);
                }
            } else if ($opcion == 'NFT') {
                $nombreArchivo = 'no_facturados_transferidos';
                $noFacturadosTansferidos = new FChipsTransferidosModel();
                $datosNoFacturadosTransferidos = $noFacturadosTansferidos->getChipsNoFacturadosTransferidos();

                foreach ($datosNoFacturadosTransferidos as $item) {
                    $infoNoFacturadosTransferidos = array(
                        'FECHA' => $item['VM_FECHA'],
                        'EJECUTIVO' => $item['VM_NOMBREDISTRIBUIDOR'],
                        'COD_CLIENTE' => $item['VM_IDDESTINO'],
                        'CLIENTE' => $item['VM_NOMBREDESTINO'],
                        'ICC' => '\'' . $item['vm_icc'],
                        'MIN' => '\'' . $item['vm_min']
                    );
                    array_push($datosGrid, $infoNoFacturadosTransferidos);
                    unset($infoNoFacturadosTransferidos);
                }
            } else {
                //TO DO
            }
//            var_dump($datosGrid);            die();
//            $NombreArchivo = "reporte_" . $nombreArchivo . "_" . getdate();
            $NombreArchivo = "reporte_" . $nombreArchivo;
//            $NombreHoja = "reporte_" . $nombreArchivo;
            $NombreHoja = "reporte";
//            var_dump($NombreHoja);die();
            $autor = "Tececab";
            $titulo = "reporte_" . $nombreArchivo;
            $tema = "reporte_" . $nombreArchivo;
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
//var_dump('ssss');die();
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
