<?php

class CierrePeriodoController extends Controller {

    public $layout = LAYOUT_FILTRO_GRID;

    public function actionIndex() {
        if (Yii::app()->request->isAjaxRequest) {
            return;
        } else {
            $model = new CierrePeriodoForm();
            unset(Yii::app()->session['idPeriodoSeleccionado']);
            unset(Yii::app()->session['reporteConPrecision']);
            unset(Yii::app()->session['precision']);

            $this->render('/proceso/cierrePeriodo', array('model' => $model));
//            var_dump(2);die();
        }
    }

    public function actionBuscaPeriodos() {
        $response = new Response();
        $fPeriodos = new FPeriodoGestionModel();
        $periodos = $fPeriodos->getPeriodos();
        $response->Result = $periodos;
        unset(Yii::app()->session['inicioPeriodoSeleccionado']);
        unset(Yii::app()->session['inicioPeriodoSeleccionado']);

        $this->actionResponse(null, null, $response);
        return;
    }

    public function actionMostrarDetallePeriodo() {
        $response = new Response();
        unset(Yii::app()->session['idPeriodoSeleccionado']);
        Yii::app()->session['idPeriodoSeleccionado'] = $_POST["idPeriodo"];

        $periodoSeleccionado = PeriodoGestionModel::model()->findAllByAttributes(array('pg_id' => $_POST["idPeriodo"]));

        Yii::app()->session['inicioPeriodoSeleccionado'] = $periodoSeleccionado[0]['pg_fecha_inicio'];
        Yii::app()->session['finPeriodoSeleccionado'] = $periodoSeleccionado[0]['pg_fecha_fin'];

        $fResumenRevision = new FResumenPeriodoModel();

        $resumenes['resumenesPeriodo'] = $fResumenRevision->getResumenxPeriodo($_POST["idPeriodo"]);

        $response->Result = $resumenes;
        $response->Status = SUCCESS;
        $this->actionResponse(null, null, $response);
        return;
    }

