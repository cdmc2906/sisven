<?php

/**
 * 
 * @fecha 
 * @author
 */
class RevisarMinesForm extends CFormModel {

    public $txtPrefijo;
    public $txtNumeroLlamar;
    public $pregunta1;
    public $pregunta1a;
    public $pregunta2;
    public $pregunta3;
    public $pregunta4;

    /**
     * Declares the validation rules.
     */
    public function rules() {
        return array(
            array('
                pregunta2,
                pregunta3,
                pregunta4,
                ', 'required'),
            array('
                txtPrefijo,
                txtNumeroLlamar,
                pregunta1,
                pregunta1a,
                pregunta2,
                pregunta3,
                pregunta4,
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
            'txtPrefijo' => 'Ingrese prefijo',
            'txtNumeroLlamar' => 'Numero llamar',
            'pregunta1' => 'Resultado llamada',
            'pregunta1a' => 'Motivo no contacto',
            'pregunta2' => 'Operadora min',
            'pregunta3' => 'Lugar de compra',
            'pregunta4' => 'Precio de compra',
        );
    }

}
