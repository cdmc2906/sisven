<?php

class ConsultaChipController extends Controller {

    public $layout = LAYOUT_FILTRO_GRID;

    public function actionIndex() {
        Yii::app()->user->setFlash('resultadoValidacion', null);
        unset(Yii::app()->session['VALIDACION']);
        Yii::app()->session['codigoAcceso'] = '';
        if (Yii::app()->request->isAjaxRequest) {
            return;
        } else {
            Yii::app()->session['ConsultaChipForm'] = '';
            $model = new ConsultaChipForm ();
            $this->render('/proceso/consultaChip', array('model' => $model));
        }
    }

    public function actionValidarCodigoAcceso() {
        try {
            $response = new Response();
//        var_dump($_COOKIE["tccvalidaciontoken"]);die();
//        var_dump($_COOKIE);//die();
//            var_dump($_POST["codigoIngresado"]);die();
            $resultadoValidacion = "";
            $codigos = array(
                "christian.araujo" => "va4m8",
                "patricio.mejia" => "juefq",
                "haydee.romero" => "3fvq1",
                "giovana.bonilla" => "edaqy",
                "jose.chamba" => "kvjie",
                "luis.burgos" => "br193",
                "oscar.almeida" => "5lvle",
                "vladimir.guilcazo" => "v7rej",
                "jhonny.pluas" => "8h7jf",
                "katerina.chaluisa" => "wpb6a",
                "cristina.quishpe" => "rwuno",
                "danny.gomez" => "sim55",
                "paul.apunte" => "wba2e",
                "esteban.martinez" => "3i1gb",
                "alejandro.rodriguez" => "05k27",
                "brenda.castillo" => "t6sms",
                "jofree.coveña" => "hz3g4",
                "dario.loor" => "hosnk",
                "zaida.moreira" => "wx29q",
                "paola.moreta" => "trqjq",
                "paola.delgado" => "vkhj9",
                "lady.tigse" => "xzusv",
                "jacqueline.atiencia" => "vryl7",
            );

            $usuarioClave = array_search($_POST["codigoIngresado"], $codigos);

            $validacion_clave = "";
//            var_dump($clave);die();

            if ($usuarioClave) {
                $validacion_clave = "CLAVE DE ACCESO ACEPTADA";
                $cookie_name = "tccvalidaciontoken";
                $cookie_value = $_POST["codigoIngresado"];
                setcookie($cookie_name, $cookie_value, time() + 43200, "/"); // dura 1/2 día
                Yii::app()->session['codigoAcceso'] = $usuarioClave . "+" . $_POST["codigoIngresado"];
            } else {
                if (strlen($_POST["codigoIngresado"]) > 0) {
                    $validacion_clave = "CLAVE DE ACCESO INCORRECTA";
                    setcookie("tccvalidaciontoken", "", time() - 3600); //borro cookie
                    Yii::app()->session['codigoAcceso'] = '';
                } else {
                    $validacion_clave = "INGRESE LA CLAVE DE ACCESO";
                    Yii::app()->session['codigoAcceso'] = '';
                }
            }

//            var_dump( $_SERVER['HTTP_USER_AGENT']);die();
//            var_dump(getallheaders());die();


            $respuesta["usuario"] = " \nBienvenido " . $usuarioClave;
            $respuesta["validacion"] = $validacion_clave;
            $respuesta["info"] = getallheaders();

//            $response->Result = $validacion_clave;
            $response->Result = $respuesta;
            $response->Status = SUCCESS;
            $this->actionResponse(null, null, $response);
            return;
        } catch (Exception $ex) {
//            $datosMinesPorGestionar['limpiar'] = false;
            $mensaje = 'Se ha producido un error al validar el codigo';
            $response->Message = $mensaje;
            $response->ClassMessage = CLASS_MENSAJE_NOTICE;
            $response->Status = ERROR;
        }
    }

