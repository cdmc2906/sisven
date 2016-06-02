<?php

/**
 * This is the model class for table "tb_estado".
 *
 * The followings are the available columns in table 'tb_estado':
 * @property integer $ID_EST
 * @property string $NOMBRE_EST
 * @property string $FECHAINGRESO_EST
 * @property string $FECHAMODIFICACION_EST
 *
 * The followings are the available model relations:
 * @property TbBodega[] $tbBodegas
 * @property TbCliente[] $tbClientes
 * @property TbProducto[] $tbProductos
 * @property TbSucursal[] $tbSucursals
 * @property TbTipoCliente[] $tbTipoClientes
 * @property TbTipoProducto[] $tbTipoProductos
 * @property TbVendedor[] $tbVendedors
 */
class EstadoModel extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tb_estado';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('NOMBRE_EST', 'length', 'max'=>50),
			array('FECHAINGRESO_EST, FECHAMODIFICACION_EST', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID_EST, NOMBRE_EST, FECHAINGRESO_EST, FECHAMODIFICACION_EST', 'safe', 'on'=>'search'),
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
			'tbBodegas' => array(self::HAS_MANY, 'TbBodega', 'ID_EST'),
			'tbClientes' => array(self::HAS_MANY, 'TbCliente', 'ID_EST'),
			'tbProductos' => array(self::HAS_MANY, 'TbProducto', 'ID_EST'),
			'tbSucursals' => array(self::HAS_MANY, 'TbSucursal', 'ID_EST'),
			'tbTipoClientes' => array(self::HAS_MANY, 'TbTipoCliente', 'ID_EST'),
			'tbTipoProductos' => array(self::HAS_MANY, 'TbTipoProducto', 'ID_EST'),
			'tbVendedors' => array(self::HAS_MANY, 'TbVendedor', 'ID_EST'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID_EST' => 'Id Est',
			'NOMBRE_EST' => 'Nombre Est',
			'FECHAINGRESO_EST' => 'Fechaingreso Est',
			'FECHAMODIFICACION_EST' => 'Fechamodificacion Est',
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

		$criteria->compare('ID_EST',$this->ID_EST);
		$criteria->compare('NOMBRE_EST',$this->NOMBRE_EST,true);
		$criteria->compare('FECHAINGRESO_EST',$this->FECHAINGRESO_EST,true);
		$criteria->compare('FECHAMODIFICACION_EST',$this->FECHAMODIFICACION_EST,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EstadoModel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
