<?php
/**
 * Description of ReporteTotalPlanForm
 * @fecha 2015/11/15
 * @author Christian Araujo
 */
class ReporteTotalPlanForm extends CFormModel {
    public $fechaConsumoInicio;
    public $fechaConsumoFin;
//    public $rutaArchivo;

    /**
     * Declares the validation rules.
     */
    public function rules() {
        return array(
            array('fechaConsumoInicio, fechaConsumoFin', 'required'),
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
            'fechaConsumoInicio' => 'Mes Consumo Inicio',
            'fechaConsumoFin' => 'Mes Consumo Fin',
        );
    }
}
