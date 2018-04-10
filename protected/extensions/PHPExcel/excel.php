<?php

/**
 * Description of excel
 * Librería para exportación a excel
 * * @date 2015-11-15
 * * @author Christian Araujo Tececab
 */
/**
 * Uso de librerías externas
 */
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'PHPExcel.php';

class excel {

    private $objPHPExcel; /* ObjPHPExcel */
    private $objWriter;
    public $MapeoDefault = 'default';

    public function __construct() {
        $this->objPHPExcel = new PHPExcel();
    }

    public function getObjPHPExcel() {
        return $this->objPHPExcel;
    }

    public function SetNombreHojaActiva($NombreHojaActiva) {
        $this->objPHPExcel->getActiveSheet()->setTitle($NombreHojaActiva);
    }

    public function SetHojaDefault($HojaDefault) {
        $this->objPHPExcel->setActiveSheetIndex($HojaDefault);
    }

    public function CrearArchivo($VersionArchivo, $NombreArchivo) {
//        var_dump($VersionArchivo);        die();
//        var_dump($this->objPHPExcel);        die();
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename= "' . $NombreArchivo . '.xlsx"');
        header('Cache-Control: max-age=0');
//        var_dump($this->objPHPExcel);        die();
        $this->objWriter = PHPExcel_IOFactory::createWriter($this->objPHPExcel, $VersionArchivo);
    }

    public function GuardarArchivo() {
        $this->objWriter->save('php://output');
    }

    /**
     * Implementar mapeos personalizados en caso de ser necesario
     * @param type $result
     */
    public function Mapeo($result, $encabezado = 'Reporte Tececab', $footer = '', $columnasCentrar = '') {
//        var_dump($result);        die();
        switch ($this->MapeoDefault) {
            case 1:
                break;
            default:
                $this->MapeoDefault($result, $encabezado, $footer, $columnasCentrar);
                break;
        }
    }

    public function MapeoCustomizadoHistorial($fechasRevisadas, $cantidadFilas, $reporteConPrecision, $reporteSinPrecision, $precision, $ejecutivo, $encabezado, $footer) {
        $row_offset = 1;
        $styleArrayCell = array(
            'font' => array(
                'bold' => true,
            ),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            ),
            'borders' => array(
                'outline' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('argb' => '00000000'),
                ),
            ),
        );

        $this->objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $row_offset, 'REPORTE CON PRECISION ' . $precision . ' METROS');
        $this->objPHPExcel->getActiveSheet()->getColumnDimensionByColumn(0)->setAutoSize(true);
        $this->objPHPExcel->getActiveSheet()->getStyleByColumnAndRow(0, $row_offset)->applyFromArray($styleArrayCell);
        $row_offset++;
        $this->objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $row_offset, 'PARAMETRO');
        $this->objPHPExcel->getActiveSheet()->getColumnDimensionByColumn(0)->setAutoSize(true);
        $this->objPHPExcel->getActiveSheet()->getStyleByColumnAndRow(0, $row_offset)->applyFromArray($styleArrayCell);

        for ($iteradorTitulos = 1; $iteradorTitulos <= count($fechasRevisadas); $iteradorTitulos++) {
            $this->objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($iteradorTitulos, $row_offset, $fechasRevisadas[$iteradorTitulos - 1]);
            $this->objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($iteradorTitulos)->setAutoSize(true);
            $this->objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($iteradorTitulos, $row_offset)->applyFromArray($styleArrayCell);
        }
        $row_offset++;
        $fResumenHistorial = new FResumenDiarioHistorialModel();
        #DEFINICION DE ESTILO PARA CADA CELDA
        $styleArray = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            ),
            'borders' => array(
                'outline' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('argb' => '00000000'),
                ),
            ),
        );
        /* EXPORTAR DATOS DE RESUMEN CON PRECISION */
        for ($fila = 0; $fila < $cantidadFilas; $fila++) {
//            var_dump($reporteConPrecision);die();
            $this->objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $fila + $row_offset, $reporteConPrecision[0][$fila]['PARAMETRO']);
            $this->objPHPExcel->getActiveSheet()
                    ->getStyleByColumnAndRow(0, $fila + $row_offset)
                    ->getAlignment()
                    ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $this->objPHPExcel->getActiveSheet()
                    ->getStyleByColumnAndRow(0, $fila + $row_offset)
                    ->getAlignment()
                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $this->objPHPExcel->getActiveSheet()->getStyleByColumnAndRow(0, $fila + $row_offset)->applyFromArray($styleArray);
        }
