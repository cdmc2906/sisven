<?php

/**
 * This is the model class for table "tb_factura".
 *
 * The followings are the available columns in table 'tb_factura':
 * @property integer $ID_FACT
 * @property string $FECHAEMISION_FACT
 * @property integer $NUMEROFACTURA_FACT
 * @property string $SUBTOTAL_FACT
 * @property string $IVA_FACT
 * @property string $TOTAL_FACT
 * @property string $DESCUENTO_FACT
 * @property integer $NUMSERIE_FACT
 * @property string $FECHAINGRESO_FACT
 * @property string $FECHAMODIFICACION_FACT
 * @property integer $IDUSR_FACT
 *
 * The followings are the available model relations:
 * @property TbCompra[] $tbCompras
 */
class FacturaModel extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tb_factura';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('NUMEROFACTURA_FACT, NUMSERIE_FACT, IDUSR_FACT', 'numerical', 'integerOnly'=>true),
			array('SUBTOTAL_FACT, IVA_FACT, TOTAL_FACT, DESCUENTO_FACT', 'length', 'max'=>24),
			array('FECHAEMISION_FACT, FECHAINGRESO_FACT, FECHAMODIFICACION_FACT', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID_FACT, FECHAEMISION_FACT, NUMEROFACTURA_FACT, SUBTOTAL_FACT, IVA_FACT, TOTAL_FACT, DESCUENTO_FACT, NUMSERIE_FACT, FECHAINGRESO_FACT, FECHAMODIFICACION_FACT, IDUSR_FACT', 'safe', 'on'=>'search'),
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
			'tbCompras' => array(self::HAS_MANY, 'TbCompra', 'ID_FACT'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID_FACT' => 'Id Fact',
			'FECHAEMISION_FACT' => 'Fechaemision Fact',
			'NUMEROFACTURA_FACT' => 'Numerofactura Fact',
			'SUBTOTAL_FACT' => 'Subtotal Fact',
			'IVA_FACT' => 'Iva Fact',
			'TOTAL_FACT' => 'Total Fact',
			'DESCUENTO_FACT' => 'Descuento Fact',
			'NUMSERIE_FACT' => 'Numserie Fact',
			'FECHAINGRESO_FACT' => 'Fechaingreso Fact',
			'FECHAMODIFICACION_FACT' => 'Fechamodificacion Fact',
			'IDUSR_FACT' => 'Idusr Fact',
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

		$criteria->compare('ID_FACT',$this->ID_FACT);
		$criteria->compare('FECHAEMISION_FACT',$this->FECHAEMISION_FACT,true);
		$criteria->compare('NUMEROFACTURA_FACT',$this->NUMEROFACTURA_FACT);
		$criteria->compare('SUBTOTAL_FACT',$this->SUBTOTAL_FACT,true);
		$criteria->compare('IVA_FACT',$this->IVA_FACT,true);
		$criteria->compare('TOTAL_FACT',$this->TOTAL_FACT,true);
		$criteria->compare('DESCUENTO_FACT',$this->DESCUENTO_FACT,true);
		$criteria->compare('NUMSERIE_FACT',$this->NUMSERIE_FACT);
		$criteria->compare('FECHAINGRESO_FACT',$this->FECHAINGRESO_FACT,true);
		$criteria->compare('FECHAMODIFICACION_FACT',$this->FECHAMODIFICACION_FACT,true);
		$criteria->compare('IDUSR_FACT',$this->IDUSR_FACT);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return FacturaModel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
