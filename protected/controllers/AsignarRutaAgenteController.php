<?php

/**
 * Description
 * @fecha 
 * @author 
 */
class AsignarRutaAgenteController extends Controller {

    public $layout = LAYOUT_FILTRO_GRID;

    public function actionIndex() {
        Yii::app()->user->setFlash('resultadoGuardar', null);
        if (Yii::app()->request->isAjaxRequest) {
            return;
        } else {
            Yii::app()->session['AsignaRutaAgenteForm'] = '';
            $model = new AsignaRutaAgenteForm ();
            $this->render('/proceso/asignarRutaAgente', array('model' => $model));
        }
    }

    public function actionCargarUsuarios() {
        $response = new Response();
        try {
            $model = new AsignaRutaAgenteForm();
//            var_dump($_POST['AsignaRutaAgenteForm']);die();
            if (isset($_POST['AsignaRutaAgenteForm'])) {
                $model->attributes = $_POST['AsignaRutaAgenteForm'];

                if ($model->validate() && $model->tipoUsuario != 0) {
                    $model->attributes = $_POST['AsignaRutaAgenteForm'];
                    $fReportes = new ReportesModel();
                    Yii::app()->session['tipoUsuario'] = $model->tipoUsuario;
                    $datos['usuarios'] = $fReportes->getUsersPorRol($model->tipoUsuario);

                    $response->Message = "Proceso realizado exitosamente";
                    $response->Status = SUCCESS;
                    $response->Result = $datos;
                }//fin model->validate
                else {
                    $response->Message = "Debe seleccionar todos los filtros";
                    $response->ClassMessage = CLASS_MENSAJE_NOTICE;
//                $response->Result = $datos; // $datosGrid;
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

    public function actionCargarRutasAsignadas() {
        $response = new Response();

        $periodoSemanalActivo = PeriodoGestionModel::model()->findAllByAttributes(
                array(
                    'pg_tipo' => array('SEMANAL')
                    , 'pg_estado' => array('1')
                )
        );
        
        Yii::app()->session['idPeriodoSemanalActivo'] = $periodoSemanalActivo[0]['pg_id'];
        Yii::app()->session['codigUsuarioSeleccionado'] = $_POST['codigoUsuario'];

        if (Yii::app()->session['tipoUsuario'] == 1) {
            $fUsuarioRuta = new FUsuarioRutaModel();
            $rutasAsignadas['rutasAsignadas'] = $fUsuarioRuta->getRutasAsignadasxUsuario($_POST['codigoUsuario']);
        } elseif (Yii::app()->session['tipoUsuario'] == 2) {
            $fEjecutivoRuta = new FEjecutivoRutaModel();
            $rutasAsignadas['rutasAsignadas'] = $fEjecutivoRuta->getRutasAsignadasxEjecutivo($_POST['codigoUsuario'], Yii::app()->session['idPeriodoSemanalActivo']);
        }

        $fZonas = new FZonasGestionModel();
        $rutasAsignadas['zonas'] = $fZonas->getInformacionZonasXPeriodo(Yii::app()->session['idPeriodoSemanalActivo']);

        $response->Result = $rutasAsignadas;
        $this->actionResponse(null, null, $response);
        return;
    }

    public function actionCargarRutasZona() {
        $response = new Response();
        $fRuta = new FRutasGestionModel();

        $rutasZona = $fRuta->getRutaxZona(
                $_POST['codigoZona']
                , Yii::app()->session['codigUsuarioSeleccionado']
                , Yii::app()->session['idPeriodoSemanalActivo']
                , Yii::app()->session['tipoUsuario']
        );

        Yii::app()->session['codigoZonaSeleccionada'] = $_POST['codigoZona'];

        $response->Result = $rutasZona;

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

    public function actionGuardarSeleccion() {
        try {
            $response = new Response();
            $rutasAsignadas = array();
            $totalResumenOmitidos = 0;
            $totalResumenGuardados = 0;
            $mensaje = '';

            if (count($_POST) > 0) {
                if (Yii::app()->session['tipoUsuario'] == 1) {
                    foreach ($_POST as $idsRutasSeleccionada) {
                        foreach ($idsRutasSeleccionada as $idRuta) {
                            $data = array(
                                'rg_id' => $idRuta,
                                'iduser' => Yii::app()->session['codigUsuarioSeleccionado'],
                                'ur_nombre_ejecutivo' => '',
                                'ur_estado' => 1,
                                'ur_zona_gestion' => Yii::app()->session['codigoZonaSeleccionada'],
                                'ur_fecha_ingreso' => date(FORMATO_FECHA_LONG),
                                'ur_fecha_modifica' => date(FORMATO_FECHA_LONG),
                                'ur_cod_usuario_ingresa_modifica' => Yii::app()->user->id,
                            );
                            array_push($rutasAsignadas, $data);
                            unset($data);
                        }
                    }

                    $dbConnection = new CI_DB_active_record(null);
                    $sql = $dbConnection->insert_batch('tb_usuario_ruta', $rutasAsignadas);
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

                    unset($rutasAsignadas);
                    $connection->active = false;

                    if (Yii::app()->session['codigoZonaSeleccionada'] > 0) {
                        $fRuta = new FRutasGestionModel();
                        $rutasZona = $fRuta->getRutaxZona(
                                Yii::app()->session['codigoZonaSeleccionada']
                                , Yii::app()->session['codigUsuarioSeleccionado']
                                , Yii::app()->session['idPeriodoSemanalActivo']
                                , Yii::app()->session['tipoUsuario']
                        );

                        $rutasAsignadas['rutasZona'] = $rutasZona;
                    }

                    $fUsuarioRuta = new FUsuarioRutaModel();
                    $rutasAsignadas['rutasAsignadas'] = $fUsuarioRuta->getRutasAsignadasxUsuario(Yii::app()->session['codigUsuarioSeleccionado']);

                    if ($totalResumenGuardados > 0) {
                        $mensaje .= '<br>Se han asignado ' . $totalResumenGuardados . ' rutas correctamente.';
                        $response->ClassMessage = CLASS_MENSAJE_SUCCESS;
                    }
                    if ($totalResumenOmitidos > 0) {
                        $mensaje .= '<br>Se han omitido ' . $totalResumenOmitidos . ' rutas.';
                        $response->ClassMessage = CLASS_MENSAJE_NOTICE;
                    }
                } elseif (Yii::app()->session['tipoUsuario'] == 2) {
                    $ejecutivoAsignar = EjecutivoModel::model()->findByAttributes(array('e_cod' => array(Yii::app()->session['codigUsuarioSeleccionado'])));
                    foreach ($_POST as $idsRutasSeleccionada) {
                        foreach ($idsRutasSeleccionada as $idRuta) {
                            $dato = explode('-', $idRuta); //primer valor id de ruta, segundo valor semana gestionar, tercer valor dia a gestionar
                            $ruta = RutaGestionModel::model()->findByAttributes(array('rg_id' => array($dato[0])));
                            $data = array(
                                'e_cod' => $ejecutivoAsignar['e_cod'],
                                'rg_id' => $dato[0],
                                'er_usuario' => $ejecutivoAsignar['e_usr_mobilvendor'],
                                'er_usuario_nombre' => $ejecutivoAsignar['e_nombre'],
                                'er_ruta' => $ruta['rg_cod_ruta_mb'],
                                'er_ruta_nombre' => $ruta['rg_nombre_ruta'],
                                'er_semana_visitar' => $dato[1],
                                'er_dia_visitar' => $dato[2],
                                'er_estado' => 1,
                                'er_fecha_ingreso' => date(FORMATO_FECHA_LONG),
                                'er_fecha_modificacion' => date(FORMATO_FECHA_LONG),
                                'er_cod_usr_ing' => Yii::app()->user->id,
                                'er_cod_usr_mod' => Yii::app()->user->id,
                            );
                            array_push($rutasAsignadas, $data);
                            unset($data);
                        }
                    }

                    $dbConnection = new CI_DB_active_record(null);
                    $sql = $dbConnection->insert_batch('tb_ejecutivo_ruta', $rutasAsignadas);
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

                    unset($rutasAsignadas);
                    $connection->active = false;

                    if (Yii::app()->session['codigoZonaSeleccionada'] > 0) {
                        $fRuta = new FRutasGestionModel();
                        $rutasZona = $fRuta->getRutaxZona(
                                Yii::app()->session['codigoZonaSeleccionada']
                                , Yii::app()->session['codigUsuarioSeleccionado']
                                , Yii::app()->session['idPeriodoSemanalActivo']
                                , Yii::app()->session['tipoUsuario']
                        );

                        $rutasAsignadas['rutasZona'] = $rutasZona;
                    }

                    $fEjecutivoRuta = new FEjecutivoRutaModel();
                    $rutasAsignadas['rutasAsignadas'] = $fEjecutivoRuta->getRutasAsignadasxEjecutivo(Yii::app()->session['codigUsuarioSeleccionado'], Yii::app()->session['idPeriodoSemanalActivo']);

                    if ($totalResumenGuardados > 0) {
                        $mensaje .= '<br>Se han asignado ' . $totalResumenGuardados . ' rutas correctamente.';
                        $response->ClassMessage = CLASS_MENSAJE_SUCCESS;
                        $response->Status = SUCCESS;
                    }
                    if ($totalResumenOmitidos > 0) {
                        $mensaje .= '<br>Se han omitido ' . $totalResumenOmitidos . ' rutas.';
                        $response->ClassMessage = CLASS_MENSAJE_NOTICE;
                        $response->Status = NOTICE;
                    }
                }
            } else {
                
            }
        } catch (Exception $e) {
            $mensaje = 'Se ha producido un error al guardar los registros';
        }
        $response->Message = $mensaje;
        $response->Result = $rutasAsignadas;
        $this->actionResponse(null, null, $response);
        return;
    }

    public function actionEliminarSeleccion() {
        try {
            $response = new Response();
            $rutasAsignadas = array();
            $totalEliminados = 0;
            $mensaje = '';
            if (count($_POST) > 0) {

                if (Yii::app()->session['tipoUsuario'] == 1) {
                    foreach ($_POST as $idsRutasSeleccionada) {
                        foreach ($idsRutasSeleccionada as $idRuta) {
                            $existeBdd = UsuarioRutaModel::model()->findByAttributes(array('ur_id' => $idRuta,));
                            if (isset($existeBdd)) {
                                $existeBdd->delete();
                                $totalEliminados++;
                            }
                        }
                    }
                } elseif (Yii::app()->session['tipoUsuario'] == 2) {
                    foreach ($_POST as $idsRutasSeleccionada) {
                        foreach ($idsRutasSeleccionada as $idRuta) {
                            $existeBdd = EjecutivoRutaModel::model()->findByAttributes(array('er_cod' => $idRuta,));
                            if (isset($existeBdd)) {
                                $existeBdd->delete();
                                $totalEliminados++;
                            }
                        }
                    }
                }

                if (Yii::app()->session['codigoZonaSeleccionada'] > 0) {
                    $fRuta = new FRutasGestionModel();
                    $rutasZona = $fRuta->getRutaxZona(
                            Yii::app()->session['codigoZonaSeleccionada']
                            , Yii::app()->session['codigUsuarioSeleccionado']
                            , Yii::app()->session['idPeriodoSemanalActivo']
                            , Yii::app()->session['tipoUsuario']
                    );

                    $rutasAsignadas['rutasZona'] = $rutasZona;
                }

                $fEjecutivoRuta = new FEjecutivoRutaModel();
                $rutasAsignadas['rutasAsignadas'] = $fEjecutivoRuta->getRutasAsignadasxEjecutivo(Yii::app()->session['codigUsuarioSeleccionado'], Yii::app()->session['idPeriodoSemanalActivo']);

                $response->Result = $rutasAsignadas;
                $response->ClassMessage = CLASS_MENSAJE_SUCCESS;
                $response->Status = SUCCESS;

                $mensaje .= '<br>Se han eliminado ' . $totalEliminados . ' rutas.';
            } else {
                $response->ClassMessage = CLASS_MENSAJE_NOTICE;
                $mensaje .= '<br>No se han seleccionado rutas para eliminar.';
            }
        } catch (Exception $e) {
            $mensaje = 'Se ha producido un error al guardar los registros';
        }

        $response->Message = $mensaje;
        $response->Result = $rutasAsignadas;
        $this->actionResponse(null, null, $response);
        return;
    }

}