//        var_dump($this->objPHPExcel);die();
        $column_offset = 1;
        for ($columna = 0; $columna < count($reporteConPrecision); $columna++) {
            for ($fila = 0; $fila < $cantidadFilas; $fila++) {
                $this->objPHPExcel->getActiveSheet()
                        ->setCellValueByColumnAndRow($columna + $column_offset, ($fila + $row_offset), $reporteConPrecision[$columna][$fila]['VALOR']);
                $this->objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($columna + $column_offset, ($fila + $row_offset))->applyFromArray($styleArray);
            }
        }
        
        //AGREGO 4 FILAS PARA SEPARAR ENTRE LOS REGISTROS CON PRECISI�N Y SIN PRESICION
        $row_offset = $cantidadFilas + 4;

        if (count($reporteSinPrecision)) {
            /* EXPORTAR DATOS DE RESUMEN SIN PRECISION */
            $this->objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $row_offset, 'REPORTE SIN PRECISION');
            $this->objPHPExcel->getActiveSheet()->getColumnDimensionByColumn(0)->setAutoSize(true);
            $this->objPHPExcel->getActiveSheet()->getStyleByColumnAndRow(0, $row_offset)->applyFromArray($styleArrayCell);
            $row_offset++;
            $this->objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $row_offset, 'PARAMETRO');
            $this->objPHPExcel->getActiveSheet()->getColumnDimensionByColumn(0)->setAutoSize(true);
            $this->objPHPExcel->getActiveSheet()->getStyleByColumnAndRow(0, $row_offset)->applyFromArray($styleArrayCell);

            for ($iteradorTitulos = 1; $iteradorTitulos <= count($fechasRevisadas); $iteradorTitulos++) {
                $this->objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($iteradorTitulos, $row_offset, $fechasRevisadas[$iteradorTitulos - 1]);
                $this->objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($iteradorTitulos)->setAutoSize(true);
                $this->objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($iteradorTitulos, $row_offset)->applyFromArray($styleArrayCell);
            }
            $row_offset++;
