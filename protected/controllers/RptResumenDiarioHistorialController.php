<?php

/**
 * Description
 * @fecha 
 * @author 
 */
class RptResumenDiarioHistorialController extends Controller {

    public function actionIndex() {
        Yii::app()->user->setFlash('resultadoGuardar', null);
        if (Yii::app()->request->isAjaxRequest) {
            return;
        } else {
            Yii::app()->session['RptResumenDiarioHistorialForm'] = '';
            $model = new RptResumenDiarioHistorialForm();
            $this->render('/reportes/rptResumenDiarioHistorial', array('model' => $model));
        }
    }

    public function actionRevisarHistorial() {
        $response = new Response();
        try {
            $solicitarLogin = true;
            if (Yii::app()->user->id <> intval(USUARIO_INVITADO)) {
                $solicitarLogin = false;
                $model = new RptResumenDiarioHistorialForm();
                if (isset($_POST['RptResumenDiarioHistorialForm'])) {
                    $model->attributes = $_POST['RptResumenDiarioHistorialForm'];
                    $_SESSION['ModelForm'] = $model;
                    Yii::app()->session['ModelForm'] = $model;

                    if ($model->validate()) {
                        $fLibreria = new Libreria();
                        $response = $fLibreria->VerificarHistorialDiarioUsuario(
                                $model->ejecutivo
                                , $model->fechagestion
                                , $model->accionHistorial
                                , $model->horaInicioGestion
                                , $model->horaFinGestion
                                , $model->precisionVisitas);
                    } else {
                        $response->Message = "Debe seleccionar todos los filtros";
                        $response->ClassMessage = CLASS_MENSAJE_NOTICE;
                    }
                }
            }
        } catch (Exception $e) {
            $response->Message = Yii::app()->params['mensajeExcepcion'];
            $response->Status = ERROR;
            $response->ClassMessage = CLASS_MENSAJE_ERROR;
        }
        if ($solicitarLogin) {
            Yii::app()->user->setFlash('resultadoGuardar', "Por favor inicie sesion para continuar");
            $returnUri = '/' . SISTEMA . '/cruge/ui/login';
            Yii::app()->clientScript->registerMetaTag("" . INTERVALO_REFRESCO_INMEDIATO . ";url={$returnUri}", null, 'refresh');
//            $this->render('/historialmb/rptResumenDiarioHistorial', array('model' => $model));
        } else {
            $this->actionResponse(null, null, $response);
        }
//        $this->actionResponse(null, $model, $response);
        return;
    }