    public function actionRevisarChips() {
        try {
//            var_dump($_POST['ConsultaChipForm']);die();
            $response = new Response();
            $iccs_validados = array();
            $icc_validado = array();
            $mines_validados = array();
            $min_validado = array();

            unset(Yii::app()->session['VALIDACION']);
            if (isset($_POST['ConsultaChipForm'])) {
                $model = new ConsultaChipForm();
//                var_dump($model->validate());die();
                $model->attributes = $_POST['ConsultaChipForm'];
                if ($model->validate()) {
                    $resultadoValidaCodigoLocal = $this->ValidarCodigoLocal($_POST['ConsultaChipForm']['codigoLocal']);
                    if (strlen($resultadoValidaCodigoLocal) == 0) {
                        $min_enviado = $_POST['ConsultaChipForm']['min'];
                        $icc_enviado = $_POST['ConsultaChipForm']['icc'];

                        if (trim($_POST['ConsultaChipForm']['min']) != '' || trim($_POST['ConsultaChipForm']['icc']) != '') {

                            $detalleResultadoIccs = " ";
                            $conteoIccTececab = 0;
                            $conteoIccNoTececab = 0;
                            $conteoIccIncorrecto = 0;
                            if (strlen($icc_enviado) > 0) {
                                $iccs = array();
                                $iccs = explode(PHP_EOL, $icc_enviado);

                                $contadorI = 1;
                                foreach ($iccs as $icc) {
                                    $caso = (strlen($icc) > 19) ? "scanner" : "soloicc";
                                    if (substr($icc, 11, 4) == "8959" || substr($icc, 0, 4) == "8959") {
                                        $resultadoValidaItemIcc = $this->ValidarChipIndividual("icc", $caso == "scanner" ? substr($icc, 11, 19) : $icc, $contadorI);
                                        $detalleResultadoIccs = $detalleResultadoIccs . $resultadoValidaItemIcc["detalle"]; //. "\n";
                                        $conteoI = $resultadoValidaItemIcc["conteo"];

                                        switch ($conteoI) {
                                            case 0:
                                                $conteoIccNoTececab += 1;
                                                break;
                                            case 1:
                                                $conteoIccTececab += 1;
                                                break;
                                            default:
                                                $conteoIccIncorrecto += 1;
                                                break;
                                        }//fin switch conteo resultado valida icc
                                        $contadorI += 1;
                                    }//fin if validar inici icc
//                                    $icc_validado = array(
//                                        'rvc_dato_chip' => $rvc_dato_chip,
//                                        'rvc_tipo_validacion' => $rvc_tipo_validacion,
//                                        'rvc_subtipo_validacion' => $rvc_subtipo_validacion,
//                                        'rvc_resultado_validacion' => $rvc_resultado_validacion,
//                                        'rvc_ejecutivo' => $rvc_ejecutivo,
//                                    );

                                    array_push($iccs_validados, $icc_validado);
                                    unset($data);
                                }//fin foreach iccs
                            }
//                        var_dump($detalleResultadoIccs,$conteoIccTececab,$conteoIccNoTececab);die();
                            $detalleResultadoMines = " ";
                            $conteoMinTececab = 0;
                            $conteoMinNoTececab = 0;
                            $conteoMinIncorrecto = 0;
                            if (strlen($min_enviado) > 0) {
                                $mines = array();
                                $mines = explode(PHP_EOL, $min_enviado);

                                $contadorM = 1;

                                foreach ($mines as $min) {
                                    $caso = (strlen($min) > 13) ? "scanner" : "soloicc";
                                    if (substr($min, 11, 2) == "09" || substr($min, 0, 2) == "09" || substr($min, 0, 4) == "593" || substr($min, 1, 1) == "9") {
                                        $resultadoValidaItemMin = $this->ValidarChipIndividual("min", $caso == "scanner" ? substr($min, 11, 10) : $min, $contadorM);
                                        $detalleResultadoMines = $detalleResultadoMines . $resultadoValidaItemMin["detalle"] . "\n";
                                        $conteoM = $resultadoValidaItemMin["conteo"];
                                        switch ($conteoM) {
                                            case 0:
                                                $conteoMinNoTececab += 1;
                                                break;
                                            case 1:
                                                $conteoMinTececab += 1;
                                                break;
                                            default:
                                                $conteoMinIncorrecto += 1;
                                                break;
                                        }
                                        $contadorM += 1;
                                    }
                                }
                            }

                            $detalleResultado = $detalleResultadoIccs . "\n\n" . $detalleResultadoMines;
                            $datosAcceso = explode("+", Yii::app()->session['codigoAcceso']);
//                            var_dump($datosAcceso);die();
                            $mensaje = 'Validacion concluida';
                            $mensajeI = strlen($icc_enviado) > 0 ? "\n**VALIDACION ICCS**\n"
                                    . "_Solicita:_ " . $datosAcceso[0] . "\n"
                                    . "_Fecha:_ " . date("Y/m/d H:i:s") . "\n\n"
                                    . $conteoIccTececab . "icc(s) es/son de Tececab\n"
                                    . $conteoIccNoTececab . " icc(s) NO es/son de Tececab\n"
                                    . $conteoIccIncorrecto . " icc(s) es/son incorrectos\n" : "";

                            $mensajeM = strlen($min_enviado) > 0 ? "\n*VALIDACION MINES*\n"
                                    . $conteoMinTececab . " mines son de Tececab\n"
                                    . $conteoMinNoTececab . " mines NO son de Tececab\n"
                                    . $conteoMinIncorrecto . " mines son incorrectos\n" : "";
//                        var_dump($resultadoMostrar);die();

                            $resultadoMostrar["mensaje"] = $mensajeI . $mensajeM . "\n" . $detalleResultado;
                            $resultadoMostrar["respuesta"] = $detalleResultado;
                            $response->Message = $mensaje;
                            $response->Result = $resultadoMostrar;
                            $response->Status = SUCCESS;
                        } else {
                            $mensaje = 'Debe ingresar un ICC o MIN para validar';
                            $response->Message = $mensaje;
                            $response->ClassMessage = CLASS_MENSAJE_NOTICE;
                            $response->Status = ERROR;
                        }
                    } else {
                        $mensaje = $resultadoValidaCodigoLocal;
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
        } catch (Exception $e) {
            $datosMinesPorGestionar['limpiar'] = false;
            $mensaje = 'Se ha producido un error al validar los registros';
            $response->Message = $mensaje;
            $response->ClassMessage = CLASS_MENSAJE_NOTICE;
            $response->Status = ERROR;
        }
//        var_dump($response);die();
        Yii::app()->user->setFlash('resultadoValidacion', $mensaje);
        $this->actionResponse(null, null, $response);
        return;
    }

    function GuardarValidacion($validacionGuardar) {
//        $rvc_dato_chip, $rvc_tipo_validacion, $rvc_subtipo_validacion, $rvc_resultado_validacion, $rvc_ejecutivo
        try {
            $response = new Response();
            $validacionChip = array();
            $totalResumenGuardados = 0;
            foreach ($_POST as $idsRutasSeleccionada) {
                $data = array(
                    'rvc_dato_chip' => $rvc_dato_chip,
                    'rvc_tipo_validacion' => $rvc_tipo_validacion,
                    'rvc_subtipo_validacion' => $rvc_subtipo_validacion,
                    'rvc_resultado_validacion' => $rvc_resultado_validacion,
                    'rvc_ejecutivo' => $rvc_ejecutivo,
                    'rvc_solicitud_fecha' => date(FORMATO_FECHA_LONG),
                    'rvc_solicitud_ip' => $rvc_solicitud_ip,
                    'rvc_solicitud_dispositivo' => $rvc_solicitud_dispositivo,
                    'rvc_solicitud_navegador' => $rvc_solicitud_navegador,
                    'rvc_estado_validacion' => 1,
                    'rg_id' => $idRuta,
                    'iduser' => Yii::app()->session['codigUsuarioSeleccionado'],
                    'ur_nombre_ejecutivo' => '',
                    'ur_estado' => 1,
                    'ur_zona_gestion' => Yii::app()->session['codigoZonaSeleccionada'],
                    'ur_fecha_ingreso' => date(FORMATO_FECHA_LONG),
                    'ur_fecha_modifica' => date(FORMATO_FECHA_LONG),
                    'ur_cod_usuario_ingresa_modifica' => Yii::app()->user->id,
                );
                array_push($validacionChip, $data);
                unset($data);
            }

            $dbConnection = new CI_DB_active_record(null);
            $sql = $dbConnection->insert_batch('tb_resultado_valida_chip', $validacionChip);
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
            unset($validacionChip);
            $connection->active = false;

            if (Yii::app()->session['codigoZonaSeleccionada'] > 0) {
                $fRuta = new FRutasGestionModel();
                $rutasZona = $fRuta->getRutaxZona(
                        Yii::app()->session['codigoZonaSeleccionada']
                        , Yii::app()->session['codigUsuarioSeleccionado']
                        , Yii::app()->session['idPeriodoSemanalActivo']
                        , Yii::app()->session['tipoUsuario']
                );

                $validacionChip['rutasZona'] = $rutasZona;
            }

            $fUsuarioRuta = new FUsuarioRutaModel();
            $validacionChip['rutasAsignadas'] = $fUsuarioRuta->getRutasAsignadasxUsuario(Yii::app()->session['codigUsuarioSeleccionado']);

            if ($totalResumenGuardados > 0) {
                $mensaje .= '<br>Se han asignado ' . $totalResumenGuardados . ' rutas correctamente.';
                $response->ClassMessage = CLASS_MENSAJE_SUCCESS;
            }
            if ($totalResumenOmitidos > 0) {
                $mensaje .= '<br>Se han omitido ' . $totalResumenOmitidos . ' rutas.';
                $response->ClassMessage = CLASS_MENSAJE_NOTICE;
            }
        } catch (Exception $e) {
            $mensaje = 'Se ha producido un error al guardar los registros';
        }
        $response->Message = $mensaje;
        $response->Result = $validacionChip;
        $this->actionResponse(null, null, $response);
        return;
    }

    function ValidarCodigoLocal($codigoLocal) {
        $resultadoValidacion = '';
        if (strlen($codigoLocal) != 10)
            $resultadoValidacion = "Codigo local incorrecto, debe tener 10 caracteres";
        if (strtoupper(substr($codigoLocal, 0, 4)) != "TCQU")
            $resultadoValidacion = "Codigo local incorrecto, debe inicar con TCQU";

        return $resultadoValidacion;
    }

    function ValidarChipIndividual($tipo, $valorValidar, $itemValidar) {
        $funcionesConsulta = new FConsultasChipModel();
        $resultadoMostrar = array();
        $resultadoConsulta = "";
        $mensajeResultado = "";
        $noEsTececab = "";
        $siEsTececab = "";

        $itemValido = true;
        $mensajeValida = "";
//        var_dump($tipo,$valorValidar);die();
////Valida ICC
        if ($tipo == "icc") {
//            var_dump(substr($valorValidar, 0,4));die();

            if (substr($valorValidar, 0, 4) != "8959") {
                $mensajeValida = "ICC con digitos inicio incorrectos ";
                $itemValido = false;
            }
            if (strlen($valorValidar) != 19) {
                $mensajeValida = "ICC debe tener 19 digitos";
                $itemValido = false;
            }
        }

        if ($itemValido) {
            $resultadoConsulta = $funcionesConsulta->getDatosChips($tipo, ($tipo == "min" ? substr($valorValidar, -9) : $valorValidar));

//        $siEsTececab = (($tipo == "icc") ? $icc_enviado : $min_enviado) . " SI ES/SON DE TECECAB";
            $noEsTececab = "**DATOS VALIDACION " . strtoupper($tipo) . "  " . $itemValidar . "**" . "\n" . $valorValidar . " NO ES DE TECECAB";


            $mensajeResultado = isset($resultadoConsulta[0]) ?
                    "**DATOS VALIDACION " . strtoupper($tipo) . "  " . $itemValidar . "**"
                    . "\n" . "*ICC:* " . $resultadoConsulta[0]['COMPRA_ICC']
                    . "\n" . "*MIN:* " . $resultadoConsulta[0]['COMPRA_MIN']
//                . "\n" . "\n" . "**TRANSFERENCIA MOVISTAR**"
                    . "\n"
                    . "\n" . "*TransfMovi-Fecha:* " . $resultadoConsulta[0]['TXMOVISTAR_FECHA']
                    . "\n" . "*TransfMovi-Codigo:* " . $resultadoConsulta[0]['TXMOVISTAR_ID_DESTINO']
                    . "\n" . "*TransfMovi-Vendedor:* " . $resultadoConsulta[0]['TXMOVISTAR_NMB_DESTINO']
//                . "\n" . "\n" . "**VENTA MOVISTAR**"
                    . "\n"
                    . "\n" . "*VenMovi-Fecha:* " . $resultadoConsulta[0]['VTMOVISTAR_FECHA']
                    . "\n" . "*VenMovi-Codigo:* " . $resultadoConsulta[0]['VTMOVISTAR_ID_DESTINO']
                    . "\n" . "*VenMovi-Cliente:* " . $resultadoConsulta[0]['VTMOVISTAR_NMB_DESTINO']
//                . "\n" . "\n" . "**INDICADORES**"
                    . "\n"
                    . "\n" . "*Ind-Fecha:* " . (strlen($resultadoConsulta[0]['VENTAS_FECHA']) > 0 ? $resultadoConsulta[0]['VENTAS_FECHA'] : "SIN VENTA")
//                . "\n" . "Ind-Factura: " . $resultadoConsulta[0]['VENTAS_NUMERO_FACTURA']
                    . "\n" . "*Ind-Codigo-Cliente:* " . (strlen($resultadoConsulta[0]['VENTAS_CODIGO']) > 0 ? $resultadoConsulta[0]['VENTAS_CODIGO'] : "SIN VENTA")
                    . "\n" . "*Ind-Cliente:* " . (strlen($resultadoConsulta[0]['VENTAS_NOMBRE_CLIENTE']) > 0 ? $resultadoConsulta[0]['VENTAS_NOMBRE_CLIENTE'] : "SIN VENTA")
//                . "\n" . "\n" . "**ALTA**"
                    . "\n"
                    . "\n" . "*Alta-Fecha:* " . (strlen($resultadoConsulta[0]['ALTAS_FECHA_ALTA']) > 0 ? $resultadoConsulta[0]['ALTAS_FECHA_ALTA'] : "SIN ALTA")
                    . "\n" . "*Alta-Ciudad:* " . (strlen($resultadoConsulta[0]['ALTAS_CIUDAD']) > 0 ? $resultadoConsulta[0]['ALTAS_CIUDAD'] : "SIN ALTA") : $noEsTececab;

//            var_dump($mensajeResultado);die();
            $resultadoMostrar["conteo"] = (isset($resultadoConsulta[0])) ? 1 : 0;
            $resultadoMostrar["detalle"] = $mensajeResultado . "\n\n";
        } else {
            $resultadoMostrar["conteo"] = 2;
            $resultadoMostrar["detalle"] = "**VALIDACION " . strtoupper($tipo) . "  " . $itemValidar . " " . $valorValidar . " INCORRECTA, " . $mensajeValida . "\n";
        }

//        var_dump($resultadoMostrar);        die();
        return $resultadoMostrar;
    }

    private function actionResponse($view = 'error', $model = null, $response = null) {
        if (Yii::app()->request->isAjaxRequest) {
            echo json_encode($response);
        } else {
            $this->render($view, $model);
        }
    }

}
