<?php

class ReporteInicioFinJornadaxFechaController extends Controller {

    public function actionIndex() {
//        $solicitarLogin = true;
//        if (Yii::app()->user->id <> intval(USUARIO_INVITADO)) {
//        if (Yii::app()->user->id <> intval(USUARIO_INVITADO)) {
//            $solicitarLogin = false;

        if (Yii::app()->request->isAjaxRequest) {
            return;
        } else {
            $model = new ReporteInicioFinJornadaxFechaForm();
            $this->render('/reportes/rptInicioFinJornadaxFecha', array('model' => $model));
        }
//        }
//        var_dump($solicitarLogin);die();
//        if ($solicitarLogin) {
//            Yii::app()->user->setFlash('resultadoGuardar', "Por favor inicie sesion para continuar");
//            $returnUri = '/' . SISTEMA . '/cruge/ui/login';
//            Yii::app()->clientScript->registerMetaTag("" . INTERVALO_REFRESCO_INMEDIATO . ";url={$returnUri}", null, 'refresh');
//        } else {
//            $this->render('/reportes/rptInicioFinJornadaxFecha', array('model' => $model));
//        }
    }

    public function actionConsultarReporte() {
        $datosGrid = array();
        $datosGridJornada = array();
        $datosGridVisitas = array();
        $response = new Response();
        $solicitarLogin = true;
        $mensaje='';
        try {

            if (Yii::app()->user->id <> intval(USUARIO_INVITADO)) {
                $solicitarLogin = false;
                $model = new ReporteInicioFinJornadaxFechaForm();
                if (isset($_POST['ReporteInicioFinJornadaxFechaForm'])) {
                    $model->attributes = $_POST['ReporteInicioFinJornadaxFechaForm'];
                    if ($model->validate()) {
                        $grupoEjecutivos = '';
                        switch ($model['tipoUsuario']) {
                            case 1: $grupoEjecutivos = GRUPO_EJECUTIVOS_ZONA;
                                break;
                            case 2: $grupoEjecutivos = GRUPO_SUPERVISORES;
                                break;
                            case 3: $grupoEjecutivos = GRUPO_SERVICIO_CLIENTE;
                                break;
                            default:$grupoEjecutivos = GRUPO_TODOS;
                                break;
                        }
                        $cEjecutivos = new FEjecutivoModel();
                        $reporteModel = new ReportesModel();
                        $fRuta = new FRutaModel();
                        $fHistorial = new FHistorialModel();
                        $fComentarioSupervisor = new FComentariosSupervisionModel();
                        $fComentarioOficina = new FComentariosOficinaModel();

                        $accion = 'Inicio Visita';
//                        var_dump($grupoEjecutivos);die();
                        $ejecutivos = $cEjecutivos->getEjecutivosXGrupoXEstado($grupoEjecutivos, 1);
//                        var_dump($ejecutivos);die();
                        foreach ($ejecutivos as $ejecutivo) {
                            $cResumenDiarioHistorialMB = new FResumenDiarioHistorialModel();
                            $inicioJornadaEjecutivo = $reporteModel->getInicioJornadaxFecha($ejecutivo['e_usr_mobilvendor'], $model->fechaInicioFinJornadaInicio, $model->horaInicioGestion);
                            $finJornadaEjecutivo = $reporteModel->getFinJornadaxUsuarioxFecha($ejecutivo['e_usr_mobilvendor'], $model->fechaInicioFinJornadaInicio, $model->horaFinGestion);
//                        $cumplimientoEjecutivo = $cResumenDiarioHistorialMB->getCumplimientoxVendedorxFecha($model->fechaInicioFinJornadaInicio, $ejecutivo['e_usr_mobilvendor']);
//                        var_dump($inicioJornadaEjecutivo,$finJornadaEjecutivo);                        DIE();
//                        if (count($cumplimientoEjecutivo) == 0) {
//                            var_dump($ejecutivo);die();
                            $diaGestion = date("w", strtotime($model->fechaInicioFinJornadaInicio));
                            $ruta_dia_gestion = "R" . $diaGestion . '-' . $ejecutivo['e_iniciales'];
                            $comentarioDiaSupervisor = '';
                            $totalClientesRuta = $fRuta->getTotalClientesxRutaxEjecutivoxDia($ejecutivo['e_iniciales'], $diaGestion + 1)[0]["TOTALCLIENTES"];

                            $visitasValidasRuta = $fHistorial->getCantidadVisitasxEjecutivoxFecha($accion, $ejecutivo['e_usr_mobilvendor'], $model->fechaInicioFinJornadaInicio, $ruta_dia_gestion);

                            if (count($visitasValidasRuta) == 0) {
                                $cumplimientoEjecutivo = '0';
                            } else {
                                if ($totalClientesRuta > 0)
                                    $cumplimientoEjecutivo = ceil((intval($visitasValidasRuta[0]['visitas_en_ruta']) / $totalClientesRuta) * 100) . '%';
                                else
                                    $cumplimientoEjecutivo = 'NA';
                            }
                            $comentarioSupervision = $fComentarioSupervisor->getComentarioSupervisionxEjecutivoxFecha($ejecutivo['e_usr_mobilvendor'], $model->fechaInicioFinJornadaInicio);
                            $comentarioOficina = '';

                            if (isset($inicioJornadaEjecutivo[0]) > 0)
                                $entrada = new DateTime($inicioJornadaEjecutivo[0]["HORA"]);
                            else
                                $entrada = '00:00:00';

                            if (isset($finJornadaEjecutivo[0]) > 0)
                                $salida = new DateTime($finJornadaEjecutivo[0]["HORA"]);
                            else
                                $salida = '00:00:00';

                            $infoJornada = array(
                                'FECHA' => $model->fechaInicioFinJornadaInicio,
                                'EJECUTIVO' => $ejecutivo['e_nombre'],
                                'CUMPLIMIENTO' => $cumplimientoEjecutivo,
                                'INICIOPRIMERAVISITA' => (count($inicioJornadaEjecutivo) > 0) ? $entrada->format("H:i") : "00:00",
                                'FINALULTIMAVISITA' => (count($finJornadaEjecutivo) > 0) ? $salida->format("H:i") : "00:00",
                                'TIEMPOGESTION' => ((count($inicioJornadaEjecutivo) > 0) && (count($finJornadaEjecutivo) > 0)) ? $entrada->diff($salida)->format("%Hh %im") : "00:00",
                                'COMENTARIOS' => (isset($comentarioSupervision[0])) ? $comentarioSupervision[0]['cs_comentario'] : '',
                                'COMENTARIOO' => '',
                            );

                            array_push($datosGridJornada, $infoJornada);
                            unset($infoJornada);

                            $cantidad = $fHistorial->getCantidadClientesVisitadosxEjecutivoxFecha($ejecutivo['e_usr_mobilvendor'], $model->fechaInicioFinJornadaInicio);
//                        var_dump($cantidad['VISITAS']);die();
                            if ($cantidad['TODAS'] != 0) {
                                $infoVisitas = array(
                                    'EJECUTIVO' => $ejecutivo['e_nombre'],
                                    'VISITAS' => (isset($cantidad['VISITAS'])) ? intval($cantidad['VISITAS']) : 0,
                                    'VISITASDUPLICADAS' => (isset($cantidad['REPETIDAS'])) ? intval($cantidad['REPETIDAS']) : 0,
                                    'TOTALVISITAS' => (isset($cantidad['TODAS'])) ? intval($cantidad['TODAS']) : 0,
                                );

                                array_push($datosGridVisitas, $infoVisitas);
                                unset($infoVisitas);
                                $mensaje = "Detalle generado correctamente";
                            } else {
                                if ($model['tipoUsuario'] == 1) {
                                    $mensaje = "No ha realizado la revisión individual de los ejecutivos en la fecha seleccionada";
                                }
                            }
                        }
                    }

                    $datosGrid['infoJornada'] = $datosGridJornada;
                    $datosGrid['infoVisitas'] = $datosGridVisitas;
//                    var_dump($datosGrid);die();

                    $_SESSION['revisionJornada'] = $datosGrid;
                    Yii::app()->session['revisionJornada'] = $datosGridJornada;
                    $response->Message = $mensaje;
                    $response->Status = SUCCESS;
                    $response->Result = $datosGrid;
//                    var_dump($response);die();
                } else {
                    echo CActiveForm::validate($model);
                    Yii::app()->end();
                }
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
//        var_dump(Yii::app()->user->id);die();
//        var_dump($solicitarLogin);die();
        if ($solicitarLogin) {
            Yii::app()->user->setFlash('resultadoGuardar', "Por favor inicie sesion para continuar");
            $returnUri = '/' . SISTEMA . '/cruge/ui/login';
//            var_dump($returnUri);die();
            Yii::app()->clientScript->registerMetaTag("" . INTERVALO_REFRESCO_INMEDIATO . ";url={$returnUri}", null, 'refresh');
//            $this->render('/historialmb/rptResumenDiarioHistorial', array('model' => $model));
        } else {
//            $this->actionResponse(null, null, $response);
            $this->actionResponse(null, null, $response);
        }

        return;
    }

    public function actionGuardarRevision() {
        try {

            $solicitarLogin = true;
            if (Yii::app()->user->id <> intval(USUARIO_INVITADO)) {
                $solicitarLogin = false;
                $datosComentarioOficina = array();
                $respuestaActualizar = '';
                $response = new Response();
                $datosFilaGrid = $_POST;

                $fechaGestion = $datosFilaGrid['FECHA'];
                $ejecutivo = $datosFilaGrid['EJECUTIVO'];
                $comentarioOficina = $datosFilaGrid['COMENTARIOO'];

                if ($comentarioOficina != 'Seleccione una opcion') {
                    $existeComentarioOficina = ComentarioOficinaModel::model()->findByAttributes(
                            array(
                                'co_fecha_historial_revisado' => $fechaGestion,
                                'co_ejecutivo_revisado' => $ejecutivo,
                                'co_tipo_comentario' => TIPOCOMENTARIOJORNADA,
                                'co_estado' => 1
                    ));

                    if (isset($existeComentarioOficina)) {
                        $existeComentarioOficina->co_estado = 0;
                        if ($existeComentarioOficina->save())
                            $respuestaActualizar = 'Registro Anterior Actualizado';
                        else
                            $respuestaActualizar = 'Error al actualizar registro';
                    }
                    /* GUARDAR DATOS COMENTARIO OFICINA */
                    $dataComentarioOficina = array(
                        'co_fecha_historial_revisado' => $fechaGestion,
                        'co_ejecutivo_revisado' => $ejecutivo,
                        'co_estado' => 1,
                        'co_comentario' => $comentarioOficina,
                        'co_tipo_comentario' => TIPOCOMENTARIOJORNADA,
                        'co_fecha_ingreso' => date(FORMATO_FECHA_LONG),
                        'co_fecha_modificacion' => date(FORMATO_FECHA_LONG),
                        'co_usuario_ingresa_modifica' => Yii::app()->user->id
                    );
                    array_push($datosComentarioOficina, $dataComentarioOficina);
                    unset($dataComentarioOficina);

                    $dbConnection = new CI_DB_active_record(null);
                    $sql = $dbConnection->insert_batch('tb_comentario_oficina', $datosComentarioOficina);
                    $sql = str_replace('"', '', $sql);

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
                    unset($datosComentarioOficina);
                    $connection->active = false;
                }
                $response->Status = NOTICE;
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
        if ($solicitarLogin) {
            Yii::app()->user->setFlash('resultadoGuardar', "Por favor inicie sesion para continuar");
            $returnUri = '/' . SISTEMA . '/cruge/ui/login/';
//            var_dump($returnUri);die();
            Yii::app()->clientScript->registerMetaTag("" . INTERVALO_REFRESCO_INMEDIATO . ";url={$returnUri}", null, 'refresh');
        } else {
            $this->actionResponse(null, null, $response);
        }
        return;
    }

    public function actionGenerateExcel($startDate) {
        $datosGrid = array();
        $response = new Response();
        try {
            if (isset(Yii::app()->session['revisionJornada']) && count(Yii::app()->session['revisionJornada']) > 0) {
                $revisionJornadas = Yii::app()->session['revisionJornada'];
                foreach ($revisionJornadas as $item) {
//                    foreach ($items as $item) {
                    $infoJornadas = array(
                        'EJECUTIVO' => (isset($item['EJECUTIVO'])) ? $item['EJECUTIVO'] : '',
                        'CUMPLIMIENTO' => (isset($item['CUMPLIMIENTO'])) ? $item['CUMPLIMIENTO'] : '',
                        'INICIOPRIMERAVISITA' => (isset($item['INICIOPRIMERAVISITA'])) ? $item['INICIOPRIMERAVISITA'] : '',
                        'FINALULTIMAVISITA' => (isset($item['FINALULTIMAVISITA'])) ? $item['FINALULTIMAVISITA'] : '',
                        'TIEMPOGESTION' => (isset($item['TIEMPOGESTION'])) ? $item['TIEMPOGESTION'] : '',
                        'COMENTARIO SUPERVISOR' => (isset($item['COMENTARIOS'])) ? $item['COMENTARIOS'] : '',
                        'COMENTARIO OFICINA' => (isset($item['COMENTARIOO'])) ? $item['COMENTARIOO'] : '',
                    );
                    array_push($datosGrid, $infoJornadas);
                    unset($infoJornadas);
//                    }
                }
                $NombreArchivo = "reporte_inicio_fin_x_fecha";
                $NombreHoja = "reporte_inicio_fin_x_fecha";

                $autor = "Tececab"; //$_SESSION['CUENTA'];
                $titulo = "reporte_inicio_fin_x_fecha";
                $tema = "reporte_inicio_fin_x_fecha";
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
            } else {
                
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

    private function actionResponse($view = 'error', $model = null, $response = null) {
        if (Yii::app()->request->isAjaxRequest) {
            echo json_encode($response);
        } else {
            $this->render($view, $model);
        }
    }

    public function actionComentarRegistroJornada() {

        $response = new Response();
        $ordenModel = new FOrdenModel();
        var_dump($_POST);
        die();
//        $cantidad = $_POST['TOTALORDENES'];
//        $nuevaIvaBase = $cantidad;
//        $nuevaIvaValor = $cantidad * Yii::app()->params['ivadoce'];
//        $nuevoSubtotal = $cantidad;
//        $nuevoImpuestos = $cantidad * Yii::app()->params['ivadoce'];
//        $nuevoTotal = $cantidad * Yii::app()->params['ivaincdoce'];
//        $usuarioMod = Yii::app()->user->id;
//        $fechaMod = date(FORMATO_FECHA_LONG);
//
//        $respuestaActualizacion = $ordenModel->getActualizarOrden(
//                $_POST['CODIGOORDEN']
//                , $_POST['ORDEN']
//                , $nuevaIvaBase
//                , $nuevaIvaValor
//                , $nuevoSubtotal
//                , $nuevoImpuestos
//                , $nuevoTotal
//                , $usuarioMod
//                , $fechaMod);
//        if ($respuestaActualizacion > 0) {
//            $response->Message = 'Actualización correcta';
//            $response->Status = NOTICE;
//        } else {
//            $response->Message = 'Actualizacion fallida';
//            $response->Status = ERROR;
//        }
//        var_dump($respuestaActualizacion);        die();
        return;
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
