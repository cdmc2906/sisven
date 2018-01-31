<?php

class RevisarMinesController extends Controller {

    public $layout = LAYOUT_FILTRO_GRID;

    public function actionIndex() {
        Yii::app()->user->setFlash('resultadoGuardar', null);
        if (Yii::app()->request->isAjaxRequest) {
            return;
        } else {
            Yii::app()->session['RevisarMinesForm'] = '';
            $model = new RevisarMinesForm ();
            $this->render('/proceso/revisarMines', array('model' => $model));
        }
    }

    public function actionCargarMinesAsignados() {
        unset(Yii::app()->session['IDMINSELECCIONADO']);
        unset(Yii::app()->session['MINSELECCIONADO']);
        unset(Yii::app()->session['IMEISELECCIONADO']);

        $response = new Response();
        $fRevisionMines = new FMinesRevisionModel();
        $rutasAsignadas['minesAsignados'] = $fRevisionMines->getMinesxUsuario(Yii::app()->user->id);
        $rutasAsignadas['contador'] = $this->MostrarAvanceGestion();
        $response->Result = $rutasAsignadas;
        $this->actionResponse(null, null, $response);
        return;
    }

    private function MostrarAvanceGestion() {
        $avance = '';

        $fRMinesRevision = new FMinesRevisionModel();
        $cantidadAsignados = $fRMinesRevision->getCantidadMinesAsignadosxUsuario(Yii::app()->user->id);
        $cantidadGestionados = $fRMinesRevision->getCantidadMinesGestionadosxUsuario(Yii::app()->user->id);
//        var_dump($cantidadAsignados);        die();
        return $cantidadGestionados[0]['gestionados'] . '/' . intval($cantidadAsignados[0]['asignados']);
    }

    public function actionSetearFilaSeleccionada() {
        $response = new Response();
        Yii::app()->session['IDMINSELECCIONADO'] = $_POST['IDMIN'];
        Yii::app()->session['IMEISELECCIONADO'] = $_POST['IMEI'];
        Yii::app()->session['MINSELECCIONADO'] = $_POST['MIN'];
        $this->actionResponse(null, null, $response);
        return;
    }

