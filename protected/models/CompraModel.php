<?php

/**
 * This is the model class for table "tb_compra".
 *
 * The followings are the available columns in table 'tb_compra':
 * @property integer $ID_COMP
 * @property integer $ID_FACT
 * @property string $FECHACOMPRA_COM
 * @property integer $IDUSR_COMP
 *
 * The followings are the available model relations:
 * @property TbFactura $iDFACT
 * @property TbProducto[] $tbProductos
 */
class CompraModel extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tb_compra';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID_FACT, IDUSR_COMP', 'numerical', 'integerOnly'=>true),
			array('FECHACOMPRA_COM', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID_COMP, ID_FACT, FECHACOMPRA_COM, IDUSR_COMP', 'safe', 'on'=>'search'),
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
			'iDFACT' => array(self::BELONGS_TO, 'TbFactura', 'ID_FACT'),
			'tbProductos' => array(self::HAS_MANY, 'TbProducto', 'ID_COMP'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID_COMP' => 'Id Comp',
			'ID_FACT' => 'Id Fact',
			'FECHACOMPRA_COM' => 'Fechacompra Com',
			'IDUSR_COMP' => 'Idusr Comp',
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

		$criteria->compare('ID_COMP',$this->ID_COMP);
		$criteria->compare('ID_FACT',$this->ID_FACT);
		$criteria->compare('FECHACOMPRA_COM',$this->FECHACOMPRA_COM,true);
		$criteria->compare('IDUSR_COMP',$this->IDUSR_COMP);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CompraModel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
