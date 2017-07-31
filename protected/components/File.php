<?php

/**
 * Description
 * @fecha 
 * @author 
 */
class File {

    private $Ruta;
    private $Archivo;
    private $Operacion;
    private $Delimitador;

    public function __construct($Ruta, $Operacion, $Delimitador) {

        $this->init($Ruta, $Operacion, $Delimitador);
    }

    public function init($Ruta, $Operacion, $Delimitador) {
        $this->Ruta = $Ruta;
        $this->Operacion = $Operacion;
        $this->Delimitador = $Delimitador;
    }

    /**
     * "a+" => abre el archivo
     * "r" => lee el archivo
     */
    private function Open() {

        if (file_exists($this->Ruta)) {
            $this->Archivo = fopen($this->Ruta, $this->Operacion);
        } else {
            throw new CHttpException(Yii::app()->params['codErrorArchivoNoExiste'], Yii::app()->params['mensajeExcepcionArchivoNoExiste'] . ' ' . $this->Ruta);
        }
    }

    /**
     * "a+" => abre el archivo
     * "r" => lee el archivo
     */
    public function existe() {

        if (file_exists($this->Ruta)) {
            $this->Archivo = fopen($this->Ruta, $this->Operacion);
        } else {
            return Yii::app()->params['mensajeExcepcionArchivoNoExiste'] . ' ' . $this->Ruta;
        }

        return '';
    }

    private function Close() {
        fclose($this->Archivo);
    }

    private function Write($data) {

        fwrite($this->Archivo, $data);
    }

    /**
     * Registra datos en un archivo
     * @param type $result Array() or String
     * @param type $encabezados Muestra encabezados $result Array
     * @param type $msj Mensaje opcional para mostrar en el log
     * @return boolean
     */
    public function setDatos($result, $encabezados = NULL, $msj = NULL) {

        if (isset($msj)) {
            $msjLog = date("Y/m/d H:i:s") . ' ' . $msj . "\r\n";
            $data = $msjLog;
        }

        $this->Archivo = fopen($this->Ruta, $this->Operacion);

        if (is_array($result)) {

            $col_names = array_keys($result[0]);
            $row_cnt = count($result);
            $fields_cnt = count($result[0]);

            if (isset($encabezados)) {
                for ($i = 0; $i < $fields_cnt; ++$i) {
                    $data .= $col_names[$i] . $this->Delimitador;
                }
                $data .= "\r\n";
            }

            for ($r = 0; ($r < $row_cnt); ++$r) {
                for ($c = 0; $c < $fields_cnt; ++$c) {

                    $data .= $result[$r][$col_names[$c]] . $this->Delimitador;
                }
                $data .= "\r\n";
            }
        } else {

            $data .= $result;
        }
        $this->Write($data);
        $this->Close();
        unset($data);

        return true;
    }

    /**
     * Retorna el total de registros del archivo
     * @return int
     */
    public function getTotalFilas() {

        $this->Open();

        $data = $this->Archivo;

        if ($data) {

            $numeroLinea = 1;
            while (!feof($data)) {
                $strFilas = fgets($data, 4096);
                $numeroLinea++;
            }
        }

        unset($data);
        $this->Close();

        return $numeroLinea;
    }

    public function verificarCabeceraArchivo() {

        $this->Open();

        $data = $this->Archivo;

        if ($data) {
            $numeroLinea = 1;
            while (!feof($data)) {

                $strFilas = fgets($data, 4096);

                if ($numeroLinea == 1) {
                    $strInicio = substr($strFilas, 0, strlen(INICIO_CABECERA));
                    if ($strInicio == INICIO_CABECERA) {
                        $datosSenae = true;
                    } else {
                        $datosSenae = false;
                    }
                    break;
                }
            }
        }

        unset($data);
        $this->Close();
        return $datosSenae;
    }

