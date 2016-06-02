<?php

/**
 * Description
 * @fecha 
 * @author 
 */
class CargaIndicadorController extends Controller {

    public function actionIndex() {
        if (Yii::app()->request->isAjaxRequest) {
            return;
        } else {
            unset($_SESSION['indicadorItems']);
            $model = new CargaIndicadorForm();
            $this->render('/indicador/cargaIndicador', array('model' => $model));
        }
    }

    public function actionSubirArchivo() {
        $response = new Response();
        try {
            $model = new CargaIndicadorForm();
            $indicadorItems = array();

            if (isset($_POST['CargaIndicadorForm'])) {
                $model->attributes = $_POST['CargaIndicadorForm'];
                if ($model->validate()) {
                    unset($_SESSION['indicadorItems']);

                    $filePath = Yii::app()->params['archivosIndicadores'];
                    $model->rutaArchivo = CUploadedFile::getInstance($model, 'rutaArchivo');
                    $model->rutaArchivo->saveAs($filePath);
                    $_SESSION['FileIndicador'] = $filePath;
                    $_SESSION['ModelForm'] = $model;

                    $operation = "r";
                    $delimiter = ';';
                    $file = new File($filePath, $operation, $delimiter);
                    $totalRows = $file->getTotalFilas();

                    if ($totalRows > 0) {
                        $totalBloques = ceil($totalRows / TAMANIO_BLOQUE);
                        $numeroBloque = 1;
                        $tamanioBloque = TAMANIO_BLOQUE;

                        while ($numeroBloque <= intval($totalBloques)) {
                            $file = new File($filePath, $operation, $delimiter);
                            $registroInicio = (($numeroBloque - 1) * $tamanioBloque) + 1;
                            $dataInsert = $this->getDatosMostrar($file, $registroInicio, $tamanioBloque);

                            if (count($dataInsert) > 0) {
                                $indicadorItems = array_merge($indicadorItems, $dataInsert);
                                unset($dataInsert);
                            }
                            $numeroBloque ++;
                        }
                        $_SESSION['indicadorItems'] = $indicadorItems;
//                        unlink($filePath);
                    } else {
                        $response->Message = 'El archivo no contiene registros';
                        $response->Status = NOTICE;
                    }
                } else {
                    //echo CActiveForm::validate($model);
                    //Yii::app()->end();
                }
            }
        } catch (Exception $e) {
            $response->Message = Yii::app()->params['mensajeExcepcion'];
            $response->Status = ERROR;
            $response->ClassMessage = CLASS_MENSAJE_ERROR;
        }

        $this->render('/indicador/cargaIndicador', array('model' => $model));
        return;
    }

