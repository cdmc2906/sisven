<?php

/**
 * This is the model class for table "tb_ejecutivo_ruta".
 *
 * The followings are the available columns in table 'tb_ejecutivo_ruta':
 * @property integer $er_cod
 * @property string $er_usuario
 * @property string $er_usuario_nombre
 * @property string $er_ruta
 * @property string $er_ruta_nombre
 * @property string $er_estatus
 * @property string $er_fecha_ingreso
 * @property string $er_fecha_asignacion
 * @property string $er_fecha_modificacion
 * @property integer $er_cod_usr_ing
 * @property integer $er_cod_usr_mod
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
			array('er_cod_usr_ing, er_cod_usr_mod', 'numerical', 'integerOnly'=>true),
			array('er_usuario, er_usuario_nombre, er_ruta, er_ruta_nombre, er_estatus', 'length', 'max'=>50),
			array('er_fecha_ingreso, er_fecha_asignacion, er_fecha_modificacion', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('er_cod, er_usuario, er_usuario_nombre, er_ruta, er_ruta_nombre, er_estatus, er_fecha_ingreso, er_fecha_asignacion, er_fecha_modificacion, er_cod_usr_ing, er_cod_usr_mod', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'er_cod' => 'Er Cod',
			'er_usuario' => 'Er Usuario',
			'er_usuario_nombre' => 'Er Usuario Nombre',
			'er_ruta' => 'Er Ruta',
			'er_ruta_nombre' => 'Er Ruta Nombre',
			'er_estatus' => 'Er Estatus',
			'er_fecha_ingreso' => 'Er Fecha Ingreso',
			'er_fecha_asignacion' => 'Er Fecha Asignacion',
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
		$criteria->compare('er_usuario',$this->er_usuario,true);
		$criteria->compare('er_usuario_nombre',$this->er_usuario_nombre,true);
		$criteria->compare('er_ruta',$this->er_ruta,true);
		$criteria->compare('er_ruta_nombre',$this->er_ruta_nombre,true);
		$criteria->compare('er_estatus',$this->er_estatus,true);
		$criteria->compare('er_fecha_ingreso',$this->er_fecha_ingreso,true);
		$criteria->compare('er_fecha_asignacion',$this->er_fecha_asignacion,true);
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