    /**
     * @return array
     */
    public function getDatosConsumo($start, $blockSize) {
        $this->Open();
        $data = $this->Archivo;

        if ($data) {
            $datosConsumo = array();
            $lineNumber = 1;
            while (!feof($data)) {
                $strFilas = fgets($data, 4096);
                if ($lineNumber >= $start && $lineNumber <= ($start + $blockSize) - 1) {
                    $arrColumnas = explode($this->Delimitador, $strFilas);

                    if (count($arrColumnas) > 0 && $arrColumnas[0] != 'Plan') { // Quita la fila de encabezados
                        $datos = array(
                            'plan' => trim($arrColumnas[0]),
                            'min' => trim($arrColumnas[1]),
                            'contrato' => trim($arrColumnas[2]),
                            'codigo_vendedor' => trim($arrColumnas[3]),
                            'vendedor' => trim($arrColumnas[4]),
                            'pago' => trim($arrColumnas[5]),
                            'concepto' => trim($arrColumnas[6]),
                            'observacion' => '', //trim($arrColumnas[7]),
                        );

                        array_push($datosConsumo, $datos);
                        unset($datos);
                    }
                }

                if ($lineNumber > ($start + $blockSize) - 1) {
                    break;
                }

                $lineNumber++;
            }
        }

        unset($data);
        $this->Close();

        return $datosConsumo;
    }

    /**
     * @return array
     */
    public function getDatosCompra($start, $blockSize) {
        $this->Open();
        $data = $this->Archivo;

        if ($data) {
            $datosCarga = array();
            $lineNumber = 1;

            while (!feof($data)) {
                $strFilas = fgets($data, 4096);
                if ($lineNumber >= $start && $lineNumber <= ($start + $blockSize) - 1) {
                    $arrColumnas = explode($this->Delimitador, $strFilas);

                    if (count($arrColumnas) > 0 && $arrColumnas[0] != 'NOMBRE') { // Quita la fila de encabezados
                        $datos = array(
                            'nombre' => trim($arrColumnas[0]),
                            'min' => trim($arrColumnas[1]),
                            'icc' => trim($arrColumnas[2]),
                            'imei' => trim($arrColumnas[3]),
                            'numero_serie' => trim($arrColumnas[4]),
                            'precio' => trim($arrColumnas[5]),
                            'costo' => trim($arrColumnas[6]),
                            'porcentaje_descuento' => trim($arrColumnas[7]),
                        );

                        array_push($datosCarga, $datos);
                        unset($datos);
                    }
                }

                if ($lineNumber > ($start + $blockSize) - 1) {
                    break;
                }

                $lineNumber++;
            }
        }

        unset($data);
        $this->Close();

        return $datosCarga;
    }

    /**
     * @return array
     */
    public function getDatosAsignacion($start, $blockSize) {
        $this->Open();
        $data = $this->Archivo;

        if ($data) {
            $datosCarga = array();
            $lineNumber = 1;

            while (!feof($data)) {
                $strFilas = fgets($data, 4096);
                if ($lineNumber >= $start && $lineNumber <= ($start + $blockSize) - 1) {
                    $arrColumnas = explode($this->Delimitador, $strFilas);

                    if (count($arrColumnas) > 0 && $arrColumnas[0] != 'NOMBRE') { // Quita la fila de encabezados
                        $datos = array(
                            'nombre' => trim($arrColumnas[0]),
                            'min' => trim($arrColumnas[1]),
                            'icc' => trim($arrColumnas[2]),
                            'imei' => trim($arrColumnas[3]),
                            'numero_serie' => trim($arrColumnas[4]),
                            'precio' => trim($arrColumnas[5]),
                            'costo' => trim($arrColumnas[6]),
                            'porcentaje_descuento' => trim($arrColumnas[7]),
                        );

                        array_push($datosCarga, $datos);
                        unset($datos);
                    }
                }

                if ($lineNumber > ($start + $blockSize) - 1) {
                    break;
                }

                $lineNumber++;
            }
        }

        unset($data);
        $this->Close();

        return $datosCarga;
    }

