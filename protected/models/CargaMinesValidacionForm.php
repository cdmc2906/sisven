<?php

/**
 * @fecha 
 * @author
 */
class CargaMinesValidacionForm extends CFormModel {

//    public $fechaIngreso;
    public $fechaUltimaCarga;
    public $rutaArchivo;
    public $delimitadorColumnas;
//    public $usuarioAsignar;

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
//            'fechaConsumo' => 'Fecha Consumo',
            'rutaArchivo' => 'Archivo Indicadores',
            'delimitadorColumnas' => 'Delimitador columnas archivo',
            'fechaUltimaCarga' => 'Ultima fecha carga de mines',
        );
    }

}