    private function getDatosMostrar($file, $start, $blockSize) {
        $dataInsert = array();
        $dataFile = $file->getDatosIndicadores($start, $blockSize);

        foreach ($dataFile as $row) {
//            if ($row['ruc'] === '1717363251') {
//                var_dump($row['direccion'], trim($row['direccion']));                die();
//            }
            $data = array(
                'FECHA' => ($row['fecha'] == '') ? null : $row['fecha'],
                'SUCURSAL' => ($row['sucursal'] == '') ? null : $row['sucursal'],
                'NUM_BOD' => ($row['num_bod'] == '') ? null : $row['num_bod'],
                'BODEGA' => ($row['bodega'] == '') ? null : $row['bodega'],
                'NUM_SERIE' => ($row['num_serie'] == '') ? null : $row['num_serie'],
                'NUM_FACT' => ($row['num_fact'] == '') ? null : $row['num_fact'],
                'CODCLI' => ($row['codcli'] == '') ? null : $row['codcli'],
                'TIPOCLI' => ($row['tipocli'] == '') ? null : $row['tipocli'],
                'NOMCLI' => ($row['nomcli'] == '') ? null : utf8_encode($row['nomcli']),
                'RUC' => ($row['ruc'] == '') ? null : $row['ruc'],
                'DIRECCION' => ($row['direccion'] == '') ? null : utf8_encode(trim($row['direccion'])),
                'CIUDAD' => ($row['ciudad'] == '') ? null : utf8_encode($row['ciudad']),
                'TELEFONO' => ($row['telefono'] == '') ? null : $row['telefono'],
                'COD_PROD' => ($row['cod_prod'] == '') ? null : $row['cod_prod'],
                'DESCRIP' => ($row['descrip'] == '') ? null : utf8_encode($row['descrip']),
                'CODGRUP' => ($row['codgrup'] == '') ? null : $row['codgrup'],
                'GRUPO' => ($row['grupo'] == '') ? null : $row['grupo'],
                'CANTIDAD' => ($row['cantidad'] == '') ? null : $row['cantidad'],
                'DETALLE' => ($row['detalle'] == '') ? null : $row['detalle'],
                'IMEI' => ($row['imei'] == '') ? null : $row['imei'],
                'MIN' => ($row['min'] == '') ? null : $row['min'],
                'ICC' => ($row['icc'] == '') ? null : $row['icc'],
                'COSTO' => ($row['costo'] == '') ? null : $row['costo'],
                'PRECIO1' => ($row['precio1'] == '') ? null : $row['precio1'],
                'PRECIO2' => ($row['precio2'] == '') ? null : $row['precio2'],
                'PRECIO3' => ($row['precio3'] == '') ? null : $row['precio3'],
                'PRECIO4' => ($row['precio4'] == '') ? null : $row['precio4'],
                'PRECIO5' => ($row['precio5'] == '') ? null : $row['precio5'],
                'PRECIO' => ($row['precio'] == '') ? null : $row['precio'],
                'PORCENDES' => ($row['porcendes'] == '') ? null : $row['porcendes'],
                'DESCUENTO' => ($row['descuento'] == '') ? null : $row['descuento'],
                'SUBTOTAL' => ($row['subtotal'] == '') ? null : $row['subtotal'],
                'IVA' => ($row['iva'] == '') ? null : $row['iva'],
                'TOTAL' => ($row['total'] == '') ? null : $row['total'],
                'E_COD' => ($row['e_cod'] == '') ? null : $row['e_cod'],
                'VENDEDOR' => ($row['vendedor'] == '') ? null : utf8_encode($row['vendedor']),
                'MES' => ($row['mes'] == '') ? null : $row['mes'],
//                'SEMANA' => ($row['semana'] == '') ? null : $row['semana'],
            );
            array_push($dataInsert, $data);
            unset($data);
        }

        return $dataInsert;
    }