    /**
     * @return array
     */
    public function getDatosIndicadores($start, $blockSize) {
        $this->Open();
        $data = $this->Archivo;

        if ($data) {
            $datosCarga = array();
            $lineNumber = 1;

            while (!feof($data)) {
                $strFilas = fgets($data, 4096);
                if ($lineNumber >= $start && $lineNumber <= ($start + $blockSize) - 1) {
                    $arrColumnas = explode($this->Delimitador, $strFilas);
//                    var_dump($arrColumnas);die();
//                    var_dump($arrColumnas[0]);                    die();
                    if (isset($arrColumnas) && count($arrColumnas) > 0 && $arrColumnas[0] != 'FECHA') { // Quita la fila de encabezados
//                        var_dump($arrColumnas[1]);
                        $datos = array(
                            'FECHA' => utf8_encode(trim($arrColumnas[0])),
                            'SUCURSAL' => utf8_encode(trim($arrColumnas[1])),
                            'NUMERO_BODEGA' => utf8_encode(trim($arrColumnas[2])),
                            'BODEGA' => utf8_encode(trim($arrColumnas[3])),
                            'NUMERO_SERIE' => trim($arrColumnas[4]),
                            'NUMERO_FACTURA' => trim($arrColumnas[5]),
                            'COD_CLIENTE' => trim($arrColumnas[6]),
                            'TIPO_CLIENTE' => trim($arrColumnas[7]),
                            'NOMBRE_CLIENTE' => utf8_encode(trim($arrColumnas[8])),
                            'RUC' => trim($arrColumnas[9]),
                            'DIRECCION' => utf8_encode(trim($arrColumnas[10])),
                            'CIUDAD' => utf8_encode(trim($arrColumnas[11])),
                            'TELEFONO' => trim($arrColumnas[12]),
                            'CODIGO_PRODUCTO' => trim($arrColumnas[13]),
                            'DESCRIPCION_PRODUCTO' => utf8_encode(trim($arrColumnas[14])),
                            'CODIGO_GRUPO' => trim($arrColumnas[15]),
                            'GRUPO' => trim($arrColumnas[16]),
                            'CANTIDAD' => trim($arrColumnas[17]),
                            'DETALLE' => trim($arrColumnas[18]),
                            'IMEI' => trim($arrColumnas[19]),
                            'MIN' => trim($arrColumnas[20]),
                            'ICC' => trim($arrColumnas[21]),
                            'COSTO' => trim($arrColumnas[22]),
                            'PRECIO1' => trim($arrColumnas[23]),
                            'PRECIO2' => trim($arrColumnas[24]),
                            'PRECIO3' => trim($arrColumnas[25]),
                            'PRECIO4' => trim($arrColumnas[26]),
                            'PRECIO5' => trim($arrColumnas[27]),
                            'PRECIO' => trim($arrColumnas[28]),
                            'PORCENDES' => trim($arrColumnas[29]),
                            'DESCUENTO' => trim($arrColumnas[30]),
                            'SUBTOTAL' => trim($arrColumnas[31]),
                            'IVA' => trim($arrColumnas[32]),
                            'TOTAL' => trim($arrColumnas[33]),
                            'E_CODIGO' => trim($arrColumnas[34]),
                            'VENDEDOR' => utf8_encode(trim($arrColumnas[35])),
                            'PROVINCIA' => utf8_encode(trim($arrColumnas[36]))
                        );

                        array_push($datosCarga, $datos);
                        unset($datos);
                    }
                }

                if ($lineNumber > ($start + $blockSize) - 1) {
                    break;
                }

                $lineNumber++;
            }
        }
//        var_dump($datosCarga);                        die();
//        die();
        unset($data);
        $this->Close();
        return $datosCarga;
    }

    public function getDatosClientes($start, $blockSize) {
        $this->Open();
        $data = $this->Archivo;

        if ($data) {
            $datosCarga = array();
            $lineNumber = 1;

            while (!feof($data)) {
                $strFilas = fgets($data, 4096);
                if ($lineNumber >= $start && $lineNumber <= ($start + $blockSize) - 1) {
                    $arrColumnas = explode($this->Delimitador, $strFilas);
//                    var_dump($arrColumnas);die();
//                    var_dump(utf8_encode($arrColumnas[0]));                    die();
                    if (count($arrColumnas) > 0 && utf8_encode($arrColumnas[0]) != 'Código' && isset($arrColumnas)) { // Quita la fila de encabezados
//                        var_dump($arrColumnas[1]);                    die();
//                        var_dump($arrColumnas[20]);
//                        var_dump($arrColumnas);                    die();
//                        if ($arrColumnas[1] == 'TCQU170290')
//                            var_dump($arrColumnas);
                        $datos = array(
                            'CLIENTE' => utf8_encode(trim($arrColumnas[1])),
                            'CLIENTENOMBRE' => utf8_encode(trim($arrColumnas[2])),
                            'LATITUD' => trim($arrColumnas[20]),
                            'LONGITUD' => trim($arrColumnas[21]),
                        );

                        array_push($datosCarga, $datos);
                        unset($datos);
                    }
                }

                if ($lineNumber > ($start + $blockSize) - 1) {
                    break;
                }

                $lineNumber++;
            }
        }
//        var_dump($datosCarga);                        die();
//        die();
        unset($data);
        $this->Close();
        return $datosCarga;
    }

