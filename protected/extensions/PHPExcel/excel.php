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

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename= "' . $NombreArchivo . '.xlsx"');
        header('Cache-Control: max-age=0');

        $this->objWriter = PHPExcel_IOFactory::createWriter($this->objPHPExcel, $VersionArchivo);
    }

    public function GuardarArchivo() {
        $this->objWriter->save('php://output');
    }

    /**
     * Implementar mapeos personalizados en caso de ser necesario
     * @param type $result
     */
    public function Mapeo($result) {
        switch ($this->MapeoDefault) {
            case 1:
                break;
            default:
                $this->MapeoDefault($result);
                break;
        }
    }

    public function MapeoDefault($result) {

        $row_cnt = count($result);

        if ($row_cnt > 0) {
            $col_names = array_keys($result[0]);
            $fields_cnt = count($result[0]);
            $row_offset = 1;

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

            for ($col = 'A'; $col !== 'I'; $col++) {
                $this->objPHPExcel->getActiveSheet()
                        ->getColumnDimension($col)
                        ->setAutoSize(true);
            }
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