    public function actionCerrarPeriodoSemanal() {
        $response = new Response();
        try {
            if (isset(Yii::app()->session['idPeriodoAbierto'])) {
                $model = new CierrePeriodoForm();

                unset(Yii::app()->session['reporteConPrecision']);
                unset(Yii::app()->session['precision']);

                if (isset($_POST['CierrePeriodoForm'])) {
                    $model->attributes = $_POST['CierrePeriodoForm'];
                    $mensaje = '';
                    $ejecutivosGestionados = 0;
                    $libreria = new Libreria();
                    $fHistorial = new FHistorialModel();
                    $datosSemanalesEjecutivos = array();
//var_dump($model['ejecutivo']);die();
                    if ($model->validate()) {

                        //Obtener listado de ejecutivos activos para revision de historial
                        if ($model->ejecutivo == 'A')
                            $ejecutivos = EjecutivoModel::model()->findAllByAttributes(
                                    array(
                                'e_estado' => 1,
                                'e_tipo' => 'V'), array(
                                'order' => 'e_usr_mobilvendor'));
                        else
                            $ejecutivos = EjecutivoModel::model()->findAllByAttributes(
                                    array(
                                'e_estado' => 1,
                                'e_tipo' => 'V',
                                'e_usr_mobilvendor' => $model['ejecutivo']
                                    ), array(
                                'order' => 'e_usr_mobilvendor'));


                        //inicio de guardado de detalles y resumenes de revisiones del historial por ejecutivo y por fecha
                        foreach ($ejecutivos as $ejecutivo) {

                            $fechas = $fHistorial->getFechasHistorialxPeriodo(
                                    Yii::app()->session['fechaInicioPeriodo']
                                    , Yii::app()->session['fechaFinPeriodo']
                                    , $model->semanaRevision
                                    , $model->accionHistorial);

                            foreach ($fechas as $fecha) {
                                $revisionHistorial = $libreria->VerificarHistorialDiarioUsuario(
                                        $ejecutivo['e_usr_mobilvendor']
                                        , $fecha["fecha"]
                                        , $model->accionHistorial
                                        , $model->horaInicioGestion
                                        , $model->horaFinGestion
                                        , $model->precisionVisitas
                                        , $model->semanaRevision);

                                if (count(Yii::app()->session['detalleRevisionGuardar']) > 0) {
                                    $estadoGuardadoDetalle = $libreria->GuardarDetallesHistorialEjecutivo();
                                    $estadoGuardadoResumen = $libreria->GuardarResumenHistorialEjecutivo();
                                    if ($estadoGuardadoDetalle != 'La revision ha sido guardada exitosamente' ||
                                            $estadoGuardadoResumen != 'La revision ha sido guardada exitosamente')
                                        $mensaje = 'Falla en guardado de datos, Revisar';
                                    else {
                                        $ejecutivosGestionados++;
                                        $mensaje = 'Guardado ok';
                                    }
                                }//fin comprobar si ejecutivo tuvo gestion en fecha
                            }//fin iteracion fechas gestion
                        }//fin iteracion ejecutivos

                        $datosSemanalesEjecutivos = $this->RecuperarGuardadosExportar(
                                $ejecutivos
                                , Yii::app()->session['fechaInicioPeriodo']
                                , Yii::app()->session['fechaFinPeriodo']
                        );
                        if ($model->ejecutivo == 'A') {
                            //Cambio estado periodo
                            $estadoActualizacionPeriodo = $this->ActualizarEstadoPeriodo(Yii::app()->session['idPeriodoAbierto'], 2);
                        }
                        
                        Yii::app()->session['reporteConPrecision'] = $datosSemanalesEjecutivos;

                        if (count($datosSemanalesEjecutivos) > 0) {
                            $response->Message = "Cierre terminado exitosamente";
                            $response->ClassMessage = CLASS_MENSAJE_SUCCESS;
                        } else {
                            $response->Message = "No existen datos para los filtros usados";
                            $response->ClassMessage = CLASS_MENSAJE_NOTICE;
                        }
                    } else {
                        $response->Message = "Debe seleccionar todos los filtros";
                        $response->ClassMessage = CLASS_MENSAJE_NOTICE;
                    }
                } else {
                    $response->Message = "Error F35 - CierrePeriodoForm";
                    $response->ClassMessage = CLASS_MENSAJE_NOTICE;
                }
            } else {
                unset(Yii::app()->session['reporteConPrecision']);
                $response->Message = "No existe periodo semanal activo.";
                $response->ClassMessage = CLASS_MENSAJE_NOTICE;
            }
        } catch (Exception $e) {
            $mensaje = array(
                'code' => $e->getCode(),
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            );
            $response->Message = $mensaje;
            $response->Status = ERROR;
        }
        $this->actionResponse(null, null, $response);
        return;
    }

    private function ActualizarEstadoPeriodo($idPeriodoActualizar, $estado) {
        //ACTUALIZAR PERIODO
        $periodo = PeriodoGestionModel::model()->findAllByAttributes(array('pg_id' => $idPeriodoActualizar));
        $periodo [0]["pg_estado"] = $estado;
        $periodo [0]["pg_fecha_modificacion"] = date(FORMATO_FECHA_LONG);
        $periodo [0]["pg_cod_usuario_ing_mod"] = Yii::app()->user->id;
        return $periodo[0]->save();
    }

