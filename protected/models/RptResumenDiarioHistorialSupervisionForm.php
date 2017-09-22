<?php

/**
 * 
 * @fecha 
 * @author
 */
class RptResumenDiarioHistorialSupervisionForm extends CFormModel {

    public $fechagestion;
    public $horaInicioGestion;
    public $horaFinGestion;
    public $supervisor;
    public $precisionVisitas;
    public $enlaceMapa;
    public $ejecutivoSupervisar;
    public $rutaSupervisar;
    public $comentarioSupervision;
    public $accionHistorial;

    /**
     * Declares the validation rules.
     */
    public function rules() {
        return array(
            array('fechagestion,supervisor,ejecutivoSupervisar,rutaSupervisar,precisionVisitas,horaFinGestion,accionHistorial', 'required'),
            array('fechagestion,supervisor,ejecutivoSupervisar,rutaSupervisar,precisionVisitas,horaInicioGestion,horaFinGestion,enlaceMapa,comentarioSupervision,accionHistorial', 'safe'),
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
            'supervisor' => 'Supervisor de Ruta',
            'precisionVisitas' => 'Precision visita (metros)',
            'horaInicioGestion' => 'Seleccione la hora de inicio gestion',
            'horaFinGestion' => 'Seleccione la hora de fin gestion',
            'enlaceMapa' => 'Ingresar el enlace del mapa',
            'ejecutivoSupervisar' => 'Seleccione Ejecutivo',
            'rutaSupervisar' => 'Seleccione la ruta del Ejecutivo',
            'accionHistorial' => 'Seleccione la accion a evaluar'
        );
    }

}
