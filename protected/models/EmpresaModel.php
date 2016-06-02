<?php

/**
 * This is the model class for table "tb_empresa".
 *
 * The followings are the available columns in table 'tb_empresa':
 * @property integer $ID_EMP
 * @property string $NOMBRE_EMP
 * @property integer $IDUSR_EMP
 * @property string $FECHAINGRESO_EMP
 * @property string $FECHAMODIFICACION_EMP
 *
 * The followings are the available model relations:
 * @property TbSucursal[] $tbSucursals
 */
class EmpresaModel extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tb_empresa';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('IDUSR_EMP', 'numerical', 'integerOnly'=>true),
			array('NOMBRE_EMP', 'length', 'max'=>50),
			array('FECHAINGRESO_EMP, FECHAMODIFICACION_EMP', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID_EMP, NOMBRE_EMP, IDUSR_EMP, FECHAINGRESO_EMP, FECHAMODIFICACION_EMP', 'safe', 'on'=>'search'),
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
			'tbSucursals' => array(self::HAS_MANY, 'TbSucursal', 'ID_EMP'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID_EMP' => 'Id Emp',
			'NOMBRE_EMP' => 'Nombre Emp',
			'IDUSR_EMP' => 'Idusr Emp',
			'FECHAINGRESO_EMP' => 'Fechaingreso Emp',
			'FECHAMODIFICACION_EMP' => 'Fechamodificacion Emp',
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

		$criteria->compare('ID_EMP',$this->ID_EMP);
		$criteria->compare('NOMBRE_EMP',$this->NOMBRE_EMP,true);
		$criteria->compare('IDUSR_EMP',$this->IDUSR_EMP);
		$criteria->compare('FECHAINGRESO_EMP',$this->FECHAINGRESO_EMP,true);
		$criteria->compare('FECHAMODIFICACION_EMP',$this->FECHAMODIFICACION_EMP,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EmpresaModel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
