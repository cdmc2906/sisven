<?php

/**
 * 
 * @fecha 
 * @author
 */
class CalculoComisionForm extends CFormModel {

    public $anio;
    public $mes;
    public $tipoVendedor;

    /**
     * Declares the validation rules.
     */
    public function rules() {
        return array(
            array('anio,mes, tipoVendedor', 'required'),
            array('anio,mes,tipoVendedor', 'safe'),
        );
    }

    /**
     * Declares customized attribute labels.
     * If not declared here, an attribute would have a label that is
     * the same as its name with the first letter in upper case.
     */
    public function attributeLabels() {
        return array(
            'anio' => 'Anio calculo comisiones',
            'mes' => 'Mes calculo comisiones',
            'tipoVendedor' => 'Seleccione el tipo de vendedor',
        );
    }

}
