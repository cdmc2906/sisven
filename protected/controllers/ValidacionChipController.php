<?php

class ValidacionChipController extends Controller {

    public $layout = LAYOUT_FILTRO_GRID;

    public function actionIndex() {
        Yii::app()->user->setFlash('resultadoValidacion', null);
        unset(Yii::app()->session['VALIDACION']);
        if (Yii::app()->request->isAjaxRequest) {
            return;
        } else {
            Yii::app()->session['ValidacionChipForm'] = '';
            $model = new ValidacionChipForm ();
            $this->render('/proceso/validacionChip', array('model' => $model));
        }
    }

    public function actionRevisarChips() {
        $response = new Response();
        $mensaje = '';
        $validarChip = new FValidacionChipModel();

        $cantidadOK = 0;
        $cantidadNOTececab = 0;
        unset(Yii::app()->session['VALIDACION']);
        try {
//            var_dump($_POST['ValidacionChipForm']);//die();
            if (isset($_POST['ValidacionChipForm'])) {
                $model = new ValidacionChipForm();
                $model->attributes = $_POST['ValidacionChipForm'];
                if ($model->validate()) {
                    $promoValidada = FALSE;
                    $ejecutivoReportaValidado = FALSE;

                    $tipoValidacion = $_POST['ValidacionChipForm']['tipoValidacion'];
                    $idPromocion = $_POST['ValidacionChipForm']['promocion'];
                    $min_enviado = $_POST['ValidacionChipForm']['min'];
                    $icc_enviado = $_POST['ValidacionChipForm']['icc'];

                    $operadora = $_POST['ValidacionChipForm']['operadora'];
                    $codigoLocal = $_POST['ValidacionChipForm']['codigoLocal'];
                    $reportadoPor = $_POST['ValidacionChipForm']['reportadoPor'];
                    $ejecutivoReporta = $_POST['ValidacionChipForm']['ejecutivoReporta'];
                    $reportadoVia = $_POST['ValidacionChipForm']['reportadoVia'];

//                    var_dump($tipoValidacion,VALIDACION_PROMO,$tipoValidacion == VALIDACION_PROMO,$idPromocion );
                    if ($tipoValidacion == VALIDACION_PROMO) {
                        if ($idPromocion != '') {
                            $valorValidarMin = isset($numeroMin[1]) ? $numeroMin[1] : '';
                            $promoValidada = TRUE;
                        }
                    } else {
                        $promoValidada = TRUE;
                    }

                    if ($reportadoPor == 'EJECUTIVO') {
                        if ($ejecutivoReporta != '')
                            $ejecutivoReportaValidado = TRUE;
                    }
                    else {
                        $ejecutivoReportaValidado = TRUE;
                    }

                    if ($ejecutivoReportaValidado) {
                        if ($promoValidada) {
                            if (trim($_POST['ValidacionChipForm']['min']) != '' || trim($_POST['ValidacionChipForm']['icc']) != '') {

                                $resultadoValidaItem = '';

                                $valorValidarMin = '';
                                $valorValidarICC = '';

                                $resultados = array();
                                $chipsValidos = array();
                                $chipsNoValidos = '';
                                $newLine = "\n";
                                $separadorConsulta = '-';
                                $parametroCompara = '';

                                $mines = array();
                                $mines = explode(PHP_EOL, $min_enviado);

                                foreach ($mines as $min) {
                                    if (strlen($min) > 0) {
                                        $numeroMin = explode($separadorConsulta, $min);

                                        if ($tipoValidacion == VALIDACION_PROMO) {
                                            $valorValidarMin = isset($numeroMin[1]) ? $numeroMin[1] : '';
                                        } else if ($tipoValidacion == VALIDACION_AUDITORIA) {
                                            $valorValidarMin = isset($min) ? $min : '';
                                        }

                                        $resultadoValidaItem = $validarChip->getDatosChipsXMin(
                                                $tipoValidacion
                                                , $numeroMin[0]
                                                , isset($numeroMin[1]) ? $numeroMin[1] : ''
                                                , $this->ValidarItem(
                                                        'M'
                                                        , $tipoValidacion
                                                        , $valorValidarMin
                                                        , $idPromocion)
                                                , $operadora
                                                , $codigoLocal
                                                , $reportadoPor
                                                , $ejecutivoReporta
                                                , $reportadoVia
                                        );
//                                        var_dump($resultadoValidaItem);die();

                                        if (count($resultadoValidaItem) > 0) {
                                            foreach ($resultadoValidaItem as $resultadoParcial) {
                                                array_push($chipsValidos, $resultadoParcial);
                                                $cantidadOK += 1;
                                            }
                                        } else {
                                            $CONS_MIN_NO_TECECAB = strlen($numeroMin[0]) == 10 ? NO_TECECAB : (strlen($numeroMin[0]) == 9 ? NO_TECECAB : 'MIN INCORRECTO');
                                            $noaplica = array(
                                                'TIPO' => $tipoValidacion,
                                                'SUBTIPO' => 'VM',
                                                'MIN_ICC' => $numeroMin[0],
                                                'CAMPO_VALIDA' => isset($numeroMin[1]) ? $numeroMin[1] : '',
                                                'RESULTADO_VALIDA' => $CONS_MIN_NO_TECECAB,
                                                'COMPRA_CDG_COMPRA' => $CONS_MIN_NO_TECECAB,
                                                'COMPRA_MIN' => $CONS_MIN_NO_TECECAB,
                                                'COMPRA_ICC' => $CONS_MIN_NO_TECECAB,
                                                'COMPRA_FECHA_COMPRA' => $CONS_MIN_NO_TECECAB,
                                                'COMPRA_MIN593' => $CONS_MIN_NO_TECECAB,
                                                'COMPRA_FECHA_ALTA' => $CONS_MIN_NO_TECECAB,
                                                'COMPRA_MESCOMPRA' => $CONS_MIN_NO_TECECAB,
                                                'COMPRA_YEARCOMPRA' => $CONS_MIN_NO_TECECAB,
                                                'TXMOVISTAR_ICC' => $CONS_MIN_NO_TECECAB,
                                                'TXMOVISTAR_MIN' => $CONS_MIN_NO_TECECAB,
                                                'TXMOVISTAR_FECHA' => $CONS_MIN_NO_TECECAB,
                                                'TXMOVISTAR_ID_DISTRI' => $CONS_MIN_NO_TECECAB,
                                                'TXMOVISTAR_NMB_DISTRI' => $CONS_MIN_NO_TECECAB,
                                                'TXMOVISTAR_ID_DESTINO' => $CONS_MIN_NO_TECECAB,
                                                'TXMOVISTAR_NMB_DESTINO' => $CONS_MIN_NO_TECECAB,
                                                'VTMOVISTAR_FECHA' => $CONS_MIN_NO_TECECAB,
                                                'VTMOVISTAR_ICC' => $CONS_MIN_NO_TECECAB,
                                                'VTMOVISTAR_MIN' => $CONS_MIN_NO_TECECAB,
                                                'VTMOVISTAR_ID_DISTRI' => $CONS_MIN_NO_TECECAB,
                                                'VTMOVISTAR_NMB_DISTRI' => $CONS_MIN_NO_TECECAB,
                                                'VTMOVISTAR_ID_DESTINO' => $CONS_MIN_NO_TECECAB,
                                                'VTMOVISTAR_NMB_DESTINO' => $CONS_MIN_NO_TECECAB,
                                                'VENTAS_MIN' => $CONS_MIN_NO_TECECAB,
                                                'VENTAS_IMEI' => $CONS_MIN_NO_TECECAB,
                                                'VENTAS_MIN593' => $CONS_MIN_NO_TECECAB,
                                                'VENTAS_FECHA' => $CONS_MIN_NO_TECECAB,
                                                'VENTAS_NUMERO_BODEGA' => $CONS_MIN_NO_TECECAB,
                                                'VENTAS_BODEGA' => $CONS_MIN_NO_TECECAB,
                                                'VENTAS_SERIE' => $CONS_MIN_NO_TECECAB,
                                                'VENTAS_NUMERO_FACTURA' => $CONS_MIN_NO_TECECAB,
                                                'VENTAS_NOMBRE_CLIENTE' => $CONS_MIN_NO_TECECAB,
                                                'VENTAS_RUC' => $CONS_MIN_NO_TECECAB,
                                                'VENTAS_CODIGO' => $CONS_MIN_NO_TECECAB,
                                                'VENTAS_ESTADO' => $CONS_MIN_NO_TECECAB,
                                                'ALTAS_MIN ' => $CONS_MIN_NO_TECECAB,
                                                'ALTAS_ICC' => $CONS_MIN_NO_TECECAB,
                                                'ALTAS_FECHA_ALTA' => $CONS_MIN_NO_TECECAB,
                                                'ALTAS_CIUDAD' => $CONS_MIN_NO_TECECAB,
                                                'ALTAS_MESALTA' => $CONS_MIN_NO_TECECAB,
                                                'ALTAS_YEARALTA' => $CONS_MIN_NO_TECECAB,
                                                'PROMO_OPERADORA' => $CONS_MIN_NO_TECECAB,
                                                'PROMO_CODIGO_LOCAL' => $CONS_MIN_NO_TECECAB,
                                                'PROMO_REPORTADO_POR' => $CONS_MIN_NO_TECECAB,
                                                'PROMO_EJECUTIVO_REPORTA' => $CONS_MIN_NO_TECECAB,
                                                'PROMO_REPORTA_VIA' => $CONS_MIN_NO_TECECAB,
                                            );
                                            array_push($chipsValidos, $noaplica);
                                            $cantidadNOTececab += 1;
                                        }
                                    }
                                }

                                $iccs = array();
                                $iccs = explode(PHP_EOL, $icc_enviado);

                                foreach ($iccs as $icc) {
                                    if (strlen($icc) > 0) {

                                        $numeroICC = explode($separadorConsulta, $icc);
                                        if ($tipoValidacion == VALIDACION_PROMO) {
                                            $valorValidarICC = isset($numeroICC [1]) ? $numeroICC [1] : '';
                                        } else if ($tipoValidacion == VALIDACION_AUDITORIA) {
                                            $valorValidarICC = isset($icc) ? $icc : '';
                                        }

                                        $resultadoValidaItem = $validarChip->getDatosChipsXICC(
                                                $tipoValidacion
                                                , $numeroICC[0]
                                                , isset($numeroICC[1]) ? $numeroICC[1] : ''
                                                , $this->ValidarItem(
                                                        'I'
                                                        , $tipoValidacion
                                                        , $valorValidarICC
                                                        , $idPromocion
                                                )
                                                , $operadora
                                                , $codigoLocal
                                                , $reportadoPor
                                                , $ejecutivoReporta
                                                , $reportadoVia
                                        );

                                        if (count($resultadoValidaItem) > 0) {
                                            foreach ($resultadoValidaItem as $resultadoParcial) {
                                                array_push($chipsValidos, $resultadoParcial);
                                                $cantidadOK += 1;
                                            }
                                        } else {
                                            $CONS_ICC_NO_TECECAB = strlen($numeroICC[0]) == 19 ? NO_TECECAB : 'ICC INCORRECTO';
                                            $noaplica = array(
                                                'TIPO' => $tipoValidacion,
                                                'SUBTIPO' => 'VI',
                                                'MIN_ICC' => $numeroICC[0],
                                                'CAMPO_VALIDA' => isset($numeroICC[1]) ? $numeroICC[1] : '',
                                                'RESULTADO_VALIDA' => $CONS_MIN_NO_TECECAB,
                                                'TIPO' => $CONS_ICC_NO_TECECAB,
                                                'COMPRA_CDG_COMPRA' => $CONS_ICC_NO_TECECAB,
                                                'COMPRA_MIN' => $CONS_ICC_NO_TECECAB,
                                                'COMPRA_ICC' => $CONS_ICC_NO_TECECAB,
                                                'COMPRA_FECHA_COMPRA' => $CONS_ICC_NO_TECECAB,
                                                'COMPRA_MIN593' => $CONS_ICC_NO_TECECAB,
                                                'COMPRA_FECHA_ALTA' => $CONS_ICC_NO_TECECAB,
                                                'COMPRA_MESCOMPRA' => $CONS_ICC_NO_TECECAB,
                                                'COMPRA_YEARCOMPRA' => $CONS_ICC_NO_TECECAB,
                                                'TXMOVISTAR_ICC' => $CONS_ICC_NO_TECECAB,
                                                'TXMOVISTAR_MIN' => $CONS_ICC_NO_TECECAB,
                                                'TXMOVISTAR_FECHA' => $CONS_ICC_NO_TECECAB,
                                                'TXMOVISTAR_ID_DISTRI' => $CONS_ICC_NO_TECECAB,
                                                'TXMOVISTAR_NMB_DISTRI' => $CONS_ICC_NO_TECECAB,
                                                'TXMOVISTAR_ID_DESTINO' => $CONS_ICC_NO_TECECAB,
                                                'TXMOVISTAR_NMB_DESTINO' => $CONS_ICC_NO_TECECAB,
                                                'VTMOVISTAR_FECHA' => $CONS_ICC_NO_TECECAB,
                                                'VTMOVISTAR_ICC' => $CONS_ICC_NO_TECECAB,
                                                'VTMOVISTAR_MIN' => $CONS_ICC_NO_TECECAB,
                                                'VTMOVISTAR_ID_DISTRI' => $CONS_ICC_NO_TECECAB,
                                                'VTMOVISTAR_NMB_DISTRI' => $CONS_ICC_NO_TECECAB,
                                                'VTMOVISTAR_ID_DESTINO' => $CONS_ICC_NO_TECECAB,
                                                'VTMOVISTAR_NMB_DESTINO' => $CONS_ICC_NO_TECECAB,
                                                'VENTAS_MIN' => $CONS_ICC_NO_TECECAB,
                                                'VENTAS_IMEI' => $CONS_ICC_NO_TECECAB,
                                                'VENTAS_MIN593' => $CONS_ICC_NO_TECECAB,
                                                'VENTAS_FECHA' => $CONS_ICC_NO_TECECAB,
                                                'VENTAS_NUMERO_BODEGA' => $CONS_ICC_NO_TECECAB,
                                                'VENTAS_BODEGA' => $CONS_ICC_NO_TECECAB,
                                                'VENTAS_SERIE' => $CONS_ICC_NO_TECECAB,
                                                'VENTAS_NUMERO_FACTURA' => $CONS_ICC_NO_TECECAB,
                                                'VENTAS_NOMBRE_CLIENTE' => $CONS_ICC_NO_TECECAB,
                                                'VENTAS_RUC' => $CONS_ICC_NO_TECECAB,
                                                'VENTAS_CODIGO' => $CONS_ICC_NO_TECECAB,
                                                'VENTAS_ESTADO' => $CONS_ICC_NO_TECECAB,
                                                'ALTAS_MIN ' => $CONS_ICC_NO_TECECAB,
                                                'ALTAS_ICC' => $CONS_ICC_NO_TECECAB,
                                                'ALTAS_FECHA_ALTA' => $CONS_ICC_NO_TECECAB,
                                                'ALTAS_CIUDAD' => $CONS_ICC_NO_TECECAB,
                                                'ALTAS_MESALTA' => $CONS_ICC_NO_TECECAB,
                                                'ALTAS_YEARALTA' => $CONS_ICC_NO_TECECAB,
                                                'PROMO_OPERADORA' => $CONS_ICC_NO_TECECAB,
                                                'PROMO_CODIGO_LOCAL' => $CONS_ICC_NO_TECECAB,
                                                'PROMO_REPORTADO_POR' => $CONS_ICC_NO_TECECAB,
                                                'PROMO_EJECUTIVO_REPORTA' => $CONS_ICC_NO_TECECAB,
                                                'PROMO_REPORTA_VIA' => $CONS_ICC_NO_TECECAB,
                                            );
                                            array_push($chipsValidos, $noaplica);
                                            $cantidadNOTececab += 1;
                                        }
                                    }
                                }

                                Yii::app()->session['VALIDACION'] = $chipsValidos;
                                $resultados['validos'] = $chipsValidos;
                                $resultados['resultado'] = "** RESULTADO **" . $newLine . $newLine
                                        . ($cantidadOK + $cantidadNOTececab) . " Chips validados" . $newLine
                                        . $cantidadOK . " Chips correctos" . $newLine
                                        . $cantidadNOTececab . " Chips No son Tececab" . $newLine;

                                $mensaje = 'Validacion concluida';
                                $response->Message = $mensaje;
                                $response->Result = $resultados;
                                $response->Status = SUCCESS;
                            } else {
                                $mensaje = 'Debe ingresar Mines o Icc para validar';
                                $response->Message = $mensaje;
                                $response->ClassMessage = CLASS_MENSAJE_NOTICE;
                                $response->Status = ERROR;
                            }
                        } else {
                            $mensaje = 'Seleccione una promocion para la validacion';
                            $response->Message = $mensaje;
                            $response->ClassMessage = CLASS_MENSAJE_NOTICE;
                            $response->Status = ERROR;
                        }
                    } else {
                        $mensaje = 'Seleccione el ejecutivo que reporta';
                        $response->Message = $mensaje;
                        $response->ClassMessage = CLASS_MENSAJE_NOTICE;
                        $response->Status = ERROR;
                    }
                } else {

                    $mensaje = 'Existe campos obligatorios (*) sin registrar';
                    $response->Message = $mensaje;
                    $response->ClassMessage = CLASS_MENSAJE_NOTICE;
                    $response->Status = ERROR;
                }
            } else {
                $mensaje = 'No se pudieron obtener datos del formulario';
            }
//            
        } catch (Exception $e) {
            $datosMinesPorGestionar['limpiar'] = false;
            $mensaje = 'Se ha producido un error al validar los registros';
            $response->Message = $mensaje;
            $response->ClassMessage = CLASS_MENSAJE_NOTICE;
            $response->Status = ERROR;
        }

        $this->actionResponse(null, null, $response);
        return;
    }