    public function actionGuardarGestion() {

        try {
            $response = new Response();
            if (isset($_POST['RevisarMinesForm'])) {
                $model = new RevisarMinesForm();
                $model->attributes = $_POST['RevisarMinesForm'];
                Yii::app()->session['ModelForm'] = $model;
                $datosGestionadosMin = array();
                $datosMinesPorGestionar = array();
                $mensaje = '';
                $totalGuardados = 0;
                $totalOmitidos = 0;

                $validacionPreguntas = false;
                $decimal_incorrecto = false;

                if ($model->pregunta1 == 'Contactado') {
                    if ($model->validate()) {
//                        var_dump('ll');die();
                        if (floatval($model->pregunta4) > 0) {
                            $decimal_incorrecto = false;
                            $validacionPreguntas = true;
                        } else {
                            $validacionPreguntas = false;
                            $decimal_incorrecto = true;
                        }
                    } else {
                        $validacionPreguntas = false;
                        $decimal_incorrecto = false;
                    }
                } else {
                    if ($model->pregunta1a == '')
                        $validacionPreguntas = false;
                    else
                        $validacionPreguntas = true;
                }
                $_minGestionado = MinesValidacionModel::model()->findByAttributes(array('miva_id' => Yii::app()->session['IDMINSELECCIONADO']));
                $revisionAnteriorMin = RevisionMinesModel::model()->findByAttributes(array('rmva_icc' => $_minGestionado ['miva_imei']));
                $_revisionAnteriorMin = isset($revisionAnteriorMin) ? intval($revisionAnteriorMin['rmva_numero_revision']) + 1 : 1;

                $estadoRevision = '';
                if ($model->pregunta1 == 'No Contactado' && $model->pregunta1a == 'Inactivo')
                    $estadoRevision = 'Inactivo';
                else
                    $estadoRevision = 'Activo';

//                VALIDACION DATOS ANTES DE GUARDAR
                if (Yii::app()->session['IDMINSELECCIONADO']) {
                    if ($validacionPreguntas) {
                        $data = array(
                            'iduser' => Yii::app()->user->id,
                            'rmva_tipo' => '',
                            'rmva_numero_revision' => $_revisionAnteriorMin,
                            'rmva_estado_revision' => $estadoRevision,
                            'rmva_carga' => $_minGestionado["miva_carga"],
                            'rmva_min' => Yii::app()->session['MINSELECCIONADO'],
                            'rmva_icc' => Yii::app()->session['IMEISELECCIONADO'],
                            'rmva_fecha_gestion' => date(FORMATO_FECHA_LONG),
                            'rmva_resultado_llamad' => $model->pregunta1,
                            'rmva_motivo_no_contado' => $model->pregunta1a,
                            'rmva_operadora' => ($model->pregunta1a == 'Inactivo') ? 'Movistar' : $model->pregunta2,
                            'rmva_lugar_compra' => $model->pregunta3,
                            'rmva_precio' => $model->pregunta4,
                            'rmva_estado' => 1,
                            'rmva_fecha_ingreso' => date(FORMATO_FECHA_LONG),
                            'rmva_fecha_modifica' => date(FORMATO_FECHA_LONG),
                            'rmva_cod_usuario_ing_mod' => Yii::app()->user->id,
                        );
                        array_push($datosGestionadosMin, $data);
                        unset($data);

                        $dbConnection = new CI_DB_active_record(null);
                        $sql = $dbConnection->insert_batch('tb_revision_mines', $datosGestionadosMin);
                        $sql = str_replace('"', '', $sql);
                        $connection = Yii::app()->db_conn;
                        $connection->active = true;
                        $transaction = $connection->beginTransaction();
                        $command = $connection->createCommand($sql);
                        $countInsertResumen = $command->execute();

                        if ($countInsertResumen > 0) {
                            $transaction->commit();
                            $totalGuardados = $countInsertResumen;
                        } else {
                            $transaction->rollback();
                            $totalOmitidos += 1;
                        }

                        unset($datosGestionadosMin);
                        $connection->active = false;

                        if ($totalGuardados > 0) {
                            $_minGestionado = MinesValidacionModel::model()->findByAttributes(array('miva_id' => Yii::app()->session['IDMINSELECCIONADO']));
                            if (isset($_minGestionado)) {
                                if ($_minGestionado["miva_estado"] == 8)
                                    $_minGestionado["miva_estado"] = 9; //GESTIONADO
                                elseif ($_minGestionado["miva_estado"] == 13)
                                    $_minGestionado["miva_estado"] = 14; //REPROCESADO

                                if ($_minGestionado->save()) {
                                    $fRMinesRevision = new FMinesRevisionModel();
                                    $datosMinesPorGestionar['mines'] = $fRMinesRevision->getMinesxUsuario(Yii::app()->user->id);

                                    $mensaje = 'Se han guardado ' . $totalGuardados . ' registros';
                                    $response->ClassMessage = CLASS_MENSAJE_SUCCESS;
                                    $datosMinesPorGestionar['limpiar'] = true;
                                    $datosMinesPorGestionar['contador'] = $this->MostrarAvanceGestion();

                                    unset(Yii::app()->session['IDMINSELECCIONADO']);
                                    unset(Yii::app()->session['MINSELECCIONADO']);
                                    unset(Yii::app()->session['IMEISELECCIONADO']);
                                } else {
                                    $mensaje = 'No se pudo actualizar el estado de gestion del min';
                                    $response->ClassMessage = CLASS_MENSAJE_NOTICE;
                                    $datosMinesPorGestionar['limpiar'] = true;
                                }
                            } else {
                                $datosMinesPorGestionar['limpiar'] = false;
                                $mensaje = 'No se pudo actualizar el estado de gestion del min';
                                $response->ClassMessage = CLASS_MENSAJE_ERROR;
                            }
                        }
                        if ($totalOmitidos > 0) {
                            $datosMinesPorGestionar['limpiar'] = false;
                            $mensaje = 'Se han omitido ' . $totalOmitidos . ' registros';
                            $response->ClassMessage = CLASS_MENSAJE_NOTICE;
                        }
                    } else {
                        $mensaje = 'Tiene preguntas sin contestar';
                        if ($decimal_incorrecto)
                            $mensaje .= '<br>El valor ingresado en precio es incorrecto';
                        $response->ClassMessage = CLASS_MENSAJE_NOTICE;
                        $datosMinesPorGestionar['limpiar'] = false;
                    }
                } else {
                    $mensaje = 'No ha seleccionado un min de la lista';
                    $response->ClassMessage = CLASS_MENSAJE_NOTICE;
                }
            } else {
                $datosMinesPorGestionar['limpiar'] = false;
                $mensaje = 'Tiene preguntas sin contestar';
                $response->ClassMessage = CLASS_MENSAJE_NOTICE;
            }
        } catch (Exception $e) {
            $datosMinesPorGestionar['limpiar'] = false;
            $mensaje = 'Se ha producido un error al guardar los registros';
            $response->ClassMessage = CLASS_MENSAJE_NOTICE;
        }


        $response->Message = $mensaje;
        $response->Result = $datosMinesPorGestionar;
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

}