    public function actionGuardarIndicadores() {
        $response = new Response();
        $DclientesRepetidos = '';
        try {
            if (isset($_SESSION['FileIndicador'])) {
                $filePath = $_SESSION['FileIndicador'];

                $operation = "r";
                $delimiter = ';';
                $file = new File($filePath, $operation, $delimiter);
                $totalRows = $file->getTotalFilas();

                $totalClientesGuardados = 0;
                $totalClientesNoGuardados = 0;
                $totalClientesDuplicados = 0;

                $totalProductosGuardados = 0;
                $totalProductosNoGuardados = 0;
                $totalProductosDuplicados = 0;

                $totalVentasGuardadas = 0;
                $totalVentasNoGuardadas = 0;
                $totalVentasDuplicadas = 0;

                $totalFacturasGuardadas = 0;
                $totalFacturasNoGuardadas = 0;
                $totalFacturasDuplicadas = 0;

                if ($totalRows > 0) {
                    $totalBloques = ceil($totalRows / TAMANIO_BLOQUE);
                    $numeroBloque = 1;
                    $tamanioBloque = TAMANIO_BLOQUE;

                    //PASO 1 INICIO DE OBTENCION DE DATOS PARA GUARDAR CLIENTES Y PRODUCTOS
                    while ($numeroBloque <= intval($totalBloques)) {
                        $file = new File($filePath, $operation, $delimiter);
                        $registroInicio = (($numeroBloque - 1) * $tamanioBloque) + 1;

                        $dataInsertar = $this->getDatosGuardarParte1($file, $registroInicio, $tamanioBloque);
                        $datosClientes = $dataInsertar['clientes'];
                        $datosProductos = $dataInsertar['productos'];
                        $_SESSION['clientesRepetidos'] = $dataInsertar['clientesRepetidos'];

                        if (isset($_SESSION['clientesDuplicados'])) {
                            $totalClientesDuplicados = $totalClientesDuplicados + $_SESSION['clientesDuplicados'];
                        }
                        if (count($datosClientes) > 0) {
                            $dbConnection = new CI_DB_active_record(null);
                            $sql = $dbConnection->insert_batch('tb_cliente', $datosClientes);
                            $sql = str_replace('"', '', $sql);

                            $connection = Yii::app()->db_conn;
                            $connection->active = true;
                            $transaction = $connection->beginTransaction();
                            $command = $connection->createCommand($sql);
                            $countInsert = $command->execute();

                            if ($countInsert > 0) {
                                $transaction->commit();
                                $totalClientesGuardados = $totalClientesGuardados + $countInsert;
                            } else {
                                $transaction->rollback();
                                $totalClientesNoGuardados = $totalClientesNoGuardados + $countInsert;
                            }
                            unset($datosClientes);
                            $connection->active = false;
                        }

                        if (isset($_SESSION['productosDuplicados'])) {
                            $totalProductosDuplicados = $totalProductosDuplicados + $_SESSION['productosDuplicados'];
                        }

                        if (count($datosProductos) > 0) {
                            $dbConnection = new CI_DB_active_record(null);
                            $sql = $dbConnection->insert_batch('tb_producto', $datosProductos);
                            $sql = str_replace('"', '', $sql);

                            $connection = Yii::app()->db_conn;
                            $connection->active = true;
                            $transaction = $connection->beginTransaction();
                            $command = $connection->createCommand($sql);
                            $countInsert = $command->execute();

                            if ($countInsert > 0) {
                                $transaction->commit();
                                $totalProductosGuardados = $totalProductosGuardados + $countInsert;
                            } else {
                                $transaction->rollback();
                                $totalProductosNoGuardados = $totalProductosNoGuardados + $countInsert;
                            }
                            unset($datosProductos);
                            $connection->active = false;
                        }

                        $numeroBloque ++;
                    }

                    //PASO 2 INICIO DE OBTENCION DE DATOS PARA GUARDAR VENTAS Y FACTURAS
                    //SE DEBEN HABER GUARDADO CLIENTES Y PRODUCTOS PRIMERO

                    $totalBloques = ceil($totalRows / TAMANIO_BLOQUE);
                    $numeroBloque = 1;
                    $tamanioBloque = TAMANIO_BLOQUE;

                    while ($numeroBloque <= intval($totalBloques)) {
                        $file = new File($filePath, $operation, $delimiter);
                        $registroInicio = (($numeroBloque - 1) * $tamanioBloque) + 1;

                        $dataInsertar2 = $this->getDatosGuardarParte2($file, $registroInicio, $tamanioBloque);
                        $datosVentas = $dataInsertar2['ventas'];
                        $datosFacturas = $dataInsertar2['facturas'];

                        if (isset($_SESSION['ventasDuplicadas'])) {
                            $totalVentasDuplicadas = $totalVentasDuplicadas + $_SESSION['ventasDuplicadas'];
                        }
                        if (count($datosVentas) > 0) {
                            $dbConnection = new CI_DB_active_record(null);
                            $sql = $dbConnection->insert_batch('tb_venta', $datosVentas);
                            $sql = str_replace('"', '', $sql);

                            $connection = Yii::app()->db_conn;
                            $connection->active = true;
                            $transaction = $connection->beginTransaction();
                            $command = $connection->createCommand($sql);
                            $countInsert = $command->execute();

                            if ($countInsert > 0) {
                                $transaction->commit();
                                $totalVentasGuardadas = $totalVentasGuardadas + $countInsert;
                            } else {
                                $transaction->rollback();
                                $totalVentasNoGuardadas = $totalVentasNoGuardadas + $countInsert;
                            }
                            unset($datosVentas);
                            $connection->active = false;
                        }

                        if (isset($_SESSION['facturasDuplicadas'])) {
                            $totalFacturasDuplicadas = $totalFacturasDuplicadas + $_SESSION['facturasDuplicadas'];
                        }
                        if (count($datosFacturas) > 0) {
                            $dbConnection = new CI_DB_active_record(null);
                            $sql = $dbConnection->insert_batch('tb_factura', $datosFacturas);
                            $sql = str_replace('"', '', $sql);

                            $connection = Yii::app()->db_conn;
                            $connection->active = true;
                            $transaction = $connection->beginTransaction();
                            $command = $connection->createCommand($sql);
                            $countInsert = $command->execute();

                            if ($countInsert > 0) {
                                $transaction->commit();
                                $totalFacturasGuardadas = $totalFacturasGuardadas + $countInsert;
                            } else {
                                $transaction->rollback();
                                $totalFacturasNoGuardadas = $totalFacturasNoGuardadas + $countInsert;
                            }
                            unset($datosFacturas);
                            $connection->active = false;
                        }

                        $numeroBloque ++;
                    }

                    if (count($_SESSION['clientesRepetidos']) > 0) {
                        foreach ($_SESSION['clientesRepetidos'] as $item) {
                            $DclientesRepetidos = $DclientesRepetidos . '\n' . $item . '\n';
                        }

                        $response->Message = '****CLIENTES****' .
                                '<br> Registros guardados: ' . $totalClientesGuardados .
                                '<br> Registros no guardados: ' . $totalClientesNoGuardados .
                                '<br> Registros duplicados: ' . $totalClientesDuplicados .
                                '<br>' .
                                '<br>' .
                                $DclientesRepetidos .
                                '<br>' .
                                '<br>' .
                                '****PRODUCTOS****' .
                                '<br> Registros guardados: ' . $totalProductosGuardados .
                                '<br> Registros no guardados: ' . $totalProductosNoGuardados .
                                '<br> Registros duplicados: ' . $totalProductosDuplicados .
                                '<br>' .
                                '****VENTAS****' .
                                '<br> Registros guardados: ' . $totalVentasGuardadas .
                                '<br> Registros no guardados: ' . $totalVentasNoGuardadas .
                                '<br> Registros duplicados: ' . $totalVentasDuplicadas .
                                '<br>' .
                                '****FACTURAS****' .
                                '<br> Registros guardados: ' . $totalFacturasGuardadas .
                                '<br> Registros no guardados: ' . $totalFacturasNoGuardadas .
                                '<br> Registros duplicados: ' . $totalFacturasDuplicadas;
                    } else {
                        $response->Message = '****CLIENTES****' .
                                '<br> Registros guardados: ' . $totalClientesGuardados .
                                '<br> Registros no guardados: ' . $totalClientesNoGuardados .
                                '<br> Registros duplicados: ' . $totalClientesDuplicados .
                                '<br>' .
                                '****PRODUCTOS****' .
                                '<br> Registros guardados: ' . $totalProductosGuardados .
                                '<br> Registros no guardados: ' . $totalProductosNoGuardados .
                                '<br> Registros duplicados: ' . $totalProductosDuplicados .
                                '<br>' .
                                '****VENTAS****' .
                                '<br> Registros guardados: ' . $totalVentasGuardadas .
                                '<br> Registros no guardados: ' . $totalVentasNoGuardadas .
                                '<br> Registros duplicados: ' . $totalVentasDuplicadas .
                                '<br>' .
                                '****FACTURAS****' .
                                '<br> Registros guardados: ' . $totalFacturasGuardadas .
                                '<br> Registros no guardados: ' . $totalFacturasNoGuardadas .
                                '<br> Registros duplicados: ' . $totalFacturasDuplicadas;
                    }
                    unlink($filePath);
                } else {
                    $response->Message = 'El archivo no contiene registros';
                    $response->Status = NOTICE;
                }
            } else {
                $response->Message = 'Cargue el archivo nuevamente';
                $response->Status = NOTICE;
            }
        } catch (Exception $e) {
            $response->Message = 'Se ha producido un error';
            $response->Status = ERROR;
            $response->ClassMessage = CLASS_MENSAJE_ERROR;
        }

        $this->actionResponse(null, null, $response);
        return;
    }

