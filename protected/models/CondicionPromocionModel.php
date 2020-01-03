<?php

/**
 * This is the model class for table "tb_condicion_promocion".
 *
 * The followings are the available columns in table 'tb_condicion_promocion':
 * @property integer $cpr_id
 * @property integer $pr_id
 * @property string $cpr_parametro
 * @property string $cpr_operador
 * @property string $cpr_valor_min
 * @property string $cpr_valor_max
 * @property integer $cpr_estado
 * @property string $cpr_fecha_ingreso
 * @property string $cpr_fecha_modifica
 * @property integer $cpr_usr_ing_mod
 *
 * The followings are the available model relations:
 * @property TbPromocion $pr
 */
class CondicionPromocionModel extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tb_condicion_promocion';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pr_id, cpr_estado, cpr_usr_ing_mod', 'numerical', 'integerOnly'=>true),
			array('cpr_parametro, cpr_operador, cpr_valor_min, cpr_valor_max', 'length', 'max'=>50),
			array('cpr_fecha_ingreso, cpr_fecha_modifica', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('cpr_id, pr_id, cpr_parametro, cpr_operador, cpr_valor_min, cpr_valor_max, cpr_estado, cpr_fecha_ingreso, cpr_fecha_modifica, cpr_usr_ing_mod', 'safe', 'on'=>'search'),
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
			'pr' => array(self::BELONGS_TO, 'TbPromocion', 'pr_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'cpr_id' => 'Cpr',
			'pr_id' => 'Pr',
			'cpr_parametro' => 'Cpr Parametro',
			'cpr_operador' => 'Cpr Operador',
			'cpr_valor_min' => 'Cpr Valor Min',
			'cpr_valor_max' => 'Cpr Valor Max',
			'cpr_estado' => 'Cpr Estado',
			'cpr_fecha_ingreso' => 'Cpr Fecha Ingreso',
			'cpr_fecha_modifica' => 'Cpr Fecha Modifica',
			'cpr_usr_ing_mod' => 'Cpr Usr Ing Mod',
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

		$criteria->compare('cpr_id',$this->cpr_id);
		$criteria->compare('pr_id',$this->pr_id);
		$criteria->compare('cpr_parametro',$this->cpr_parametro,true);
		$criteria->compare('cpr_operador',$this->cpr_operador,true);
		$criteria->compare('cpr_valor_min',$this->cpr_valor_min,true);
		$criteria->compare('cpr_valor_max',$this->cpr_valor_max,true);
		$criteria->compare('cpr_estado',$this->cpr_estado);
		$criteria->compare('cpr_fecha_ingreso',$this->cpr_fecha_ingreso,true);
		$criteria->compare('cpr_fecha_modifica',$this->cpr_fecha_modifica,true);
		$criteria->compare('cpr_usr_ing_mod',$this->cpr_usr_ing_mod);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CondicionPromocionModel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
