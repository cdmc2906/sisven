<?php

/**
 * 
 * @fecha 
 * @author
 */
class CargaAsignacionForm extends CFormModel {

    public $fechaAsignacion;
    public $rutaArchivo;

    /**
     * Declares the validation rules.
     */
    public function rules() {
        return array(
            array('fechaAsignacion', 'required'),
            array('fechaAsignacion, rutaArchivo', 'safe'),
            array('rutaArchivo', 'file', 'types' => 'csv')
        );
    }

    /**
     * Declares customized attribute labels.
     * If not declared here, an attribute would have a label that is
     * the same as its name with the first letter in upper case.
     */
    public function attributeLabels() {
        return array(
            'fechaAsignacion' => 'Fecha Asignacion',
            'rutaArchivo' => 'Archivo Asignacion',
        );
    }

}
