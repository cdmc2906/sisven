<?php

/**
 * 
 * @fecha 
 * @author
 */
class ValidacionChipForm extends CFormModel {

    public $tipoValidacion;
    public $operadora;
    public $min;
    public $icc;
    public $codigoLocal;
    public $reportadoPor;
    public $ejecutivoReporta;
    public $reportadoVia;
//    public $fechaActivaCliente;
    public $promocion;

    /**
     * Declares the validation rules.
     */
    public function rules() {
        return array(
            array('
                tipoValidacion,
                operadora,
                codigoLocal,
                reportadoPor,
                reportadoVia,
                ', 'required'),
            array('
               tipoValidacion,
               operadora,
                min,
                icc,
                codigoLocal,
                reportadoPor,
                ejecutivoReporta,
                reportadoVia,
                promocion,
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
            'tipoValidacion' => 'Tipo validacion',
            'operadora' => 'Operadora',
            'min' => 'Ingrese min validar-aaaa/mm/dd',
            'icc' => 'Ingrese icc validar',
            'codigoLocal' => 'Codigo del local',
            'reportadoPor' => 'Reportado por',
            'ejecutivoReporta' => 'Ejecutivo',
            'reportadoVia' => 'Reportado via',
//            'fechaActivaCliente' => 'Fecha activacion',
            'promocion' => 'Promocion',
        );
    }

}