    private function getDatosGuardarParte1($file, $start, $blockSize) {
        $datos = array();
        $datosClientes = array();
        $datosProductos = array();
        $clientesRepetidos = array();

//        $_SESSION['clientesRepetidos'] = 0;

        $_SESSION['clientesDuplicados'] = 0;
        $_SESSION['productosDuplicados'] = 0;

        $dataFile = $file->getDatosIndicadores($start, $blockSize);
        foreach ($dataFile as $row) {
            $existeBdd = ClienteModel::model()->findByAttributes(array('IDDELTA_CLI' => $row['codcli']));
//            if (!$existeBdd)
//                $existeBdd = ClienteModel::model()->findByAttributes(array('NOMBRE_CLI' => $row['nomcli']));

            $exisArray = false;
            foreach ($datosClientes as $item) {
                $exisArray = in_array($row['ruc'], $item);
                if ($exisArray)
                    break;
            }

            if (!$existeBdd && !$exisArray) {
                $data = array(
                    'ID_EST' => 1,
                    'ID_TCLI' => ($row['tipocli'] == '') ? null : $row['tipocli'],
                    'NOMBRE_CLI' => ($row['nomcli'] == '') ? null : utf8_encode($row['nomcli']),
                    'DOCUMENTO_CLI' => ($row['ruc'] == '') ? null : $row['ruc'],
                    'DIRECCION_CLI' => ($row['direccion'] == '') ? null : str_replace('"', '', utf8_encode(trim($row['direccion']))),
                    'TELEFONO_CLI' => ($row['telefono'] == '') ? 0 : str_replace(',', '.', $row['telefono']),
                    'EMAIL_CLI' => 'ingresar@correo.com',
                    'FECHAINGRESO_CLI' => date(FORMATO_FECHA_LONG),
                    'FECHAMODIFICACION_CLI' => date(FORMATO_FECHA_LONG),
                    'IDDELTA_CLI' => ($row['codcli'] == '') ? 0 : str_replace(',', '.', $row['codcli']),
                    'IDUSR_CLI' => Yii::app()->user->id
                );

                array_push($datosClientes, $data);
                unset($data);
            } else {
                $_SESSION['clientesDuplicados'] = $_SESSION['clientesDuplicados'] + 1;
            }
        }
        $datos['clientes'] = $datosClientes;
        $datos['clientesRepetidos'] = $clientesRepetidos;

        foreach ($dataFile as $row) {
            $existeBdd = ProductoModel::model()->findByAttributes(array('IMEI_PROD' => $row['imei']));
            $exisArray = false;
            foreach ($datosProductos as $item) {
                $exisArray = in_array($row['imei'], $item);
                if ($exisArray)
                    break;
            }
            if (!$existeBdd && !$exisArray) {
                $min = $row['min'];
                if (strlen($row['min']) == 9) {
                    $min = "099" . substr($row['min'], -8);
                }
                $data = array(
                    'ID_EST' => 1,
                    'ID_TPRO' => ($row['cod_prod'] == '') ? null : $row['cod_prod'],
                    'ID_BODEGA' => ($row['num_bod'] == '') ? null : $row['num_bod'],
                    'NOMBRE_PROD' => ($row['descrip'] == '') ? null : utf8_encode($row['descrip']),
                    'MIN_PROD' => ($min == '') ? null : $min,
                    'MIN_593_PROD' => ($min == '') ? null : "593" . substr($min, -9),
                    'ICC_PROD' => ($row['icc'] == '') ? null : $row['icc'],
                    'IMEI_PROD' => ($row['imei'] == '') ? null : $row['imei'],
                    'PRECIO_PROD' => ($row['precio1'] == '') ? 0 : str_replace(',', '.', $row['precio1']),
                    'COSTO_PROD' => ($row['costo'] == '') ? 0 : str_replace(',', '.', $row['costo']),
                    'PORCENTAJEDESCUENTO_PROD' => ($row['porcendes'] == '') ? 0 : str_replace(',', '.', $row['porcendes']),
                );

                array_push($datosProductos, $data);
                unset($data);
            } else {
                $_SESSION['productosDuplicados'] = $_SESSION['productosDuplicados'] + 1;
            }
        }
        $datos['productos'] = $datosProductos;

        return $datos;
    }

