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

    public function MapeoCustomizado($fechasRevisadas, $parametrosAlmacenados, $ejecutivo, $encabezado, $footer) {
//        var_dump($parametrosAlmacenados);die();
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
        for ($fila = 0; $fila < count($parametrosAlmacenados); $fila++) {
            for ($columna = 0; $columna <= count($fechasRevisadas); $columna++) {
                if ($columna == 0)
                    $this->objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($columna, ($fila + $row_offset), $parametrosAlmacenados[$fila]);
                else {
                    $valoresHistorial = $fResumenHistorial->getValoresRevisionesEjecutivo(
                            $fechasRevisadas[$columna - 1]
                            , $parametrosAlmacenados[$fila]
                            , $ejecutivo);
                    $valorCelda = isset($valoresHistorial[0]) ? $valoresHistorial[0]["valor"] : 'SinDatos';
                    $this->objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($columna, ($fila + $row_offset), $valorCelda);
                }
                if ($columna > 0) {
                    $this->objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($columna, $fila + $row_offset)
                            ->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                    $this->objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($columna, $fila + $row_offset)
                            ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                }#FIN DE IF COMPRUEBA COLUMNA EN ID COLUMNAS CENTRAR
                #APLICACION DE ESTILO A LA CELDA
                $this->objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($columna, ($fila + $row_offset))->applyFromArray($styleArray);
            }#FIN ITERACION SOBRE COLUMNAS
        }/* FIN ITERACION SOBRE FILAS */

//        /* CONFIGURACION DE ENCABEZADOS Y PIE DE PAGINA DE IMPRESION */
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