    private function RecuperarGuardadosExportar($ejecutivos, $fechaInicioPeriodo, $fechaFinPeriodo) {
        $resumenesPorEjecutivo = array();
        $datosSemanalesEjecutivos = array();
        $fHistorial = new FHistorialModel();

        foreach ($ejecutivos as $ejecutivo) {
            $fechasRevisadas = array();
            $fResumenHistorial = new FResumenDiarioHistorialModel();
            $datosRevisiones = $fResumenHistorial->getDatosRevisionesEjecutivo(
                    $fechaInicioPeriodo
                    , $fechaFinPeriodo
                    , $ejecutivo['e_usr_mobilvendor']
            );

            foreach ($datosRevisiones as $item) {
                array_push($fechasRevisadas, $item["fecha_gestion"]);
            }

            $resumenesPorEjecutivo = array();
            $resumenesPorDia = array();

            foreach ($fechasRevisadas as $fechaGestion) {
                $resumenesPorDia = array();
                $cantidadEventosHistorial = $fHistorial->getCantidadClientesVisitadosxEjecutivoxFecha(
                        $ejecutivo['e_usr_mobilvendor']
                        , $fechaGestion);

                if ($cantidadEventosHistorial > 0) {
                    $resumenRevisionGuardado = ResumenHistorialDiarioModel::model()->findAllByAttributes(
                            array('rhd_cod_ejecutivo' => $ejecutivo['e_usr_mobilvendor'], //,$model->ejecutivo
                                'rhd_fecha_historial' => $fechaGestion));

                    foreach ($resumenRevisionGuardado as $itemResumenRevisionGuardado) {
                        $itemResumenDia = array(
                            'FECHA_HISTORIAL' => $itemResumenRevisionGuardado["rhd_fecha_historial"],
                            'EJECUTIVO' => $itemResumenRevisionGuardado["rhd_cod_ejecutivo"],
                            'PARAMETRO' => $itemResumenRevisionGuardado["rhd_parametro"],
                            'VALOR' => strval($itemResumenRevisionGuardado["rhd_valor"]),
                        );

                        array_push($resumenesPorDia, $itemResumenDia);
                        unset($itemResumenDia);
                    }
                }
                array_push($resumenesPorEjecutivo, $resumenesPorDia);
                unset($resumenesPorDia);
            }//fin iteracion fechas

            if (count($datosRevisiones) > 0) {
                $datosPorEjecutivo = array(
                    'FECHAS_GESTION' => $fechasRevisadas,
                    'DATOS_EJECUTIVO' => $resumenesPorEjecutivo
                );
                array_push($datosSemanalesEjecutivos, $datosPorEjecutivo);
                unset($datosPorEjecutivo);
            }
        }//FIN ITERACION DE EJECUTIVOS
        return $datosSemanalesEjecutivos;
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
            if (isset(Yii::app()->session['reporteConPrecision']) && count(Yii::app()->session['reporteConPrecision']) > 0) {

                $NombreArchivo = "resumen_Historial_Ejecutivo";
                $autor = "Tececab"; //$_SESSION['CUENTA'];
                $titulo = "resumenHistorialEjecutivo";
                $tema = "Reporte Tececab";
                $keywords = "office 2007";

                $excel = new excel();
                $encabezadoImprimir = 'RESUMEN SEMANAL DEL' . Yii::app()->session['fechaInicioPeriodo'] . ' AL  ' . Yii::app()->session['fechaFinPeriodo'];
                $footerImprimir = Yii::app()->user->name . ' - ' . date('Y/m/d h:i A');
                $excel->getObjPHPExcel()->getProperties()
                        ->setCreator($autor)
                        ->setLastModifiedBy($autor)
                        ->setTitle($titulo)
                        ->setSubject($tema)
                        ->setDescription($tema)
                        ->setKeywords($keywords)
                        ->setCategory($tema);

                $excel->MapeoCustomizadoHistorial(
                        COLUMNAS_RESUMEN_HISTORIAL
                        , Yii::app()->session['reporteConPrecision']
                        , $encabezadoImprimir
                        , $footerImprimir);
                $excel->CrearArchivo('Excel2007', $NombreArchivo);
                $excel->GuardarArchivo();

                unset(Yii::app()->session['reporteConPrecision']);
            } else {
                $response->Message = 'No existen datos para generar archivo';
                $response->Status = ERROR;
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

    public function actionReversarPeriodo() {
        $response = new Response();
        try {
//            var_dump(Yii::app()->session['idPeriodoSeleccionado']);die();
            if (Yii::app()->session['idPeriodoSeleccionado']) {

                $actualizado = $this->ActualizarEstadoPeriodo(Yii::app()->session['idPeriodoSeleccionado'], 1);

                $datosResumenEliminar = ResumenHistorialDiarioModel::model()->findAllByAttributes(array('pg_id' => Yii::app()->session['idPeriodoSeleccionado']));
                $contador_r_eliminados = 0;
                foreach ($datosResumenEliminar as $item) {
                    $item->delete();
                    $contador_r_eliminados++;
                }

                $datosDetalleEliminar = DetalleRevisionHistorialModel::model()->findAllByAttributes(array('pg_id' => Yii::app()->session['idPeriodoSeleccionado']));
                $contador_d_eliminados = 0;
                foreach ($datosDetalleEliminar as $item) {
                    $item->delete();
                    $contador_d_eliminados++;
                }
                $response->Message = 'Seleccione el periodo';
                $response->Status = ERROR;

//                var_dump($contador_d_eliminados);die();
//                 unset(Yii::app()->session['inicioPeriodoSeleccionado']);
//        unset(Yii::app()->session['inicioPeriodoSeleccionado']);
                $response->Message = 'El periodo del ' . Yii::app()->session['inicioPeriodoSeleccionado'] . ' al ' . Yii::app()->session['inicioPeriodoSeleccionado'] . ' fue reabierto exitosamente.\n';
                $response->Status = SUCCESS;
            } else {
                $response->Message = 'Seleccione el periodo';
                $response->Status = ERROR;
            }
        } catch (Exception $e) {
            $mensaje = array(
                'code' => $e->getCode(),
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            );
            $response->Message = $mensaje;
            $response->Status = ERROR;
        }
        $this->actionResponse(null, null, $response);
        return;
    }

    public function actionExportarResumen() {
        $response = new Response();
        try {
            if (isset(Yii::app()->session['idPeriodoSeleccionado'])) {

                $_inicioPeriodo = DateTime::createFromFormat('Y-m-d H:i:s', Yii::app()->session['inicioPeriodoSeleccionado']);
                $inicioPeriodo = $_inicioPeriodo->format(FORMATO_FECHA_3);

                $_finPeriodo = DateTime::createFromFormat('Y-m-d H:i:s', Yii::app()->session['finPeriodoSeleccionado']);
                $finPeriodo = $_finPeriodo->format(FORMATO_FECHA_3);
//                var_dump($inicioPeriodo,$finPeriodo);die();
                $ejecutivos = EjecutivoModel::model()->findAllByAttributes(
                        array(
                    'e_estado' => 1,
                    'e_tipo' => 'V'), array(
                    'order' => 'e_usr_mobilvendor'));

                $datosSemanalesEjecutivos = $this->RecuperarGuardadosExportar(
                        $ejecutivos
                        , $inicioPeriodo
                        , $finPeriodo
                );

                Yii::app()->session['reporteConPrecision'] = $datosSemanalesEjecutivos;

                if (isset($datosSemanalesEjecutivos)) {

                    if (count($datosSemanalesEjecutivos) > 0) {
                        $NombreArchivo = "resumen_Historial_Ejecutivo";
                        $autor = "Tececab"; //$_SESSION['CUENTA'];
                        $titulo = "resumenHistorialEjecutivo";
                        $tema = "Reporte Tececab";
                        $keywords = "office 2007";

                        $excel = new excel();
                        $encabezadoImprimir = 'RESUMEN SEMANAL DEL' . $inicioPeriodo . ' AL  ' . $finPeriodo;
                        $footerImprimir = Yii::app()->user->name . ' - ' . date('Y/m/d h:i A');
                        $excel->getObjPHPExcel()->getProperties()
                                ->setCreator($autor)
                                ->setLastModifiedBy($autor)
                                ->setTitle($titulo)
                                ->setSubject($tema)
                                ->setDescription($tema)
                                ->setKeywords($keywords)
                                ->setCategory($tema);

                        $excel->MapeoCustomizadoHistorial(
                                COLUMNAS_RESUMEN_HISTORIAL
                                , $datosSemanalesEjecutivos
                                , $encabezadoImprimir
                                , $footerImprimir);
                        $excel->CrearArchivo('Excel2007', $NombreArchivo);
                        $excel->GuardarArchivo();

                        unset(Yii::app()->session['reporteConPrecision']);
                    } else {
                        $response->Message = 'Debe generar el reporte';
                        $response->Status = ERROR;
                    }
                } else {
                    $response->Message = 'No existen datos para generar archivo';
                    $response->Status = ERROR;
                }
            } else {
                $response->Message = 'Seleccione el periodo nuevamente';
                $response->Status = ERROR;
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