    function ValidarItem($origen, $tipo = '', $valorValidar, $idPromocion) {
        $resultadoValidaCondicion = '';
        switch ($tipo) {
            case VALIDACION_PROMO:
                if (strlen($valorValidar) > 0) {
                    $criteria = new CDbCriteria;
                    $condicion = "pr_id =" . intval($idPromocion);
                    $criteria->addCondition($condicion);
                    $condicion = "cpr_estado = 4";
                    $criteria->addCondition($condicion);

                    $condicionespromociones = CondicionPromocionModel::model()->findAll($criteria);

                    $resultadoValidaCondicion = 'SELECCIONE PROMOCION';
                    if (count($condicionespromociones) > 0) {
                        foreach ($condicionespromociones as $condicion) {
                            $resultadoValidaCondicion = 'NO APLICA';
                            $parametroCompara = strtotime($valorValidar);
                            if (isset($parametroCompara)) {
                                switch ($condicion["cpr_operador"]) {
                                    case OPERADOR_BETWEEN:
                                        if (
                                                $parametroCompara >= strtotime($condicion["cpr_valor_min"]) &&
                                                $parametroCompara <= strtotime($condicion["cpr_valor_max"])) {
                                            $resultadoValidaCondicion = 'APLICA';
                                        }
                                        break;
                                    case OPERADOR_MAYOR_IGUAL:
                                        if ($parametroCompara >= $condicion["cpr_valor_min"])
                                            $resultadoValidaCondicion = 'APLICA';
                                        break;
                                    case OPERADOR_MENOR_IGUAL:
                                        if ($parametroCompara <= $condicion["cpr_valor_min"])
                                            $resultadoValidaCondicion = 'APLICA';
                                        break;
                                    case OPERADOR_IGUAL:
                                        if ($parametroCompara == $condicion["cpr_valor_min"])
                                            $resultadoValidaCondicion = 'APLICA';
                                        break;
                                    case OPERADOR_LIKE:
                                        break;
                                    case OPERADOR_IN:
                                        break;
                                    case OPERADOR_DIFERENTE:
                                        if ($parametroCompara != $condicion["cpr_valor_min"])
                                            $resultadoValidaCondicion = 'APLICA';
                                        break;
                                    default :
                                        break;
                                } //Fin Switch
                            }
                        }
                    }
                }
                else {
                    $resultadoValidaCondicion = 'Parametro validacion incorrecto';
                }

                break;
            case VALIDACION_AUDITORIA:
//                var_dump($origen);die();
                if ($origen == 'I') {
                    $numeroICC = explode('-', $valorValidar);
                    $datosEnMovistar = new FVentasMovistarModel();
                    $resultado = $datosEnMovistar->getDatosVentaxICC($numeroICC[0]);
//                    var_dump($resultado);                    die();

                    if (count($resultado) > 1)
                        $resultadoValidaCondicion = 'MIN EN VARIAS VENTAS';
                    else {
                        if ($resultado[0]['vm_iddestino'] == $numeroICC[1])
                            $resultadoValidaCondicion = 'LOCAL OK';
                        else
                            $resultadoValidaCondicion = 'LOCAL DIFERENTE';
                    }
                } else {
                    $resultadoValidaCondicion = 'AUDITORIA DE MIN NO DISPONIBLE';
                }
                break;

            default:
                break;
        }

        return $resultadoValidaCondicion;
    }

