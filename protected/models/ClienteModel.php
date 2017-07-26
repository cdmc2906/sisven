<?php

/**
 * This is the model class for table "tb_cliente".
 *
 * The followings are the available columns in table 'tb_cliente':
 * @property integer $cli_codigo
 * @property string $cli_codigo_cliente
 * @property string $cli_nombre_cliente
 * @property string $cli_latitud
 * @property string $cli_longitud
 * @property integer $cli_estado
 * @property string $cli_fecha_ingreso
 * @property string $cli_fecha_modificacion
 * @property integer $cli_usuario_ingresa_modifica
 */
class ClienteModel extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tb_cliente';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cli_estado, cli_usuario_ingresa_modifica', 'numerical', 'integerOnly'=>true),
			array('cli_codigo_cliente', 'length', 'max'=>50),
			array('cli_nombre_cliente, cli_latitud, cli_longitud', 'length', 'max'=>250),
			array('cli_fecha_ingreso, cli_fecha_modificacion', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('cli_codigo, cli_codigo_cliente, cli_nombre_cliente, cli_latitud, cli_longitud, cli_estado, cli_fecha_ingreso, cli_fecha_modificacion, cli_usuario_ingresa_modifica', 'safe', 'on'=>'search'),
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
			'cli_codigo' => 'Cli Codigo',
			'cli_codigo_cliente' => 'Cli Codigo Cliente',
			'cli_nombre_cliente' => 'Cli Nombre Cliente',
			'cli_latitud' => 'Cli Latitud',
			'cli_longitud' => 'Cli Longitud',
			'cli_estado' => 'Cli Estado',
			'cli_fecha_ingreso' => 'Cli Fecha Ingreso',
			'cli_fecha_modificacion' => 'Cli Fecha Modificacion',
			'cli_usuario_ingresa_modifica' => 'Cli Usuario Ingresa Modifica',
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

		$criteria->compare('cli_codigo',$this->cli_codigo);
		$criteria->compare('cli_codigo_cliente',$this->cli_codigo_cliente,true);
		$criteria->compare('cli_nombre_cliente',$this->cli_nombre_cliente,true);
		$criteria->compare('cli_latitud',$this->cli_latitud,true);
		$criteria->compare('cli_longitud',$this->cli_longitud,true);
		$criteria->compare('cli_estado',$this->cli_estado);
		$criteria->compare('cli_fecha_ingreso',$this->cli_fecha_ingreso,true);
		$criteria->compare('cli_fecha_modificacion',$this->cli_fecha_modificacion,true);
		$criteria->compare('cli_usuario_ingresa_modifica',$this->cli_usuario_ingresa_modifica);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ClienteModel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
