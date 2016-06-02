<?php

/**
 * This is the model class for table "tb_rango_comision".
 *
 * The followings are the available columns in table 'tb_rango_comision':
 * @property integer $ID_RCOM
 * @property integer $RANGOMIN_RCOM
 * @property integer $RANGOMAX_RCOM
 * @property string $PORCENTAJE_RCOM
 * @property string $FECHAINGRESO_RCOM
 * @property string $FECHAMODIFICACION_RCOM
 * @property integer $IDUSR_RCOM
 *
 * The followings are the available model relations:
 * @property TbComision[] $tbComisions
 */
class RangoComisionModel extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tb_rango_comision';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('RANGOMIN_RCOM, RANGOMAX_RCOM, IDUSR_RCOM', 'numerical', 'integerOnly'=>true),
			array('PORCENTAJE_RCOM', 'length', 'max'=>4),
			array('FECHAINGRESO_RCOM, FECHAMODIFICACION_RCOM', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID_RCOM, RANGOMIN_RCOM, RANGOMAX_RCOM, PORCENTAJE_RCOM, FECHAINGRESO_RCOM, FECHAMODIFICACION_RCOM, IDUSR_RCOM', 'safe', 'on'=>'search'),
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
			'tbComisions' => array(self::HAS_MANY, 'TbComision', 'ID_RCOM'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID_RCOM' => 'Id Rcom',
			'RANGOMIN_RCOM' => 'Rangomin Rcom',
			'RANGOMAX_RCOM' => 'Rangomax Rcom',
			'PORCENTAJE_RCOM' => 'Porcentaje Rcom',
			'FECHAINGRESO_RCOM' => 'Fechaingreso Rcom',
			'FECHAMODIFICACION_RCOM' => 'Fechamodificacion Rcom',
			'IDUSR_RCOM' => 'Idusr Rcom',
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

		$criteria->compare('ID_RCOM',$this->ID_RCOM);
		$criteria->compare('RANGOMIN_RCOM',$this->RANGOMIN_RCOM);
		$criteria->compare('RANGOMAX_RCOM',$this->RANGOMAX_RCOM);
		$criteria->compare('PORCENTAJE_RCOM',$this->PORCENTAJE_RCOM,true);
		$criteria->compare('FECHAINGRESO_RCOM',$this->FECHAINGRESO_RCOM,true);
		$criteria->compare('FECHAMODIFICACION_RCOM',$this->FECHAMODIFICACION_RCOM,true);
		$criteria->compare('IDUSR_RCOM',$this->IDUSR_RCOM);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RangoComisionModel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
