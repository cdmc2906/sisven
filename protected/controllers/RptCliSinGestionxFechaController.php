<?php

/**
 * Description
 * @fecha 
 * @author 
 */
class RptCliSinGestionxFechaController extends Controller {

    public $layout = LAYOUT_FILTRO_GRID;

    public function actionIndex() {

        if (Yii::app()->request->isAjaxRequest) {
            return;
        } else {
            Yii::app()->session['RptCliSinGestionxFechaForm'] = '';

            $model = new RptCliSinGestionxFechaForm();
            $this->render('/reportes/rptCliSinGestionxFecha', array('model' => $model));
        }
    }

    function validarCamposVNS($modelSeleccion, $mesSeleccionado) {
        $resultadoValidacion = '';

        $model = $modelSeleccion;
        $nuevaLinea = '<br/>';
//        var_dump($model->tipoFecha,$model->tipoFecha != '' , $model->tipoFecha == NULL,$model,$mesSeleccionado);die();
        if ($model->tipoUsuario != '' || $model->tipoUsuario != NULL) {
            if ($model->tipoUsuario == 'E') {
                if ($model->usuario == '' || $model->usuario == NULL)
                    $resultadoValidacion .= $nuevaLinea . 'Seleccione el ejecutivo';
            }
        } else
            $resultadoValidacion .= 'Seleccione el tipo de ejecutivo';
//        var_dump($mesSeleccionado);die();
        if ($model->tipoFecha != '' || $model->tipoFecha != NULL) {
            if ($model->tipoFecha == 'M') {
                if ($mesSeleccionado == '')
                    $resultadoValidacion .= $nuevaLinea . 'Seleccione el mes';
                if ($model->anio == '' || $model->anio == NULL)
                    $resultadoValidacion .= $nuevaLinea . 'Seleccione el anio';
            } else if ($model->tipoFecha == 'P') {
                if ($model->periodo == '' || $model->periodo != NULL)
                    $resultadoValidacion .= $nuevaLinea . 'Seleccione el periodo';
            } else if ($model->tipoFecha == 'R') {
                if ($model->fechaInicioAnalisis == '' || $model->fechaInicioAnalisis != NULL)
                    $resultadoValidacion .= $nuevaLinea . 'Ingrese la fecha de inicio del rango';
                if ($model->fechaFinAnalisis == '' || $model->fechaFinAnalisis != NULL)
                    $resultadoValidacion .= $nuevaLinea . 'Ingrese la fecha de fin del rango';
            }
        }
        else {
            $resultadoValidacion .= $nuevaLinea . 'Seleccione el tipo de fecha';
        }

        return $resultadoValidacion;
    }

