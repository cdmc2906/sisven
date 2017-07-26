<?php

/**
 * This is the model class for table "tb_historial_mb".
 *
 * The followings are the available columns in table 'tb_historial_mb':
 * @property integer $h_cod
 * @property integer $h_id
 * @property string $h_fecha
 * @property string $h_usuario
 * @property string $h_ruta
 * @property string $h_ruta_nombre
 * @property integer $h_semana
 * @property integer $h_dia
 * @property string $h_cod_cliente
 * @property string $h_nom_cliente
 * @property string $h_direccion
 * @property string $h_accion
 * @property string $h_cod_accion
 * @property string $h_cod_comentario
 * @property string $h_comentario
 * @property string $h_monto
 * @property string $h_latitud
 * @property string $h_longitud
 * @property integer $h_romper_secuencia
 * @property string $h_fch_ingreso
 * @property string $h_fch_modificacion
 * @property string $h_fch_desde
 * @property string $h_fch_hasta
 * @property integer $h_usr_ing_mod
 * @property string $h_usuario_nombre
 */
class HistorialMbModel extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tb_historial_mb';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('h_id, h_semana, h_dia, h_romper_secuencia, h_usr_ing_mod', 'numerical', 'integerOnly'=>true),
			array('h_usuario, h_ruta, h_ruta_nombre, h_cod_cliente, h_nom_cliente, h_direccion, h_accion, h_cod_accion, h_cod_comentario, h_comentario, h_monto, h_usuario_nombre', 'length', 'max'=>500),
			array('h_latitud, h_longitud', 'length', 'max'=>10),
			array('h_fecha, h_fch_ingreso, h_fch_modificacion, h_fch_desde, h_fch_hasta', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('h_cod, h_id, h_fecha, h_usuario, h_ruta, h_ruta_nombre, h_semana, h_dia, h_cod_cliente, h_nom_cliente, h_direccion, h_accion, h_cod_accion, h_cod_comentario, h_comentario, h_monto, h_latitud, h_longitud, h_romper_secuencia, h_fch_ingreso, h_fch_modificacion, h_fch_desde, h_fch_hasta, h_usr_ing_mod, h_usuario_nombre', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'h_cod' => 'Codigo',
			'h_id' => 'Id historial Mb',
			'h_fecha' => 'Fecha',
			'h_usuario' => 'Usuario',
			'h_ruta' => 'Ruta',
			'h_ruta_nombre' => 'Ruta Nombre',
			'h_semana' => 'Semana',
			'h_dia' => 'Dia',
			'h_cod_cliente' => 'Codigo Cliente',
			'h_nom_cliente' => 'Nombre Cliente',
			'h_direccion' => 'Direccion',
			'h_accion' => 'Accion',
			'h_cod_accion' => 'Codigo Accion',
			'h_cod_comentario' => 'Codigo Comentario',
			'h_comentario' => 'Comentario',
			'h_monto' => 'Monto',
			'h_latitud' => 'Latitud',
			'h_longitud' => 'Longitud',
			'h_romper_secuencia' => 'Romper Secuencia',
			'h_fch_ingreso' => 'Fecha Ingreso',
			'h_fch_modificacion' => 'Fecha Modificacion',
			'h_fch_desde' => 'Fch Desde',
			'h_fch_hasta' => 'H Fch Hasta',
			'h_usr_ing_mod' => 'H Usr Ing Mod',
			'h_usuario_nombre' => 'Nombre Usuario',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('h_cod',$this->h_cod);
		$criteria->compare('h_id',$this->h_id);
		$criteria->compare('h_fecha',$this->h_fecha,true);
		$criteria->compare('h_usuario',$this->h_usuario,true);
		$criteria->compare('h_ruta',$this->h_ruta,true);
		$criteria->compare('h_ruta_nombre',$this->h_ruta_nombre,true);
		$criteria->compare('h_semana',$this->h_semana);
		$criteria->compare('h_dia',$this->h_dia);
		$criteria->compare('h_cod_cliente',$this->h_cod_cliente,true);
		$criteria->compare('h_nom_cliente',$this->h_nom_cliente,true);
		$criteria->compare('h_direccion',$this->h_direccion,true);
		$criteria->compare('h_accion',$this->h_accion,true);
		$criteria->compare('h_cod_accion',$this->h_cod_accion,true);
		$criteria->compare('h_cod_comentario',$this->h_cod_comentario,true);
		$criteria->compare('h_comentario',$this->h_comentario,true);
		$criteria->compare('h_monto',$this->h_monto,true);
		$criteria->compare('h_latitud',$this->h_latitud,true);
		$criteria->compare('h_longitud',$this->h_longitud,true);
		$criteria->compare('h_romper_secuencia',$this->h_romper_secuencia);
		$criteria->compare('h_fch_ingreso',$this->h_fch_ingreso,true);
		$criteria->compare('h_fch_modificacion',$this->h_fch_modificacion,true);
		$criteria->compare('h_fch_desde',$this->h_fch_desde,true);
		$criteria->compare('h_fch_hasta',$this->h_fch_hasta,true);
		$criteria->compare('h_usr_ing_mod',$this->h_usr_ing_mod);
		$criteria->compare('h_usuario_nombre',$this->h_usuario_nombre,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return HistorialMbModel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