    public function getDatosHistorialMb($start, $blockSize) {
        $this->Open();
        $data = $this->Archivo;

        if ($data) {
            $datosCarga = array();
            $lineNumber = 1;

            while (!feof($data)) {
                $strFilas = fgets($data, 4096);
                if ($lineNumber >= $start && $lineNumber <= ($start + $blockSize) - 1) {
                    $arrColumnas = explode($this->Delimitador, $strFilas);
//                    var_dump($arrColumnas);die();
//                    var_dump($arrColumnas[1]);                    die();
                    if (isset($arrColumnas[18])) {
                        if (count($arrColumnas) > 0 && $arrColumnas[0] != 'Id') { // Quita la fila de encabezados
//                        var_dump($arrColumnas[1]);                    die();
                            $datos = array(
                                'ID' => trim($arrColumnas[0]),
                                'FECHA' => trim($arrColumnas[1]),
                                'USUARIO' => utf8_encode(trim($arrColumnas[2])),
                                'USUARIONOMBRE' => utf8_encode(trim($arrColumnas[3])),
                                'RUTA' => utf8_encode(trim($arrColumnas[4])),
                                'RUTANOMBRE' => utf8_encode(trim($arrColumnas[5])),
                                'SEMANA' => trim($arrColumnas[6]),
                                'DIA' => trim($arrColumnas[7]),
                                'CLIENTE' => utf8_encode(trim($arrColumnas[8])),
                                'CLIENTENOMBRE' => utf8_encode(trim($arrColumnas[9])),
                                'DIRECCION' => utf8_encode(trim($arrColumnas[10])),
                                'ACCION' => utf8_encode(trim($arrColumnas[11])),
                                'CODIGO' => utf8_encode(trim($arrColumnas[12])),
                                'CODIGOCOMENTARIO' => utf8_encode(trim($arrColumnas[13])),
                                'COMENTARIO' => utf8_encode(trim($arrColumnas[14])),
                                'MONTO' => trim($arrColumnas[15]),
                                'LATITUD' => trim($arrColumnas[16]),
                                'LONGITUD' => trim($arrColumnas[17]),
                                'ROMPERSECUENCIA' => trim($arrColumnas[18]),
                            );
                            array_push($datosCarga, $datos);
                            unset($datos);
                        }
                    }
                }

                if ($lineNumber > ($start + $blockSize) - 1) {
                    break;
                }

                $lineNumber++;
            }
        }
//        var_dump($datosCarga);                        die();
        unset($data);
        $this->Close();
        return $datosCarga;
    }

