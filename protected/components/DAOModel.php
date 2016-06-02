<?php

/**
 * Description of BaseModel
 * Implementa conexi�n a la base de datos
 * @fecha 2014/05/08
 * @author Jorge - Innovasoft
 */
class DAOModel extends CModel {

    public $connection;

    public function __construct() {
        $this->init();
    }

    public function init() {

        try {
            $this->connection = Yii::app()->db_conn;
            $this->connection->active = true;
        } catch (Exception $e) {

            $mensaje = array(
                'code' => $e->getCode(),
                'error' => Yii::app()->params['leyendaErrorConeccionBDD'] . $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            );

            throw new CDbException($mensaje['error'] . " Archivo: " . $mensaje['file'] . " Linea: " . $mensaje['line'], $mensaje['code'], null);
        }
    }

    public function Close() {
        $this->connection->active = false;
    }

    public function attributeNames() {
        
    }
}
