<?php

/**
 * 
 * @fecha 
 * @author
 */
class RevisionSecuenciaForm extends CFormModel {

    public $ejecutivo;
    public $fechagestion;
    public $horaInicioGestion;
    public $horaFinGestion;
    public $accionHistorial;
    public $precisionVisitas;
    public $comentarioSupervision;
    public $semanaRevision;
    public $campo0;
    public $campo1;
    public $campo2;
    public $campo3;
    public $campo4;
    public $campo5;
    public $campo6;
    public $campo7;
    public $campo8;
    public $pregunta1;
    public $pregunta2;

    /**
     * Declares the validation rules.
     */
    public function rules() {
        return array(
            array('ejecutivo'
                . ',fechagestion'
                . ',precisionVisitas'
                . ',horaFinGestion'
                . ',accionHistorial'
                . ',semanaRevision'
//                . ',pregunta1'
//                . ',pregunta2'
                , 'required'),
            array('ejecutivo
                ,fechagestion
                ,precisionVisitas
                ,horaInicioGestion
                ,horaFinGestion
                ,comentarioSupervision
                ,enlaceMapa
                ,accionHistorial
                ,semanaRevision
                ,pregunta1
                ,pregunta2', 'safe'),
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
            'semanaRevision' => 'Semana revision',

            'campo0' => 'Cliente',
            'campo1' => 'Secuencia Ruta',
            'campo2' => 'Secuencia Historial',
            'campo3' => 'Estado',
            'campo4' => 'Inicio gestion',
            'campo5' => 'Fin gestion',
            
            'campo6' => 'Tiempo gestion',
            'campo7' => 'Metros visita',
            
            'campo8' => 'Venta',
            
            'pregunta1' => 'Estado',
            'pregunta2' => 'Comentario',
        );
    }

}
