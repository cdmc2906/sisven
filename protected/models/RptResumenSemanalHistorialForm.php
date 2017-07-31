<?php

/**
 * 
 * @fecha 
 * @author
 */
class RptResumenSemanalHistorialForm extends CFormModel {

    public $anio;
    public $mes;
//    public $fechagestion;
    public $ejecutivo;

    /**
     * Declares the validation rules.
     */
    public function rules() {
        return array(
            array('anio, mes, ejecutivo', 'required'),
            array('anio, mes, ejecutivo', 'safe'),
        );
    }

    /**
     * Declares customized attribute labels.
     * If not declared here, an attribute would have a label that is
     * the same as its name with the first letter in upper case.
     */
    public function attributeLabels() {
        return array(
            'anio' => 'Anio historial',
            'mes' => 'Mes historial',
            'ejecutivo' => 'Ejecutivo ruta',
        );
    }

}
