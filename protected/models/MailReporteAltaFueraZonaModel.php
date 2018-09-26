<?php

/**
  CrugeLogon

  Modelo para el formulario de Login y Password Recovery

  funciona bajo dos escenarios: 'login' y 'pwdrec'


  CrugeLogon es un modelo (CFormModel) para el formulario de Login y Password Recovery
  que aparte de validar que los datos de ambos fomularios esten correctos tambien
  ayuda al proceso de llamar a Yii::app()->user->login mediante un metodo llamado login().

  basicamente es como el modelo LoginForm que trae Yii por defecto.


  @author: Christian Salazar H. <christiansalazarh@gmail.com> @salazarchris74
  @license protected/modules/cruge/LICENSE
 */
class MailReporteAltaFueraZonaModel extends CFormModel {

    public $fechaGeneracion;
    public $ejecutivo;
    public $emailTo;
    public $periodo;
    public $cantidadAltas;
    public $cantidadCiudades;
    public $archivoAdjunto;
    private $_model;

//    private $_identity;

    public function getModel() {
        return $this->_model;
    }

    public function rules() {
        return array(
        );
    }

    public function attributeLabels() {
        // la etiqueta $label cambiara depende de como este configuado el sistema
        //
        return array(
            'fechaGeneracion' => 'Fecha Generacion',
            'ejecutivo' => 'Ejecutivo',
            'periodo' => 'Periodo',
        );
    }

}
