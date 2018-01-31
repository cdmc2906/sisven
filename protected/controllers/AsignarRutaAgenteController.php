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
//            var_dump($_POST['RptSupervisorVsEjecutivoHistorialForm']);die();
            if (isset($_POST['AsignaRutaAgenteForm'])) {
                $model->attributes = $_POST['AsignaRutaAgenteForm'];
                if ($model->validate() && $model->tipoUsuario != 0) {
                    $model->attributes = $_POST['AsignaRutaAgenteForm'];
                    $fReportes = new ReportesModel();
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
        $fUsuarioRuta = new FUsuarioRutaModel();
        $rutasAsignadas['rutasAsignadas'] = $fUsuarioRuta->getRutasAsignadasxUsuario($_POST['codigoUsuario']);
        Yii::app()->session['codigUsuarioSeleccionado'] = $_POST['codigoUsuario'];

        $fZonas = new FZonasGestionModel();
        $rutasAsignadas['zonas'] = $fZonas->getZonasCantidadRutas(1);

        $response->Result = $rutasAsignadas;
        $this->actionResponse(null, null, $response);
        return;
    }

    public function actionCargarRutasZona() {
        $response = new Response();
        $fRuta = new FRutasGestionModel();
        $rutasZona = $fRuta->getRutaxZona($_POST['codigoZona'], Yii::app()->session['codigUsuarioSeleccionado']);
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
//            var_dump($_POST);die();
            if (count($_POST) > 0) {
                
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
                foreach ($_POST as $idsRutasSeleccionada) {
                    foreach ($idsRutasSeleccionada as $idRuta) {
                        $existeBdd = UsuarioRutaModel::model()->findByAttributes(array('ur_id' => $idRuta,));
//                        var_dump($existeBdd);                        die();
                        if (isset($existeBdd)) {
                            $existeBdd->delete();
                            $totalEliminados++;
                        }
                    }
                }

                $fUsuarioRuta = new FUsuarioRutaModel();
                $rutasAsignadas['rutasAsignadas'] = $fUsuarioRuta->getRutasAsignadasxUsuario(Yii::app()->session['codigUsuarioSeleccionado']);

                $response->Result = $rutasAsignadas;
                $response->ClassMessage = CLASS_MENSAJE_SUCCESS;
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
