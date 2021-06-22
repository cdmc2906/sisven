<?php

/**
 * Description
 * @fecha 
 * @author 
 */
class CargaIndicadorController extends Controller
{

    public $layout = LAYOUT_IMPORTAR;

    public function actionIndex()
    {
        if (Yii::app()->request->isAjaxRequest) {
            return;
        } else {
            //            unset($_SESSION['indicadorItems']);
            unset(Yii::app()->session['indicadorItems']);
            $model = new CargaIndicadorForm();
            $this->render('/carga/cargaIndicador', array('model' => $model));
        }
    }

    public function actionSubirArchivo()
    {
        $response = new Response();
        try {
            $model = new CargaIndicadorForm();
            $indicadorItems = array();
            //            $_SESSION['indicadoresDuplicados'] = 0;
            Yii::app()->session['indicadoresDuplicados'] = 0;
            if (isset($_POST['CargaIndicadorForm'])) {
                $model->attributes = $_POST['CargaIndicadorForm'];
                if ($model->validate()) {

                    $model->rutaArchivo = CUploadedFile::getInstance($model, 'rutaArchivo');
                    //                    var_dump($filePath,$model->rutaArchivo->name);die();  
                    $filePath = Yii::app()->params['archivosIndicadores'] . $model->rutaArchivo->name;
                    $model->rutaArchivo->saveAs($filePath);
                    Yii::app()->session['FileIndicador'] = $filePath;
                    Yii::app()->session['ModelForm'] = $model;

                    //                    var_dump($model->delimitadorColumnas);                    die();
                    $operation = "r";
                    //                    $delimiter = ',';
                    $delimiter = $model->delimitadorColumnas;

                    //                    var_dump($filePath, $operation, $delimiter);                    die();
                    $file = new File($filePath, $operation, $delimiter);
                    //                    var_dump($file);die();
                    $totalRows = $file->getTotalFilas();
                    //                    var_dump($totalRows);die();

                    if ($totalRows > 0) {
                        $totalBloques = ceil($totalRows / TAMANIO_BLOQUE);
                        $numeroBloque = 1;
                        $tamanioBloque = TAMANIO_BLOQUE;

                        while ($numeroBloque <= intval($totalBloques)) {
                            $file = new File($filePath, $operation, $delimiter);
                            $registroInicio = (($numeroBloque - 1) * $tamanioBloque) + 1;
                            $dataInsert = $this->getDatosMostrar($file, $registroInicio, $tamanioBloque);
                            //                            var_dump($dataInsert);die();
                            if (count($dataInsert) > 0) {
                                $indicadorItems = array_merge($indicadorItems, $dataInsert);
                                unset($dataInsert);
                            }
                            $numeroBloque++;
                        }
                        //                        $_SESSION['indicadorItems'] = $indicadorItems;
                        Yii::app()->session['indicadorItems'] = $indicadorItems;
                        //                        unlink($filePath);
                        //var_dump($indicadorItems, Yii::app()->session['indicadorItems']);
                        //die();
                        //                        var_dump($_SESSION['indicadorItems']);die();
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

        $this->render('/carga/cargaIndicador', array('model' => $model));
        return;
    }

    private function getDatosMostrar($file, $start, $blockSize)
    {
        $dataInsert = array();
        $dataFile = $file->getDatosIndicadores($start, $blockSize);

//         var_dump($dataFile);die();
        foreach ($dataFile as $row) {
            //            if ($row['ruc'] === '1717363251') {
            //                var_dump($row['direccion'], trim($row['direccion']));                die();
            //            }
//                var_dump($row);            die();
            // var_dump($row['FECHA']);//die();
            $date = DateTime::createFromFormat(FORMATO_FECHA_LONG_7, $row['FECHA']);
            $dateString = '';
            if ($date !== FALSE) {
                $dateString = $date->format(FORMATO_FECHA_LONG);
            }
            else {
                $dateString=substr($row['FECHA'],0,19);
                //extraigo los caracteres de la fecha (10)
                //+ 1 espacio separador
                //+ 8 caracteres del tiempo horas, minutos, segundos
            }
            // var_dump($row['FECHA'],$date,$dateString);die();

            $data = array(
                'FECHA' => $dateString,//($row['FECHA'] == '') ? null : $row['FECHA'],
                'SUCURSAL' => ($row['SUCURSAL'] == '') ? null : $row['SUCURSAL'],
                'NUMERO_BODEGA' => ($row['NUMERO_BODEGA'] == '') ? null : $row['NUMERO_BODEGA'],
                'BODEGA' => ($row['BODEGA'] == '') ? null : $row['BODEGA'],
                'NUMERO_SERIE' => ($row['NUMERO_SERIE'] == '') ? null : $row['NUMERO_SERIE'],
                'NUMERO_FACTURA' => ($row['NUMERO_FACTURA'] == '') ? null : $row['NUMERO_FACTURA'],
                'COD_CLIENTE' => ($row['COD_CLIENTE'] == '') ? null : $row['COD_CLIENTE'],
                'TIPO_CLIENTE' => ($row['TIPO_CLIENTE'] == '') ? null : $row['TIPO_CLIENTE'],
                'NOMBRE_CLIENTE' => ($row['NOMBRE_CLIENTE'] == '') ? null : $row['NOMBRE_CLIENTE'],
                'RUC' => ($row['RUC'] == '') ? null : $row['RUC'],
                'DIRECCION' => ($row['DIRECCION'] == '') ? null : $row['DIRECCION'],
                'CIUDAD' => ($row['CIUDAD'] == '') ? null : $row['CIUDAD'],
                'TELEFONO' => ($row['TELEFONO'] == '') ? null : $row['TELEFONO'],
                'CODIGO_PRODUCTO' => ($row['CODIGO_PRODUCTO'] == '') ? null : $row['CODIGO_PRODUCTO'],
                'DESCRIPCION_PRODUCTO' => ($row['DESCRIPCION_PRODUCTO'] == '') ? null : $row['DESCRIPCION_PRODUCTO'],
                'CODIGO_GRUPO' => ($row['CODIGO_GRUPO'] == '') ? null : $row['CODIGO_GRUPO'],
                'GRUPO' => ($row['GRUPO'] == '') ? null : $row['GRUPO'],
                'CANTIDAD' => ($row['CANTIDAD'] == '') ? null : $row['CANTIDAD'],
                'DETALLE' => ($row['DETALLE'] == '') ? null : $row['DETALLE'],
                'IMEI' => ($row['IMEI'] == '') ? null : $row['IMEI'],
                'MIN' => ($row['MIN'] == '') ? null : $row['MIN'],
                'ICC' => ($row['ICC'] == '') ? null : $row['ICC'],
                'COSTO' => ($row['COSTO'] == '') ? null : $row['COSTO'],
                'PRECIO1' => ($row['PRECIO1'] == '') ? null : $row['PRECIO1'],
                'PRECIO2' => ($row['PRECIO2'] == '') ? null : $row['PRECIO2'],
                'PRECIO3' => ($row['PRECIO3'] == '') ? null : $row['PRECIO3'],
                'PRECIO4' => ($row['PRECIO4'] == '') ? null : $row['PRECIO4'],
                'PRECIO5' => ($row['PRECIO5'] == '') ? null : $row['PRECIO5'],
                'PRECIO' => ($row['PRECIO'] == '') ? null : $row['PRECIO'],
                'PORCENDES' => ($row['PORCENDES'] == '') ? null : $row['PORCENDES'],
                'DESCUENTO' => ($row['DESCUENTO'] == '') ? null : $row['DESCUENTO'],
                'SUBTOTAL' => ($row['SUBTOTAL'] == '') ? null : $row['SUBTOTAL'],
                'IVA' => ($row['IVA'] == '') ? null : $row['IVA'],
                'TOTAL' => ($row['TOTAL'] == '') ? null : $row['TOTAL'],
                'E_CODIGO' => ($row['E_CODIGO'] == '') ? null : $row['E_CODIGO'],
                'VENDEDOR' => ($row['VENDEDOR'] == '') ? null : $row['VENDEDOR'],
//                'MES' => ($row['MES'] == '') ? null : $row['MES'],
//                'SEMANA' => ($row['SEMANA'] == '') ? null : $row['PROVINCIA'],
//                'CEDULA' => ($row['CEDULA'] == '') ? null : $row['CEDULA'],
//                'LISTADO_OPERADORA' => ($row['LISTADO_OPERADORA'] == '') ? null : $row['LISTADO_OPERADORA'],
                'PROVINCIA' => ($row['PROVINCIA'] == '') ? null : $row['PROVINCIA'],
//                'ESTATUS' => ($row['ESTATUS'] == '') ? null : $row['ESTATUS'],
                //                'FECHA_INGRESO' => date(FORMATO_FECHA_LONG),
                //                'FECHA_MODIFICACION' => date(FORMATO_FECHA_LONG),
                //                'USUARIO_INGRESA_MODIFICA' => Yii::app()->user->id
            );
            array_push($dataInsert, $data);
            unset($data);
        }
        // var_dump($dataInsert[0]);die();
//                var_dump($dataInsert);die();
        return $dataInsert;
    }

    public function actionGuardarIndicadores()
    {
        $response = new Response();
        try {
            //            if (isset($_SESSION['FileIndicador'])) {
            if (isset(Yii::app()->session['FileIndicador'])) {
                //                $filePath = $_SESSION['FileIndicador'];
                Yii::app()->session['indicadoresDuplicados'] = 0;
                $filePath = Yii::app()->session['FileIndicador'];

                $operation = "r";
                //              $delimiter = ';';
                //                $delimiter = $_SESSION['ModelForm']["delimitadorColumnas"]; //';';;
                $delimiter = Yii::app()->session['ModelForm']["delimitadorColumnas"]; //';';;

                $file = new File($filePath, $operation, $delimiter);
                $totalRows = $file->getTotalFilas();

                var_dump(Yii::app()->session['indicadorItems']);
                die();

                $totalIndicadoresGuardados = 0;
                $totalIndicadoresNoGuardados = 0;
                $totalIndicadoresDuplicados = 0;

                if ($totalRows > 0) {
                    $totalBloques = ceil($totalRows / TAMANIO_BLOQUE);
                    $numeroBloque = 1;
                    $tamanioBloque = TAMANIO_BLOQUE;

                    while ($numeroBloque <= intval($totalBloques)) {
                        $file = new File($filePath, $operation, $delimiter);
                        $registroInicio = (($numeroBloque - 1) * $tamanioBloque) + 1;
                        $dataInsertar = $this->getDatosGuardar($file, $registroInicio, $tamanioBloque);
                        $datosIndicadores = $dataInsertar;
                        //                        $_SESSION['clientesRepetidos'] = $dataInsertar['clientesRepetidos'];
                        //                        if (isset($_SESSION['indicadoresDuplicados'])) {
                        if (isset(Yii::app()->session['indicadoresDuplicados'])) {
                            //                            $totalIndicadoresDuplicados = $totalIndicadoresDuplicados + $_SESSION['indicadoresDuplicados'];
                            $totalIndicadoresDuplicados = $totalIndicadoresDuplicados + Yii::app()->session['indicadoresDuplicados'];
                        }
                        if (count($datosIndicadores) > 0) {
                            $dbConnection = new CI_DB_active_record(null);
                            $sql = $dbConnection->insert_batch('tb_indicadores', $datosIndicadores);
                            $sql = str_replace('"', '', $sql);
                            //                            var_dump($sql);                            die();
                            $connection = Yii::app()->db_conn;
                            $connection->active = true;
                            $transaction = $connection->beginTransaction();
                            $command = $connection->createCommand($sql);
                            $countInsert = $command->execute();

                            if ($countInsert > 0) {
                                $transaction->commit();
                                $totalIndicadoresGuardados = $totalIndicadoresGuardados + $countInsert;
                            } else {
                                $transaction->rollback();
                                $totalIndicadoresNoGuardados = $totalIndicadoresNoGuardados + $countInsert;
                            }
                            unset($datosIndicadores);
                            $connection->active = false;
                        }

                        $numeroBloque++;
                    }


                    if (true) {

                        $response->Message = '<br> Registros guardados: ' . $totalIndicadoresGuardados .
                            '<br> Registros no guardados: ' . $totalIndicadoresNoGuardados .
                            '<br> Registros duplicados: ' . $totalIndicadoresDuplicados;
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

    private function getDatosGuardar($file, $start, $blockSize)
    {
        $datos = array();
        $datosIndicadores = array();
        $indicadoresRepetidos = array();

        $dataFile = $file->getDatosIndicadores($start, $blockSize);
        foreach ($dataFile as $row) {
            //            $existeBdd = false;
            $existeBdd = IndicadoresModel::model()->findByAttributes(
                array('i_imei' => $row['IMEI'])
            );
            if (isset($existeBdd)) {
                //                var_dump($existeBdd);die();
                $existeBdd->delete();
                //                $_SESSION['indicadoresDuplicados'] += 1;
                Yii::app()->session['indicadoresDuplicados'] += 1;
            }

            $exisArray = false;
            foreach ($datosIndicadores as $item) {
                $exisArray = in_array($row['IMEI'], $item);
                if ($exisArray)
                    break;
            }
            //            var_dump($row['FECHA']);die();
            if (!$exisArray) {

                //                $fechaIndicador = DateTime::createFromFormat('d/m/Y', $row['FECHA']);
                //                $sfechaIndicador = $fechaIndicador->format(FORMATO_FECHA_LONG);


                $date = DateTime::createFromFormat(FORMATO_FECHA_LONG_5, $row['FECHA']);
                $dateString = '';
                if ($date !== FALSE) {
                    $dateString = $date->format(FORMATO_FECHA_LONG);
                }
                // var_dump($dateString, $row['FECHA']);                die();
                $i_costo = $this->evaluateDecimal($row['COSTO']);
                $i_precio1 = $this->evaluateDecimal($row['PRECIO1']);
                $i_precio2 = $this->evaluateDecimal($row['PRECIO2']);
                // var_dump($i_precio1,$row['PRECIO1']);die();
                $i_precio3 = $this->evaluateDecimal($row['PRECIO3']);
                $i_precio4 = $this->evaluateDecimal($row['PRECIO4']);
                $i_precio5 = $this->evaluateDecimal($row['PRECIO5']);
                $i_precio = $this->evaluateDecimal($row['PRECIO']);
                $i_porcendes = $this->evaluateDecimal($row['PORCENDES']);
                $i_descuento = $this->evaluateDecimal($row['DESCUENTO']);
                $i_subtotal = $this->evaluateDecimal($row['SUBTOTAL']);
                $i_iva = $this->evaluateDecimal($row['IVA']);
                $i_total = $this->evaluateDecimal($row['TOTAL']);
                // // var_dump($i_costo ,
                // $i_precio1,
                // $i_precio2 ,
                // $i_precio3 ,
                // $i_precio4 ,
                // $i_precio5 ,
                // $i_precio ,
                // $i_porcendes ,
                // $i_descuento ,
                // $i_subtotal ,
                // $i_iva ,
                // $i_total);die();

                $data = array(
                    //''i_codigo' => ($row['CODIGO'] == '') ? null : $row['CODIGO'],
                    'i_fecha' => ($row['FECHA'] == '') ? null : $dateString, //$sfechaIndicador,
                    'i_sucursal' => ($row['SUCURSAL'] == '') ? null : $row['SUCURSAL'],
                    'i_numero_bodega' => ($row['NUMERO_BODEGA'] == '') ? null : $row['NUMERO_BODEGA'],
                    'i_bodega' => ($row['BODEGA'] == '') ? null : $row['BODEGA'],
                    'i_numero_serie' => ($row['NUMERO_SERIE'] == '') ? null : $row['NUMERO_SERIE'],
                    'i_numero_factura' => ($row['NUMERO_FACTURA'] == '') ? null : $row['NUMERO_FACTURA'],
                    'i_cod_cliente' => ($row['COD_CLIENTE'] == '') ? null : $row['COD_CLIENTE'],
                    'i_tipo_cliente' => ($row['TIPO_CLIENTE'] == '') ? null : $row['TIPO_CLIENTE'],
                    'i_nombre_cliente' => ($row['NOMBRE_CLIENTE'] == '') ? null : $row['NOMBRE_CLIENTE'],
                    'i_ruc' => ($row['RUC'] == '') ? null : $row['RUC'],
                    'i_direccion' => ($row['DIRECCION'] == '') ? null : $row['DIRECCION'],
                    'i_ciudad' => ($row['CIUDAD'] == '') ? null : $row['CIUDAD'],
                    'i_telefono' => ($row['TELEFONO'] == '') ? null : $row['TELEFONO'],
                    'i_codigo_producto' => ($row['CODIGO_PRODUCTO'] == '') ? null : $row['CODIGO_PRODUCTO'],
                    'i_descripcion_producto' => ($row['DESCRIPCION_PRODUCTO'] == '') ? null : $row['DESCRIPCION_PRODUCTO'],
                    'i_codigo_grupo' => ($row['CODIGO_GRUPO'] == '') ? null : $row['CODIGO_GRUPO'],
                    'i_grupo' => ($row['GRUPO'] == '') ? null : $row['GRUPO'],
                    'i_cantidad' => ($row['CANTIDAD'] == '') ? null : intval($row['CANTIDAD']),
                    'i_detalle' => ($row['DETALLE'] == '') ? null : $row['DETALLE'],
                    'i_imei' => ($row['IMEI'] == '') ? null : $row['IMEI'],
                    'i_min' => ($row['MIN'] == '') ? null : $row['MIN'],
                    'i_icc' => ($row['ICC'] == '') ? null : $row['ICC'],
                    'i_costo' => $i_costo,
                    'i_precio1' => $i_precio1,
                    'i_precio2' => $i_precio2,
                    'i_precio3' => $i_precio3,
                    'i_precio4' => $i_precio4,
                    'i_precio5' => $i_precio5,
                    'i_precio' => $i_precio,
                    'i_porcendes' => $i_porcendes,
                    'i_descuento' => $i_descuento,
                    'i_subtotal' => $i_subtotal,
                    'i_iva' => $i_iva,
                    'i_total' => $i_total,
                    'i_e_codigo' => ($row['E_CODIGO'] == '') ? null : $row['E_CODIGO'],
                    'i_vendedor' => ($row['VENDEDOR'] == '') ? null : $row['VENDEDOR'],
                    'i_mes' => ($row['MES'] == '') ? null : $row['MES'],
                    'i_semana' => ($row['SEMANA'] == '') ? null : $row['SEMANA'],
                    'i_cedula' => ($row['CEDULA'] == '') ? null : $row['CEDULA'],
                    'i_listado_operadora' => ($row['LISTADO_OPERADORA'] == '') ? null : $row['LISTADO_OPERADORA'],
                    'i_provincia' => ($row['PROVINCIA'] == '') ? null : $row['PROVINCIA'],
                    'i_estatus' => ($row['ESTATUS'] == '') ? null : $row['ESTATUS'],
                    'i_fecha_ingreso' => date(FORMATO_FECHA_LONG),
                    'i_fecha_modificacion' => date(FORMATO_FECHA_LONG),
                    'i_usuario_ingresa_modifica' => Yii::app()->user->id,
                    'i_estado_icc' => 'ICC OK'
                    //                    'IDDELTA_CLI' => ($row['codcli'] == '') ? 0 : str_replace(',', '.', $row['codcli']),
                );
                // var_dump($data);die();
                array_push($datosIndicadores, $data);
                unset($data);
            }
        }
        $datos = $datosIndicadores;
        // var_dump($datos);die();
        return $datos;
    }

    public static function evaluateDecimal($campoValidar)
    {
        // var_dump($campoValidar,is_float(floatval($campoValidar)),floatval($campoValidar),is_integer(intval($campoValidar)),intval($campoValidar));die();
        if (is_float(floatval($campoValidar))) {
            return floatval($campoValidar);
        } elseif (is_int(intval($campoValidar))) {
            return intval($campoValidar);
        } else {
            return 0;
        }
    }

    public function actionVerDatosArchivo()
    {
        if (!Yii::app()->request->isAjaxRequest) {
            $error['message'] = Yii::app()->params['msjErrorAccesoPag'];
            $error['code'] = Yii::app()->params['codErrorAccesoPag'];
            $this->render(Yii::app()->params['pagError'], $error);
        }

        $response = new Response();
        try {
            $response->Result = Yii::app()->session['indicadorItems'];
            //            unset($_SESSION['indicadorItems']);
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

        // unset(Yii::app()->session['indicadorItems']);
        $this->actionResponse(null, null, $response);
        return;
    }

    private function actionResponse($view = 'error', $model = null, $response = null)
    {
        // var_dump(json_encode($response),$response);die();
        if (Yii::app()->request->isAjaxRequest) {
            // var_dump($response);die();
            echo json_encode($response);
        } else {
            $this->render($view, $model);
        }
    }
}
