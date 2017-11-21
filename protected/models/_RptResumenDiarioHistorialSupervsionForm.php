<?php

/**
 * 
 * @fecha 
 * @author
 */
class RptResumenDiarioHistorialSupervisionForm extends CFormModel {

//    public $anio;
//    public $mes;
    public $fechagestion;
    public $horaInicioGestion;
    public $horaFinGestion;
    public $ejecutivo;
    public $precisionVisitas;
//    public $comentarioSupervision;
    public $enlaceMapa;
    public $rutaSupervisar;

    /**
     * Declares the validation rules.
     */
    public function rules() {
        return array(
            array('fechagestion, ejecutivo,precisionVisitas,horaFinGestion', 'required'),
            array('fechagestion,ejecutivo,precisionVisitas,horaInicioGestion,horaFinGestion,enlaceMapa,rutaSupervisar', 'safe'),
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
            'precisionVisitas' => 'Precision visita (metros)',
            'horaInicioGestion' => 'Seleccione la hora de inicio gestion',
            'horaFinGestion' => 'Seleccione la hora de fin gestion',
//            'comentarioSupervision' => 'Ingresar el comentario de supervision',
            'enlaceMapa' => 'Ingresar el enlace del mapa',
            'rutaSupervisar' => 'Seleccione la ruta a supervisar'
        );
    }

}
