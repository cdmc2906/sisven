<?php

/**
 * Description of ReporteTotalPlanForm
 * @fecha 2015/11/15
 * @author Christian Araujo
 */
class ReporteVentasxVendedorForm extends CFormModel {

    public $vendedor;
//    public $mes;

//    public $rutaArchivo;

    /**
     * Declares the validation rules.
     */
    public function rules() {
        return array(
            array('vendedor', 'required'),
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
            'vendedor' => 'Seleccione el vendedor',
//            'mes' => 'Seleccione el mes',
//            'fechaConsumoFin' => 'Fecha Consumo Fin',
        );
    }

}
