<?php

/**
 * 
 * @fecha 
 * @author
 */
class CargaCompraForm extends CFormModel {

    public $fechaCompra;
    public $rutaArchivo;
    public $estadoId;
    public $tipoProducto;
    public $bodegaId;

    /**
     * Declares the validation rules.
     */
    public function rules() {
        return array(
            array('fechaCompra, estadoId, tipoProducto, bodegaId', 'required'),
            array('fechaCompra, rutaArchivo, estadoId', 'safe'),
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
            'fechaCompra' => 'Fecha Compra',
            'rutaArchivo' => 'Archivo Compra',
            'estadoId' => 'Estado',
            'bodegaId' => 'Bodega' ,
            'tipoProducto'=> 'Tipo Producto'
        );
    }

}
