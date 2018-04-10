<?php

/**
 * This is the model class for table "tb_historial_cliente_ruta".
 *
 * The followings are the available columns in table 'tb_historial_cliente_ruta':
 * @property integer $hcr_id
 * @property string $hcr_ruta_anterior
 * @property string $hcr_ruta_nueva
 * @property string $hcr_direccion_anterior
 * @property string $hcr_direccion_nueva
 * @property integer $hcr_semana_anterior
 * @property integer $hcr_semana_nueva
 * @property integer $hcr_dia_anterior
 * @property integer $hcr_dia_nuevo
 * @property integer $hcr_secuencia_anterior
 * @property integer $hcr_secuencia_nueva
 * @property integer $hcr_estado_anterior
 * @property integer $hcr_estado_nuevo
 * @property string $hcr_fch_actualiza_ruta
 * @property string $hcr_cambios
 * @property string $hcr_fch_ingreso
 * @property string $hcr_fch_modificacion
 * @property integer $hcr_cod_usuario_ing_mod
 */
class HistorialClienteRutaModel extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tb_historial_cliente_ruta';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('hcr_semana_anterior, hcr_semana_nueva, hcr_dia_anterior, hcr_dia_nuevo, hcr_secuencia_anterior, hcr_secuencia_nueva, hcr_estado_anterior, hcr_estado_nuevo, hcr_cod_usuario_ing_mod', 'numerical', 'integerOnly'=>true),
			array('hcr_ruta_anterior, hcr_ruta_nueva, hcr_direccion_anterior, hcr_direccion_nueva', 'length', 'max'=>150),
			array('hcr_cambios', 'length', 'max'=>500),
			array('hcr_fch_actualiza_ruta, hcr_fch_ingreso, hcr_fch_modificacion', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('hcr_id, hcr_ruta_anterior, hcr_ruta_nueva, hcr_direccion_anterior, hcr_direccion_nueva, hcr_semana_anterior, hcr_semana_nueva, hcr_dia_anterior, hcr_dia_nuevo, hcr_secuencia_anterior, hcr_secuencia_nueva, hcr_estado_anterior, hcr_estado_nuevo, hcr_fch_actualiza_ruta, hcr_cambios, hcr_fch_ingreso, hcr_fch_modificacion, hcr_cod_usuario_ing_mod', 'safe', 'on'=>'search'),
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
			'hcr_id' => 'Hcr',
			'hcr_ruta_anterior' => 'Hcr Ruta Anterior',
			'hcr_ruta_nueva' => 'Hcr Ruta Nueva',
			'hcr_direccion_anterior' => 'Hcr Direccion Anterior',
			'hcr_direccion_nueva' => 'Hcr Direccion Nueva',
			'hcr_semana_anterior' => 'Hcr Semana Anterior',
			'hcr_semana_nueva' => 'Hcr Semana Nueva',
			'hcr_dia_anterior' => 'Hcr Dia Anterior',
			'hcr_dia_nuevo' => 'Hcr Dia Nuevo',
			'hcr_secuencia_anterior' => 'Hcr Secuencia Anterior',
			'hcr_secuencia_nueva' => 'Hcr Secuencia Nueva',
			'hcr_estado_anterior' => 'Hcr Estado Anterior',
			'hcr_estado_nuevo' => 'Hcr Estado Nuevo',
			'hcr_fch_actualiza_ruta' => 'Hcr Fch Actualiza Ruta',
			'hcr_cambios' => 'Hcr Cambios',
			'hcr_fch_ingreso' => 'Hcr Fch Ingreso',
			'hcr_fch_modificacion' => 'Hcr Fch Modificacion',
			'hcr_cod_usuario_ing_mod' => 'Hcr Cod Usuario Ing Mod',
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

		$criteria->compare('hcr_id',$this->hcr_id);
		$criteria->compare('hcr_ruta_anterior',$this->hcr_ruta_anterior,true);
		$criteria->compare('hcr_ruta_nueva',$this->hcr_ruta_nueva,true);
		$criteria->compare('hcr_direccion_anterior',$this->hcr_direccion_anterior,true);
		$criteria->compare('hcr_direccion_nueva',$this->hcr_direccion_nueva,true);
		$criteria->compare('hcr_semana_anterior',$this->hcr_semana_anterior);
		$criteria->compare('hcr_semana_nueva',$this->hcr_semana_nueva);
		$criteria->compare('hcr_dia_anterior',$this->hcr_dia_anterior);
		$criteria->compare('hcr_dia_nuevo',$this->hcr_dia_nuevo);
		$criteria->compare('hcr_secuencia_anterior',$this->hcr_secuencia_anterior);
		$criteria->compare('hcr_secuencia_nueva',$this->hcr_secuencia_nueva);
		$criteria->compare('hcr_estado_anterior',$this->hcr_estado_anterior);
		$criteria->compare('hcr_estado_nuevo',$this->hcr_estado_nuevo);
		$criteria->compare('hcr_fch_actualiza_ruta',$this->hcr_fch_actualiza_ruta,true);
		$criteria->compare('hcr_cambios',$this->hcr_cambios,true);
		$criteria->compare('hcr_fch_ingreso',$this->hcr_fch_ingreso,true);
		$criteria->compare('hcr_fch_modificacion',$this->hcr_fch_modificacion,true);
		$criteria->compare('hcr_cod_usuario_ing_mod',$this->hcr_cod_usuario_ing_mod);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return HistorialClienteRutaModel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
