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
    public $horaInicioGestion;
    public $horaFinGestion;
    public $ejecutivo;
    public $precisionVisitas;
    public $comentarioSupervision;
    public $enlaceMapa;
    public $accionHistorial;
    public $semanaRevision;

    /**
     * Declares the validation rules.
     */
    public function rules() {
        return array(
            array('fechagestion,ejecutivo,precisionVisitas,horaFinGestion,accionHistorial,semanaRevision', 'required'),
            array('fechagestion,ejecutivo,precisionVisitas,horaInicioGestion,horaFinGestion,comentarioSupervision,enlaceMapa,accionHistorial,semanaRevision', 'safe'),
        );
    }

    /**
     * Declares customized attribute labels.
     * If not declared here, an attribute would have a label that is
     * the same as its name with the first letter in upper case.
     */
    public function attributeLabels() {
        return array(
            'fechagestion' => 'Fecha gestion',
            'ejecutivo' => 'Ejecutivo ruta',
            'precisionVisitas' => 'Precision visita',
            'horaInicioGestion' => 'Hora de inicio',
            'horaFinGestion' => 'Hora de fin',
            'comentarioSupervision' => 'Ingresar el comentario de supervision',
            'enlaceMapa' => 'Ingresar el enlace del mapa',
            'accionHistorial' => 'Accion historial',
            'semanaRevision' => 'Semana revision'
        );
    }

}
