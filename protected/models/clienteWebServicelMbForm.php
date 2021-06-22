<?php

/**
 * @fecha 
 * @author
 */
class ClienteWebServicelMbForm extends CFormModel {

//    public $rutaArchivo;
//    public $periodoAbierto;
//    public $fechaUltimaCarga;
    public $origen;

    /**
     * Declares the validation rules.
     */
    public function rules() {
        return array(
            array('origen', 'required'),
//            array('rutaArchivo,delimitadorColumnas,fechaUltimaCarga', 'safe'),
//            array('rutaArchivo', 'file', 'types' => 'csv,xls,xlsx')
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
//            'rutaArchivo' => 'Archivo Historial',
//            'delimitadorColumnas' => 'Delimitador columnas archivo',
//            'fechaUltimaCarga' => 'Ultima fecha carga historial',
            'origen' => 'Origen Datos',
        );
    }

}