    private function getDatosGuardarParte2($file, $start, $blockSize) {
        $datos = array();

        $datosVentas = array();
        $datosFacturas = array();

        $_SESSION['ventasDuplicadas'] = 0;
        $_SESSION['facturasDuplicadas'] = 0;

        $dataFile = $file->getDatosIndicadores($start, $blockSize);

        foreach ($dataFile as $row) {
            $producto = ProductoModel::model()->findByAttributes(array('IMEI_PROD' => $row['imei']));
            $cliente = ClienteModel::model()->findByAttributes(array('IDDELTA_CLI' => $row['codcli']));
            $vendedor = VendedorModel::model()->findByAttributes(array('ID_VEND' => $row['e_cod']));

            if (isset($producto) && isset($cliente) && isset($vendedor)) {
                $exisArray = false;
                $existeBdd = VentaModel::model()->findByAttributes(array('ID_PRO' => $producto->ID_PRO));
                foreach ($datosVentas as $item) {
                    $exisArray = in_array($producto->ID_PRO, $item);
                    if ($exisArray)
                        break;
                }
//                var_dump(date('Y-m-d', strtotime($row['fecha'])),$row['fecha']);die();

                $date = str_replace('/', '-', $row['fecha']);
                $date1 = date('Y-m-d', strtotime($date));

                if (!$existeBdd && !$exisArray) {
                    $data = array(
                        'ID_VEND' => ($row['e_cod'] == '') ? null : $row['e_cod'],
                        'ID_CLI' => $cliente->ID_CLI,
                        'ID_PRO' => $producto->ID_PRO,
                        'FECHA_VENT' => ($row['fecha'] == '') ? null : $date1, //(date('Y-m-d', strtotime($row['fecha'])),
                        'MES_VENT' => ($row['mes'] == '') ? null : utf8_encode($row['mes']),
                        'SEMANA_VENT' => ($row['semana'] == '') ? 0 : $row['semana'],
                        'PRECIO_VENT' => ($row['precio'] == '') ? null : str_replace(',', '.', $row['precio']),
                        'CANTIDAD_VENT' => ($row['cantidad'] == '') ? 0 : $row['cantidad'],
                        'NUMFACTURA_VENT' => ($row['num_fact'] == '') ? null : $row['num_fact'],
                        'FECHAINGRESO_VENT' => date(FORMATO_FECHA_LONG),
                        'FECHAMODIFICACION_VENT' => date(FORMATO_FECHA_LONG),
                        'IDUSR_VENT' => Yii::app()->user->id
                    );

                    array_push($datosVentas, $data);
                    unset($data);
                } else {
                    $_SESSION['ventasDuplicadas'] = $_SESSION['ventasDuplicadas'] + 1;
                }
            } else {
                //agregar codigo para indicar las novedades de los clientes, productos, y vendedores no encontrados
            }
        }
        $datos['ventas'] = $datosVentas;

        foreach ($dataFile as $row) {
            $existeBdd = FacturaModel::model()->findByAttributes(array('NUMEROFACTURA_FACT' => $row['num_fact']));
            $exisArray = false;
            foreach ($datosFacturas as $item) {
                $exisArray = in_array($row['num_fact'], $item);
                if ($exisArray)
                    break;
            }

            if (!$existeBdd && !$exisArray) {
                $data = array(
                    'NUMEROFACTURA_FACT' => ($row['num_fact'] == '') ? null : $row['num_fact'],
                    'NUMSERIE_FACT' => ($row['num_serie'] == '') ? null : $row['num_serie'],
                    'FECHAEMISION_FACT' => ($row['fecha'] == '') ? null : $row['fecha'],
//                    'SUBTOTAL_FACT' => ($row['subtotal'] == '') ? null : $row['subtotal'],
//                    'IVA_FACT' => ($row['iva'] == '') ? null : utf8_encode($row['iva']),
//                    'TOTAL_FACT' => ($row['total'] == '') ? null : $row['total'],
//                    'DESCUENTO_FACT' => ($row['descuento'] == '') ? null : $row['descuento'],
                    'FECHAINGRESO_FACT' => date(FORMATO_FECHA_LONG),
                    'FECHAMODIFICACION_FACT' => date(FORMATO_FECHA_LONG),
                    'IDUSR_FACT' => Yii::app()->user->id
                );

                array_push($datosFacturas, $data);
                unset($data);
            } else {
                $_SESSION['facturasDuplicadas'] = $_SESSION['facturasDuplicadas'] + 1;
            }
        }
        $datos['facturas'] = $datosFacturas;
//        var_dump($datos);        die();
        return $datos;
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
//            var_dump($_SESSION['indicadorItems'], $response->Result); die();
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

    public function filters() {
// return the filter configuration for this controller, e.g.:
        return array('accessControl', array('CrugeAccessControlFilter'));
    }

    public function accessRules() {
        return array(
            array('allow', // allow authenticated users to access all actions
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

}
