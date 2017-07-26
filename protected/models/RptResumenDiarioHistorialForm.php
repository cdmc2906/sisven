<?php

/**
 * 
 * @fecha 
 * @author
 */
class RptResumenDiarioHistorialForm extends CFormModel {

//    public $anio;
//    public $mes;
    public $fechagestion;
    public $ejecutivo;
    public $precisionVisitas;

    /**
     * Declares the validation rules.
     */
    public function rules() {
        return array(
            array('fechagestion, ejecutivo,precisionVisitas', 'required'),
            array('fechagestion,ejecutivo,precisionVisitas', 'safe'),
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
            'precisionVisitas' => 'Precision visita (metros)'
            
        );
    }

}
