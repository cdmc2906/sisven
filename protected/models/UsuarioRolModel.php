<?php

/**
 * This is the model class for table "tb_usuario_rol".
 *
 * The followings are the available columns in table 'tb_usuario_rol':
 * @property integer $usrl_id
 * @property integer $iduser
 * @property integer $r_id
 * @property integer $usrl_estado
 * @property string $usrl_fecha_ingreso
 * @property string $usrl_fecha_modifica
 * @property integer $usrl_cod_usuario_ing_mod
 * @property string $usrl_nombre_usuario
 *
 * The followings are the available model relations:
 * @property CrugeUser $iduser0
 * @property TbRol $r
 */
class UsuarioRolModel extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tb_usuario_rol';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('iduser, r_id, usrl_estado, usrl_cod_usuario_ing_mod', 'numerical', 'integerOnly'=>true),
			array('usrl_nombre_usuario', 'length', 'max'=>250),
			array('usrl_fecha_ingreso, usrl_fecha_modifica', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('usrl_id, iduser, r_id, usrl_estado, usrl_fecha_ingreso, usrl_fecha_modifica, usrl_cod_usuario_ing_mod, usrl_nombre_usuario', 'safe', 'on'=>'search'),
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
			'iduser0' => array(self::BELONGS_TO, 'CrugeUser', 'iduser'),
			'r' => array(self::BELONGS_TO, 'TbRol', 'r_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'usrl_id' => 'Codigo Usuario Rol',
			'iduser' => 'ID Usuario',
			'r_id' => 'ID Rol',
			'usrl_estado' => 'Estado',
			'usrl_fecha_ingreso' => 'Fecha Ingreso',
			'usrl_fecha_modifica' => 'Fecha Modifica',
			'usrl_cod_usuario_ing_mod' => 'Responsable',
			'usrl_nombre_usuario' => 'Nombre Usuario',
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

		$criteria->compare('usrl_id',$this->usrl_id);
		$criteria->compare('iduser',$this->iduser);
		$criteria->compare('r_id',$this->r_id);
		$criteria->compare('usrl_estado',$this->usrl_estado);
		$criteria->compare('usrl_fecha_ingreso',$this->usrl_fecha_ingreso,true);
		$criteria->compare('usrl_fecha_modifica',$this->usrl_fecha_modifica,true);
		$criteria->compare('usrl_cod_usuario_ing_mod',$this->usrl_cod_usuario_ing_mod);
		$criteria->compare('usrl_nombre_usuario',$this->usrl_nombre_usuario,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UsuarioRolModel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
