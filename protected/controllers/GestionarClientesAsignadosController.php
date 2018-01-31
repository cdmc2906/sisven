<?php

class GestionarClientesAsignadosController extends Controller {

    public $layout = LAYOUT_FILTRO_GRID;

    public function actionIndex() {
        Yii::app()->user->setFlash('resultadoGuardar', null);
        if (Yii::app()->request->isAjaxRequest) {
            return;
        } else {
            Yii::app()->session['GestionClientesRutaForm'] = '';
            $model = new GestionClientesRutaForm ();
            $this->render('/proceso/gestionarClientesAsignados', array('model' => $model));
        }
    }

    public function actionCargarRutasAsignadas() {
        $response = new Response();
        $fUsuarioRuta = new FUsuarioRutaModel();

//        $rutasAsignadas['rutasAsignadas'] = $fUsuarioRuta->getRutasAsignadasxUsuario(Yii::app()->user->id);
        $rutasAsignadas['rutasAsignadas'] = $fUsuarioRuta->getRutasAsignadasxUsuario(12);

        $response->Result = $rutasAsignadas;
        $this->actionResponse(null, null, $response);
        return;
    }

    public function actionCargarClientesRutas() {
        $response = new Response();

        $fRuta = new FRutaModel();

        $rutasZona = $fRuta->getClientesxRuta($_POST['codigoRuta']);
        $response->Result = $rutasZona;

        $this->actionResponse(null, null, $response);
        return;
    }

    public function actionAgregarActualizarTelefonoCliente() {
        $response = new Response();

        $fRuta = new FRutaModel();
        var_dump($_POST);
        die();
        $operacion = $_POST['oper'];
//        edit=>editar
        /* array(5) {
          ["TELEFONO"]=>string(6) "123123"
          ["VALIDO"]=>string(2) "No"
          ["INVALIDO"]=>string(2) "Si"
          ["oper"]=>string(4) "edit"
          ["id"]=>string(4) "jqg1"
          }
         */
//        add=>nuevo
        /*
          array(5) {
          ["TELEFONO"]=>string(0) ""
          ["VALIDO"]=>string(2) "No"
          ["INVALIDO"]=>string(2) "No"
          ["oper"]=>string(3) "add"
          ["id"]=>string(6) "_empty"
          }
         */
        var_dump($operacion);
        die();
        $rutasZona = $fRuta->getClientesxRuta($_POST['codigoRuta']);
        $response->Result = $rutasZona;

        $this->actionResponse(null, null, $response);
        return;
    }

    public function actionReportarNovedad() {
        $response = new Response();

        var_dump($_POST);
        die();
        $operacion = $_POST['oper'];
//        edit=>editar
        /* array(5) {
          ["TELEFONO"]=>string(6) "123123"
          ["VALIDO"]=>string(2) "No"
          ["INVALIDO"]=>string(2) "Si"
          ["oper"]=>string(4) "edit"
          ["id"]=>string(4) "jqg1"
          }
         */
//        add=>nuevo
        /*
          array(5) {
          ["TELEFONO"]=>string(0) ""
          ["VALIDO"]=>string(2) "No"
          ["INVALIDO"]=>string(2) "No"
          ["oper"]=>string(3) "add"
          ["id"]=>string(6) "_empty"
          }
         */
        var_dump($operacion);
        die();
        $rutasZona = $fRuta->getClientesxRuta($_POST['codigoRuta']);
        $response->Result = $rutasZona;

        $this->actionResponse(null, null, $response);
        return;
    }

