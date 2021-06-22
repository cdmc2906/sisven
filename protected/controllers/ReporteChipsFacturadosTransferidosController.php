<?php

class ReporteChipsFacturadosTransferidosController extends Controller {

    public $layout = LAYOUT_IMPORTAR;

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
            if (true) {
                $transferencias = new FTransferenciasMovistarModel();
                $facturadosNoTansferidos = new FChipsFacturadosModel();
                $datosFacturadosNoTransferidos = $facturadosNoTansferidos->getChipsFacturadosNoTransferidos();
                $noFacturadosTansferidos = new FChipsTransferidosModel();
                $datosNoFacturadosTransferidos = $noFacturadosTansferidos->getChipsNoFacturadosTransferidos();

                // var_dump($datosFacturadosNoTransferidos);die();
                foreach ($datosFacturadosNoTransferidos as $item) {
                    $lote = $transferencias->getLotexICC($item['i_imei']);
                    if (count($lote) > 0) {
                        $lote_ = $lote[0]["tm_numero_lote"];
                    } else {
                        $lote_ = "SIN LOTE";
                    }
                    $infoFacturadosNoTransferidos = array(
                        'FECHA' => $item['i_fecha'],
                        'BODEGA' => $item['i_bodega'],
                        'COD_CLIENTE' => $item['I_CODIGO_GRUPO'],
                        'CLIENTE' => $item['I_NOMBRE_CLIENTE'],
                        'ICC' => $item['i_imei'],
                        'MIN' => $item['i_min'],
                        'LOTE' => $lote_// $item['tm_lote']
                    );
                    array_push($datosGridFNT, $infoFacturadosNoTransferidos);
                    unset($infoFacturadosNoTransferidos);
                }
                foreach ($datosNoFacturadosTransferidos as $item) {
                    // var_dump($item);die();
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
//                }
                Yii::app()->session['FNT'] = $datosGridFNT;
                Yii::app()->session['NFT'] = $datosGridNFT;

                $datosGrid['FNT'] = $datosGridFNT;
                $datosGrid['NFT'] = $datosGridNFT;

                $response->Result = $datosGrid;

                if (count($datosGridFNT) == 0 && count($datosGridNFT) == 0) {
                    $response->Message = 'Facturacion cuadrada con Transferencias Movistar';
                    $response->ClassMessage = CLASS_MENSAJE_SUCCESS;
//                    $response->Status = NOTICE;
                } else {
                    $response->Message = 'Chips de diferencias generado correctamente';
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

        $this->actionResponse(null, null, $response);
        return;
    }

    public function actionGenerateExcel($opcion) {
        $datosGrid = array();
        $datosGridFNT = array();
        $datosGridNFT = array();
        $response = new Response();
        $nombreArchivo = '';
        try {
            if ($opcion == 'FNT') {
                $nombreArchivo = 'facturados_no_transferidos';

                $datosFacturadosNoTransferidos = Yii::app()->session['FNT'];

                foreach ($datosFacturadosNoTransferidos as $item) {
                    $infoFacturadosNoTransferidos = array(
                        'FECHA' => $item['FECHA'],
                        'BODEGA' => $item['BODEGA'],
                        'COD_CLIENTE' => $item['COD_CLIENTE'],
                        'CLIENTE' => $item['CLIENTE'],
                        'ICC' => '\'' . $item['ICC'],
                        'MIN' => '\'' . $item['MIN'],
                        'LOTE' => '\'' . $item['LOTE']
                    );
                    array_push($datosGrid, $infoFacturadosNoTransferidos);
                    unset($infoFacturadosNoTransferidos);
                }
            } else if ($opcion == 'NFT') {
                $nombreArchivo = 'no_facturados_transferidos';
                $datosNoFacturadosTransferidos = Yii::app()->session['NFT'];

                foreach ($datosNoFacturadosTransferidos as $item) {
                    $infoNoFacturadosTransferidos = array(
                        'FECHA' => $item['FECHA'],
                        'EJECUTIVO' => $item['EJECUTIVO'],
                        'COD_CLIENTE' => $item['COD_CLIENTE'],
                        'CLIENTE' => $item['CLIENTE'],
                        'ICC' => '\'' . $item['ICC'],
                        'MIN' => '\'' . $item['MIN']
                    );
                    array_push($datosGrid, $infoNoFacturadosTransferidos);
                    unset($infoNoFacturadosTransferidos);
                }
            } else {
                //TO DO
            }
            $NombreArchivo = "reporte_" . $nombreArchivo;
            $NombreHoja = "reporte";
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
