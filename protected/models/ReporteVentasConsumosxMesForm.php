<?php

/**
 * Description of ReporteTotalPlanForm
 * @fecha 2015/11/15
 * @author Christian Araujo
 */
class ReporteVentasConsumosxMesForm extends CFormModel {

    public $mes;

    /**
     * Declares the validation rules.
     */
    public function rules() {
        return array(
            array('mes', 'required'),
        );
    }

    /**
     * Declares customized attribute labels.
     * If not declared here, an attribute would have a label that is
     * the same as its name with the first letter in upper case.
     */
    public function attributeLabels() {
        return array(
            'mes' => 'Mes consulta',
        );
    }

}
