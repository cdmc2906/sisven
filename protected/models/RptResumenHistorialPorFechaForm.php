<?php

/**
 * 
 * @fecha 
 * @author
 */
class RptResumenHistorialPorFechaForm extends CFormModel {

//    public $anio;
//    public $mes;
    public $fechaInicioGestion;
    public $fechaFinGestion;
    public $ejecutivo;

    /**
     * Declares the validation rules.
     */
    public function rules() {
        return array(
            array('fechaInicioGestion,fechaFinGestion, ejecutivo', 'required'),
            array('fechaInicioGestion,fechaFinGestion, ejecutivo', 'safe'),
        );
    }

    /**
     * Declares customized attribute labels.
     * If not declared here, an attribute would have a label that is
     * the same as its name with the first letter in upper case.
     */
    public function attributeLabels() {
        return array(
            'fechaInicioGestion' => 'Fecha Inicio',
            'fechaFinGestion' => 'Fecha Fin',
            'ejecutivo' => 'Ejecutivo ruta',
        );
    }

}
