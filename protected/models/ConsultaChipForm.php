<?php

/**
 * 
 * @fecha 
 * @author
 */
class ConsultaChipForm extends CFormModel {

    public $codigoAcceso;
    public $min;
    public $icc;
    public $codigoLocal;

    /**
     * Declares the validation rules.
     */
    public function rules() {
        return array(
            array('
                codigoLocal,
                ', 'required'),
            array('
                codigoAcceso,
                min,
                icc,
                codigoLocal,
                ', 'safe'),
        );
    }

    /**
     * Declares customized attribute labels.
     * If not declared here, an attribute would have a label that is
     * the same as its name with the first letter in upper case.
     */
    public function attributeLabels() {
        return array(
            'codigoAcceso' => 'Clave de acceso',
            'min' => 'Ingrese el/los MIN(es) a validar',
            'icc' => 'Ingrese el/los ICC(es) a validar',
            'codigoLocal' => 'Codigo del local TCQU',
        );
    }

}
