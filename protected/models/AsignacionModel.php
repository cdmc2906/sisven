<?php

/**
 * This is the model class for table "tb_asignacion".
 *
 * The followings are the available columns in table 'tb_asignacion':
 * @property integer $ID_ASIG
 * @property integer $ID_PRO
 * @property integer $ID_VEND
 * @property string $FECHAINGRESO_ASIG
 * @property integer $IDUSR_ASIF
 *
 * The followings are the available model relations:
 * @property TbVendedor $iDVEND
 * @property TbProducto $iDPRO
 */
class AsignacionModel extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tb_asignacion';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID_PRO, ID_VEND, IDUSR_ASIF', 'numerical', 'integerOnly'=>true),
			array('FECHAINGRESO_ASIG', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID_ASIG, ID_PRO, ID_VEND, FECHAINGRESO_ASIG, IDUSR_ASIF', 'safe', 'on'=>'search'),
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
			'iDVEND' => array(self::BELONGS_TO, 'TbVendedor', 'ID_VEND'),
			'iDPRO' => array(self::BELONGS_TO, 'TbProducto', 'ID_PRO'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID_ASIG' => 'Id Asig',
			'ID_PRO' => 'Id Pro',
			'ID_VEND' => 'Id Vend',
			'FECHAINGRESO_ASIG' => 'Fechaingreso Asig',
			'IDUSR_ASIF' => 'Idusr Asif',
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

		$criteria->compare('ID_ASIG',$this->ID_ASIG);
		$criteria->compare('ID_PRO',$this->ID_PRO);
		$criteria->compare('ID_VEND',$this->ID_VEND);
		$criteria->compare('FECHAINGRESO_ASIG',$this->FECHAINGRESO_ASIG,true);
		$criteria->compare('IDUSR_ASIF',$this->IDUSR_ASIF);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AsignacionModel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
