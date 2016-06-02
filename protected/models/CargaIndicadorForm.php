<?php

/**
 * @fecha 
 * @author
 */
class CargaIndicadorForm extends CFormModel {

//    public $fechaIngreso;
    public $rutaArchivo;

    /**
     * Declares the validation rules.
     */
    public function rules() {
        return array(
//            array('fechaConsumo', 'required'),
            array('rutaArchivo', 'safe'),
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
//            'fechaConsumo' => 'Fecha Consumo',
            'rutaArchivo' => 'Archivo Indicadores',
        );
    }

}