    public function getDatosVentasMovistar($start, $blockSize) {
        $this->Open();
        $data = $this->Archivo;

        if ($data) {
            $datosCarga = array();
            $lineNumber = 1;

            while (!feof($data)) {
                $strFilas = fgets($data, 4096);
                if ($lineNumber >= $start && $lineNumber <= ($start + $blockSize) - 1) {
                    $arrColumnas = explode($this->Delimitador, $strFilas);
//                    var_dump($arrColumnas);die();
//                    if(is_array($arrColumnas)) {
//                    if(
//                    if (count($arrColumnas) > 0) {
                    if (isset($arrColumnas[17])) {
                        if ($arrColumnas[0] != 'Transferencia de Fecha y hora ') {

//                            $prueba = trim(utf8_encode(substr($arrColumnas[12], 1, -1)));
//                            var_dump($prueba);                            die();

                            $fechaVenta = DateTime::createFromFormat('d/m/Y H:i:s', trim(utf8_decode(trim($arrColumnas[0])), "?"));
                            $sfechaVenta = $fechaVenta->format(FORMATO_FECHA_LONG);
                            $datos = array(
                                'FECHA' => $sfechaVenta, //trim(utf8_decode(trim($arrColumnas[0])), "?"),
                                //''FECHA' => trim(utf8_encode(substr($arrColumnas[0],1,-1))),
                                'TRANSACCION' => trim(utf8_encode(substr($arrColumnas[1], 1, -1))),
                                'DISTRIBUIDOR' => trim(utf8_encode(substr($arrColumnas[2], 1, -1))),
                                'NOMBREDISTRIBUIDOR' => trim(utf8_encode(substr($arrColumnas[3], 1, -1))),
                                'CODIGOSCL' => trim(utf8_encode(substr($arrColumnas[4], 1, -1))),
                                'INVENTARIOANTERIORFUENTE' => trim(utf8_encode(substr($arrColumnas[5], 1, -1))),
                                'INVENTARIOACTUALFUENTE' => trim(utf8_encode(substr($arrColumnas[6], 1, -1))),
                                'TIPOSIM' => trim(utf8_encode(substr($arrColumnas[7], 1, -1))),
                                'ICC' => trim(utf8_encode(substr($arrColumnas[8], 1, -1))),
                                'MIN' => trim(utf8_encode(substr($arrColumnas[9], 1, -1))),
                                'ESTADO' => trim(utf8_encode(substr($arrColumnas[10], 1, -1))),
                                'IDDESTINO' => trim(utf8_encode(substr($arrColumnas[11], 1, -1))),
                                'NOMBREDESTINO' => trim(utf8_encode(substr($arrColumnas[12], 1, -1))),
                                'INVENTARIOANTERIORDESTINO' => trim(utf8_encode(substr($arrColumnas[13], 1, -1))),
                                'INVENTARIOACTUALDESTINO' => trim(utf8_encode(substr($arrColumnas[14], 1, -1))),
                                'CANAL' => trim(utf8_encode(substr($arrColumnas[15], 1, -1))),
                                'LOTE' => trim(utf8_encode(substr($arrColumnas[16], 1, -1))),
                                'ZONA' => trim(utf8_encode(substr($arrColumnas[17], 1, -1))),
                            );

                            array_push($datosCarga, $datos);
                            unset($datos);
                        }
                    }
                }

                if ($lineNumber > ($start + $blockSize) - 1) {
                    break;
                }

                $lineNumber++;
            }
        }
//        var_dump($datosCarga);        die();
        unset($data);
        $this->Close();
        return $datosCarga;
    }

