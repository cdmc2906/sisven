<?php

/**
 * Description of ReporteTotalPlanForm
 * @fecha 2015/11/15
 * @author Christian Araujo
 */
class RptResultadosRevisionMinesForm extends CFormModel {

    public $pregunta1;
    public $pregunta1a;
    public $pregunta2;
    public $pregunta3;
    public $pregunta4;
    public $pregunta5;
    public $pregunta6;
    public $pregunta7;

    /**
     * Declares the validation rules.
     */
    public function rules() {
        return array(
//            array('
//                pregunta1,
//                pregunta2,
//                pregunta3,
//                pregunta4,
//                ', 'required'),
            array('
                pregunta1,
                pregunta1a,
                pregunta2,
                pregunta3,
                pregunta4,
                pregunta5,
                pregunta6,
                pregunta7
                ', 'safe'),
        );
    }

    /**
     * Declares customized attribute labels.
     * If not declared here, an attribute would have a label that is
     * the same as its name with the first letter in upper case.
     */
    public function attributeLabels() {
        return array(
            'pregunta1' => 'Resultado de la llamada:',
            'pregunta1a' => 'Motivo de no contacto:',
            'pregunta2' => 'Con quien se contacta:',
            'pregunta3' => 'Confirmar visita vendedor:',
            'pregunta4' => 'Compro chips ultima visita:',
            'pregunta5' => 'Verificar Telefonos:',
            'pregunta6' => 'Razon no compra chips:',
            'pregunta7' => 'Observaciones:',
        );
    }

}