    public function actionCargarDatosCliente() {
        $response = new Response();
        $respuesta = array();

        $codigoClienteSeleccionado = $_POST['codigoCliente'];
        $cliente = ClienteModel::model()->findAllByAttributes(array('cli_codigo_cliente' => $codigoClienteSeleccionado));

        if (isset($cliente[0])) {
            //$("#txtCodigoCliente").val(datosResult['codigoCliente']);
            $respuesta["codigoCliente"] = $codigoClienteSeleccionado;

            //$("#txtNombreCliente").val(datosResult['nombreCliente']);
            $respuesta["nombreCliente"] = $cliente[0]['cli_nombre_cliente'];

//        $("#txtEstadoAnterior").val(datosResult['estadoAnterior']);
            $fResultadoEncuesta = new FResultadosEncuestaModel();
            $estadoContactoAnterior = $fResultadoEncuesta->getEstadoAnteriorEncuestaxCliente($codigoClienteSeleccionado);
            if (isset($estadoContactoAnterior[0]))
                $respuesta["estadoAnterior"] = $estadoContactoAnterior[0]['resultado'];
            else
                $respuesta["estadoAnterior"] = 'ERROR';
//        $("#txtNovedades").val(datosResult['novedades']);
            $fNovedades = new FNovedadesClienteModel ();
            $novedades = $fNovedades->getEstadosNovedadesxCliente($codigoClienteSeleccionado);
            $cantidadNovedadesPendientes = 0;
            $cantidadNnovedadesSolucionadas = 0;
            if (isset($novedades) & count($novedades) > 0) {
                foreach ($novedades as $novedad) {
                    if ($novedad['idestado'] == 4 || $novedad['idestado'] == 5)
                        $cantidadNovedadesPendientes += 1;
                    else
                        $cantidadNnovedadesSolucionadas += 1;
                }
                $respuesta["novedades"] = '(' . $cantidadNovedadesPendientes . ')PENDIENTES - (' . $cantidadNnovedadesSolucionadas . ')SOLUCIONADAS';
            } else
                $respuesta["novedades"] = 'SIN NOVEDADES';

//        $("#txtContactosCliente").val(datosResult['contactosCliente']);
            $telefonosContacto = TelefonoClienteModel::model()->findAllByAttributes(array('cli_codigo' => $cliente[0]['cli_codigo']));
            $contacto = '';
            $telefonosValidar = array();

            foreach ($telefonosContacto as $telefono) {
                $contacto .= $telefono['tcli_telefono'] . '/';
                $telf = array(
                    'IDTELEFONO' => $telefono['tcli_id'],
                    'TELEFONO' => $telefono['tcli_telefono'],
                    'VALIDO' => 'Si',
                );
                array_push($telefonosValidar, $telf);
                unset($telf);
            }
            $respuesta["contactosCliente"] = $contacto;
            $respuesta["telefonosValidar"] = $telefonosValidar;

            $_novedadesNoCompra = NovedadesModel::model()->findAllByAttributes(array('nov_categoria' => TIPO_NOVEDAD_NO_COMPRA_CHIP));
            $novedadesNoCompraChip = array();
            foreach ($_novedadesNoCompra as $novedad) {
                $dat = array(
                    'IDNOVEDAD' => $novedad['nov_id'],
                    'NOVEDAD' => $novedad['nov_descripcion'],
                );
                array_push($novedadesNoCompraChip, $dat);
                unset($dat);
            }
            $respuesta["novedadesNoCompraChip"] = $novedadesNoCompraChip;

            $_novedadesIncidencia = NovedadesModel::model()->findAllByAttributes(array('nov_categoria' => TIPO_NOVEDAD_GENERAL));
            $novedadesIncidencia = array();
            foreach ($_novedadesIncidencia as $novedad) {
                $dat = array(
                    'IDNOVEDAD' => $novedad['nov_id'],
                    'NOVEDAD' => $novedad['nov_descripcion'],
                );
                array_push($novedadesIncidencia, $dat);
                unset($dat);
            }
            $respuesta["novedadesIncidencia"] = $novedadesIncidencia;

//        $("#txtChipsVenta").val(datosResult['chipsVenta']);
            $fOrden = new FOrdenModel();
            $_fechaUltimaVisita = $fOrden->getFechaUltimaCompraxCliente($codigoClienteSeleccionado);
            $fechaUltimaVisita = '';

            if (isset($_fechaUltimaVisita[0]))
                $fechaUltimaVisita = $_fechaUltimaVisita[0]['fechaultimaventa'];
            else
                $fechaUltimaVisita = date('Y-m-d', strtotime(date('Y-m-d') . ' - 1 days'));

            $rsTotales = new FRutaModel();
            $ventaDía = intval($rsTotales->getTotalChipsVentaxDiaxHoraInicioxCliente(
                            $fechaUltimaVisita
                            , '09:00'
                            , $codigoClienteSeleccionado
                    )[0]['RESPUESTA']);
            $respuesta["chipsVenta"] = $ventaDía . ' (' . $fechaUltimaVisita . ')';

            $respuesta["historialNovedades"] = $fNovedades->getHistorialNovedadesxCliente($codigoClienteSeleccionado);
            ;
        }


        $response->Result = $respuesta;

        $this->actionResponse(null, null, $response);
        return;
    }

    public function actionGuardarGestion() {
        try {
            $response = new Response();
            if (false) {
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

    private function actionResponse($view = 'error', $model = null, $response = null) {
        if (Yii::app()->request->isAjaxRequest) {
            echo json_encode($response);
        } else {
            $this->render($view, $model);
        }
    }

}
