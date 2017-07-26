<?php

/**
 * This is the model class for table "tb_rango_cumplimiento".
 *
 * The followings are the available columns in table 'tb_rango_cumplimiento':
 * @property integer $c_cod
 * @property string $c_rango_min
 * @property string $c_rango_max
 * @property string $c_nombre_rango
 * @property integer $c_estado_rango
 * @property string $c_fecha_ingreso
 * @property string $c_fecha_modificacion
 * @property integer $c_codigo_usuario_ingresa
 * @property integer $c_codigo_usuario_modifica
 */
class RangoCumplimientoModel extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tb_rango_cumplimiento';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('c_estado_rango, c_codigo_usuario_ingresa, c_codigo_usuario_modifica', 'numerical', 'integerOnly'=>true),
			array('c_rango_min, c_rango_max', 'length', 'max'=>4),
			array('c_nombre_rango', 'length', 'max'=>500),
			array('c_fecha_ingreso, c_fecha_modificacion', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('c_cod, c_rango_min, c_rango_max, c_nombre_rango, c_estado_rango, c_fecha_ingreso, c_fecha_modificacion, c_codigo_usuario_ingresa, c_codigo_usuario_modifica', 'safe', 'on'=>'search'),
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
			'c_cod' => 'C Cod',
			'c_rango_min' => 'C Rango Min',
			'c_rango_max' => 'C Rango Max',
			'c_nombre_rango' => 'C Nombre Rango',
			'c_estado_rango' => 'C Estado Rango',
			'c_fecha_ingreso' => 'C Fecha Ingreso',
			'c_fecha_modificacion' => 'C Fecha Modificacion',
			'c_codigo_usuario_ingresa' => 'C Codigo Usuario Ingresa',
			'c_codigo_usuario_modifica' => 'C Codigo Usuario Modifica',
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

		$criteria->compare('c_cod',$this->c_cod);
		$criteria->compare('c_rango_min',$this->c_rango_min,true);
		$criteria->compare('c_rango_max',$this->c_rango_max,true);
		$criteria->compare('c_nombre_rango',$this->c_nombre_rango,true);
		$criteria->compare('c_estado_rango',$this->c_estado_rango);
		$criteria->compare('c_fecha_ingreso',$this->c_fecha_ingreso,true);
		$criteria->compare('c_fecha_modificacion',$this->c_fecha_modificacion,true);
		$criteria->compare('c_codigo_usuario_ingresa',$this->c_codigo_usuario_ingresa);
		$criteria->compare('c_codigo_usuario_modifica',$this->c_codigo_usuario_modifica);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RangoCumplimientoModel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
