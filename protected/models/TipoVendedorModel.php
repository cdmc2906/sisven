<?php

/**
 * This is the model class for table "tb_tipo_vendedor".
 *
 * The followings are the available columns in table 'tb_tipo_vendedor':
 * @property integer $ID_TVE
 * @property string $NOMBRE_TVE
 * @property string $FECHAINGRESO_TVE
 * @property string $FECHAMODIFICACION_TVE
 * @property integer $IDUSR_TVE
 * @property integer $ID_EST
 *
 * The followings are the available model relations:
 * @property TbEstado $iDEST
 * @property TbVendedor[] $tbVendedors
 */
class TipoVendedorModel extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tb_tipo_vendedor';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID_TVE, FECHAINGRESO_TVE', 'required'),
			array('ID_TVE, IDUSR_TVE, ID_EST', 'numerical', 'integerOnly'=>true),
			array('NOMBRE_TVE', 'length', 'max'=>250),
			array('FECHAMODIFICACION_TVE', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID_TVE, NOMBRE_TVE, FECHAINGRESO_TVE, FECHAMODIFICACION_TVE, IDUSR_TVE, ID_EST', 'safe', 'on'=>'search'),
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
			'iDEST' => array(self::BELONGS_TO, 'TbEstado', 'ID_EST'),
			'tbVendedors' => array(self::HAS_MANY, 'TbVendedor', 'ID_TVE'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID_TVE' => 'Id Tve',
			'NOMBRE_TVE' => 'Nombre Tve',
			'FECHAINGRESO_TVE' => 'Fechaingreso Tve',
			'FECHAMODIFICACION_TVE' => 'Fechamodificacion Tve',
			'IDUSR_TVE' => 'Idusr Tve',
			'ID_EST' => 'Id Est',
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

		$criteria->compare('ID_TVE',$this->ID_TVE);
		$criteria->compare('NOMBRE_TVE',$this->NOMBRE_TVE,true);
		$criteria->compare('FECHAINGRESO_TVE',$this->FECHAINGRESO_TVE,true);
		$criteria->compare('FECHAMODIFICACION_TVE',$this->FECHAMODIFICACION_TVE,true);
		$criteria->compare('IDUSR_TVE',$this->IDUSR_TVE);
		$criteria->compare('ID_EST',$this->ID_EST);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TipoVendedorModel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
