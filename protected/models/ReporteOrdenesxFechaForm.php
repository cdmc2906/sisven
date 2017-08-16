<?php
/**
 * Description of ReporteTotalPlanForm
 * @fecha 2015/11/15
 * @author Christian Araujo
 */
class ReporteOrdenesxFechaForm extends CFormModel {
    public $fechaOrdenesInicio;
    public $fechaOrdenesFin;
    public $tipoReporte;
//    public $fechaConsumoFin;
//    public $rutaArchivo;

    /**
     * Declares the validation rules.
     */
    public function rules() {
        return array(
            array('tipoReporte', 'required'),
            array('fechaOrdenesInicio', 'required'),
            array('fechaOrdenesFin', 'required'),
//            array('fechaConsumo, rutaArchivo', 'safe'),
        );
    }

    /**
     * Declares customized attribute labels.
     * If not declared here, an attribute would have a label that is
     * the same as its name with the first letter in upper case.
     */
    public function attributeLabels() {
        return array(
            'fechaOrdenesInicio' => 'Fecha Inicio',
            'fechaOrdenesFin' => 'Fecha Fin',
            'tipoReporte' => 'Seleccion el tipo reporte',
//            'fechaConsumoFin' => 'Fecha Consumo Fin',
        );
    }
}