    public function actionGuardarRevision() {
        $response = new Response();

        $model = new RptResumenDiarioHistorialForm();

        $datosDetalleRevisionDiarioGuardar = array();
        $totalDetallesGuardados = 0;
        $totalDetallesOmitidos = 0;

        $datosResumenRevisionDiarioGuardar = array();
        $totalResumenGuardados = 0;
        $totalResumenOmitidos = 0;

        $datosComentarioOficina = array();
        $datosComentarioSupervisor = array();
        $mensaje = '';
        try {
            $solicitarLogin = true;
            if (Yii::app()->user->id <> intval(USUARIO_INVITADO)) {
                $solicitarLogin = false;
                if (isset(Yii::app()->session['detallerevisionhistorialitem']) && isset(Yii::app()->session['resumenrevisionhistorialitem'])) {

//                var_dump(Yii::app()->session['ModelForm']);die();
                    $fechagestion = Yii::app()->session['ModelForm']['fechagestion'];
                    $ejecutivo = Yii::app()->session['ModelForm']['ejecutivo'];
                    $precisionVisita = Yii::app()->session['ModelForm']['precisionVisitas'];
                    $comentarioSupervisor = $_POST['RptResumenDiarioHistorialForm']['comentarioSupervision'];
                    $enlaceMapa = $_POST['RptResumenDiarioHistorialForm']['enlaceMapa'];

                    $model->fechagestion = $fechagestion;
                    $model->ejecutivo = $ejecutivo;
//                $model->
//                $model->horaFinGestion=Yii::app()->session['ModelForm']['fechagestion']
//                var_dump($comentarioSupervisor);die();

                    /* VERIFICACION PARA ELIMINACION DE REGISTROS DE RESUMEN HISTORIAL */
                    $consultasResumenDH = new FResumenDiarioHistorialModel();
                    $cantidadRegistrosResumen = intval($consultasResumenDH->getCantidadResumenxVendedorxFecha($fechagestion, $ejecutivo)[0]['registrosResumen']);
                    $registrosIguales = $consultasResumenDH->getItemResumenxVendedorxFecha($fechagestion, $ejecutivo);
                    if ($cantidadRegistrosResumen > 0) {
                        foreach ($registrosIguales as $itemBorrar) {
                            $existeBdd = ResumenHistorialDiarioModel::model()->findByAttributes(
                                    array(
                                        'rhd_fecha_historial' => $itemBorrar['rhd_fecha_historial'],
                                        'rhd_cod_ejecutivo' => $itemBorrar['rhd_cod_ejecutivo']
                                    )
                            );
                            if (isset($existeBdd)) {
                                $existeBdd->delete();
                            }
                        }
                    }

                    /* GUARDAR DATOS RESUMEN REVISION */
                    $datosResumenRevisionHistorial = Yii::app()->session['resumenrevisionhistorialitem'];
                    if (count($datosResumenRevisionHistorial) > 0) {
                        foreach ($datosResumenRevisionHistorial as $row) {
                            $data = array(
                                'rhd_cod_ejecutivo' => ($row['EJECUTIVO'] == '') ? -1 : $row['EJECUTIVO'],
                                'rhd_fecha_historial' => ($row['FECHA_HISTORIAL'] == '') ? null : $row['FECHA_HISTORIAL'],
                                'rhd_parametro' => ($row['PARAMETRO'] == '') ? null : $row['PARAMETRO'],
                                'rhd_valor' => ($row['VALOR'] == '') ? 0 : $row['VALOR'],
                                'rhd_semana' => ($row['SEMANA'] == '') ? 0 : $row['SEMANA'],
//                                'rhd_observacion_supervisor' => (strlen(trim($comentarioSupervisor)) > 0) ? 'Comentario no ingresado' : trim($comentarioSupervisor),
                                'rhd_usuario_supervisor' => Yii::app()->user->id,
                                'rhd_fecha_ingreso_observacion' => date(FORMATO_FECHA_LONG),
                                'rhd_fecha_modifica_observacion' => date(FORMATO_FECHA_LONG),
                                'rhd_fecha_ingreso' => date(FORMATO_FECHA_LONG),
                                'rhd_fecha_modificacion' => date(FORMATO_FECHA_LONG),
                                'rhd_usuario_ingresa_modifica' => Yii::app()->user->id
                            );
                            array_push($datosResumenRevisionDiarioGuardar, $data);
                            unset($data);
                        }// fin iteracion filas resumen revision
                        if (count($datosResumenRevisionDiarioGuardar) > 0) {
                            $dbConnection = new CI_DB_active_record(null);
                            $sql = $dbConnection->insert_batch('tb_resumen_historial_diario', $datosResumenRevisionDiarioGuardar);
                            $sql = str_replace('"', '', $sql);
                            $connection = Yii::app()->db_conn;
                            $connection->active = true;
                            $transaction = $connection->beginTransaction();
                            $command = $connection->createCommand($sql);
                            $countInsertResumen = $command->execute();
                            if ($countInsertResumen > 0) {
                                $transaction->commit();
                                $totalResumenGuardados = $countInsertResumen;
                            } else {
                                $transaction->rollback();
                                $totalResumenOmitidos += 1;
                            }
                            unset($datosResumenRevisionDiarioGuardar);
                            $connection->active = false;
                        }

                        if ($totalResumenGuardados > 0)
                            $mensaje .= '<br>Se han guardado ' . $totalResumenGuardados . ' registros resumen correctamente.';
                        if ($totalResumenOmitidos > 0)
                            $mensaje .= '<br>Se han omitido ' . $totalResumenOmitidos . ' resumenes.';
                    }

                    /* VERIFICACION PARA ELIMINACION DE REGISTROS DE DETALLE HISTORIAL */
                    $consultasDetalleDH = new FDetalleDiarioHistorialModel();
                    $cantidadRegistrosDetalle = intval($consultasDetalleDH->getCantidadDetallexVendedorxFecha($fechagestion, $ejecutivo)[0]['registrosDetalle']);
                    $registrosIgualesDetalle = $consultasDetalleDH->getItemDetallexVendedorxFecha($fechagestion, $ejecutivo);
                    if ($cantidadRegistrosDetalle > 0) {
                        foreach ($registrosIgualesDetalle as $itemBorrar) {
                            $existeBdd = DetalleHistorialDiarioModel::model()->findByAttributes(
                                    array(
                                        'rh_fecha_ruta' => $itemBorrar['rh_fecha_ruta'],
                                        'rh_codigo_vendedor' => $itemBorrar['rh_codigo_vendedor']
                            ));
                            if (isset($existeBdd)) {
                                $existeBdd->delete();
                            }
                        }
                    }

                    /* GUARDAR DATOS DETALLE REVISION */
                    $datosDetalleRevisionHistorial = Yii::app()->session['detallerevisionhistorialitem'];
                    if (count($datosDetalleRevisionHistorial) > 0) {
                        foreach ($datosDetalleRevisionHistorial as $row) {
                            $data = array(
                                'rh_fecha_item' => ($row['FECHARUTA'] == '') ? null : $row['FECHARUTA'],
                                'rh_fecha_revision' => ($row['FECHAREVISION'] == '') ? null : $row['FECHAREVISION'],
                                'rh_fecha_ruta' => ($row['FECHARUTA'] == '') ? null : $row['FECHARUTA'],
                                'rh_codigo_vendedor' => ($row['CODEJECUTIVO'] == '') ? null : $row['CODEJECUTIVO'],
                                'rh_cod_cliente' => ($row['CODIGOCLIENTE'] == '') ? null : $row['CODIGOCLIENTE'],
                                'rh_cliente' => ($row['CLIENTE'] == '') ? null : $row['CLIENTE'],
                                'rh_ruta_visita' => ($row['RUTAUSADA'] == '') ? null : $row['RUTAUSADA'],
                                'rh_orden_visita' => ($row['SECUENCIAVISITA'] == '') ? null : $row['SECUENCIAVISITA'],
                                'rh_ruta_ejecutivo' => ($row['RUTACLIENTE'] == '') ? null : $row['RUTACLIENTE'],
                                'rh_secuencia_ruta' => ($row['SECUENCIARUTA'] == '') ? null : $row['SECUENCIARUTA'],
                                'rh_observacion_ruta' => ($row['ESTADOREVISIONR'] == '') ? null : $row['ESTADOREVISIONR'],
                                'rh_observacion_secuencia' => ($row['ESTADOREVISIONS'] == '') ? null : $row['ESTADOREVISIONS'],
                                'rh_chips_compra' => ($row['CHIPSCOMPRADOS'] == '') ? null : $row['CHIPSCOMPRADOS'],
                                'rh_metros' => ($row['METROS'] == '') ? null : $row['METROS'],
                                'rh_validacion' => ($row['VALIDACION'] == '') ? null : $row['VALIDACION'],
                                'rh_precision' => ($precisionVisita == '') ? 0 : $precisionVisita,
                                'rh_latitud_cliente' => ($row['LATITUDC'] == '') ? null : $row['LATITUDC'],
                                'rh_longitud_cliente' => ($row['LONGITUDC'] == '') ? null : $row['LONGITUDC'],
                                'rh_latitud_historial' => ($row['LATITUDH'] == '') ? null : $row['LATITUDH'],
                                'rh_longitud_historial' => ($row['LONGITUDH'] == '') ? null : $row['LONGITUDH'],
                                'rh_estado' => 'INGRESADO',
                                'rh_fecha_ingreso' => date(FORMATO_FECHA_LONG),
                                'rh_fecha_modificacion' => date(FORMATO_FECHA_LONG),
                                'rh_usuario_revisa' => Yii::app()->user->id
                            );
                            array_push($datosDetalleRevisionDiarioGuardar, $data);
                            unset($data);
                        }// fin iteracion filas detalle revision

                        if (count($datosDetalleRevisionDiarioGuardar) > 0) {
                            $dbConnection = new CI_DB_active_record(null);
                            $sql = $dbConnection->insert_batch('tb_detalle_historial_diario', $datosDetalleRevisionDiarioGuardar);
                            $sql = str_replace('"', '', $sql);
                            $connection = Yii::app()->db_conn;
                            $connection->active = true;
                            $transaction = $connection->beginTransaction();
                            $command = $connection->createCommand($sql);
                            $countInsertDetalles = $command->execute();
                            if ($countInsertDetalles > 0) {
                                $transaction->commit();
                                $totalDetallesGuardados = $countInsertDetalles;
                            } else {
                                $transaction->rollback();
                                $totalDetallesOmitidos += 1;
                            }
                            unset($datosDetalleRevisionDiarioGuardar);
                            $connection->active = false;
                        }

                        if ($totalDetallesGuardados > 0)
                            $mensaje .= '<br>Se han cargado ' . $totalDetallesGuardados . ' registros detalles correctamente.';
                        if ($totalDetallesOmitidos > 0)
                            $mensaje .= '<br>Se han omitido ' . $totalDetallesOmitidos . ' detalles omitidos.';
                    }

                    /* VERIFICACION PARA ELIMINACION DE COMENTARIOS SUPERVIDOR */
                    if (strlen($comentarioSupervisor) > 0) {
                        $existeComentarioSupervisor = ComentarioSupervisionModel::model()->findByAttributes(
                                array(
                                    'cs_fecha_historial_supervisado' => $fechagestion,
                                    'cs_ejecutivo_supervisado' => $ejecutivo,
                                    'cs_estado' => 1)
                        );

//                    if (isset($existeComentarioSupervisor)) {
//                        $existeComentarioSupervisor->cs_estado = 0;
//                        $existeComentarioSupervisor->cs_fecha_modificacion = date(FORMATO_FECHA_LONG);
//                        $existeComentarioSupervisor->cs_usuario_ingresa_modifica = Yii::app()->user->id;
//
//                        $existeComentarioSupervisor->save();
//                        var_dump(2);die();
//                    }
                        /* GUARDAR DATOS COMENTARIO SUPERVISOR */
                        $dataComentarioSupervisor = array(
                            'cs_fecha_historial_supervisado' => $fechagestion,
                            'cs_ejecutivo_supervisado' => $ejecutivo,
                            'cs_comentario' => $comentarioSupervisor,
                            'cs_estado' => 1,
                            'cs_fecha_ingreso' => date(FORMATO_FECHA_LONG),
                            'cs_fecha_modificacion' => date(FORMATO_FECHA_LONG),
                            'cs_usuario_ingresa_modifica' => Yii::app()->user->id
                        );
                        array_push($datosComentarioSupervisor, $dataComentarioSupervisor);
                        unset($dataComentarioSupervisor);
                        $dbConnection = new CI_DB_active_record(null);
                        $sql = $dbConnection->insert_batch('tb_comentario_supervision', $datosComentarioSupervisor);
                        $sql = str_replace('"', '', $sql);
//                    var_dump($sql);die();
                        $connection = Yii::app()->db_conn;
                        $connection->active = true;
                        $transaction = $connection->beginTransaction();
                        $command = $connection->createCommand($sql);
                        $countadorInsertComentarioSupervisor = $command->execute();
                        if ($countadorInsertComentarioSupervisor > 0) {
                            $transaction->commit();
                        } else {
                            $transaction->rollback();
                        }
                        unset($datosComentarioSupervisor);
                        $connection->active = false;
                    }

                    /* VERIFICACION PARA ELIMINACION DE COMENTARIOS OFICINA (ENLACE MAPA) */
                    if (strlen($enlaceMapa) > 0) {
                        $existeComentarioOficina = ComentarioOficinaModel::model()->findByAttributes(
                                array(
                                    'co_fecha_historial_revisado' => $fechagestion,
                                    'co_ejecutivo_revisado' => $ejecutivo,
                                    'co_tipo_comentario' => TIPOCOMENTARIOENLACEMAPA, //'Enlace Mapa',
                                    'co_estado' => 1
                        ));
                        /* GUARDAR DATOS COMENTARIO OFICINA */
                        $dataComentarioOficina = array(
                            'co_fecha_historial_revisado' => $fechagestion,
                            'co_ejecutivo_revisado' => $ejecutivo,
                            'co_enlace_mapa' => $enlaceMapa,
                            'co_estado' => 1,
                            'co_tipo_comentario' => TIPOCOMENTARIOENLACEMAPA,
                            'co_fecha_ingreso' => date(FORMATO_FECHA_LONG),
                            'co_fecha_modificacion' => date(FORMATO_FECHA_LONG),
                            'co_usuario_ingresa_modifica' => Yii::app()->user->id
                        );
                        array_push($datosComentarioOficina, $dataComentarioOficina);
                        unset($dataComentarioOficina);

                        $dbConnection = new CI_DB_active_record(null);
                        $sql = $dbConnection->insert_batch('tb_comentario_oficina', $datosComentarioOficina);
                        $sql = str_replace('"', '', $sql);
//                    var_dump($sql);                    die();
                        $connection = Yii::app()->db_conn;
                        $connection->active = true;
                        $transaction = $connection->beginTransaction();
                        $command = $connection->createCommand($sql);
                        $countadorInsertComentarioOficina = $command->execute();
                        if ($countadorInsertComentarioOficina > 0) {
                            $transaction->commit();
                        } else {
                            $transaction->rollback();
                        }
//                    var_dump($countadorInsertComentarioSupervisor);die();
//                    $mensaje .= "<br>Se guardo " . $countadorInsertComentarioOficina . " comentarios oficina";
                        unset($datosComentarioOficina);
                        $connection->active = false;
                    }
                } else {
                    $mensaje = 'No existen registros para guardar';
                }
            }
//            else {                $solicitarLogin = true;            }
        } catch (Exception $e) {
            $mensaje = 'Se ha producido un error al guardar los registros';
        }
        if ($solicitarLogin) {
            Yii::app()->user->setFlash('resultadoGuardar', "Por favor inicie sesion para continuar");
            $returnUri = '/' . SISTEMA . '/cruge/ui/login';
            Yii::app()->clientScript->registerMetaTag("" . INTERVALO_REFRESCO_INMEDIATO . ";url={$returnUri}", null, 'refresh');
        } else {
            Yii::app()->user->setFlash('resultadoGuardar', $mensaje);
            $returnUri = '/sisven/RptResumenDiarioHistorial/';
//        Yii::app()->clientScript->registerMetaTag("" . INTERVALO_REFRESCO_AUTOMATICO . ";url={$returnUri}", null, 'refresh');
            $this->render('/historialmb/rptResumenDiarioHistorial', array('model' => $model));
        }
        return;
    }

