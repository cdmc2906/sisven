<?php

/**
 * 
 * @fecha 
 * @author
 */
class RptResumenSemanalHistorialForm extends CFormModel {

//    public $anio;
//    public $mes;
    public $fechagestion;
    public $ejecutivo;

    /**
     * Declares the validation rules.
     */
    public function rules() {
        return array(
            array('fechagestion, ejecutivo', 'required'),
            array('fechagestion,ejecutivo', 'safe'),
        );
    }

    /**
     * Declares customized attribute labels.
     * If not declared here, an attribute would have a label that is
     * the same as its name with the first letter in upper case.
     */
    public function attributeLabels() {
        return array(
            'fechagestion' => 'Fecha gestion en ruta',
            'ejecutivo' => 'Ejecutivo asignado ruta',
        );
    }

}
