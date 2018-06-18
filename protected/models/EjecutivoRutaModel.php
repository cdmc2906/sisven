<?php

/**
 * This is the model class for table "tb_ejecutivo_ruta".
 *
 * The followings are the available columns in table 'tb_ejecutivo_ruta':
 * @property integer $er_cod
 * @property integer $e_cod
 * @property integer $rg_id
 * @property string $er_usuario
 * @property string $er_usuario_nombre
 * @property string $er_ruta
 * @property string $er_ruta_nombre
 * @property integer $er_semana_visitar
 * @property integer $er_dia_visitar
 * @property string $er_estado
 * @property string $er_fecha_ingreso
 * @property string $er_fecha_modificacion
 * @property integer $er_cod_usr_ing
 * @property integer $er_cod_usr_mod
 *
 * The followings are the available model relations:
 * @property TbEjecutivo $eCod
 * @property TbRutaGestion $rg
 */
class EjecutivoRutaModel extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tb_ejecutivo_ruta';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('e_cod, rg_id, er_semana_visitar, er_dia_visitar, er_cod_usr_ing, er_cod_usr_mod', 'numerical', 'integerOnly'=>true),
			array('er_usuario, er_usuario_nombre, er_ruta, er_ruta_nombre, er_estado', 'length', 'max'=>50),
			array('er_fecha_ingreso, er_fecha_modificacion', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('er_cod, e_cod, rg_id, er_usuario, er_usuario_nombre, er_ruta, er_ruta_nombre, er_semana_visitar, er_dia_visitar, er_estado, er_fecha_ingreso, er_fecha_modificacion, er_cod_usr_ing, er_cod_usr_mod', 'safe', 'on'=>'search'),
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
			'eCod' => array(self::BELONGS_TO, 'TbEjecutivo', 'e_cod'),
			'rg' => array(self::BELONGS_TO, 'TbRutaGestion', 'rg_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'er_cod' => 'Er Cod',
			'e_cod' => 'E Cod',
			'rg_id' => 'Rg',
			'er_usuario' => 'Er Usuario',
			'er_usuario_nombre' => 'Er Usuario Nombre',
			'er_ruta' => 'Er Ruta',
			'er_ruta_nombre' => 'Er Ruta Nombre',
			'er_semana_visitar' => 'Er Semana Visitar',
			'er_dia_visitar' => 'Er Dia Visitar',
			'er_estado' => 'Er Estado',
			'er_fecha_ingreso' => 'Er Fecha Ingreso',
			'er_fecha_modificacion' => 'Er Fecha Modificacion',
			'er_cod_usr_ing' => 'Er Cod Usr Ing',
			'er_cod_usr_mod' => 'Er Cod Usr Mod',
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

		$criteria->compare('er_cod',$this->er_cod);
		$criteria->compare('e_cod',$this->e_cod);
		$criteria->compare('rg_id',$this->rg_id);
		$criteria->compare('er_usuario',$this->er_usuario,true);
		$criteria->compare('er_usuario_nombre',$this->er_usuario_nombre,true);
		$criteria->compare('er_ruta',$this->er_ruta,true);
		$criteria->compare('er_ruta_nombre',$this->er_ruta_nombre,true);
		$criteria->compare('er_semana_visitar',$this->er_semana_visitar);
		$criteria->compare('er_dia_visitar',$this->er_dia_visitar);
		$criteria->compare('er_estado',$this->er_estado,true);
		$criteria->compare('er_fecha_ingreso',$this->er_fecha_ingreso,true);
		$criteria->compare('er_fecha_modificacion',$this->er_fecha_modificacion,true);
		$criteria->compare('er_cod_usr_ing',$this->er_cod_usr_ing);
		$criteria->compare('er_cod_usr_mod',$this->er_cod_usr_mod);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EjecutivoRutaModel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