    public function actionModificarComentarioSupervisor() {
//        var_dump($_POST);        die();
        $model = new RptResumenDiarioHistorialForm();

        $datosDetalleRevisionDiarioGuardar = array();
        $totalDetallesGuardados = 0;
        $totalDetallesOmitidos = 0;

        $datosResumenRevisionDiarioGuardar = array();
        $totalResumenGuardados = 0;
        $totalResumenOmitidos = 0;
        $mensaje = '';
        try {
            if (count($datosDetalleRevisionHistorial) > 0) {
                foreach ($datosDetalleRevisionHistorial as $row) {
                    $data = array(
                        'rh_fecha_item' => ($row['FECHARUTA'] == '') ? null : $row['FECHARUTA'],
                        'rh_fecha_revision' => ($row['FECHAREVISION'] == '') ? null : $row['FECHAREVISION'],
                        'rh_fecha_ruta' => ($row['FECHARUTA'] == '') ? null : $row['FECHARUTA'],
                        'rh_codigo_vendedor' => ($row['CODEJECUTIVO'] == '') ? null : $row['CODEJECUTIVO'],
                        'rh_cod_cliente' => ($row['CODIGOCLIENTE'] == '') ? null : $row['CODIGOCLIENTE'],
                        'rh_cliente' => ($row['CLIENTE'] == '') ? null : $row['CLIENTE'],
                        'rh_ruta_visita' => ($row['RUTAUSADA'] == '') ? null : $row['RUTAUSADA'],
                        'rh_orden_visita' => ($row['SECUENCIAVISITA'] == '') ? null : $row['SECUENCIAVISITA'],
                        'rh_ruta_ejecutivo' => ($row['RUTACLIENTE'] == '') ? null : $row['RUTACLIENTE'],
                        'rh_secuencia_ruta' => ($row['SECUENCIARUTA'] == '') ? null : $row['SECUENCIARUTA'],
                        'rh_observacion_ruta' => ($row['ESTADOREVISIONR'] == '') ? null : $row['ESTADOREVISIONR'],
                        'rh_observacion_secuencia' => ($row['ESTADOREVISIONS'] == '') ? null : $row['ESTADOREVISIONS'],
                        'rh_chips_compra' => ($row['CHIPSCOMPRADOS'] == '') ? null : $row['CHIPSCOMPRADOS'],
                        'rh_metros' => ($row['METROS'] == '') ? null : $row['METROS'],
                        'rh_validacion' => ($row['VALIDACION'] == '') ? null : $row['VALIDACION'],
                        'rh_precision' => ($precisionVisita == '') ? 0 : $precisionVisita,
                        'rh_latitud_cliente' => ($row['LATITUDC'] == '') ? null : $row['LATITUDC'],
                        'rh_longitud_cliente' => ($row['LONGITUDC'] == '') ? null : $row['LONGITUDC'],
                        'rh_latitud_historial' => ($row['LATITUDH'] == '') ? null : $row['LATITUDH'],
                        'rh_longitud_historial' => ($row['LONGITUDH'] == '') ? null : $row['LONGITUDH'],
                        'rh_estado' => 'INGRESADO',
                        'rh_fecha_ingreso' => date(FORMATO_FECHA_LONG),
                        'rh_fecha_modificacion' => date(FORMATO_FECHA_LONG),
                        'rh_usuario_revisa' => Yii::app()->user->id
                    );
                    array_push($datosDetalleRevisionDiarioGuardar, $data);
                    unset($data);
                }// fin iteracion filas detalle revision

                if (count($datosDetalleRevisionDiarioGuardar) > 0) {
                    $dbConnection = new CI_DB_active_record(null);
                    $sql = $dbConnection->insert_batch('tb_detalle_historial_diario', $datosDetalleRevisionDiarioGuardar);
                    $sql = str_replace('"', '', $sql);
                    $connection = Yii::app()->db_conn;
                    $connection->active = true;
                    $transaction = $connection->beginTransaction();
                    $command = $connection->createCommand($sql);
                    $countInsertDetalles = $command->execute();
                    if ($countInsertDetalles > 0) {
                        $transaction->commit();
                        $totalDetallesGuardados = $countInsertDetalles;
                    } else {
                        $transaction->rollback();
                        $totalDetallesOmitidos += 1;
                    }
                    unset($datosDetalleRevisionDiarioGuardar);
                    $connection->active = false;
                }

                if ($totalDetallesGuardados > 0)
                    $mensaje .= '<br>Se han cargado ' . $totalDetallesGuardados . ' registros detalles correctamente.';
                if ($totalDetallesOmitidos > 0)
                    $mensaje .= '<br>Se han omitido ' . $totalDetallesOmitidos . ' detalles omitidos.';
            }
        } catch (Exception $e) {
            $mensaje = 'Se ha producido un error al guardar los registros';
        }
        Yii::app()->user->setFlash('resultadoModificarComentarioSupervisor', 'modificador');
        $returnUri = '/sisven/RptResumenDiarioHistorial/';
        Yii::app()->clientScript->registerMetaTag("" . INTERVALO_REFRESCO_AUTOMATICO . ";url={$returnUri}", null, 'refresh');
        $this->render('/historialmb/rptResumenDiarioHistorial', array('model' => $model));
        return;
    }

