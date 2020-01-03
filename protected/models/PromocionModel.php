<?php

/**
 * This is the model class for table "tb_promocion".
 *
 * The followings are the available columns in table 'tb_promocion':
 * @property integer $pr_id
 * @property string $pr_nombre
 * @property string $pr_fecha_inicio
 * @property string $pr_fecha_fin
 * @property integer $pr_estado
 * @property string $pr_ingreso
 * @property string $pr_modificacion
 * @property integer $pr_id_usr_ing_mod
 *
 * The followings are the available model relations:
 * @property TbCondicionPromocion[] $tbCondicionPromocions
 */
class PromocionModel extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tb_promocion';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pr_estado, pr_id_usr_ing_mod', 'numerical', 'integerOnly'=>true),
			array('pr_nombre', 'length', 'max'=>500),
			array('pr_fecha_inicio, pr_fecha_fin, pr_ingreso, pr_modificacion', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('pr_id, pr_nombre, pr_fecha_inicio, pr_fecha_fin, pr_estado, pr_ingreso, pr_modificacion, pr_id_usr_ing_mod', 'safe', 'on'=>'search'),
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
			'tbCondicionPromocions' => array(self::HAS_MANY, 'TbCondicionPromocion', 'pr_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'pr_id' => 'Pr',
			'pr_nombre' => 'Pr Nombre',
			'pr_fecha_inicio' => 'Pr Fecha Inicio',
			'pr_fecha_fin' => 'Pr Fecha Fin',
			'pr_estado' => 'Pr Estado',
			'pr_ingreso' => 'Pr Ingreso',
			'pr_modificacion' => 'Pr Modificacion',
			'pr_id_usr_ing_mod' => 'Pr Id Usr Ing Mod',
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

		$criteria->compare('pr_id',$this->pr_id);
		$criteria->compare('pr_nombre',$this->pr_nombre,true);
		$criteria->compare('pr_fecha_inicio',$this->pr_fecha_inicio,true);
		$criteria->compare('pr_fecha_fin',$this->pr_fecha_fin,true);
		$criteria->compare('pr_estado',$this->pr_estado);
		$criteria->compare('pr_ingreso',$this->pr_ingreso,true);
		$criteria->compare('pr_modificacion',$this->pr_modificacion,true);
		$criteria->compare('pr_id_usr_ing_mod',$this->pr_id_usr_ing_mod);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PromocionModel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
