<?php

/**
 * Description
 * @fecha 
 * @author 
 */
class CalculoComisionController extends Controller {

    public function actionIndex() {
        if (Yii::app()->request->isAjaxRequest) {
            return;
        } else {
//            unset($_SESSION['indicadorItems']);
            $model = new CalculoComisionForm();
            $this->render('/comision/calculoComision', array('model' => $model));
        }
    }

    public function actionCalcularComisiones() {

        $datosGrid = array();
        $response = new Response();
        try {
            $model = new CalculoComisionForm();
            if (isset($_POST['CalculoComisionForm'])) {
                $model->attributes = $_POST['CalculoComisionForm'];
                if ($model->validate()) {
//                  Esta consulta sirve para traer solo el campo id_Vend en el resultado de la consulta
//                  $vendedores = VendedorModel::model()->findAll(array('select' => 'ID_VEND'));
//                    $porcentaje = RangoComisionModel::model()->find($criteria);
//                    $vendedores = VendedorModel::model()->findAll(array('order' => 'NOMBRE_VEND'));
                    $vendedores = VendedorModel::model()->findAllByAttributes(array('ID_TVE' => $model->tipoVendedor, 'ID_EST' => 1));
                    $comisionModel = new ComisionModel();
                    if ($model->tipoVendedor == 1) { //comprueba id tipo vendedor (1=ejecutivo) 
                        foreach ($vendedores as $vendedor) {
                            $totalValorVentas = 0;
                            $cantidadVenta = 0;
                            $consumoMinMes = 0;
                            $totalValorConsumoMinMes = 0;
                            $cantidadConsumo = 0;
                            $totalCantidadConsumo = 0;
//                            var_dump($model);die();
                            $ventasMes = $comisionModel->getMinesVentaxMesxVendedor($model, $vendedor->ID_VEND, $model->tipoVendedor);

                            //VERIFICO QUE EL VENDEDOR TENGA VENTAS PARA ESA FECHA
                            if (isset($ventasMes[0]['ID_PRO'])) {
                                for ($i = 0; $i <= count($ventasMes) - 1; $i++) {
                                    $totalesventasMes = $comisionModel->getTotalesVentaxMesxVendedor($model, $vendedor->ID_VEND, $model->tipoVendedor);
                                    $totalValorVentas = $totalesventasMes[0]['VALOR_VENTA'];
                                    $cantidadVenta = $totalesventasMes[0]['CANTIDAD_VENDIDO'];

                                    $consumoMinMes = $comisionModel->getConsumoxMin($ventasMes[$i]['ID_PRO'], $model);
                                    if (isset($consumoMinMes[0]['SUM(VALORPAGO_CONS)'])) {
                                        $totalValorConsumoMinMes = $totalValorConsumoMinMes + $consumoMinMes[0]['SUM(VALORPAGO_CONS)'];
                                        $cantidadConsumo = $cantidadConsumo + 1; //$consumoMinMes[0]['CANTIDAD_CONSUMO'];
                                    }
                                }//fin for sobre ventasmes

                                $totalCantidadConsumo = $totalCantidadConsumo + $cantidadConsumo;

                                $porcentajeComision = 0;
                                $porcentajeAlcanzado = ($totalCantidadConsumo <= 0) ? 0 : ($totalCantidadConsumo / $cantidadVenta) * 100;
                                if ($porcentajeAlcanzado > 0) {
                                    $porcentaje = $comisionModel->getComisionSegunRango($porcentajeAlcanzado);
                                    if (isset($porcentaje[0]['PORCENTAJE_RCOM'])) {
                                        $porcentajeComision = $porcentaje[0]['PORCENTAJE_RCOM'];
                                    }
                                }
                                $comision = ($porcentajeComision <= 0) ? 0 : ($totalValorConsumoMinMes * $porcentajeComision);
                                $datosVentasConsumoxVendedor = array(
                                    'ID_VENDEDOR' => $vendedor->ID_VEND,
                                    'NOMBRE_VENDEDOR' => $vendedor->NOMBRE_VEND,
                                    'TOTAL_VENTA' => number_format($totalValorVentas, 2, '.', ''),
                                    'CHIPS_VENDIDOS' => $cantidadVenta,
                                    'TOTAL_CONSUMOS' => number_format($totalValorConsumoMinMes, 2, '.', ''),
                                    'CHIPS_CON_CONSUMO' => $cantidadConsumo,
                                    'PORCENTAJE' => number_format($porcentajeAlcanzado, 2, '.', '') . "%",
                                    'COMISION' => number_format($comision, 2, '.', ''),
                                );
//                                var_dump($datosVentasConsumoxVendedor);die();
                                array_push($datosGrid, $datosVentasConsumoxVendedor);
                                unset($datosVentasConsumoxVendedor);
                            }
                        }
                        $_SESSION['comisionesGeneradas'] = $datosGrid;

                        $response->Message = "Comisiones para vendedores generadas correctamente";
                        $response->Status = SUCCESS;
                        $response->Result = $datosGrid;
                    } else if ($model->tipoVendedor == 2) {//comprueba id tipo vendedor (2=mayorista) 
                        foreach ($vendedores as $vendedor) {
                            $minesVendidos = 0;
                            $totalConsumoMines = 0;
                            $totalValorVentas = 0;
                            $totalValorConsumoMinMes = 0;

                            $totalValorVentas = 0;
                            $cantidadVenta = 0;
                            $consumoMinMes = 0;
                            $cantidadConsumo = 0;
                            $totalCantidadConsumo = 0;

                            $ventasMes = $comisionModel->getMinesVentaxMesxVendedor($model, $vendedor->ID_VEND, $model->tipoVendedor);
//                            var_dump($ventasMes);                            die();
                            //VERIFICO QUE EL MAYORISTA TENGA VENTAS PARA ESA FECHA
                            if (isset($ventasMes[0]['ID_PRO'])) {
                                for ($i = 0; $i <= count($ventasMes) - 1; $i++) {
                                    $totalesventasMes = $comisionModel->getTotalesVentaxMesxVendedor($model, $vendedor->ID_VEND, $model->tipoVendedor);
                                    $totalValorVentas = $totalesventasMes[0]['VALOR_VENTA'];
                                    $cantidadVenta = $totalesventasMes[0]['CANTIDAD_VENDIDO'];

                                    $consumoMinMes = $comisionModel->getConsumoxMin($ventasMes[$i]['ID_PRO'], $model);
                                    if (isset($consumoMinMes[0]['SUM(VALORPAGO_CONS)'])) {
                                        $totalValorConsumoMinMes = $totalValorConsumoMinMes + $consumoMinMes[0]['SUM(VALORPAGO_CONS)'];
                                        $cantidadConsumo = $cantidadConsumo + 1; //$consumoMinMes[0]['CANTIDAD_CONSUMO'];
                                    }
                                }//fin for sobre ventasmes

                                $totalCantidadConsumo = $totalCantidadConsumo + $cantidadConsumo;

                                $porcentajeComision = 0;
                                $porcentajeAlcanzado = ($totalCantidadConsumo <= 0) ? 0 : ($totalCantidadConsumo / $cantidadVenta) * 100;
                                if ($porcentajeAlcanzado > 0) {
                                    $porcentaje = $comisionModel->getComisionSegunRango($porcentajeAlcanzado);
                                    if (isset($porcentaje[0]['PORCENTAJE_RCOM'])) {
                                        $porcentajeComision = $porcentaje[0]['PORCENTAJE_RCOM'];
                                    }
                                }
                                $porcentajeComision = 0.1;

                                $comision = ($porcentajeComision <= 0) ? 0 : ($totalValorConsumoMinMes * $porcentajeComision);
                                $datosVentasConsumoxVendedor = array(
                                    'ID_VENDEDOR' => $vendedor->ID_VEND,
                                    'NOMBRE_VENDEDOR' => $vendedor->NOMBRE_VEND,
                                    'TOTAL_VENTA' => number_format($totalValorVentas, 2, '.', ''),
                                    'CHIPS_VENDIDOS' => $cantidadVenta,
                                    'TOTAL_CONSUMOS' => number_format($totalValorConsumoMinMes, 2, '.', ''),
                                    'CHIPS_CON_CONSUMO' => $cantidadConsumo,
                                    'PORCENTAJE' => number_format($porcentajeAlcanzado, 2, '.', '') . "%",
                                    'COMISION' => number_format($comision, 2, '.', ''),
                                );
                                array_push($datosGrid, $datosVentasConsumoxVendedor);
                                unset($datosVentasConsumoxVendedor);
                            }
                        }
                        $_SESSION['comisionesGeneradas'] = $datosGrid;


                        $response->Message = "Comisiones para mayoristas generadas correctamente";
                        $response->Status = SUCCESS;
                        $response->Result = $datosGrid;
                    }
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
            $comisionesCalculadas = array();
            $datos = $_SESSION['comisionesGeneradas'];
            foreach ($datos as $value) {
                $dat = array(
                    'ID_VENDEDOR' => $value['ID_VENDEDOR'],
                    'VENDEDOR' => $value['NOMBRE_VENDEDOR'],
                    'CHIPS VENDIDOS' => $value['CHIPS_VENDIDOS'],
                    'CHIPS CON CONSUMO' => $value['CHIPS_CON_CONSUMO'],
                    'CONSUMO MES' => $value['TOTAL_CONSUMOS'],
                    'PORCENTAJE' => $value['PORCENTAJE'],
                    'COMISION' => $value['COMISION'],
                );
                array_push($comisionesCalculadas, $dat);
            }

            $NombreArchivo = "ReporteCalculoComisiones";
            $NombreHoja = "reporte";

            $autor = "Christian"; //$_SESSION['CUENTA'];
            $titulo = "ReporteCalculoComisiones";
            $tema = "ReporteCalculoComisiones";
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

            $excel->Mapeo($comisionesCalculadas);

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
