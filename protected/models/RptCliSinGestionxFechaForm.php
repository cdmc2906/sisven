<?php

/**
 * 
 * @fecha 
 * @author
 */
class RptCliSinGestionxFechaForm extends CFormModel {

    public $tipoUsuario;
    public $usuario;
    public $tipoFecha;
    public $anio;
    public $mes;
    public $periodo;
    public $fechaInicioAnalisis;
    public $fechaFinAnalisis;
    public $tipoEjecutivoAcum;
    public $ejecutivoAcum;
    public $anioInicioAcum;
    public $anioFinAcum;
    public $mesInicioAcum;
    public $mesFinAcum;

    public function rules() {
        return array(
//            array('tipoUsuario,tipoFecha,tipoEjecutivoAcum,anioInicioAcum,anioFinAcum', 'required'),
            array('
                tipoUsuario
                ,usuario
                ,tipoFecha
                ,anio
                ,mes
                ,periodo
                ,fechaInicioAnalisis
                ,fechaFinAnalisis
                ,anioInicioAcum
                ,anioFinAcum
                ,mesInicioAcum
                ,mesFinAcum
                ,tipoEjecutivoAcum
                ,ejecutivoAcum
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
            'tipoUsuario' => 'Tipo Usuario',
            'usuario' => 'Usuario',
            'tipoFecha' => 'Tipo fecha',
            'periodo' => 'Periodo',
            'anio' => 'Anio',
            'mes' => 'Mes',
            'fechaInicioAnalisis' => 'Fecha Inicio',
            'anioInicioAcum' => 'Anio Inicio',
            'anioFinAcum' => 'Anio Fin',
            'mesInicioAcum' => 'Mes Inicio',
            'mesFinAcum' => 'Mes Fin',
            'tipoEjecutivoAcum' => 'Tipo Ejecutivo',
            'ejecutivoAcum' => 'Ejecutivo',
        );
    }

}
