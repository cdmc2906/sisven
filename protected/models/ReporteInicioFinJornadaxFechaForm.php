<?php

/**
 * Description of ReporteTotalPlanForm
 * @fecha 2015/11/15
 * @author Christian Araujo
 */
class ReporteInicioFinJornadaxFechaForm extends CFormModel {

    public $fechaInicioFinJornadaInicio;
    public $horaFinGestion;
    public $horaInicioGestion;
    public $tipoUsuario;

//    public $fechaConsumoFin;
//    public $rutaArchivo;

    /**
     * Declares the validation rules.
     */
    public function rules() {
        return array(
            array('fechaInicioFinJornadaInicio,horaInicioGestion,horaFinGestion,tipoUsuario', 'required'),
//            array('fechaOrdenesFin', 'required'),
//            array('fechaConsumo, rutaArchivo', 'safe'),
        );
    }

    /**
     * Declares customized attribute labels.
     * If not declared here, an attribute would have a label that is
     * the same as its name with the first letter in upper case.
     */
    public function attributeLabels() {
        return array(
            'fechaInicioFinJornadaInicio' => 'Fecha Revision',
            'horaInicioGestion' => 'Hora Inicio',
            'horaFinGestion' => 'Hora Fin',
            'tipoUsuario' => 'Seleccione el tipo de usuario',
        );
    }

}
