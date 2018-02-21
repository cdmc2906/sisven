<?php

/**
 * Description of ReporteTotalPlanForm
 * @fecha 2015/11/15
 * @author Christian Araujo
 */
class RptResultadosRevisionMinesForm extends CFormModel {

    public $agenteReasignar;

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
                agenteReasignar,
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
            'agente Reasignar' => 'Agente Reasignar:',
        );
    }

}
