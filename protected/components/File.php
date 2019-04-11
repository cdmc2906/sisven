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
                    if (isset($arrColumnas[36])) {
                        if ($arrColumnas[0] != 'FECHA') { // Quita la fila de encabezados
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

    public function getDatosMinesValidacion($start, $blockSize) {
        $this->Open();
        $data = $this->Archivo;

        if ($data) {
            $datosCarga = array();
            $lineNumber = 1;

            while (!feof($data)) {
                $strFilas = fgets($data, 4096);
                if ($lineNumber >= $start && $lineNumber <= ($start + $blockSize) - 1) {
                    $arrColumnas = explode($this->Delimitador, $strFilas);
                    if (isset($arrColumnas[8])) {
                        if ($arrColumnas[0] != 'FECHA') { // Quita la fila de encabezados
                            $datos = array(
                                'FECHA' => utf8_encode(trim($arrColumnas[0])),
                                'BODEGA' => utf8_encode(trim($arrColumnas[1])),
                                'NOMBRE_CLIENTE' => utf8_encode(trim($arrColumnas[2])),
                                'CODIGO_GRUPO' => trim($arrColumnas[3]),
                                'DETALLE' => trim($arrColumnas[4]),
                                'IMEI' => trim($arrColumnas[5]),
                                'MIN' => trim($arrColumnas[6]),
                                'VENDEDOR' => utf8_encode(trim($arrColumnas[7])),
                                'USUARIOASGINADO' => utf8_encode(trim($arrColumnas[8])),
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
//                $strFilas = fgets($data);
//                var_dump($strFilas,"ca",$strFilas1);die();
                if ($lineNumber >= $start && $lineNumber <= ($start + $blockSize) - 1) {
                    $arrColumnas = explode($this->Delimitador, $strFilas);
                    if (isset($arrColumnas[32])) {
//                        var_dump(utf8_encode($arrColumnas[0]), utf8_encode('Código'), utf8_encode($arrColumnas[0]) != utf8_encode('Código'));
//                        var_dump(substr($arrColumnas[1], 0, 7));
                        if (substr($arrColumnas[1], 0, 7) != 'Tipo de') {
//                            var_dump($arrColumnas[1]);
                            $datos = array(
                                'CLI_CODIGO_CLIENTE' => utf8_encode(trim($arrColumnas[0])),
                                'CLI_TIPO_DE_IDENTIFICACION' => utf8_encode(trim($arrColumnas[1])),
                                'CLI_IDENTIFICACION' => utf8_encode(trim($arrColumnas[2])),
                                'CLI_NOMBRE_CLIENTE' => utf8_decode(utf8_encode(trim(trim($arrColumnas[3], '"')))),
                                'CLI_NOMBRE_DE_COMPANIA' => utf8_decode(utf8_encode(trim(trim($arrColumnas[4], '"')))),
                                'CLI_NOMBRE_COMERCIAL' => utf8_decode(utf8_encode(trim($arrColumnas[5], '"'))),
                                'CLI_CONTACTO' => utf8_decode(utf8_encode(trim(trim($arrColumnas[6], '"')))),
                                'CLI_MONEDA' => utf8_encode(trim($arrColumnas[7])),
                                'CLI_MONEDA_NOMBRE' => utf8_encode(trim($arrColumnas[8])),
                                'CLI_TIPO_DE_NEGOCIO' => utf8_encode(trim($arrColumnas[9])),
                                'CLI_TIPO_DE_NEGOCIO_NOMBRE' => utf8_encode(trim($arrColumnas[10])),
                                'CLI_SUBCANAL' => utf8_encode(trim($arrColumnas[11])),
                                'CLI_SUBCANAL_NOMBRE' => utf8_encode(trim($arrColumnas[12])),
                                'CLI_LISTA_DE_PRECIOS' => utf8_encode(trim($arrColumnas[13])),
                                'CLI_LISTA_DE_PRECIOS_NOMBRE' => utf8_encode(trim($arrColumnas[14])),
                                'CLI_LISTA_DE_PRECIOS_2' => utf8_encode(trim($arrColumnas[15])),
                                'CLI_LISTA_DE_PRECIOS_2_NOMBRE' => utf8_encode(trim($arrColumnas[16])),
                                'CLI_TERMINO_DE_PAGO' => utf8_encode(trim($arrColumnas[17])),
                                'CLI_TERMINO_DE_PAGO_NOMBRE' => utf8_encode(trim($arrColumnas[18])),
                                'CLI_METODO_DE_PAGO' => utf8_encode(trim($arrColumnas[19])),
                                'CLI_METODO_DE_PAGO_NOMBRE' => utf8_encode(trim($arrColumnas[20])),
                                'CLI_GRUPO' => utf8_encode(trim($arrColumnas[21])),
                                'CLI_GRUPO_NOMBRE' => utf8_encode(trim($arrColumnas[22])),
                                'CLI_USUARIO' => utf8_encode(trim($arrColumnas[23])),
                                'CLI_USUARIO_NOMBRE' => utf8_decode(utf8_encode(trim($arrColumnas[24]))),
                                'CLI_COMENTARIO' => utf8_encode(trim(trim($arrColumnas[25], '"'))),
                                'CLI_OBJETIVO_DE_VENTA' => utf8_encode(trim($arrColumnas[26])),
                                'CLI_MAXIMO_DESCUENTO_PORCENTAJE' => utf8_encode(trim($arrColumnas[27])),
                                'CLI_RETENCION_PORCENTAJE' => utf8_encode(trim($arrColumnas[28])),
                                'CLI_TIENE_CREDITO' => utf8_encode(trim($arrColumnas[29])),
                                'CLI_ESTATUS' => utf8_encode(trim($arrColumnas[30])),
                                'CLI_CREADO' => utf8_encode(trim($arrColumnas[31])),
                                'CLI_CREADO_POR' => utf8_encode(trim($arrColumnas[32])),
                            );
//                            var_dump($datos);die();
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
//            die();
        }
//        var_dump($datosCarga);        die();
        unset($data);
        $this->Close();
        return $datosCarga;
    }

    public function getDireccionClientes($start, $blockSize) {
        $this->Open();
        $data = $this->Archivo;

        if ($data) {
            $datosCarga = array();
            $lineNumber = 1;

            while (!feof($data)) {
                $strFilas = fgets($data, 4096);
//                $strFilas = fgets($data);
//                var_dump($strFilas);die();
                if ($lineNumber >= $start && $lineNumber <= ($start + $blockSize) - 1) {
                    $arrColumnas = explode($this->Delimitador, $strFilas);
//                    var_dump(isset($arrColumnas[29]),$arrColumnas);die();
                    if (isset($arrColumnas[25])) {
//                        var_dump(utf8_encode($arrColumnas[0]), utf8_encode('Código'), utf8_encode($arrColumnas[0]) != utf8_encode('Código'));
//                        var_dump(substr($arrColumnas[1], 0, 7));
                        if ($arrColumnas[1] != 'Cliente') {
//                            var_dump($arrColumnas[1]);
                            $datos = array(
                                'DCLI_CODIGO' => utf8_encode(trim(trim(trim($arrColumnas[0]), "'"), ";")),
                                'DCLI_CLIENTE' => utf8_encode(trim(trim($arrColumnas[1]), "'")),
                                'DCLI_CLIENTE_NOMBRE' => utf8_decode(utf8_encode(trim(trim($arrColumnas[2]), "'"))),
                                'DCLI_CLIENTE_IDENTIFICACION' => utf8_encode(trim(trim($arrColumnas[3]), "'")),
                                'DCLI_CLIENTE_COMENTARIO' => utf8_decode(utf8_encode(trim(trim(trim($arrColumnas[4]), "'"), ";"))),
                                'DCLI_OFICINA' => utf8_encode(trim(trim($arrColumnas[5]), "'")),
                                'DCLI_OFICINA_NOMBRE' => utf8_encode(trim(trim($arrColumnas[6]), "'")),
                                'DCLI_CODIGO_DE_BARRAS' => utf8_encode(trim(trim($arrColumnas[7]), "'")),
                                'DCLI_DESCRIPCION' => utf8_encode(trim(trim($arrColumnas[8]), "'")),
                                'DCLI_CONTACTO' => utf8_encode(trim(trim($arrColumnas[9]), "'")),
                                'DCLI_GEO_AREA' => utf8_decode(utf8_encode(trim(trim($arrColumnas[10]), "'"))),
                                'DCLI_GEO_AREA_NOMBRE' => utf8_decode(utf8_encode(trim(trim($arrColumnas[11]), "'"))),
                                'DCLI_GEO_AREA_CODIGO_RECORRIDO' => utf8_encode(trim(trim($arrColumnas[12]), "'")),
                                'DCLI_GEO_AREA_DESCRIPCION_RECORRIDO' => utf8_decode(utf8_encode(trim(trim($arrColumnas[13]), "'"))),
                                'DCLI_CALLE_PRINCIPAL' => utf8_decode(utf8_encode(trim(trim($arrColumnas[14]), "'"))),
                                'DCLI_NOMENCLATURA' => utf8_decode(utf8_encode(trim(trim($arrColumnas[15]), "'"))),
                                'DCLI_CALLE_SECUNDARIA' => utf8_decode(utf8_encode(trim(trim($arrColumnas[16]), "'"))),
                                'DCLI_REFERENCIA' => utf8_decode(utf8_encode(trim(trim($arrColumnas[17]), "'"))),
                                'DCLI_CODIGO_POSTAL' => utf8_encode(trim(trim($arrColumnas[18]), "'")),
                                'DCLI_TELEFONO' => utf8_encode(trim(trim($arrColumnas[19]), "'")),
                                'DCLI_FAX' => utf8_encode(trim(trim($arrColumnas[20]), "'")),
                                'DCLI_EMAIL' => utf8_encode(trim(trim($arrColumnas[21]), "'")),
                                'DCLI_LATITUD' => utf8_encode(trim(trim($arrColumnas[22]), "'")),
                                'DCLI_LONGITUD' => utf8_encode(trim(trim($arrColumnas[23]), "'")),
                                'DCLI_ULTIMA_VISITA' => utf8_encode(trim(trim($arrColumnas[24]), "'")),
                                'DCLI_ESTADO_DE_LOCALIZACION' => utf8_decode(utf8_encode(trim(trim($arrColumnas[25]), "'"))),
                            );
//                            var_dump($datos);die();
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
//            die();
        }
//        var_dump($datosCarga);        die();
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
                    if (isset($arrColumnas[19]) && intval($arrColumnas[0] > 0)) {
                        if (count($arrColumnas) > 0 && $arrColumnas[0] != 'Id') { // Quita la fila de encabezados
//                        var_dump($arrColumnas[1]);                    die();
                            $datos = array(
                                'ID' => trim($arrColumnas[0]),
                                'FECHA' => trim($arrColumnas[1]),
                                'USUARIO' => utf8_encode(trim($arrColumnas[2])),
                                'USUARIONOMBRE' => utf8_decode(utf8_encode(trim($arrColumnas[3]))),
                                'RUTA' => utf8_encode(trim($arrColumnas[4])),
                                'RUTANOMBRE' => utf8_decode(utf8_encode(trim($arrColumnas[5]))),
                                'SEMANA' => trim($arrColumnas[6]),
                                'DIA' => trim($arrColumnas[7]),
                                'CLIENTE' => utf8_encode(trim($arrColumnas[8])),
                                'CLIENTENOMBRE' => utf8_encode(trim($arrColumnas[9])),
                                'DIRECCION' => utf8_decode(utf8_encode(trim($arrColumnas[10]))),
                                // agregada nueva columna
                                'ACCION' => utf8_decode(utf8_encode(trim($arrColumnas[12]))),
                                'CODIGO' => utf8_decode(utf8_encode(trim($arrColumnas[13]))),
                                'CODIGOCOMENTARIO' => utf8_encode(trim($arrColumnas[14])),
                                'COMENTARIO' => utf8_decode(utf8_encode(trim($arrColumnas[15]))),
                                'MONTO' => trim($arrColumnas[16]),
                                'LATITUD' => trim($arrColumnas[17]),
                                'LONGITUD' => trim($arrColumnas[18]),
                                'ROMPERSECUENCIA' => trim($arrColumnas[19]),
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

    public function getDatosTransferenciasMovistar($start, $blockSize) {
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
                                'CLIENTENOMBRE' => utf8_decode(utf8_encode(trim($arrColumnas[9]))),
                                'CLIENTEIDENTIFICACION' => utf8_encode(trim($arrColumnas[10])),
                                'DIRECCION' => utf8_decode(utf8_encode(trim($arrColumnas[11]))),
                                'LISTAPRECIOS' => utf8_encode(trim($arrColumnas[12])),
                                'LISTAPRECIOSNOMBRE' => utf8_encode(trim($arrColumnas[13])),
                                'BODEGAORIGEN' => utf8_encode(trim($arrColumnas[14])),
                                'BODEGAORIGENNOMBRE' => utf8_decode(utf8_encode(trim($arrColumnas[15]))),
                                'TERMINOPAGO' => utf8_encode(trim($arrColumnas[16])),
                                'TERMINOPAGONOMBRE' => utf8_encode(trim($arrColumnas[17])),
                                'USUARIO' => utf8_encode(trim($arrColumnas[18])),
                                'USUARIONOMBRE' => utf8_decode(utf8_encode(trim($arrColumnas[19]))),
                                'DEPARTAMENTOVENTAS' => utf8_encode(trim($arrColumnas[20])),
                                'OFICINA' => utf8_encode(trim($arrColumnas[21])),
                                'OFICINANOMBRE' => utf8_encode(trim($arrColumnas[22])),
                                'TIPOSECUENCIA' => utf8_encode(trim($arrColumnas[23])),
                                'IVA12BASE' => trim($arrColumnas[24]),
                                'IVA12VALOR' => trim($arrColumnas[25]),
                                'IVA0BASE' => trim($arrColumnas[26]),
                                'IVA0VALOR' => trim($arrColumnas[27]),
                                'IVA14BASE' => trim($arrColumnas[28]),
                                'IVA14VALOR' => trim($arrColumnas[29]),
                                'SUBTOTAL' => trim($arrColumnas[30]),
                                'DESCUENTOP' => trim($arrColumnas[31]),
                                'DESCUENTO' => trim($arrColumnas[32]),
                                'IMPUESTOS' => trim($arrColumnas[33]),
                                'OTROSCARGOS' => trim($arrColumnas[34]),
                                'TOTAL' => trim($arrColumnas[35]),
                                'DATOS' => utf8_encode(trim($arrColumnas[36])),
                                'REFERENCIA' => utf8_encode(trim($arrColumnas[37])),
                                'ESTATUSPROCESO' => utf8_encode(trim($arrColumnas[38]))
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
                    if (isset($arrColumnas[11])) {
                        if ($arrColumnas[1] != 'Ruta') { // Quita la fila de encabezados
                            $datos = array(
                                'CODIGO' => utf8_encode(trim($arrColumnas[0])),
                                'RUTA' => utf8_encode(trim($arrColumnas[1])),
                                'CLIENTE' => utf8_encode(trim(str_replace("'", '', $arrColumnas[2]))),
                                'NOMBRE' => trim(trim(utf8_encode(str_replace("'", '', $arrColumnas[3])), '"'), ' 	'), //utf8_encode(trim($arrColumnas[2])),
                                'TIPODENEGOCIO' => utf8_encode(trim(str_replace("'", '', $arrColumnas[4]))),
                                'DIRECCION' => utf8_encode(trim(str_replace("'", '', $arrColumnas[5]))),
                                'DIRECCIONDESCRIPCION' => trim(trim(utf8_encode(str_replace("'", '', $arrColumnas[6])), '"'), '	'), //utf8_encode(trim($arrColumnas[4])),
                                'REFERENCIA' => trim(trim(utf8_encode(str_replace("'", '', $arrColumnas[7])), '"'), '	'), //utf8_encode(trim($arrColumnas[5])),
                                'SEMANA' => trim($arrColumnas[8]),
                                'DIA' => trim($arrColumnas[9]),
                                'SECUENCIA' => trim($arrColumnas[10]),
                                'ESTATUS' => trim($arrColumnas[11]),
                            );
//                            var_dump($datos["NOMBRE"]);die();
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

    public function getDatosMinesDesconocidos($start, $blockSize) {
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
                    if (isset($arrColumnas[5])) {
                        if ($arrColumnas[0] != 'Nro') { // Quita la fila de encabezados
//                        var_dump($arrColumnas[1]);                    die();
                            $datos = array(
                                'NRO' => utf8_encode(trim($arrColumnas[0])),
                                'ICC' => utf8_encode(trim(trim($arrColumnas[1]), '\'')),
                                'MIN' => utf8_encode(trim(trim($arrColumnas[2]), '\'')),
                                'CODIGOVENDEDOR' => utf8_encode(trim($arrColumnas[3])),
                                'CIUDAD' => utf8_encode(trim($arrColumnas[4])),
                                'FECHAALTA' => utf8_encode(trim($arrColumnas[5]))
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
