<?php

/**
 * Description
 * @fecha 
 * @author 
 */
class RptResumenSemanalHistorialController extends Controller {

    public function actionIndex() {
        if (Yii::app()->request->isAjaxRequest) {
            return;
        } else {
            $_SESSION['ejecutivo'] = '';
            $model = new RptResumenSemanalHistorialForm();
            $this->render('/historialmb/rptResumenSemanalHistorial', array('model' => $model));
        }
    }


    public function actionRevisarHistorial() {
        $datos = array();
        $datosDetalleGrid = array();
        $datosResumenGrid = array();
//        $datosResumenGrid2 = array();
//        $_SESSION['ejecutivo']='';
        $response = new Response();
        try {
            $model = new RptResumenSemanalHistorialForm();
            if (isset($_POST['RptResumenSemanalHistorialForm'])) {
                $model->attributes = $_POST['RptResumenSemanalHistorialForm'];
                if ($model->validate()) {

                    $primerDiaMes = date("Y-m-01", strtotime($model->anio . '-' . $model->mes . '-01'));
//                    $ultimoDiaMes = date("Y-m-t", strtotime($model->anio . '-' . $model->mes . '-01'));

                    $ejecutivo = EjecutivoModel::model()->findAllByAttributes(array('e_usr_mobilvendor' => $model->ejecutivo));

                    $semanaItemAnterior = 0;
                    $semanaItemActual = 0;
                    $secuenciaVisitaHistorial = 1;
                    $fHistorial = new FHistorialModel();
                    $fOrden = new FOrdenModel();
                    $frutamodel = new FRutaModel();
                    $contadorDiasAgregar = 0;
                    $diaMes = $primerDiaMes;
                    $diasMes = intval(date("t", strtotime($model->anio . '-' . $model->mes . '-01')));

                    for ($contadorDiasAgregar = 0; $contadorDiasAgregar <= $diasMes; $contadorDiasAgregar++) {
                        $datosResumenGrid2 = array();
                        $diaMes = date('Y-m-d', strtotime($primerDiaMes . ' + ' . $contadorDiasAgregar . ' days'));
                        $dia = date("w", strtotime($diaMes));
                        if ($dia > 0 && $dia < 6) {
                            $semanaItemActual = strval($this->weekOfMonth($diaMes));
                            $historial = $fHistorial->getHistorialxVendedorxFecha($diaMes, $ejecutivo[0]['e_usr_mobilvendor']);
                            if (count($historial) > 0) {
                                $rsTotalClientesRuta = $frutamodel->getTotalClientesxRutaxEjecutivoxDia($ejecutivo[0]['e_iniciales'], $dia + 1);
                                $totalClientesRuta = $rsTotalClientesRuta[0]["TOTALCLIENTES"];

                                $porcentajeCumplimiento = 0;
                                $totalVisitasEfectuadas = 0;
                                $visitasRuta = 0;
                                $visitasFueraRuta = 0;
                                $cantidadVentaRuta = 0;
                                $cantidadVentaFueraRuta = 0;
                                $clientesConVenta = 0;
                                $totalVentaReportada = 0;
                                $visitaRepetida = false;

                                $rsclientesNoVisitados = $frutamodel->getTotalClientesNoVisitadosxRutaxEjecutivo($ejecutivo[0]['e_iniciales'], $dia + 1, $diaMes, $ejecutivo[0]['e_usr_mobilvendor']);
                                $clientesNoVisitados = $rsclientesNoVisitados[0]['CLIENTESNOVISITADOS'];

                                foreach ($historial as $itemHistorial) {
                                    $fechaHistorialSinFormato = new DateTime($itemHistorial['FECHAVISITA']);
                                    $fechaHistorial = $fechaHistorialSinFormato->format('Y-m-d');

                                    $estadoRevisionRuta = '';
                                    $cantidadChips = $fOrden->getChipsxClientexEjecutivoxFecha($itemHistorial['CODIGOCLIENTE'], $ejecutivo[0]['e_usr_mobilvendor'], $fechaHistorial);
                                    $chips = $cantidadChips[0]['CHIPS'];

                                    foreach ($datosDetalleGrid as $item) {
                                        if (in_array($itemHistorial['CODIGOCLIENTE'], $item) && intval($item['CHIPSCOMPRADOS']) > 0) {
                                            $chips = "0";
                                        }
                                    }

                                    $ruta = $frutamodel->getRutaxCliente($itemHistorial['CODIGOCLIENTE'], $ejecutivo[0]['e_iniciales']);
                                    if (count($ruta) == 0) {
                                        $rutaCliente = "Sin ruta";
                                        $secuenciaRutaCliente = "Sin secuencia";
                                    } else {
                                        $rutaCliente = $ruta[0]['RUTA'];
                                        $secuenciaRutaCliente = $ruta[0]['SECUENCIA'];
                                        if ($chips > 0) {
                                            $clientesConVenta += 1;
                                        }
                                    }
                                    if ($itemHistorial['RUTAVISITA'] == $rutaCliente) {

//                            $itemHistorial['CODIGOCLIENTE'];

                                        foreach ($datosDetalleGrid as $item) {
                                            if (in_array($itemHistorial['CODIGOCLIENTE'], $item)) {
                                                $visitaRepetida = true;
                                                break;
                                            }
                                        }
                                        if ($visitaRepetida) {
                                            $estadoRevisionRuta = 'Visita en ruta repetida';
                                        } else {
                                            $estadoRevisionRuta = 'Visita en ruta';
                                            $visitasRuta += 1;
                                        }

                                        if ($chips > 0) {
                                            $cantidadVentaRuta += $chips;
                                        }
                                    } else {
                                        $estadoRevisionRuta = 'Visita fuera de ruta';
                                        $visitasFueraRuta += 1;
                                        if ($chips > 0) {
                                            $cantidadVentaFueraRuta += $chips;
                                        }
                                    }
                                    if ($secuenciaVisitaHistorial == $secuenciaRutaCliente) {
                                        $estadoRevisionS = 'Secuencia OK';
                                    } else {
                                        $estadoRevisionS = 'Otra secuencia';
                                    }

                                    $totalVentaReportada = $cantidadVentaFueraRuta + $cantidadVentaRuta;
                                    $totalVisitasEfectuadas = $visitasRuta + $visitasFueraRuta;
                                    $porcentajeCumplimiento = ($visitasRuta / $totalClientesRuta) * 100;

                                    $revisionRuta = array(
//                                      'FECHAREVISION' => date(FORMATO_FECHA),
                                        'FECHARUTA' => $itemHistorial['FECHAVISITA'],
//                                      'CODEJECUTIVO' => $ejecutivo[0]->e_usr_mobilvendor,
//                                      'EJECUTIVO' => $ejecutivo[0]->e_nombre,
                                        'CODIGOCLIENTE' => $itemHistorial['CODIGOCLIENTE'],
                                        'CLIENTE' => $itemHistorial['NOMBRECLIENTE'],
                                        'RUTAUSADA' => $itemHistorial['RUTAVISITA'],
                                        'SECUENCIAVISITA' => $secuenciaVisitaHistorial,
                                        'RUTACLIENTE' => $rutaCliente,
                                        'SECUENCIARUTA' => $secuenciaRutaCliente,
                                        'ESTADOREVISIONR' => $estadoRevisionRuta,
                                        'ESTADOREVISIONS' => $estadoRevisionS,
                                        'CHIPSCOMPRADOS' => $chips,
                                    );
                                    $secuenciaVisitaHistorial = $secuenciaVisitaHistorial + 1;
                                    array_push($datosDetalleGrid, $revisionRuta);
//                                    $datos['detalle'] = $datosDetalleGrid;
                                    unset($revisionRuta);
                                }// Fin iteracion items historial
//                                var_dump($datosDetalleGrid);die();
                                $resumenRuta = array(
                                    'PORCENTAJE-CUMPLIMIENTO' => ($porcentajeCumplimiento == null) ? "0%" : number_format($porcentajeCumplimiento, 2) . "%",
                                    'VISITAS-EFECTUADAS' => ($totalVisitasEfectuadas == null) ? 0 : $totalVisitasEfectuadas,
                                    'CLIENTES-RUTA' => ($totalClientesRuta == null) ? 0 : $totalClientesRuta,
                                    'CLIENTES-NO-VISITADOS' => ($clientesNoVisitados == null) ? 0 : $clientesNoVisitados,
                                    'VISITAS-RUTA' => ($visitasRuta == null) ? 0 : $visitasRuta,
                                    'VISITAS-FUERA-RUTA' => ($visitasFueraRuta == null) ? 0 : $visitasFueraRuta,
                                    'CANTIDAD-VENTA-RUTA' => ($cantidadVentaRuta == null) ? 0 : $cantidadVentaRuta,
                                    'CANTIDAD-VENTA-FUERA-RUTA' => ($cantidadVentaFueraRuta == null) ? 0 : $cantidadVentaFueraRuta,
                                    'CLIENTES-VENTA' => ($clientesConVenta == null) ? 0 : $clientesConVenta,
                                    'TOTAL-VENTA-REPORTADA' => ($totalVentaReportada == null) ? 0 : $totalVentaReportada,
                                );
                                array_push($datosResumenGrid, $resumenRuta);
                                unset($resumenRuta);
//                              
//                                var_dump($semanaItemActual,$semanaItemAnterior);
                                if ($semanaItemActual != 0 && $semanaItemAnterior != 0) {
                                    if ($semanaItemActual != $semanaItemAnterior) {
                                        
                                        $datos["'" . $semanaItemAnterior . "'"] = $datosResumenGrid2;
                                        unset($datosResumenGrid2);
//                                        $datosResumenGrid2='';
                                    }
                                }


                                $fechaCorta = DateTime::createFromFormat('Y-m-d', $diaMes)->format(FORMATO_FECHA_2);
                                foreach ($datosResumenGrid as $key => $filaGrid) {
                                    foreach ($filaGrid as $clave => $valor) {
                                        $resumenRutaPivot = array(
                                            'EJECUTIVO' => $ejecutivo[0]['e_usr_mobilvendor'],
                                            'FECHA_HISTORIAL' => $fechaCorta,
                                            'PARAMETRO' => $clave,
                                            'VALOR' => $valor,
                                            'SEMANA' => strval($this->weekOfMonth($diaMes)),
                                        );
                                        array_push($datosResumenGrid2, $resumenRutaPivot);
                                        unset($resumenRutaPivot);
                                    }//fin iteracion valores en fila
                                }//fin iteracion filas resumen
                                $semanaItemAnterior = strval($this->weekOfMonth($diaMes));
                            }//fin de if controla si dia es domingo o sabado
                        }//fin de if controla cantidad de registros por dia en historial de usuario
                    }//fin for iterando en los dias del mes
                }//fin model->validate
//                var_dump($datosResumenGrid2);                die();
//                var_dump(json_encode($datosResumenGrid2));                die();
//                var_dump($datos);
                die();


//                $datos['resumen'] = $datosResumenGrid2;
//                $_SESSION['detallerevisionhistorialitem'] = $datosDetalleGrid;
//                $_SESSION['resumenrevisionhistorialitem'] = $datosResumenGrid2;
                $response->Message = "Historial revisado exitosamente";
                $response->Status = SUCCESS;
                $response->Result = $datos; // $datosGrid;
            }
        } catch (Exception $e) {
            $response->Message = Yii::app()->params['mensajeExcepcion'];
            $response->Status = ERROR;
            $response->ClassMessage = CLASS_MENSAJE_ERROR;
        }
        $this->actionResponse(null, null, $response);
        return;
    }

