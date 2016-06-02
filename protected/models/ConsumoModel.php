<?php

/**
 * This is the model class for table "tb_consumo".
 *
 * The followings are the available columns in table 'tb_consumo':
 * @property integer $ID_CONS
 * @property integer $ID_PRO
 * @property string $PLAN_CONS
 * @property string $MIN_CONS
 * @property string $CONTRATO_CONS
 * @property string $CODIGOVENDEDOR_CONS
 * @property string $VENDEDOR_CONS
 * @property string $VALORPAGO_CONS
 * @property string $FECHACONSUMO_CONS
 * @property string $FECHAINGRESO_CONS
 * @property string $FECHAMODIFICACION_CONS
 * @property string $OBSERVACION_CONS
 * @property integer $IDUSR_CONS
 * @property integer $ID_MES
 *
 * The followings are the available model relations:
 * @property TbProducto $iDPRO
 * @property TbMes $iDMES
 */
class ConsumoModel extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tb_consumo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID_PRO, IDUSR_CONS, ID_MES', 'numerical', 'integerOnly'=>true),
			array('PLAN_CONS, CONTRATO_CONS, CODIGOVENDEDOR_CONS, VENDEDOR_CONS', 'length', 'max'=>250),
			array('MIN_CONS', 'length', 'max'=>50),
			array('VALORPAGO_CONS', 'length', 'max'=>24),
			array('OBSERVACION_CONS', 'length', 'max'=>500),
			array('FECHACONSUMO_CONS, FECHAINGRESO_CONS, FECHAMODIFICACION_CONS', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID_CONS, ID_PRO, PLAN_CONS, MIN_CONS, CONTRATO_CONS, CODIGOVENDEDOR_CONS, VENDEDOR_CONS, VALORPAGO_CONS, FECHACONSUMO_CONS, FECHAINGRESO_CONS, FECHAMODIFICACION_CONS, OBSERVACION_CONS, IDUSR_CONS, ID_MES', 'safe', 'on'=>'search'),
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
			'iDPRO' => array(self::BELONGS_TO, 'TbProducto', 'ID_PRO'),
			'iDMES' => array(self::BELONGS_TO, 'TbMes', 'ID_MES'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID_CONS' => 'Id Cons',
			'ID_PRO' => 'Id Pro',
			'PLAN_CONS' => 'Plan Cons',
			'MIN_CONS' => 'Min Cons',
			'CONTRATO_CONS' => 'Contrato Cons',
			'CODIGOVENDEDOR_CONS' => 'Codigovendedor Cons',
			'VENDEDOR_CONS' => 'Vendedor Cons',
			'VALORPAGO_CONS' => 'Valorpago Cons',
			'FECHACONSUMO_CONS' => 'Fechaconsumo Cons',
			'FECHAINGRESO_CONS' => 'Fechaingreso Cons',
			'FECHAMODIFICACION_CONS' => 'Fechamodificacion Cons',
			'OBSERVACION_CONS' => 'Observacion Cons',
			'IDUSR_CONS' => 'Idusr Cons',
			'ID_MES' => 'Id Mes',
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

		$criteria->compare('ID_CONS',$this->ID_CONS);
		$criteria->compare('ID_PRO',$this->ID_PRO);
		$criteria->compare('PLAN_CONS',$this->PLAN_CONS,true);
		$criteria->compare('MIN_CONS',$this->MIN_CONS,true);
		$criteria->compare('CONTRATO_CONS',$this->CONTRATO_CONS,true);
		$criteria->compare('CODIGOVENDEDOR_CONS',$this->CODIGOVENDEDOR_CONS,true);
		$criteria->compare('VENDEDOR_CONS',$this->VENDEDOR_CONS,true);
		$criteria->compare('VALORPAGO_CONS',$this->VALORPAGO_CONS,true);
		$criteria->compare('FECHACONSUMO_CONS',$this->FECHACONSUMO_CONS,true);
		$criteria->compare('FECHAINGRESO_CONS',$this->FECHAINGRESO_CONS,true);
		$criteria->compare('FECHAMODIFICACION_CONS',$this->FECHAMODIFICACION_CONS,true);
		$criteria->compare('OBSERVACION_CONS',$this->OBSERVACION_CONS,true);
		$criteria->compare('IDUSR_CONS',$this->IDUSR_CONS);
		$criteria->compare('ID_MES',$this->ID_MES);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ConsumoModel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
