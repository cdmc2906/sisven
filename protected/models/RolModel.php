<?php

/**
 * This is the model class for table "tb_rol".
 *
 * The followings are the available columns in table 'tb_rol':
 * @property integer $r_id
 * @property string $r_nombre_rol
 * @property integer $r_estado
 * @property string $r_fecha_ingreso
 * @property string $r_fecha_modifica
 * @property integer $r_cod_usuario_ing_mod
 *
 * The followings are the available model relations:
 * @property TbUsuarioRol[] $tbUsuarioRols
 */
class RolModel extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tb_rol';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('r_estado, r_cod_usuario_ing_mod', 'numerical', 'integerOnly'=>true),
			array('r_nombre_rol', 'length', 'max'=>1024),
			array('r_fecha_ingreso, r_fecha_modifica', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('r_id, r_nombre_rol, r_estado, r_fecha_ingreso, r_fecha_modifica, r_cod_usuario_ing_mod', 'safe', 'on'=>'search'),
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
			'tbUsuarioRols' => array(self::HAS_MANY, 'TbUsuarioRol', 'r_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'r_id' => 'R',
			'r_nombre_rol' => 'R Nombre Rol',
			'r_estado' => 'R Estado',
			'r_fecha_ingreso' => 'R Fecha Ingreso',
			'r_fecha_modifica' => 'R Fecha Modifica',
			'r_cod_usuario_ing_mod' => 'R Cod Usuario Ing Mod',
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

		$criteria->compare('r_id',$this->r_id);
		$criteria->compare('r_nombre_rol',$this->r_nombre_rol,true);
		$criteria->compare('r_estado',$this->r_estado);
		$criteria->compare('r_fecha_ingreso',$this->r_fecha_ingreso,true);
		$criteria->compare('r_fecha_modifica',$this->r_fecha_modifica,true);
		$criteria->compare('r_cod_usuario_ing_mod',$this->r_cod_usuario_ing_mod);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RolModel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
