<?php

/**
 * 
 * @fecha 
 * @author
 */
class AsignaRutaAgenteForm extends CFormModel {

    public $tipoUsuario;

    /**
     * Declares the validation rules.
     */
    public function rules() {
        return array(
            array('tipoUsuario', 'required'),
            array('tipoUsuario', 'safe'),
        );
    }

    /**
     * Declares customized attribute labels.
     * If not declared here, an attribute would have a label that is
     * the same as its name with the first letter in upper case.
     */
    public function attributeLabels() {
        return array(
            'tipoUsuario' => 'Tipo usuario',
        );
    }

}
