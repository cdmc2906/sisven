<?php

/**
 * @fecha 
 * @author
 */
class CargaOrdenesMbForm extends CFormModel {

//    public $fechaIngreso;
    public $rutaArchivo;
    public $fechaUltimaCarga;
    public $delimitadorColumnas;

    /**
     * Declares the validation rules.
     */
    public function rules() {
        return array(
            array('delimitadorColumnas', 'required'),
            array('rutaArchivo,delimitadorColumnas,fechaUltimaCarga', 'safe'),
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
            'rutaArchivo' => 'Archivo Ordenes',
            'delimitadorColumnas' => 'Delimitador columnas archivo',
            'fechaUltimaCarga' => 'Ultima fecha carga informacion ordenes',
        );
    }

}