    public function actionAnalizarClientes() {
        try {
            $solicitarLogin = true;
            if (Yii::app()->user->id <> intval(USUARIO_INVITADO)) {
                $response = new Response();
                $solicitarLogin = false;
                $model = new RptCliSinGestionxFechaForm();
                $model->attributes = $_POST['RptCliSinGestionxFechaForm'];
                Yii::app()->session['ModelForm'] = $model;

                $mesSeleccionado = '';
                $mesSeleccionado = isset($_POST['RptCliSinGestionxFechaForm_mes']) ? $_POST['RptCliSinGestionxFechaForm_mes'] : '';

                $resultadoValidacion = $this->validarCamposVNS($model, $mesSeleccionado);
                if ($resultadoValidacion == '') {
                    if ($model->tipoFecha == 'M') {
                        $mes = strlen($mesSeleccionado) == 1 ? '0' . $mesSeleccionado : $mesSeleccionado;
                        $fechaIni = intval($model->anio) . '-' . $mes . '-01';
                        $fechaInicio = date(FORMATO_FECHA_3, strtotime($fechaIni));
                        $fechaFin = date("Y-m-t", strtotime($fechaInicio));
                    } else if ($model->tipoFecha == 'P') {
                        $periodo = PeriodoGestionModel::model()->findAllByPk($model->periodo);
                        $fechaInicio = $periodo[0]['pg_fecha_inicio'];
                        $fechaFin = $periodo[0]['pg_fecha_fin'];
                    } else if ($model->tipoFecha == 'R') {
                        $fechaInicio = $model->fechaInicioAnalisis;
                        $fechaFin = $model->fechaFinAnalisis;
                    } else {
                        $fechaFin = date(FORMATO_FECHA_3);
                        $cantidad = '-' . $model->tipoFecha . ' day';

                        $fechaInicio = strtotime($cantidad, strtotime($fechaFin));
                        $fechaInicio = date(FORMATO_FECHA_3, $fechaInicio);
                    }

                    $cEjecutivos = new FEjecutivoModel();
                    $ejecutivos = $cEjecutivos->getEjecutivosXGrupoXEstado($model->tipoUsuario, 1);

                    $fHistorial = new FHistorialModel();

                    $periodos = $fHistorial->getPeriodosEnHistorial($fechaInicio, $fechaFin);
                    $datosVisitas = array();
                    $datosVisitasPCP = array();
                    $Visitados = array();
                    $NoVisitados = array();
                    foreach ($periodos as $periodo) {
                        if ($model->tipoUsuario == 'E') { //Selecciona un solo ejecutivo para analizar
                            /* INICIO DE CARGA DE DETALLES */
                            $reporteV = $fHistorial->getDetalleClientesVisitadosxTipoUsrxUsrxFecha(
                                    1
                                    , $model->usuario
                                    , $periodo['fecha_inicio']
                                    , $periodo['fecha_fin']
                                    , $periodo["id_periodo"]);

                            foreach ($reporteV as $itemReporetV) {
                                $itemV = array(
                                    'ITEM' => $itemReporetV['ITEM'],
                                    'EJECUTIVO' => $itemReporetV['EJECUTIVO'],
                                    'RUTA' => $itemReporetV['RUTA'],
                                    'CODIGOCLIENTE' => $itemReporetV['CODIGOCLIENTE'],
                                    'CLIENTE' => $itemReporetV['CLIENTE'],
                                    'VISITAS' => $itemReporetV['VISITAS'],
                                    'PERIODO' => $periodo["nombre_periodo"],
                                );
                                array_push($Visitados, $itemV);
                            }

                            $reporteNV = $fHistorial->getDetalleClientesVisitadosxTipoUsrxUsrxFecha(
                                    0
                                    , $model->usuario
                                    , $periodo['fecha_inicio']
                                    , $periodo['fecha_fin']
                                    , $periodo["id_periodo"]);
                            foreach ($reporteNV as $itemReporetNV) {
                                $itemNV = array(
                                    'ITEM' => $itemReporetNV['ITEM'],
                                    'EJECUTIVO' => $itemReporetNV['EJECUTIVO'],
                                    'RUTA' => $itemReporetNV['RUTA'],
                                    'CODIGOCLIENTE' => $itemReporetNV['CODIGOCLIENTE'],
                                    'CLIENTE' => $itemReporetNV['CLIENTE'],
                                    'PERIODO' => $periodo["nombre_periodo"],
                                );
                                array_push($NoVisitados, $itemNV);
                            }
                            /* FIN DE CARGA DE DETALLES */


                            $fRutas = new FRutaModel();
                            $rutas = $fRutas->getRutasxEjecutivoxPeriodo($model->usuario, $periodo["id_periodo"]);
                            $ejecutivo = EjecutivoModel::model()->findByAttributes(array('e_usr_mobilvendor' => $model->usuario));

                            if (count($rutas) > 0) {
                                foreach ($rutas as $ruta) {
                                    $clientesG = $fHistorial->getClientesConYSinGestionxFecha(
                                            $model->usuario
                                            , $ruta["RUTA"]
                                            , $periodo["fecha_inicio"]
                                            , $periodo["fecha_fin"]
                                            , $periodo["id_periodo"]);

                                    $itemRuta = array(
                                        'EJECUTIVO' => $ejecutivo["e_nombre"],
                                        'RUTA' => $ruta["RUTA"],
                                        'PERIODO' => $periodo["nombre_periodo"],
                                        'GESTIONADOS' => isset($clientesG[1]) ? $clientesG[1]["CONTEO_CLIENTES"] : 0,
                                        'NOGESTIONADOS' => isset($clientesG[0]) ? $clientesG[0]["CONTEO_CLIENTES"] : 0,
                                    );
                                    array_push($datosVisitas, $itemRuta);

                                    $clientesGPCP = $fHistorial->getClientesConYSinGestionxFechaPCP(
                                            $model->usuario
                                            , $ruta["RUTA"]
                                            , $periodo["fecha_inicio"]
                                            , $periodo["fecha_fin"]
                                            , $periodo["id_periodo"]);
//                                var_dump($clientesGPCP);                                die();
                                    foreach ($clientesGPCP as $clientePCP) {
//                                    var_dump($clientePCP);die();
                                        $itemRutaPCP = array(
                                            'PROVINCIA' => $clientePCP ["PROVINCIA"],
                                            'CANTON' => $clientePCP ["CANTON"],
                                            'PARROQUIA' => $clientePCP ["PARROQUIA"],
                                            'PERIODO' => $periodo["nombre_periodo"],
                                            'GESTIONADOS' => ($clientePCP ["TIPO"] == 'VISITADOS') ? $clientePCP["CONTEO_CLIENTES"] : 0,
                                            'NOGESTIONADOS' => ($clientePCP ["TIPO"] == 'NO VISITADOS') ? $clientePCP["CONTEO_CLIENTES"] : 0,
                                        );
                                        array_push($datosVisitasPCP, $itemRutaPCP);
                                    }
                                }
                            }
                        } else {
                            foreach ($ejecutivos as $ejecutivo) {
                                /* INICIO DE CARGA DE DETALLES */
                                $reporteV = $fHistorial->getDetalleClientesVisitadosxTipoUsrxUsrxFecha(
                                        1
                                        , $ejecutivo["e_usr_mobilvendor"]
                                        , $periodo['fecha_inicio']
                                        , $periodo['fecha_fin']
                                        , $periodo["id_periodo"]);
                                foreach ($reporteV as $itemReporetV) {
                                    $itemV = array(
                                        'ITEM' => $itemReporetV['ITEM'],
                                        'EJECUTIVO' => $itemReporetV['EJECUTIVO'],
                                        'RUTA' => $itemReporetV['RUTA'],
                                        'CODIGOCLIENTE' => $itemReporetV['CODIGOCLIENTE'],
                                        'CLIENTE' => $itemReporetV['CLIENTE'],
                                        'VISITAS' => $itemReporetV['VISITAS'],
                                        'PERIODO' => $periodo["nombre_periodo"],
                                    );
                                    array_push($Visitados, $itemV);
                                }
                                $reporteNV = $fHistorial->getDetalleClientesVisitadosxTipoUsrxUsrxFecha(
                                        0
                                        , $ejecutivo["e_usr_mobilvendor"]
                                        , $periodo['fecha_inicio']
                                        , $periodo['fecha_fin']
                                        , $periodo["id_periodo"]);
                                foreach ($reporteNV as $itemReporetNV) {
                                    $itemNV = array(
                                        'ITEM' => $itemReporetNV['ITEM'],
                                        'EJECUTIVO' => $itemReporetNV['EJECUTIVO'],
                                        'RUTA' => $itemReporetNV['RUTA'],
                                        'CODIGOCLIENTE' => $itemReporetNV['CODIGOCLIENTE'],
                                        'CLIENTE' => $itemReporetNV['CLIENTE'],
                                        'PERIODO' => $periodo["nombre_periodo"],
                                    );
                                    array_push($NoVisitados, $itemNV);
                                }
                                /* FIN DE CARGA DE DETALLES */

                                $fRutas = new FRutaModel();
                                $rutas = $fRutas->getRutasxEjecutivoxPeriodo($ejecutivo["e_usr_mobilvendor"], $periodo["id_periodo"]);
                                if (count($rutas) > 0) {
                                    foreach ($rutas as $ruta) {
                                        $clientesG = $fHistorial->getClientesConYSinGestionxFecha(
                                                $ejecutivo["e_usr_mobilvendor"]
                                                , $ruta["RUTA"]
                                                , $periodo["fecha_inicio"]
                                                , $periodo["fecha_fin"]
                                                , $periodo["id_periodo"]);

                                        $itemRuta = array(
                                            'EJECUTIVO' => $ejecutivo["e_nombre"],
                                            'RUTA' => $ruta["RUTA"],
                                            'PERIODO' => $periodo["nombre_periodo"],
                                            'GESTIONADOS' => isset($clientesG[1]) ? $clientesG[1]["CONTEO_CLIENTES"] : 0,
                                            'NOGESTIONADOS' => isset($clientesG[0]) ? $clientesG[0]["CONTEO_CLIENTES"] : 0,
                                        );
                                        array_push($datosVisitas, $itemRuta);

                                        $clientesGPCP = $fHistorial->getClientesConYSinGestionxFechaPCP(
                                                $ejecutivo["e_usr_mobilvendor"]
                                                , $ruta["RUTA"]
                                                , $periodo["fecha_inicio"]
                                                , $periodo["fecha_fin"]
                                                , $periodo["id_periodo"]);

                                        foreach ($clientesGPCP as $clientePCP) {
//                                    var_dump($clientePCP);die();
                                            $itemRutaPCP = array(
                                                'PROVINCIA' => $clientePCP ["PROVINCIA"],
                                                'CANTON' => $clientePCP ["CANTON"],
                                                'PARROQUIA' => $clientePCP ["PARROQUIA"],
                                                'PERIODO' => $periodo["nombre_periodo"],
                                                'GESTIONADOS' => ($clientePCP ["TIPO"] == 'VISITADOS') ? $clientePCP["CONTEO_CLIENTES"] : 0,
                                                'NOGESTIONADOS' => ($clientePCP ["TIPO"] == 'NO VISITADOS') ? $clientePCP["CONTEO_CLIENTES"] : 0,
                                            );
                                            array_push($datosVisitasPCP, $itemRutaPCP);
                                        }
                                    }
                                }
                            }
                        }
                    }

                    $datosClientes['resumenVisitas'] = $datosVisitas;
                    $datosClientes['resumenVisitasPCP'] = $datosVisitasPCP;
                    $datosClientes['detalleVisitados'] = $Visitados;
                    $datosClientes['detalleNoVisitados'] = $NoVisitados;
                    $response->Message = "Periodo revisado exitosamente";
                    $response->Status = SUCCESS;
                    $response->Result = $datosClientes;
                } else {
                    $response->Message = "$resultadoValidacion";
                    $response->Status = NOTICE;
                    $response->ClassMessage = CLASS_MENSAJE_NOTICE;
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
//        var_dump($response);die();
        return;
    }

    function validarCamposAcum($modelSeleccion, $anioInicio, $mesInicio, $anioFin, $mesFin) {
        $resultadoValidacion = '';

        $model = $modelSeleccion;
        $nuevaLinea = '<br/>';

        if ($model->tipoEjecutivoAcum != '' || $model->tipoEjecutivoAcum != NULL) {
            if ($model->tipoEjecutivoAcum == 'E') {
                if ($model->ejecutivoAcum == '' || $model->ejecutivoAcum == NULL)
                    $resultadoValidacion .= $nuevaLinea . 'Seleccione el ejecutivo';
            }
        } else
            $resultadoValidacion .= 'Seleccione el tipo de usuario';

        if ($anioInicio != '') {
            if ($mesInicio == '')
                $resultadoValidacion .= $nuevaLinea . 'Seleccione el mes inicial';
        } else
            $resultadoValidacion .= $nuevaLinea . 'Seleccione el anio inicial';
        if ($anioFin != '') {
            if ($mesFin == '')
                $resultadoValidacion .= $nuevaLinea . 'Seleccione el mes final';
        } else
            $resultadoValidacion .= $nuevaLinea . 'Seleccione el anio final';
        return $resultadoValidacion;
    }

    public function actionAnalizarClientesAcumulado() {
        $response = new Response();
        try {
            $solicitarLogin = true;
            if (Yii::app()->user->id <> intval(USUARIO_INVITADO)) {
                $solicitarLogin = false;
                $model = new RptCliSinGestionxFechaForm();
                $model->attributes = $_POST['RptCliSinGestionxFechaForm'];

//                var_dump($model);                die();
                $fHistorial = new FHistorialModel();
                $titulos = array();
                $columnas = array();
                $anioInicio = $model->anioInicioAcum;
                $anioFin = $model->anioFinAcum;

                $mesInicio = isset($_POST['RptCliSinGestionxFechaForm_mesInicioAcum']) ? $_POST['RptCliSinGestionxFechaForm_mesInicioAcum'] : '';
                $mesFin = isset($_POST['RptCliSinGestionxFechaForm_mesFinAcum']) ? $_POST['RptCliSinGestionxFechaForm_mesFinAcum'] : '';

                $resultadoValidacion = $this->validarCamposAcum($model, $anioInicio, $mesInicio, $anioFin, $mesFin);
//                var_dump($resultadoValidacion);                die();
                if ($resultadoValidacion == '') {
                    if ($model->tipoEjecutivoAcum == 'E') {
                        $reporteAcumulado = $fHistorial->getDetalleClientesVisitadosAcumulado(
                                $mesInicio
                                , $mesFin
                                , $model->ejecutivoAcum);

                        foreach ($reporteAcumulado[0] as $key => $value) {
                            array_push($titulos, $key);

                            $columna = array(
                                'name' => "" . $key . "",
                                'index' => "" . $key . "",
                                'width' => 50,
                                'sortable' => false,
                                'frozen' => true
                            );
                            array_push($columnas, $columna);
                        }
                    } else {
                        $reporteAcumulado = array();
                        $cEjecutivos = new FEjecutivoModel();
                        $ejecutivos = $cEjecutivos->getEjecutivosXGrupoXEstado($model->tipoEjecutivoAcum, 1);

                        foreach ($ejecutivos as $ejecutivo) {
                            $itemReporteAcumulado = $fHistorial->getDetalleClientesVisitadosAcumulado(
                                    $mesInicio
                                    , $mesFin
                                    , $ejecutivo["e_usr_mobilvendor"]);

                            foreach ($itemReporteAcumulado as $item) {

                                array_push($reporteAcumulado, $item);
                            }
                            if (count($titulos) == 0) {
                                if (isset($reporteAcumulado[0])) {
                                    foreach ($reporteAcumulado[0] as $key => $value) {
                                        array_push($titulos, $key);

                                        $columna = array(
                                            'name' => "" . $key . "",
                                            'index' => "" . $key . "",
                                            'width' => 50,
                                            'sortable' => false,
                                            'frozen' => true
                                        );
                                        array_push($columnas, $columna);
                                    }
                                }
                            }
                        }
                    }


                    $datosClientes['datos'] = $reporteAcumulado;
                    $datosClientes['titulos'] = $titulos;
                    $datosClientes['columnas'] = $columnas;

                    $response->Message = "Periodo revisado exitosamente";
                    $response->Status = SUCCESS;
                    $response->Result = $datosClientes;
                } else {
                    $response->Message = $resultadoValidacion;
                    $response->Status = NOTICE;
                    $response->ClassMessage = CLASS_MENSAJE_NOTICE;
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
        return;
    }

    private function actionResponse($view = 'error', $model = null, $response = null) {
        if (Yii::app()->request->isAjaxRequest) {
            echo json_encode($response);
        } else {
            $this->render($view, $model);
        }
    }

    public function actionCargarMeses() {
        $anio = $_POST['anio'];

        $criteria = new CDbCriteria();
        $criteria->condition = 'pg_tipo=\'SEMANAL\' AND pg_anio=' . $anio;
        $criteria->distinct = true;
        $criteria->select = 'pg_mes';

        $meses = PeriodoGestionModel::model()->findAll($criteria);

        if (count($meses) > 0) {
            $cmb = "<select name='RptCliSinGestionxFechaForm_mes' id='RptCliSinGestionxFechaForm_mes' class='form-control select2'>";
            $cmb .= "<option value=''>Seleccione un mes</option>";
            $opcion = '';
            foreach ($meses as $value) {
                switch ($value['pg_mes']) {
                    case 1:
                        $nombre = 'Enero';
                        break;
                    case 2:
                        $nombre = 'Febrero';
                        break;
                    case 3:
                        $nombre = 'Marzo';
                        break;
                    case 4:
                        $nombre = 'Abril';
                        break;
                    case 5:
                        $nombre = 'Mayo';
                        break;
                    case 6:
                        $nombre = 'Junio';
                        break;
                    case 7:
                        $nombre = 'Julio';
                        break;
                    case 8:
                        $nombre = 'Agosto';
                        break;
                    case 9:
                        $nombre = 'Septiembre';
                        break;
                    case 10:
                        $nombre = 'Octubre';
                        break;
                    case 11:
                        $nombre = 'Noviembre';
                        break;
                    case 12:
                        $nombre = 'Diciembre';
                        break;
                    default:
                        break;
                }
                $opcion .= "<option value=" . $value['pg_mes'] . " >" . $nombre . "</option>";
            }
            $cmb .= $opcion;
        } else {
            $cmb = "< select name='RptCliSinGestionxFechaForm_mes' id='RptCliSinGestionxFechaForm_mes' disabled='disabled' class='form-control select2'>";
            $cmb .= "<option value=''>Seleccione un mes</option>";
        }

        $cmb .= "</select>";
        echo json_encode($cmb);
        return;
    }

    public function actionCargarMesesInicioAcum() {
        $anio = $_POST['anio'];

        $criteria = new CDbCriteria();
        $criteria->condition = 'pg_tipo=\'SEMANAL\' AND pg_anio=' . $anio;
        $criteria->distinct = true;
        $criteria->select = 'pg_mes';

        $meses = PeriodoGestionModel::model()->findAll($criteria);

        if (count($meses) > 0) {
            $cmb = "<select name='RptCliSinGestionxFechaForm_mesInicioAcum' id='RptCliSinGestionxFechaForm_mesInicioAcum' class='form-control select2'>";
            $cmb .= "<option value=''>Seleccione un mes</option>";
            $opcion = '';
            foreach ($meses as $value) {
                $fechaIni = intval($anio) . '-' . $value['pg_mes'] . '-01';
                $fechaInicio = date(FORMATO_FECHA_3, strtotime($fechaIni));
                $fechaFin = date("Y-m-t", strtotime($fechaInicio));
                switch ($value['pg_mes']) {
                    case 1:
                        $nombre = 'Enero';
                        break;
                    case 2:
                        $nombre = 'Febrero';
                        break;
                    case 3:
                        $nombre = 'Marzo';
                        break;
                    case 4:
                        $nombre = 'Abril';
                        break;
                    case 5:
                        $nombre = 'Mayo';
                        break;
                    case 6:
                        $nombre = 'Junio';
                        break;
                    case 7:
                        $nombre = 'Julio';
                        break;
                    case 8:
                        $nombre = 'Agosto';
                        break;
                    case 9:
                        $nombre = 'Septiembre';
                        break;
                    case 10:
                        $nombre = 'Octubre';
                        break;
                    case 11:
                        $nombre = 'Noviembre';
                        break;
                    case 12:
                        $nombre = 'Diciembre';
                        break;
                    default:
                        break;
                }
                $opcion .= "<option value=" . $fechaInicio . " >" . $nombre . "</option>";
            }
            $cmb .= $opcion;
        } else {
            $cmb = "< select name='RptCliSinGestionxFechaForm_mesInicioAcum' id='RptCliSinGestionxFechaForm_mesInicioAcum' disabled='disabled' class='form-control select2'>";
            $cmb .= "<option value=''>Seleccione un mes</option>";
        }

        $cmb .= "</select>";
        echo json_encode($cmb);
        return;
    }

    public function actionCargarMesesFinAcum() {
        $anio = $_POST['anio'];

        $criteria = new CDbCriteria();
        $criteria->condition = 'pg_tipo=\'SEMANAL\' AND pg_anio=' . $anio;
        $criteria->distinct = true;
        $criteria->select = 'pg_mes';

        $meses = PeriodoGestionModel::model()->findAll($criteria);

        if (count($meses) > 0) {
            $cmb = "<select name='RptCliSinGestionxFechaForm_mesFinAcum' id='RptCliSinGestionxFechaForm_mesFinAcum' class='form-control select2'>";
            $cmb .= "<option value=''>Seleccione un mes</option>";
            $opcion = '';
            foreach ($meses as $value) {
                $fechaIni = intval($anio) . '-' . $value['pg_mes'] . '-01';
                $fechaInicio = date(FORMATO_FECHA_3, strtotime($fechaIni));
                $fechaFin = date("Y-m-t", strtotime($fechaInicio));
                switch ($value['pg_mes']) {
                    case 1:
                        $nombre = 'Enero';
                        break;
                    case 2:
                        $nombre = 'Febrero';
                        break;
                    case 3:
                        $nombre = 'Marzo';
                        break;
                    case 4:
                        $nombre = 'Abril';
                        break;
                    case 5:
                        $nombre = 'Mayo';
                        break;
                    case 6:
                        $nombre = 'Junio';
                        break;
                    case 7:
                        $nombre = 'Julio';
                        break;
                    case 8:
                        $nombre = 'Agosto';
                        break;
                    case 9:
                        $nombre = 'Septiembre';
                        break;
                    case 10:
                        $nombre = 'Octubre';
                        break;
                    case 11:
                        $nombre = 'Noviembre';
                        break;
                    case 12:
                        $nombre = 'Diciembre';
                        break;
                    default:
                        break;
                }
                $opcion .= "<option value=" . $fechaFin . " >" . $nombre . "</option>";
            }
            $cmb .= $opcion;
        } else {
            $cmb = "< select name='RptCliSinGestionxFechaForm_mesFinAcum' id='RptCliSinGestionxFechaForm_mesFinAcum' disabled='disabled' class='form-control select2'>";
            $cmb .= "<option value=''>Seleccione un mes</option>";
        }

        $cmb .= "</select>";
        echo json_encode($cmb);
        return;
    }

}