    private function actionResponse($view = 'error', $model = null, $response = null) {
        if (Yii::app()->request->isAjaxRequest) {
            echo json_encode($response);
        } else {
            $this->render($view, $model);
        }
    }

    public function actionGenerateExcel() {
        $response = new Response();
        try {

            $revisionRuta = array();
            $datos = Yii::app()->session['detallerevisionhistorialitem'];
            foreach ($datos as $value) {
                $dat = array(
//                    'FECHAREVISION' => $value['FECHAREVISION'],
                    'FECHARUTA' => $value['FECHARUTA'],
                    'EJECUTIVO' => $value['EJECUTIVO'],
                    'CODIGOCLIENTE' => $value['CODIGOCLIENTE'],
                    'CLIENTE' => $value['CLIENTE'],
                    'RUTAUSADA' => $value['RUTAUSADA'],
                    'SECUENCIAVISITA' => $value['SECUENCIAVISITA'],
                    'RUTACLIENTE' => $value['RUTACLIENTE'],
                    'SECUENCIARUTA' => $value['SECUENCIARUTA'],
                    'ESTADOREVISIONR' => $value['ESTADOREVISIONR'],
                    'ESTADOREVISIONS' => $value['ESTADOREVISIONS'],
                    'CHIPSCOMPRADOS' => $value['CHIPSCOMPRADOS'],
                    'METROS' => $value['METROS'],
                    'VALIDACION' => $value['VALIDACION'],
                    'LATITUD_CLIENTE' => $value['LATITUDC'],
                    'LONGITUD_CLIENTE' => $value['LONGITUDC'],
                    'LATITUD_VISITA' => $value['LATITUDH'],
                    'LONGITUD_VISITA' => $value['LONGITUDH'],
                );
                array_push($revisionRuta, $dat);
            }

            $NombreArchivo = "reporte_detalle_revision_ruta";
            $NombreHoja = "reporte_detalle_revision_ruta";

            $autor = "Tececab"; //$_SESSION['CUENTA'];
            $titulo = "reporte_detalle_revision_ruta";
            $tema = "reporte_detalle_revision_ruta";
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

    public function actionGenerateExcelResumen() {
        $response = new Response();
        try {
            $revisionRuta = array();
            $datosResumenDiario = Yii::app()->session['resumenrevisionhistorialitem'];
            $datosPrimeraUltima = Yii::app()->session['resumenPrimeraUltima'];

            foreach ($datosResumenDiario as $value) {
                $dat = array(
                    'PARAMETRO' => $value['PARAMETRO'],
                    'VALOR' => $value['VALOR'],
                    'FECHA_GESTION' => strval(Yii::app()->session['ModelForm']['fechagestion']),
                    'EJECUTIVO' => strval(Yii::app()->session['ModelForm']['ejecutivo'])
                );
                array_push($revisionRuta, $dat);
            }
            foreach ($datosPrimeraUltima as $filaGrid) {
//                var_dump($key );die();
                $dat = array(
                    'PARAMETRO' => $filaGrid["VISITA"],
                    'VALOR' => $filaGrid["CANTIDAD"],
                    'FECHA_GESTION' => strval(Yii::app()->session['ModelForm']['fechagestion']),
                    'EJECUTIVO' => strval(Yii::app()->session['ModelForm']['ejecutivo'])
                );
                array_push($revisionRuta, $dat);
            }

            $NombreArchivo = "reporte_resumen_revision_ruta";
            $NombreHoja = "reporte_resumen_revision_ruta";

            $autor = "Tececab"; //$_SESSION['CUENTA'];
            $titulo = "reporte_resumen_revision_ruta";
            $tema = "reporte_resumen_revision_ruta";
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

    public function actionGenerateExcelNoVisitados() {
        $response = new Response();
        try {
            $clientesNoVisitados = array();
            $fRuta = new FRutaModel();
            $filtros = array();
            $filtros = Yii::app()->session['ModelForm'];
            if ($filtros) {
                $ejecutivo = EjecutivoModel::model()->findAllByAttributes(array('e_usr_mobilvendor' => $filtros['ejecutivo']));
                $diaGestion = date("w", strtotime($filtros['fechagestion']));
                $ruta_dia_gestion = "R" . $diaGestion . '-' . $ejecutivo[0]['e_iniciales'];
                $fRutaA = $fRuta->getClientesNoVisitadosxRutaxEjecutivoxDia($filtros['ejecutivo'], $ruta_dia_gestion, $diaGestion + 1, $filtros['fechagestion'], $filtros['accionHistorial']);

                foreach ($fRutaA as $clienteNoVisitado) {
                    $dat = array(
                        'FECHA_GESTION' => $filtros['fechagestion'],
                        'RUTA' => $ruta_dia_gestion,
                        'CODIGO EJECUTIVO' => $ejecutivo[0]['e_usr_mobilvendor'],
                        'EJECUTIVO' => $ejecutivo[0]['e_nombre'],
                        'COD_CLIENTE' => $clienteNoVisitado['r_cod_cliente'],
                        'NOMBRE CLIENTE' => $clienteNoVisitado['r_nom_cliente']
                    );
                    array_push($clientesNoVisitados, $dat);
                }

                $NombreArchivo = "clientes_no_visitados";
                $NombreHoja = "clientes_no_visitados";

                $autor = "Tececab"; //$_SESSION['CUENTA'];
                $titulo = "clientes_no_visitados";
                $tema = "clientes_no_visitados";
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

                $excel->Mapeo($clientesNoVisitados);

                $excel->CrearArchivo('Excel2007', $NombreArchivo);
                $excel->GuardarArchivo();
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
        return;
    }

    public function actionGenerateExcelTiemposGestion() {
        $response = new Response();
        try {
            $filtros = array();
            $filtros = Yii::app()->session['ModelForm'];

            if ($filtros) {
                $ejecutivo = EjecutivoModel::model()->findAllByAttributes(array('e_usr_mobilvendor' => $filtros['ejecutivo']));

                $detalleTiemposGestion = array();
                $detalleGestionEjecutivo = Yii::app()->session['tiemposGestionEjecutivo'];
                foreach ($detalleGestionEjecutivo as $item) {
                    $dat = array(
                        'FECHA_GESTION' => $item["FECHA_GESTION"],
                        'CODIGO_CLIENTE' => $item["CODIGO_CLIENTE"],
                        'NOMBRE_CLIENTE' => $item["CLIENTE"],
                        'RUTA' => $item["RUTA"],
                        'INICIO_VISITA' => $item["INICIO_VISITA"],
                        'FIN_VISITA' => $item["FIN_VISITA"],
                        'TIEMPO_GESTION' => $item["T_GESTION"],
                        'TIEMPO_TRASLADO' => $item["T_TRASLADO"],
                        'DISTANCIA_EJE_CLIENTE' => $item["DISTANCIA_EJECUTIVO_CLIENTE"],
                        'DISTANCIA_CLIENTES' => $item["DISTANCIA_CLIENTES"],
                    );
                    array_push($detalleTiemposGestion, $dat);
                }
                $columnasCentrar = array();
                array_push($columnasCentrar, array('NUMCOLUMNA' => '3')); #RUTA
                array_push($columnasCentrar, array('NUMCOLUMNA' => '4')); #INICIO_VISITA
                array_push($columnasCentrar, array('NUMCOLUMNA' => '5')); #FIN_VISITA
                array_push($columnasCentrar, array('NUMCOLUMNA' => '6')); #T_GESTION
                array_push($columnasCentrar, array('NUMCOLUMNA' => '7')); #T_TRASLADO
                array_push($columnasCentrar, array('NUMCOLUMNA' => '8')); #DISTANCIA_CLIENTE_SUP
                array_push($columnasCentrar, array('NUMCOLUMNA' => '9')); #DISTANCIA_CLIENTES
                $NombreArchivo = "tiempos_gestion_ejecutivo";
                $NombreHoja = "tiempos_gestion_ejecutivo";

                $autor = "Tececab"; //$_SESSION['CUENTA'];
                $titulo = "tiempos_gestion_ejecutivo";
                $tema = "tiempos_gestion_ejecutivo";
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

                $encabezadoImprimir = 'DETALLE GESTION  ' . $filtros['fechagestion'] . ' - ' . $ejecutivo[0]['e_nombre'];
                $footerImprimir = Yii::app()->user->name . ' - ' . date('Y/m/d h:i A');

                $excel->Mapeo($detalleTiemposGestion, $encabezadoImprimir, $footerImprimir, $columnasCentrar);

                $excel->CrearArchivo('Excel2007', $NombreArchivo);
                $excel->GuardarArchivo();
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
        return;
    }

}
