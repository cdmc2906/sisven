<?php

/**
 * Description
 * @fecha 
 * @author 
 */
class CargaCompraController extends Controller {

    public function actionIndex() {
        if (Yii::app()->request->isAjaxRequest) {
            return;
        } else {

            $cs = Yii::app()->getClientScript();
            $cs->registerPackage('jquery');

            unset($_SESSION['compraItems']);

            $model = new CargaCompraForm();

            $this->render('/compra/cargaCompra', array('model' => $model));
        }
    }

    public function actionSubirArchivo() {
        $response = new Response();

        try {
            $model = new CargaCompraForm();
            $compraItems = array();

            if (isset($_POST['CargaCompraForm'])) {
                $model->attributes = $_POST['CargaCompraForm'];
                if ($model->validate()) {
                    unset($_SESSION['compraItems']);

                    $filePath = Yii::app()->params['archivosCompra'];
                    $model->rutaArchivo = CUploadedFile::getInstance($model, 'rutaArchivo');
                    $model->rutaArchivo->saveAs($filePath);
                    $_SESSION['FileCompra'] = $filePath;
                    $_SESSION['FechaCompra'] = $model->fechaCompra;
                    $_SESSION['modelForm'] = $model;

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
                            $dataInsert = $this->getDatosMostrar($file, $registroInicio, $tamanioBloque, $model->fechaCompra);

                            if (count($dataInsert) > 0) {
                                $compraItems = array_merge($compraItems, $dataInsert);
                                unset($dataInsert);
                            }
                            $numeroBloque ++;
                        }
                        $_SESSION['compraItems'] = $compraItems;
//                         unlink($filePath);
                    } else {
                        $response->Message = 'El archivo no contiene registros';
                        $response->Status = NOTICE;
                    }
                } else {
//                    echo CActiveForm::validate($model);
//                    Yii::app()->end();
                }
            }
        } catch (Exception $e) {
            $response->Message = Yii::app()->params['mensajeExcepcion'];
            $response->Status = ERROR;
            $response->ClassMessage = CLASS_MENSAJE_ERROR;
        }

        $this->render('/compra/cargaCompra', array('model' => $model));
        return;
    }

    private function getDatosMostrar($file, $start, $blockSize, $fechaCompra) {
        $dataInsert = array();
        $dataFile = $file->getDatosCompra($start, $blockSize);

        foreach ($dataFile as $row) {
            $data = array(
                'NOMBRE_PROD' => ($row['nombre'] == '') ? null : $row['nombre'],
                'MIN_PROD' => ($row['min'] == '') ? null : $row['min'],
                'ICC_PROD' => ($row['icc'] == '') ? null : $row['icc'],
                'IMEI_PROD' => ($row['imei'] == '') ? null : $row['imei'],
                'NUMSERIE_PROD' => ($row['numero_serie'] == '') ? null : $row['numero_serie'],
                'PRECIO_PROD' => ($row['precio'] == '') ? 0 : str_replace(',', '.', $row['precio']),
                'COSTO_PROD' => ($row['costo'] == '') ? 0 : str_replace(',', '.', $row['costo']),
//                'FECHA_COMPRA' => $fechaCompra,
                'PORCENTAJEDESCUENTO_PROD' => ($row['porcentaje_descuento'] == '') ? 0 : $row['porcentaje_descuento'],
            );
            array_push($dataInsert, $data);
            unset($data);
        }
//        var_dump($dataInsert);die();
        return $dataInsert;
    }

    public function actionGuardarCompra() {
        $response = new Response();

        try {
            if (isset($_SESSION['FileCompra']) && isset($_SESSION['FechaCompra']) && isset($_SESSION['modelForm'])) {
                $filePath = $_SESSION['FileCompra'];

                $model = new CargaCompraForm();
                $model = $_SESSION['modelForm'];

                $operation = "r";
                $delimiter = ';';
                $file = new File($filePath, $operation, $delimiter);
                $totalRows = $file->getTotalFilas();

                $totalGuardados = 0;
                $totalNoGuardados = 0;
                $totalDuplicados = 0;

                if ($totalRows > 0) {

                    $totalBloques = ceil($totalRows / TAMANIO_BLOQUE);
                    $numeroBloque = 1;
                    $tamanioBloque = TAMANIO_BLOQUE;

                    while ($numeroBloque <= intval($totalBloques)) {
                        $file = new File($filePath, $operation, $delimiter);
                        $registroInicio = (($numeroBloque - 1) * $tamanioBloque) + 1;

                        $dataInsert = $this->getDatosGuardar($model, $file, $registroInicio, $tamanioBloque);
                        if (isset($_SESSION['duplicados'])) {
                            $totalDuplicados = $totalDuplicados + $_SESSION['duplicados'];
                        }

                        if (count($dataInsert) > 0) {
                            $dbConnection = new CI_DB_active_record(null);
                            $sql = $dbConnection->insert_batch('tb_producto', $dataInsert);
                            $sql = str_replace('"', '', $sql);
//                            var_dump($sql); die();

                            $connection = Yii::app()->db_conn;
                            $connection->active = true;
                            $transaction = $connection->beginTransaction();
                            $command = $connection->createCommand($sql);
                            $countInsert = $command->execute();

                            if ($countInsert > 0) {
                                $transaction->commit();
                                $totalGuardados = $totalGuardados + $countInsert;
                            } else {
                                $transaction->rollback();
                                $totalNoGuardados = $totalNoGuardados + $countInsert;
                            }
                            unset($dataInsert);
                            $connection->active = false;
                        }

                        $numeroBloque ++;
                    }
                    $mensaje = 'Registros guardados: ' . $totalGuardados .
                            '<br> Registros no guardados: ' . $totalNoGuardados .
                            '<br> Registros duplicados: ' . $totalDuplicados;

                    if ($totalNoGuardados > 0 || $totalDuplicados > 0) {
                        $response->Message = $mensaje;
                        $response->Status = NOTICE;
                        $response->ClassMessage = CLASS_MENSAJE_NOTICE;
                    } else {
                        $response->Message = $mensaje;
                        $response->Status = NOTICE;
                        $response->ClassMessage = CLASS_MENSAJE_NOTICE;
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

//        var_dump($response); die();
        $this->actionResponse(null, null, $response);
        return;
    }

    private function getDatosGuardar($model, $file, $start, $blockSize) {
        $dataInsert = array();
        $_SESSION['duplicados'] = 0;

        $dataFile = $file->getDatosCompra($start, $blockSize);

        foreach ($dataFile as $row) {
            $existe = ProductoModel::model()->findByAttributes(
                    array('MIN_PROD' => $row['min']));
//$existe = false;
            if (!$existe) {
                $data = array(
                    'ID_EST' => $model->estadoId,
                    'ID_COMP' => 1, //MODIFICAR PARA QUE PRIMERO SE GUARDE LA COMPRA Y ESE ID SE PONGA
                    'ID_TPRO' => $model->tipoProducto, //MODIFICAR PARA QUE TOME AUTOMATICAMENTE SEGUN UN COMBO
                    'ID_BODEGA' => $model->bodegaId, //MODIFICAR PARA QUE TOME EL ID DE LA BODEGA QUE SELECCIONE EL USUARIO
                    'NOMBRE_PROD' => ($row['nombre'] == '') ? null : $row['nombre'],
                    'MIN_PROD' => ($row['min'] == '') ? null : $row['min'],
                    'ICC_PROD' => ($row['icc'] == '') ? null : $row['icc'],
                    'IMEI_PROD' => ($row['imei'] == '') ? null : $row['imei'],
//                    'IMEI_PROD' => ($row['icc'] == '') ? null : str_replace(',', '.', $row['pago']),
                    'NUMSERIE_PROD' => ($row['numero_serie'] == '') ? null : $row['numero_serie'],
                    'PRECIO_PROD' => ($row['precio'] == '') ? null : str_replace(',', '.', $row['precio']),
                    'COSTO_PROD' => ($row['costo'] == '') ? null : str_replace(',', '.', $row['costo']),
                    'PORCENTAJEDESCUENTO_PROD' => ($row['porcentaje_descuento'] == '') ? null : str_replace(',', '.', $row['porcentaje_descuento']),
//                    'IDUSR_CONS' => Yii::app()->user->id
                );

                array_push($dataInsert, $data);
                unset($data);
            } else {
                $_SESSION['duplicados'] = $_SESSION['duplicados'] + 1;
            }
        }

        return $dataInsert;
    }

    public function actionVerDatosArchivo() {
        if (!Yii::app()->request->isAjaxRequest) {
            $error['message'] = Yii::app()->params['msjErrorAccesoPag'];
            $error['code'] = Yii::app()->params['codErrorAccesoPag'];
            $this->render(Yii::app()->params['pagError'], $error);
        }

        $response = new Response();
        try {
            $response->Result = $_SESSION['compraItems'];
            unset($_SESSION['compraItems']);
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