    public function actionGuardarHistorial() {
        $response = new Response();
        $datosResumenRevision = array();
        $datosDetalleRevision = array();
        $totalDetallesGuardados = 0;
        $totalDetallesOmitidos = 0;
        $totalResumenGuardados = 0;
        $totalResumenOmitidos = 0;

        try {
            if (isset($_SESSION['revisionhistorialitem'])) {
                $datosDetalleRevisionHistorial = $_SESSION['detallerevisionhistorialitem'];
                $datosResumenRevisionHistorial = $_SESSION['resumenrevisionhistorialitem'];
                if (count($datosDetalleRevisionHistorial) > 0) {
                    foreach ($datosDetalleRevisionHistorial as $row) {
                        $data = array(
                            //''rh_id' => ($row[''] == '') ? null : $row[''],
                            'rh_item' => 'HISTORIAL',
//                            'rh_fecha_item' => $sfechaItem,
                            'rh_fecha_item' => ($row['FECHARUTA'] == '') ? null : $row['FECHARUTA'],
                            'rh_fecha_revision' => ($row['FECHAREVISION'] == '') ? null : $row['FECHAREVISION'],
                            'rh_codigo_vendedor' => ($row['CODEJECUTIVO'] == '') ? null : $row['CODEJECUTIVO'],
                            'rh_cod_cliente' => ($row['CODIGOCLIENTE'] == '') ? null : $row['CODIGOCLIENTE'],
                            'rh_ruta_visita' => ($row['RUTAUSADA'] == '') ? null : $row['RUTAUSADA'],
                            'rh_orden_visita' => ($row['SECUENCIAVISITA'] == '') ? null : $row['SECUENCIAVISITA'],
                            'rh_ruta_ejecutivo' => ($row['RUTACLIENTE'] == '') ? null : $row['RUTACLIENTE'],
                            'rh_secuencia_ruta' => ($row['SECUENCIARUTA'] == '') ? null : $row['SECUENCIARUTA'],
                            'rh_observacion_ruta' => ($row['ESTADOREVISIONR'] == '') ? null : $row['ESTADOREVISIONR'],
                            'rh_observacion_secuencia' => ($row['ESTADOREVISIONS'] == '') ? null : $row['ESTADOREVISIONS'],
                            'rh_chips_compra' => ($row['CHIPSCOMPRADOS'] == '') ? null : $row['CHIPSCOMPRADOS'],
                            'rh_estado' => 'INGRESADO',
                            'rh_fecha_ingreso' => date(FORMATO_FECHA_LONG),
                            'rh_fecha_modificacion' => date(FORMATO_FECHA_LONG),
                            'rh_usuario_revisa' => Yii::app()->user->id
                        );
                        array_push($datosDetalleRevision, $data);
                        unset($data);
                    }// fin iteracion filas detalle revision
                    if (count($datosDetalleRevision) > 0) {
                        $dbConnection = new CI_DB_active_record(null);
                        $sql = $dbConnection->insert_batch('tb_control_historial_ruta', $datosDetalleRevision);
                        $sql = str_replace('"', '', $sql);
                        $connection = Yii::app()->db_conn;
                        $connection->active = true;
                        $transaction = $connection->beginTransaction();
                        $command = $connection->createCommand($sql);
                        $countInsert = $command->execute();
                        if ($countInsert > 0) {
                            $transaction->commit();
                            $totalDetallesGuardados += 1;
                        } else {
                            $transaction->rollback();
                            $totalDetallesOmitidos += 1;
                        }
                        unset($datosDetalleRevision);
                        $connection->active = false;
                    }

                    if (count($datosResumenRevisionHistorial) > 0) {
                        foreach ($datosResumenRevisionHistorial as $row) {
//                        var_dump($row);                        die();
                            $data = array(
                                //''rh_id' => ($row[''] == '') ? null : $row[''],
                                'rrh_cod_ejecutivo' => ($row['EJECUTIVO'] == '') ? null : $row['EJECUTIVO'],
                                'rrh_fecha_historial' => ($row['FECHA_HISTORIAL'] == null) ? '0001/01/01' : $row['FECHA_HISTORIAL'],
                                'rrh_parametro' => ($row['PARAMETRO'] == null) ? 0 : $row['PARAMETRO'],
                                'rrh_valor' => ($row['VALOR'] == null) ? 0 : $row['VALOR'],
                                'rrh_fecha_ingreso' => date(FORMATO_FECHA_LONG),
                                'rrh_fecha_modificacion' => date(FORMATO_FECHA_LONG),
                                'rrh_usuario_ingresa_modifica' => Yii::app()->user->id,
                            );
                            array_push($datosResumenRevision, $data);
                            unset($data);
                        }//fin iteracion filas resumen
                        if (count($datosResumenRevision) > 0) {
                            $dbConnection = new CI_DB_active_record(null);
                            $sql = $dbConnection->insert_batch('tb_resumen_historial', $datosResumenRevision);
                            $sql = str_replace('"', '', $sql);
                            $connection = Yii::app()->db_conn;
                            $connection->active = true;
                            $transaction = $connection->beginTransaction();
                            $command = $connection->createCommand($sql);
                            $countInsert = $command->execute();
                            if ($countInsert > 0) {
                                $transaction->commit();
                                $totalResumenGuardados += 1;
                            } else {
                                $transaction->rollback();
                                $totalResumenOmitidos += 1;
                            }
                            unset($datosResumenRevision);
                            $connection->active = false;
                        }
                    }//fin control numero de registros resumens



                    $response->Message = 'Se han cargado ' . $totalDetallesGuardados . ' registros detalles correctamente.\n';
                    $response->Message = 'Se han cargado ' . $totalResumenGuardados . ' registros resumen correctamente.';
                    $response->Message = '\n\nSe han omitido ' . $totalDetallesOmitidos . ' detalles y ' . $totalResumenOmitidos . ' resumen omitidos.';
                } else {
                    $response->Message = 'No existen registros para guardar';
                    $response->Status = NOTICE;
                }
            }
        } catch (Exception $e) {
            $response->Message = 'Se ha producido un error';
            $response->Status = ERROR;
            $response->ClassMessage = CLASS_MENSAJE_ERROR;
        }

        $this->actionResponse(null, null, $response);
        return;
    }

    public function actionVerDatosArchivo() {
//        if (!Yii::app()->request->isAjaxRequest) {
//            $error['message'] = Yii::app()->params['msjErrorAccesoPag'];
//            $error['code'] = Yii::app()->params['codErrorAccesoPag'];
//            $this->render(Yii::app()->params['pagError'], $error);
//        }
//
//        $response = new Response();
//        try {
//            $response->Result = $_SESSION['indicadorItems'];
//            unset($_SESSION['indicadorItems']);
//        } catch (Exception $e) {
//            $mensaje = array(
//                'code' => $e->getCode(),
//                'error' => $e->getMessage(),
//                'file' => $e->getFile(),
//                'line' => $e->getLine()
//            );
//
//            $response->Message = Yii::app()->params['mensajeExcepcion'];
//            $response->Status = ERROR;
//        }
//
//        $this->actionResponse(null, null, $response);
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

    public function actionGenerateExcel() {
        $response = new Response();
        try {
            $revisionRuta = array();
            $datos = $_SESSION['detallerevisionhistorialitem']; // $_SESSION['historialitem'];
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
