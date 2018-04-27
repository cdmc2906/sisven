<?php

/**
 * 
 * @fecha 
 * @author
 */
class CierrePeriodoForm extends CFormModel {

//    public $anio;
//    public $mes;
//    public $fechaInicioGestion;
//    public $fechaFinGestion;
//    public $periodoGestion;
//    public $ejecutivo;
    public $horaInicioGestion;
    public $horaFinGestion;
    public $precisionVisitas;
    public $accionHistorial;
    public $semanaRevision;

    /**
     * Declares the validation rules.
     */
    public function rules() {
        return array(
            array('horaInicioGestion, horaFinGestion, precisionVisitas, accionHistorial, semanaRevision', 'required'),
            array('horaInicioGestion, horaFinGestion, precisionVisitas, accionHistorial, semanaRevision', 'safe'),
        );
    }

    /**
     * Declares customized attribute labels.
     * If not declared here, an attribute would have a label that is
     * the same as its name with the first letter in upper case.
     */
    public function attributeLabels() {
        return array(
//            'periodoGestion' => 'Periodo Gestion',
//            'ejecutivo' => 'Ejecutivo ruta',
            'horaInicioGestion' => 'Hora inicio ',
            'horaFinGestion' => 'Hora fin',
            'precisionVisitas' => 'Precision visita',
            'accionHistorial' => 'Accion historial',
            'semanaRevision' => 'Semana',
        );
    }

}
