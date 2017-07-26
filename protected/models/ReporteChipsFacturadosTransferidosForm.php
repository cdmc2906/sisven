<?php
/**
 * Description of ReporteTotalPlanForm
 * @fecha 2015/11/15
 * @author Christian Araujo
 */
class ReporteChipsFacturadosTransferidosForm extends CFormModel {
//    public $fechaInicio;
    public $anioConsulta;
    public $mesConsulta;

    /**
     * Declares the validation rules.
     */
    public function rules() {
        return array(
//            array('fechaInicio', 'required'),
            array('anioConsulta,mesConsulta', 'required'),
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
            'anioConsulta' => 'Anio Consulta',
            'mesConsulta' => 'Mes consulta',
//            'fechaOrdenesFin' => 'Fecha Fin',
//            'fechaConsumoFin' => 'Fecha Consumo Fin',
        );
    }
}