//        $cantidadFilas = 12;
            if (count($reporteSinPrecision) > 0) {
                for ($fila = 0; $fila < $cantidadFilas; $fila++) {
                    $this->objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $fila + $row_offset, $reporteSinPrecision[0][$fila]['PARAMETRO']);
                    $this->objPHPExcel->getActiveSheet()
                            ->getStyleByColumnAndRow(0, $fila + $row_offset)
                            ->getAlignment()
                            ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                    $this->objPHPExcel->getActiveSheet()
                            ->getStyleByColumnAndRow(0, $fila + $row_offset)
                            ->getAlignment()
                            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    $this->objPHPExcel->getActiveSheet()->getStyleByColumnAndRow(0, $fila + $row_offset)->applyFromArray($styleArray);
                }
                $column_offset = 1;
                for ($columna = 0; $columna < count($reporteSinPrecision); $columna++) {
                    for ($fila = 0; $fila < $cantidadFilas; $fila++) {
                        $this->objPHPExcel->getActiveSheet()
                                ->setCellValueByColumnAndRow($columna + $column_offset, ($fila + $row_offset), $reporteSinPrecision[$columna][$fila]['VALOR']);
                        $this->objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($columna + $column_offset, ($fila + $row_offset))->applyFromArray($styleArray);
                    }
                }
            }
        }
        /* CONFIGURACION DE ENCABEZADOS Y PIE DE PAGINA DE IMPRESION */
        $this->objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddHeader('&C&H' . $encabezado);
        $this->objPHPExcel->getActiveSheet()->getHeaderFooter()->
                setOddFooter('&L&B' . $this->objPHPExcel->getProperties()->getTitle() . '&C&B' . $footer . '&RPag. &P de &N');
        $this->objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_DEFAULT);
    }

    public function MapeoCustomizadoGestionValidacionMines($usuarios, $fechasRevisadas, $datosFechas, $horasRevisadas, $datosHoras, $encabezado, $footer) {

//        var_dump($fechasRevisadas,count($fechasRevisadas),$fechasRevisadas[0]['fecha']);die();

        $row_offset = 1;
        $styleArrayCell = array(
            'font' => array(
                'bold' => true,
            ),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            ),
            'borders' => array(
                'outline' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('argb' => '00000000'),
                ),
            ),
        );

        #DEFINICION DE ESTILO PARA CADA CELDA
        $styleArray = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            ),
            'borders' => array(
                'outline' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('argb' => '00000000'),
                ),
            ),
        );
        //INICIO DE IMPRESION DE DATOS POR FECHAS

        $this->objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $row_offset, 'RESUMEN GESTION CARGA POR FECHA');
        $this->objPHPExcel->getActiveSheet()->getColumnDimensionByColumn(0)->setAutoSize(true);
        $this->objPHPExcel->getActiveSheet()->getStyleByColumnAndRow(0, $row_offset)->applyFromArray($styleArrayCell);
        $row_offset++;
        $this->objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $row_offset, 'AGENTE');
        $this->objPHPExcel->getActiveSheet()->getStyleByColumnAndRow(0, $row_offset)->applyFromArray($styleArrayCell);

        for ($iteradorFechas = 1; $iteradorFechas <= count($fechasRevisadas); $iteradorFechas++) {
            $this->objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($iteradorFechas, $row_offset, $fechasRevisadas[$iteradorFechas - 1]['fecha']);
            $this->objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($iteradorFechas)->setAutoSize(true);
            $this->objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($iteradorFechas, $row_offset)->applyFromArray($styleArrayCell);
        }
        $row_offset++;

        for ($iteradorUsuarios = 0; $iteradorUsuarios < count($usuarios); $iteradorUsuarios++) {
            $this->objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $row_offset, $usuarios[$iteradorUsuarios]['nombreusuario']);
            $this->objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($iteradorFechas)->setAutoSize(true);
            $this->objPHPExcel->getActiveSheet()->getStyleByColumnAndRow(0, $row_offset)->applyFromArray($styleArrayCell);
            for ($iteradorFechas = 1; $iteradorFechas <= count($fechasRevisadas); $iteradorFechas++) {
                $valorParametro = '';
                foreach ($datosFechas as $clave => $itemAgente) {
                    if ($usuarios[$iteradorUsuarios]['idusuario'] == $clave) {
                        foreach ($itemAgente as $item) {
                            if ($item['fecha'] == $fechasRevisadas[$iteradorFechas - 1]['fecha']) {
                                $valorParametro = $item['cantidad'];
                                break;
                            }
                        }
                    }
                }
                $this->objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($iteradorFechas, $row_offset, $valorParametro);
                $this->objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($iteradorFechas)->setAutoSize(true);
                $this->objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($iteradorFechas, $row_offset)->applyFromArray($styleArrayCell);
            }
            $row_offset ++;
        }

        #INICIO DE IMPRESION DE DATOS POR HORAS
        $row_offset += 2;
        $this->objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $row_offset, 'RESUMEN GESTION CARGA POR HORA');
        $this->objPHPExcel->getActiveSheet()->getColumnDimensionByColumn(0)->setAutoSize(true);
        $this->objPHPExcel->getActiveSheet()->getStyleByColumnAndRow(0, $row_offset)->applyFromArray($styleArrayCell);
        $row_offset++;
        $this->objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $row_offset, 'AGENTE');
        $this->objPHPExcel->getActiveSheet()->getStyleByColumnAndRow(0, $row_offset)->applyFromArray($styleArrayCell);

        for ($iteradorHoras = 1; $iteradorHoras <= count($horasRevisadas); $iteradorHoras++) {
            $this->objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($iteradorHoras, $row_offset, $horasRevisadas[$iteradorHoras - 1]['hora']);
            $this->objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($iteradorHoras)->setAutoSize(true);
            $this->objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($iteradorHoras, $row_offset)->applyFromArray($styleArrayCell);
        }
        $row_offset++;

        for ($iteradorUsuarios = 0; $iteradorUsuarios < count($usuarios); $iteradorUsuarios++) {
            $this->objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $row_offset, $usuarios[$iteradorUsuarios]['nombreusuario']);
            $this->objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($iteradorFechas)->setAutoSize(true);
            $this->objPHPExcel->getActiveSheet()->getStyleByColumnAndRow(0, $row_offset)->applyFromArray($styleArrayCell);
            for ($iteradorHoras = 1; $iteradorHoras <= count($horasRevisadas); $iteradorHoras++) {
                $valorParametro = '';
                foreach ($datosHoras as $clave => $itemAgente) {
//                    var_dump($clave);die();
                    if ($usuarios[$iteradorUsuarios]['idusuario'] == $clave) {
                        foreach ($itemAgente as $item) {
//                        var_dump($item,$horasRevisadas[$iteradorHoras - 1]['hora']);                        die();
//                        var_dump($item['fecha'] ,$fechasRevisadas[$iteradorFechas - 1]['fecha']);                        die();
                            if ($item['hora'] == $horasRevisadas[$iteradorHoras - 1]['hora']) {
                                $valorParametro = $item['cantidad'];
//                        var_dump($item['cantidad']);                        die();
                                break;
                            }
                        }
                    }
                }
                $this->objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($iteradorHoras, $row_offset, $valorParametro);
                $this->objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($iteradorHoras)->setAutoSize(true);
                $this->objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($iteradorHoras, $row_offset)->applyFromArray($styleArrayCell);
            }
            $row_offset ++;
        }

        /* CONFIGURACION DE ENCABEZADOS Y PIE DE PAGINA DE IMPRESION */
        $this->objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddHeader('&C&H' . $encabezado);
        $this->objPHPExcel->getActiveSheet()->getHeaderFooter()->
                setOddFooter('&L&B' . $this->objPHPExcel->getProperties()->getTitle() . '&C&B' . $footer . '&RPag. &P de &N');
        $this->objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_DEFAULT);
    }

    public function MapeoDefault($result, $encabezado, $footer, $columnasCentrar) {
//var_dump($result);        die();
        $row_cnt = count($result);

        if ($row_cnt > 0) {
            $col_names = array_keys($result[0]);
            $fields_cnt = count($result[0]);
            $row_offset = 1;

            /* Encabezados */
            for ($i = 0; $i < $fields_cnt; ++$i) {
                $this->objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($i, $row_offset, utf8_encode($col_names[$i]));

                $this->objPHPExcel->getActiveSheet()
                        ->getColumnDimensionByColumn($i)
                        ->setAutoSize(true);

                //Formato para titulo con negrita y centrado
                $styleArrayCell = array(
                    'font' => array(
                        'bold' => true,
                    ),
                    'alignment' => array(
                        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    ),
                    'borders' => array(
                        'outline' => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN,
                            'color' => array('argb' => '00000000'),
                        ),
                    ),
                );

                $this->objPHPExcel->getActiveSheet()
                        ->getStyleByColumnAndRow($i, $row_offset)->applyFromArray($styleArrayCell);
            }

            $row_offset++;

            /* Filas de datos */
            for ($r = 0; ($r < 65536) && ($r < $row_cnt); ++$r) {
                for ($c = 0; $c < $fields_cnt; ++$c) {
                    if (!isset($result[$r][$col_names[$c]]) || is_null($result[$r][$col_names[$c]])) {
                        $this->objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($c, ($r + $row_offset), '');
                    } elseif ($result[$r][$col_names[$c]] != '') {

                        $data = html_entity_decode($result[$r][$col_names[$c]]);

                        $this->objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($c, ($r + $row_offset), $data);
                    } else {
                        $this->objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($c, ($r + $row_offset), '');
                    }
                    $this->objPHPExcel->getActiveSheet()
                            ->getStyleByColumnAndRow($c, ($r + $row_offset))
                            ->getAlignment()
                            ->setWrapText(true);
                    #DEFINICION DE ESTILO PARA CADA CELDA
                    $styleArray = array(
                        'borders' => array(
                            'outline' => array(
                                'style' => PHPExcel_Style_Border::BORDER_THIN,
                                'color' => array('argb' => '00000000'),
                            ),
                        ),
                    );

                    #APLICACION DE ESTILO A LA CELDA
                    $this->objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($c, ($r + $row_offset))->applyFromArray($styleArray);

                    #VALIDACION QUE SE ENVIO COMO PARAMETROS LOS ID DE LAS COLUMNAS PARA CENTRAR
                    if (isset($columnasCentrar[0]["NUMCOLUMNA"])) {
                        foreach ($columnasCentrar as $item) {
                            if (in_array($c, $item)) {
                                $this->objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($c, $r + $row_offset)
                                        ->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                                $this->objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($c, $r + $row_offset)
                                        ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                                break;
                            }#FIN DE IF COMPRUEBA COLUMNA EN ID COLUMNAS CENTRAR
                        }#FIN FOREACH
                    }#FIN VALIDACION ENVIO DE COLUMNAS CENTRAR
                }#FIN ITERACION SOBRE COLUMNAS
            }#FIN ITERACION SOBRE FILAS
            #CONFIGURACION DE ENCABEZADOS Y PIE DE PAGINA DE IMPRESION
            $this->objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddHeader('&C&H' . $encabezado);
            $this->objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&L&B' . $this->objPHPExcel->getProperties()->getTitle() . '&C&B' . $footer . '&RPag. &P de &N');
            $this->objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
        }
    }

    public function MapeoTablasImagen($data, $nombreImagen, $fechaReporte) {
        $objDrawing = new PHPExcel_Worksheet_Drawing();
        $objDrawing->setPath('./images/inen_header.png');       // filesystem reference for the image file                // sets the image height to 36px (overriding the actual image height); 
        $objDrawing->setHeight(50);
        $objDrawing->setCoordinates('A1');    // pins the top-left corner of the image to cell D24
        $objDrawing->setWorksheet($this->objPHPExcel->getActiveSheet());

        $this->objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, 1, 'CRECIMIENTO DEMANDA');
        $this->objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, 2, 'AL ' . $fechaReporte);
        $this->objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(11, 1, $_SESSION['CUENTA']);
        $this->objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(11, 2, date(FORMATO_FECHA_LONG));


        $row_offset = 0;
        foreach ($data as $result) {
            $row_cnt = count($result);

            if ($row_cnt > 0) {
                $col_names = array_keys($result[0]);
                $fields_cnt = count($result[0]);
                if ($row_offset == 0) {
                    $row_offset = 5;
                } else {
                    $row_offset = $row_offset + 7;
                }

                /* Encabezados */
                for ($i = 0; $i < $fields_cnt; ++$i) {
                    $this->objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($i, $row_offset, utf8_encode($col_names[$i]));
                }

                $row_offset++;

                for ($r = 0; ($r < 65536) && ($r < $row_cnt); ++$r) {
                    for ($c = 0; $c < $fields_cnt; ++$c) {
                        if (!isset($result[$r][$col_names[$c]]) || is_null($result[$r][$col_names[$c]])) {
                            $this->objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($c, ($r + $row_offset), '');
                        } elseif ($result[$r][$col_names[$c]] != '') {

                            $data = html_entity_decode($result[$r][$col_names[$c]]);

                            $this->objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($c, ($r + $row_offset), $data);
                        } else {
                            $this->objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($c, ($r + $row_offset), '');
                        }
                    }
                }

                $row_offset = $row_cnt;
            }
        }

        $this->objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);

        if (file_exists(Yii::app()->params['rutaArchivosGraficos'] . $nombreImagen . '.png')) {
            $objDrawing = new PHPExcel_Worksheet_Drawing();
            $objDrawing->setPath('./graficos/' . $nombreImagen . '.png');       // filesystem reference for the image file                // sets the image height to 36px (overriding the actual image height); 
            $objDrawing->setCoordinates('H6');    // pins the top-left corner of the image to cell D24
            $objDrawing->setWorksheet($this->objPHPExcel->getActiveSheet());
        }
    }

}