    public function actionGuardarMinesPromo() {
        try {
            $response = new Response();
            $rutasAsignadas = array();
            $totalResumenOmitidos = 0;
            $totalResumenGuardados = 0;
            $mensaje = '';

//            var_dump(Yii::app()->session['VALIDACION']);die();
//            var_dump($_POST);            die();
//            var_dump($_POST['codigoLocal']);
//            die();
//            var_dump($_POST['minesSeleccionados']);
//            die();
//            if (count($_POST) > 0) {
//                if (Yii::app()->session['tipoUsuario'] == 1) {
//                    foreach ($_POST as $idsRutasSeleccionada) {
//                        foreach ($idsRutasSeleccionada as $idRuta) {
//                            $data = array(
//                                'rg_id' => $idRuta,
//                                'iduser' => Yii::app()->session['codigUsuarioSeleccionado'],
//                                'ur_nombre_ejecutivo' => '',
//                                'ur_estado' => 1,
//                                'ur_zona_gestion' => Yii::app()->session['codigoZonaSeleccionada'],
//                                'ur_fecha_ingreso' => date(FORMATO_FECHA_LONG),
//                                'ur_fecha_modifica' => date(FORMATO_FECHA_LONG),
//                                'ur_cod_usuario_ingresa_modifica' => Yii::app()->user->id,
//                            );
//                            array_push($rutasAsignadas, $data);
//                            unset($data);
//                        }
//                    }
//
//                    $dbConnection = new CI_DB_active_record(null);
//                    $sql = $dbConnection->insert_batch('tb_usuario_ruta', $rutasAsignadas);
//                    $sql = str_replace('"', '', $sql);
//                    $connection = Yii::app()->db_conn;
//                    $connection->active = true;
//                    $transaction = $connection->beginTransaction();
//                    $command = $connection->createCommand($sql);
//                    $countInsertResumen = $command->execute();
//
//                    if ($countInsertResumen > 0) {
//                        $transaction->commit();
//                        $totalResumenGuardados = $countInsertResumen;
//                    } else {
//                        $transaction->rollback();
//                        $totalResumenOmitidos += 1;
//                    }
//
//                    unset($rutasAsignadas);
//                    $connection->active = false;
//
//                    if (Yii::app()->session['codigoZonaSeleccionada'] > 0) {
//                        $fRuta = new FRutasGestionModel();
//                        $rutasZona = $fRuta->getRutaxZona(
//                                Yii::app()->session['codigoZonaSeleccionada']
//                                , Yii::app()->session['codigUsuarioSeleccionado']
//                                , Yii::app()->session['idPeriodoSemanalActivo']
//                                , Yii::app()->session['tipoUsuario']
//                        );
//
//                        $rutasAsignadas['rutasZona'] = $rutasZona;
//                    }
//
//                    $fUsuarioRuta = new FUsuarioRutaModel();
//                    $rutasAsignadas['rutasAsignadas'] = $fUsuarioRuta->getRutasAsignadasxUsuario(Yii::app()->session['codigUsuarioSeleccionado']);
//
//                    if ($totalResumenGuardados > 0) {
//                        $mensaje .= '<br>Se han asignado ' . $totalResumenGuardados . ' rutas correctamente.';
//                        $response->ClassMessage = CLASS_MENSAJE_SUCCESS;
//                    }
//                    if ($totalResumenOmitidos > 0) {
//                        $mensaje .= '<br>Se han omitido ' . $totalResumenOmitidos . ' rutas.';
//                        $response->ClassMessage = CLASS_MENSAJE_NOTICE;
//                    }
//                } elseif (Yii::app()->session['tipoUsuario'] == 2) {
//                    $ejecutivoAsignar = EjecutivoModel::model()->findByAttributes(array('e_cod' => array(Yii::app()->session['codigUsuarioSeleccionado'])));
//                    foreach ($_POST as $idsRutasSeleccionada) {
//                        foreach ($idsRutasSeleccionada as $idRuta) {
//                            $dato = explode('-', $idRuta); //primer valor id de ruta, segundo valor semana gestionar, tercer valor dia a gestionar
//                            $ruta = RutaGestionModel::model()->findByAttributes(array('rg_id' => array($dato[0])));
//                            $data = array(
//                                'e_cod' => $ejecutivoAsignar['e_cod'],
//                                'rg_id' => $dato[0],
//                                'er_usuario' => $ejecutivoAsignar['e_usr_mobilvendor'],
//                                'er_usuario_nombre' => $ejecutivoAsignar['e_nombre'],
//                                'er_ruta' => $ruta['rg_cod_ruta_mb'],
//                                'er_ruta_nombre' => $ruta['rg_nombre_ruta'],
//                                'er_semana_visitar' => $dato[1],
//                                'er_dia_visitar' => $dato[2],
//                                'er_estado' => 1,
//                                'er_fecha_ingreso' => date(FORMATO_FECHA_LONG),
//                                'er_fecha_modificacion' => date(FORMATO_FECHA_LONG),
//                                'er_cod_usr_ing' => Yii::app()->user->id,
//                                'er_cod_usr_mod' => Yii::app()->user->id,
//                            );
//                            array_push($rutasAsignadas, $data);
//                            unset($data);
//                        }
//                    }
//
//                    $dbConnection = new CI_DB_active_record(null);
//                    $sql = $dbConnection->insert_batch('tb_ejecutivo_ruta', $rutasAsignadas);
//                    $sql = str_replace('"', '', $sql);
//                    $connection = Yii::app()->db_conn;
//                    $connection->active = true;
//                    $transaction = $connection->beginTransaction();
//                    $command = $connection->createCommand($sql);
//                    $countInsertResumen = $command->execute();
//
//                    if ($countInsertResumen > 0) {
//                        $transaction->commit();
//                        $totalResumenGuardados = $countInsertResumen;
//                    } else {
//                        $transaction->rollback();
//                        $totalResumenOmitidos += 1;
//                    }
//
//                    unset($rutasAsignadas);
//                    $connection->active = false;
//
//                    if (Yii::app()->session['codigoZonaSeleccionada'] > 0) {
//                        $fRuta = new FRutasGestionModel();
//                        $rutasZona = $fRuta->getRutaxZona(
//                                Yii::app()->session['codigoZonaSeleccionada']
//                                , Yii::app()->session['codigUsuarioSeleccionado']
//                                , Yii::app()->session['idPeriodoSemanalActivo']
//                                , Yii::app()->session['tipoUsuario']
//                        );
//
//                        $rutasAsignadas['rutasZona'] = $rutasZona;
//                    }
//
//                    $fEjecutivoRuta = new FEjecutivoRutaModel();
//                    $rutasAsignadas['rutasAsignadas'] = $fEjecutivoRuta->getRutasAsignadasxEjecutivo(Yii::app()->session['codigUsuarioSeleccionado'], Yii::app()->session['idPeriodoSemanalActivo']);
//
//                    if ($totalResumenGuardados > 0) {
//                        $mensaje .= '<br>Se han asignado ' . $totalResumenGuardados . ' rutas correctamente.';
//                        $response->ClassMessage = CLASS_MENSAJE_SUCCESS;
//                        $response->Status = SUCCESS;
//                    }
//                    if ($totalResumenOmitidos > 0) {
//                        $mensaje .= '<br>Se han omitido ' . $totalResumenOmitidos . ' rutas.';
//                        $response->ClassMessage = CLASS_MENSAJE_NOTICE;
//                        $response->Status = NOTICE;
//                    }
//                }
//            } else {
//                
//            }
            $mensaje = 'Registros guardados';

            $response->Status = SUCCESS;

//        $response->Result = $rutasAsignadas;
        } catch (Exception $e) {
            $mensaje = 'Se ha producido un error al guardar los registros';
        }
        $response->Message = $mensaje;
        $response->Message = $mensaje;
//        $response->Result = $rutasAsignadas;
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
