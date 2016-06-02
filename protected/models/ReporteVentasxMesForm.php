<?php
/**
 * Description of ReporteTotalPlanForm
 * @fecha 2015/11/15
 * @author Christian Araujo
 */
class ReporteVentasxMesForm extends CFormModel {
    public $mes;
//    public $fechaConsumoFin;
//    public $rutaArchivo;

    /**
     * Declares the validation rules.
     */
    public function rules() {
        return array(
            array('mes', 'required'),
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
            'mes' => 'Mes consulta',
//            'fechaConsumoFin' => 'Fecha Consumo Fin',
        );
    }
}
