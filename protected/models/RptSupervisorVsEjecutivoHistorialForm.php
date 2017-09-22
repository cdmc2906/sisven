<?php

/**
 * 
 * @fecha 
 * @author
 */
class RptSupervisorVsEjecutivoHistorialForm extends CFormModel {

//    public $anio;
//    public $mes;
    public $fechagestion;
    public $accionHistorial;
    public $precisionVisitas;
    public $horaInicioGestion;
    public $horaFinGestion;
    
//    public $ejecutivo;
//    public $comentarioSupervision;
//    public $enlaceMapa;
//    

    /**
     * Declares the validation rules.
     */
    public function rules() {
        return array(
//            array('fechagestion, precisionVisitas,horaFinGestion,accionHistorial', 'required'),
//            array('fechagestion,ejecutivo,precisionVisitas,horaInicioGestion,horaFinGestion,comentarioSupervision,enlaceMapa,accionHistorial', 'safe'),
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
//            'ejecutivo' => 'Ejecutivo asignado ruta',
            'precisionVisitas' => 'Precision visita (metros)',
            'horaInicioGestion' => 'Seleccione la hora de inicio gestion',
            'horaFinGestion' => 'Seleccione la hora de fin gestion',
//            'comentarioSupervision' => 'Ingresar el comentario de supervision',
//            'enlaceMapa' => 'Ingresar el enlace del mapa',
            'accionHistorial' => 'Seleccione la accion a evaluar'
        );
    }

}
