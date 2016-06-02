<?php

/**
 * Description
 * @fecha 
 * @author 
 */
class CargaConsumoController extends Controller {

    public function actionIndex() {
        if (Yii::app()->request->isAjaxRequest) {
            return;
        } else {

            $cs = Yii::app()->getClientScript();
            $cs->registerPackage('jquery');

            unset($_SESSION['consumoItems']);

            $model = new CargaConsumoForm();

            $this->render('/consumo/cargaConsumo', array('model' => $model));
        }
    }

    public function actionSubirArchivo() {
        $response = new Response();

        try {
            $model = new CargaConsumoForm();
            $consumoItems = array();

            if (isset($_POST['CargaConsumoForm'])) {
                $model->attributes = $_POST['CargaConsumoForm'];
                if ($model->validate()) {
                    unset($_SESSION['consumoItems']);

                    $filePath = Yii::app()->params['archivosConsumo'];
                    $model->rutaArchivo = CUploadedFile::getInstance($model, 'rutaArchivo');
                    $model->rutaArchivo->saveAs($filePath);
                    $_SESSION['FileConsumo'] = $filePath;
                    $_SESSION['FechaConsumo'] = $model->mesConsumo;

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
                            $dataInsert = $this->getDatosMostrar($file, $registroInicio, $tamanioBloque, $model->mesConsumo);

                            if (count($dataInsert) > 0) {
                                $consumoItems = array_merge($consumoItems, $dataInsert);
                                unset($dataInsert);
                            }
                            $numeroBloque ++;
                        }
                        $_SESSION['consumoItems'] = $consumoItems;
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

        $this->render('/consumo/cargaConsumo', array('model' => $model));
        return;
    }

    private function getDatosMostrar($file, $start, $blockSize, $mesConsumo) {
        $dataInsert = array();
        $dataFile = $file->getDatosConsumo($start, $blockSize);

        foreach ($dataFile as $row) {
            $data = array(
                'PLAN_CONS' => ($row['plan'] == '') ? null : $row['plan'],
                'MIN_CONS' => ($row['min'] == '') ? null : $row['min'],
                'CONTRATO_CONS' => ($row['contrato'] == '') ? null : $row['contrato'],
                'CODIGOVENDEDOR_CONS' => ($row['codigo_vendedor'] == '') ? null : $row['codigo_vendedor'],
                'VENDEDOR_CONS' => ($row['vendedor'] == '') ? null : $row['vendedor'],
                'VALORPAGO_CONS' => ($row['pago'] == '') ? 0 : str_replace(',', '.', $row['pago']),
                'FECHACONSUMO_CONS' => $mesConsumo,
                'OBSERVACION_CONS' => ($row['observacion'] == '') ? null : $row['observacion'],
            );

            array_push($dataInsert, $data);
            unset($data);
        }

        return $dataInsert;
    }

    public function actionGuardarConsumo() {
        $response = new Response();
        $minesDesconocidos = array();
        $todos_minesDesconocidos = array();
        try {
            if (isset($_SESSION['FileConsumo']) && isset($_SESSION['FechaConsumo'])) {
                $filePath = $_SESSION['FileConsumo'];

                $operation = "r";
                $delimiter = ';';
                $file = new File($filePath, $operation, $delimiter);
                $totalRows = $file->getTotalFilas();

                $totalGuardados = 0;
                $totalNoGuardados = 0;
                $totalDuplicados = 0;
                $totalOmitidos = 0;
                $totalDesconocidos = 0;

                if ($totalRows > 0) {

                    $totalBloques = ceil($totalRows / TAMANIO_BLOQUE);
                    $numeroBloque = 1;
                    $tamanioBloque = TAMANIO_BLOQUE;

//                    $mines = '';
                    while ($numeroBloque <= intval($totalBloques)) {
                        $file = new File($filePath, $operation, $delimiter);
                        $registroInicio = (($numeroBloque - 1) * $tamanioBloque) + 1;

                        $dataInsert = $this->getDatosGuardar($file, $registroInicio, $tamanioBloque, $_SESSION['FechaConsumo']);
                        $consumosGuardar = $dataInsert['consumos'];
                        $minesDesconocidos = $dataInsert['minesDesconocidos'];

                        if (isset($minesDesconocidos)) {
                            $totalDesconocidos = $totalDesconocidos + count($minesDesconocidos);
//                            array_push($todos_minesDesconocidos, $minesDesconocidos);
                            $todos_minesDesconocidos = array_merge($todos_minesDesconocidos, $minesDesconocidos);
                            unset($minesDesconocidos);
                        }

                        if (isset($_SESSION['duplicados'])) {
                            $totalDuplicados = $totalDuplicados + $_SESSION['duplicados'];
                        }
                        if (isset($_SESSION['omitidos'])) {
                            $totalOmitidos = $totalOmitidos + $_SESSION['omitidos'];
                        }

                        if (count($consumosGuardar) > 0) {

                            $dbConnection = new CI_DB_active_record(null);
                            $sql = $dbConnection->insert_batch('tb_consumo', $consumosGuardar);
                            $sql = str_replace('"', '', $sql);

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
                            '<br> Registros duplicados: ' . $totalDuplicados .
                            '<br> Registros omitidos pago=0: ' . $totalOmitidos .
                            '<br> Mines desconocidos: ' . $totalDesconocidos;
//                    if ($totalNoGuardados > 0 || $totalDuplicados > 0 || $totalDesconocidos > 0) {
//                        $response->Message = $mensaje;
//                        $response->Status = NOTICE;
//                    } else {
                    $response->Message = $mensaje;
                    $response->Status = SUCCESS;
//                    }
//                    if (count($mineslista) > 0) {
//                        $reporteModel = new ReportesModel();
//
//                        $datos = array();
//                        $datos['fechaConsumoInicio'] = $_SESSION['FechaConsumo'];
//                        $datos['fechaConsumoFin'] = $_SESSION['FechaConsumo'];
//                        $consumos = $reporteModel->getTotalPlan($datos);
//                    var_dump($todos_minesDesconocidos);die();
                    $_SESSION['minesdesconocidos'] = $todos_minesDesconocidos;
                    $response->Result = $todos_minesDesconocidos;
//                    var_dump($todos_minesDesconocidos[]);die();
//                    }
//                    var_dump($minesDesconocidos);                    die();
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

//        var_dump($response);        die();
        $this->actionResponse(null, null, $response);
        return;
    }

    private function getDatosGuardar($file, $start, $blockSize, $mesConsumo) {
        $resultadoDatos = array();
        $consumosInsert = array();
        $minesDesconocidos = array();
        $_SESSION['duplicados'] = 0;
        $_SESSION['omitidos'] = 0;
//        $_SESSION['minesDesconocidos'] = 0;
        $contadorminesDesconocidos = 0;

        $dataFile = $file->getDatosConsumo($start, $blockSize);

        foreach ($dataFile as $row) {
            if ($row['pago'] > 0) {
                $existe = ConsumoModel::model()->findByAttributes(
                        array('ID_MES' => $mesConsumo, 'MIN_CONS' => $row['min']));
                $producto = ProductoModel::model()->findByAttributes(
                        array('MIN_593_PROD' => $row['min']));
                if (isset($producto)) {
                    if (!$existe) {
                        $data = array(
                            'ID_PRO' => $producto->ID_PRO,
                            'PLAN_CONS' => ($row['plan'] == '') ? null : $row['plan'],
                            'MIN_CONS' => ($row['min'] == '') ? null : $row['min'],
                            'CONTRATO_CONS' => ($row['contrato'] == '') ? null : $row['contrato'],
                            'CODIGOVENDEDOR_CONS' => ($row['codigo_vendedor'] == '') ? null : $row['codigo_vendedor'],
                            'VENDEDOR_CONS' => ($row['vendedor'] == '') ? null : $row['vendedor'],
                            'VALORPAGO_CONS' => ($row['pago'] == '') ? 0 : str_replace(',', '.', $row['pago']),
                            'FECHACONSUMO_CONS' => date(FORMATO_FECHA_LONG),
                            'FECHAINGRESO_CONS' => date(FORMATO_FECHA_LONG),
                            'FECHAMODIFICACION_CONS' => date(FORMATO_FECHA_LONG),
                            'OBSERVACION_CONS' => ($row['observacion'] == '') ? null : $row['observacion'],
                            'IDUSR_CONS' => Yii::app()->user->id,
                            'ID_MES' => $mesConsumo,
                        );

                        array_push($consumosInsert, $data);
                        unset($data);
                    } else {
                        $_SESSION['duplicados'] = $_SESSION['duplicados'] + 1;
                    }
                } else {
                    $a = array('min' => $row['min']);
                    array_push($minesDesconocidos, $a);
                }
            }// if verifica si tiene consumo o no 
            else {
                $_SESSION['omitidos'] = $_SESSION['omitidos'] + 1;
            }
        }
        $resultadoDatos['minesDesconocidos'] = $minesDesconocidos;
        $resultadoDatos['consumos'] = $consumosInsert;
        return $resultadoDatos;
    }

    public function actionVerDatosArchivo() {
        if (!Yii::app()->request->isAjaxRequest) {
            $error['message'] = Yii::app()->params['msjErrorAccesoPag'];
            $error['code'] = Yii::app()->params['codErrorAccesoPag'];
            $this->render(Yii::app()->params['pagError'], $error);
        }

        $response = new Response();
        try {
//            var_dump($_SESSION['consumoItems']);die();
            $response->Result = $_SESSION['consumoItems'];
            unset($_SESSION['consumoItems']);
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
//        var_dump(Yii::app()->request->isAjaxRequest);die();
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

    public function actionGenerateExcel() {
//        var_dump($_SESSION['minesdesconocidos']);die();
        $response = new Response();
        try {
//            $formData = new ReporteVentasConsumosxMesForm();
//            $formData->mes = $mes;
//            $reporteModel = new ReportesModel();
//
//            $data = $reporteModel->getVentasConsumosxMes($formData);

            $minesDesconocidos = array();
            $datos = $_SESSION['minesdesconocidos'];
//            var_dump($datos);die();
            foreach ($datos as $value) {
//                var_dump($value);die();
                $dat = array(
                    'MINES_DESCONOCIDOS' => "'" . $value['min'],
                );
                array_push($minesDesconocidos, $dat);
            }

            $NombreArchivo = "ReporteMinesDesconocidos";
            $NombreHoja = "reporte";

            $autor = "Christian"; //$_SESSION['CUENTA'];
            $titulo = "ReporteMinesDesconocidos";
            $tema = "ReporteMinesDesconocidos";
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

            $excel->Mapeo($minesDesconocidos);

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