    public function getDatosOrdenesMb($start, $blockSize) {
        $this->Open();
        $data = $this->Archivo;

        if ($data) {
            $datosCarga = array();
            $lineNumber = 1;

            while (!feof($data)) {
                $strFilas = fgets($data, 4096);
                if ($lineNumber >= $start && $lineNumber <= ($start + $blockSize) - 1) {
                    $arrColumnas = explode($this->Delimitador, $strFilas);
//                    var_dump($arrColumnas);die();
//                    var_dump($arrColumnas[1]);                    die();
                    if (isset($arrColumnas[37])) {
                        if ($arrColumnas[0] != 'Id') { // Quita la fila de encabezados
//                        var_dump($arrColumnas[1]);                    die();
                            $datos = array(
                                'ID' => trim($arrColumnas[0]),
                                'CONCEPTO' => utf8_encode(trim($arrColumnas[1])),
                                'CODIGO' => utf8_encode(trim($arrColumnas[2])),
                                'COMENTARIO' => utf8_encode(trim($arrColumnas[3])),
                                'FECHACREACION' => trim($arrColumnas[4]),
                                'FECHADESPACHO' => trim($arrColumnas[5]),
                                'TIPO' => utf8_encode(trim($arrColumnas[6])),
                                'ESTATUS' => utf8_encode(trim($arrColumnas[7])),
                                'CLIENTE' => utf8_encode(trim($arrColumnas[8])),
                                'CLIENTENOMBRE' => utf8_encode(trim($arrColumnas[9])),
                                'CLIENTEIDENTIFICACION' => utf8_encode(trim($arrColumnas[10])),
                                'DIRECCION' => utf8_encode(trim($arrColumnas[11])),
                                'LISTAPRECIOS' => utf8_encode(trim($arrColumnas[12])),
                                'LISTAPRECIOSNOMBRE' => utf8_encode(trim($arrColumnas[13])),
                                'BODEGAORIGEN' => utf8_encode(trim($arrColumnas[14])),
                                'BODEGAORIGENNOMBRE' => utf8_encode(trim($arrColumnas[15])),
                                'TERMINOPAGO' => utf8_encode(trim($arrColumnas[16])),
                                'TERMINOPAGONOMBRE' => utf8_encode(trim($arrColumnas[17])),
                                'USUARIO' => utf8_encode(trim($arrColumnas[18])),
                                'USUARIONOMBRE' => utf8_encode(trim($arrColumnas[19])),
                                'OFICINA' => utf8_encode(trim($arrColumnas[20])),
                                'OFICINANOMBRE' => utf8_encode(trim($arrColumnas[21])),
                                'TIPOSECUENCIA' => utf8_encode(trim($arrColumnas[22])),
                                'IVA12BASE' => trim($arrColumnas[23]),
                                'IVA12VALOR' => trim($arrColumnas[24]),
                                'IVA0BASE' => trim($arrColumnas[25]),
                                'IVA0VALOR' => trim($arrColumnas[26]),
                                'IVA14BASE' => trim($arrColumnas[27]),
                                'IVA14VALOR' => trim($arrColumnas[28]),
                                'SUBTOTAL' => trim($arrColumnas[29]),
                                'DESCUENTOP' => trim($arrColumnas[30]),
                                'DESCUENTO' => trim($arrColumnas[31]),
                                'IMPUESTOS' => trim($arrColumnas[32]),
                                'OTROSCARGOS' => trim($arrColumnas[33]),
                                'TOTAL' => trim($arrColumnas[34]),
                                'DATOS' => utf8_encode(trim($arrColumnas[35])),
                                'REFERENCIA' => utf8_encode(trim($arrColumnas[36])),
                                'ESTATUSPROCESO' => utf8_encode(trim($arrColumnas[37])),
                            );

                            array_push($datosCarga, $datos);
                            unset($datos);
                        }
                    }
                }

                if ($lineNumber > ($start + $blockSize) - 1) {
                    break;
                }

                $lineNumber++;
            }
        }
//        var_dump($datosCarga);                        die();
        unset($data);
        $this->Close();
        return $datosCarga;
    }

    public function getDatosRutasMb($start, $blockSize) {
        $this->Open();
        $data = $this->Archivo;

        if ($data) {
            $datosCarga = array();
            $lineNumber = 1;

            while (!feof($data)) {
                $strFilas = fgets($data, 4096);
                if ($lineNumber >= $start && $lineNumber <= ($start + $blockSize) - 1) {
                    $arrColumnas = explode($this->Delimitador, $strFilas);
//                    var_dump($arrColumnas);die();
//                    var_dump($arrColumnas[1]);                    die();
                    if (isset($arrColumnas[9])) {
                        if ($arrColumnas[0] != 'Ruta') { // Quita la fila de encabezados
//                        var_dump($arrColumnas[1]);                    die();
                            $datos = array(
                                'RUTA' => utf8_encode(trim($arrColumnas[0])),
                                'CLIENTE' => utf8_encode(trim($arrColumnas[1])),
                                'NOMBRE' => utf8_encode(trim($arrColumnas[2])),
                                'DIRECCION' => utf8_encode(trim($arrColumnas[3])),
                                'DIRECCIONDESCRIPCION' => utf8_encode(trim($arrColumnas[4])),
                                'REFERENCIA' => utf8_encode(trim($arrColumnas[5])),
                                'SEMANA' => trim($arrColumnas[6]),
                                'DIA' => trim($arrColumnas[7]),
                                'SECUENCIA' => trim($arrColumnas[8]),
                                'ESTATUS' => trim($arrColumnas[9]),
                            );

                            array_push($datosCarga, $datos);
                            unset($datos);
                        }
                    }
                }

                if ($lineNumber > ($start + $blockSize) - 1) {
                    break;
                }

                $lineNumber++;
            }
        }
//        var_dump($datosCarga);                        die();
        unset($data);
        $this->Close();
        return $datosCarga;
    }

}
