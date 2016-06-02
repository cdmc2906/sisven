<?php

/**
 * This is the model class for table "tb_mes".
 *
 * The followings are the available columns in table 'tb_mes':
 * @property integer $ID_MES
 * @property string $NOMBRE_MES
 * @property string $FECHAINGRESO_MES
 * @property string $FECHAMODIFICACION_MES
 * @property string $IDUSR_MES
 * @property string $ABREVIACION_MES
 *
 * The followings are the available model relations:
 * @property TbConsumo[] $tbConsumos
 */
class MesModel extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tb_mes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('FECHAINGRESO_MES', 'required'),
			array('NOMBRE_MES', 'length', 'max'=>50),
			array('ABREVIACION_MES', 'length', 'max'=>5),
			array('FECHAMODIFICACION_MES, IDUSR_MES', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID_MES, NOMBRE_MES, FECHAINGRESO_MES, FECHAMODIFICACION_MES, IDUSR_MES, ABREVIACION_MES', 'safe', 'on'=>'search'),
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
			'tbConsumos' => array(self::HAS_MANY, 'TbConsumo', 'ID_MES'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID_MES' => 'Id Mes',
			'NOMBRE_MES' => 'Nombre Mes',
			'FECHAINGRESO_MES' => 'Fechaingreso Mes',
			'FECHAMODIFICACION_MES' => 'Fechamodificacion Mes',
			'IDUSR_MES' => 'Idusr Mes',
			'ABREVIACION_MES' => 'Abreviacion Mes',
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

		$criteria->compare('ID_MES',$this->ID_MES);
		$criteria->compare('NOMBRE_MES',$this->NOMBRE_MES,true);
		$criteria->compare('FECHAINGRESO_MES',$this->FECHAINGRESO_MES,true);
		$criteria->compare('FECHAMODIFICACION_MES',$this->FECHAMODIFICACION_MES,true);
		$criteria->compare('IDUSR_MES',$this->IDUSR_MES,true);
		$criteria->compare('ABREVIACION_MES',$this->ABREVIACION_MES,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MesModel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
