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
                    $data.= $col_names[$i] . $this->Delimitador;
                }
                $data.="\r\n";
            }

            for ($r = 0; ($r < $row_cnt); ++$r) {
                for ($c = 0; $c < $fields_cnt; ++$c) {

                    $data.= $result[$r][$col_names[$c]] . $this->Delimitador;
                }
                $data.="\r\n";
            }
        } else {

            $data.=$result;
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
                            'observacion' => '',//trim($arrColumnas[7]),
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
                    if (count($arrColumnas) > 0 && $arrColumnas[0] != 'FECHA') { // Quita la fila de encabezados
                        $datos = array(
                            'fecha' => trim($arrColumnas[0]),
                            'sucursal' => trim($arrColumnas[1]),
                            'num_bod' => trim($arrColumnas[2]),
                            'bodega' => trim($arrColumnas[3]),
                            'num_serie' => trim($arrColumnas[4]),
                            'num_fact' => trim($arrColumnas[5]),
                            'codcli' => trim($arrColumnas[6]),
                            'tipocli' => trim($arrColumnas[7]),
                            'nomcli' => trim($arrColumnas[8]),
                            'ruc' => trim($arrColumnas[9]),
                            'direccion' => trim($arrColumnas[10]),
                            'ciudad' => trim($arrColumnas[11]),
                            'telefono' => trim($arrColumnas[12]),
                            'cod_prod' => trim($arrColumnas[13]),
                            'descrip' => trim($arrColumnas[14]),
                            'codgrup' => trim($arrColumnas[15]),
                            'grupo' => trim($arrColumnas[16]),
                            'cantidad' => trim($arrColumnas[17]),
                            'detalle' => trim($arrColumnas[18]),
                            'imei' => trim($arrColumnas[19]),
                            'min' => trim($arrColumnas[20]),
                            'icc' => trim($arrColumnas[21]),
                            'costo' => trim($arrColumnas[22]),
                            'precio1' => trim($arrColumnas[23]),
                            'precio2' => trim($arrColumnas[24]),
                            'precio3' => trim($arrColumnas[25]),
                            'precio4' => trim($arrColumnas[26]),
                            'precio5' => trim($arrColumnas[27]),
                            'precio' => trim($arrColumnas[28]),
                            'porcendes' => trim($arrColumnas[29]),
                            'descuento' => trim($arrColumnas[30]),
                            'subtotal' => trim($arrColumnas[31]),
                            'iva' => trim($arrColumnas[32]),
                            'total' => trim($arrColumnas[33]),
                            'e_cod' => trim($arrColumnas[34]),
                            'vendedor' => trim($arrColumnas[35]),
                            'mes' => trim($arrColumnas[36]),
                            'semana' => trim($arrColumnas[37]),
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
        unset($data);
        $this->Close();
        return $datosCarga;
    }

}
