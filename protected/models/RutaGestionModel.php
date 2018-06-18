<?php

/**
 * This is the model class for table "tb_ruta_gestion".
 *
 * The followings are the available columns in table 'tb_ruta_gestion':
 * @property integer $rg_id
 * @property integer $zg_id
 * @property string $rg_cod_ruta_mb
 * @property string $rg_nombre_ruta
 * @property integer $rg_estado_ruta
 * @property string $rg_fecha_ingreso
 * @property string $rg_fecha_modifica
 * @property integer $rg_cod_usuario_ingresa_modifica
 *
 * The followings are the available model relations:
 * @property TbZonasGestion $zg
 * @property TbUsuarioRuta[] $tbUsuarioRutas
 * @property TbEjecutivoRuta[] $tbEjecutivoRutas
 */
class RutaGestionModel extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tb_ruta_gestion';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('zg_id, rg_estado_ruta, rg_cod_usuario_ingresa_modifica', 'numerical', 'integerOnly'=>true),
			array('rg_cod_ruta_mb, rg_nombre_ruta', 'length', 'max'=>50),
			array('rg_fecha_ingreso, rg_fecha_modifica', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('rg_id, zg_id, rg_cod_ruta_mb, rg_nombre_ruta, rg_estado_ruta, rg_fecha_ingreso, rg_fecha_modifica, rg_cod_usuario_ingresa_modifica', 'safe', 'on'=>'search'),
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
			'zg' => array(self::BELONGS_TO, 'TbZonasGestion', 'zg_id'),
			'tbUsuarioRutas' => array(self::HAS_MANY, 'TbUsuarioRuta', 'rg_id'),
			'tbEjecutivoRutas' => array(self::HAS_MANY, 'TbEjecutivoRuta', 'rg_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'rg_id' => 'Rg',
			'zg_id' => 'Zg',
			'rg_cod_ruta_mb' => 'Rg Cod Ruta Mb',
			'rg_nombre_ruta' => 'Rg Nombre Ruta',
			'rg_estado_ruta' => 'Rg Estado Ruta',
			'rg_fecha_ingreso' => 'Rg Fecha Ingreso',
			'rg_fecha_modifica' => 'Rg Fecha Modifica',
			'rg_cod_usuario_ingresa_modifica' => 'Rg Cod Usuario Ingresa Modifica',
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

		$criteria->compare('rg_id',$this->rg_id);
		$criteria->compare('zg_id',$this->zg_id);
		$criteria->compare('rg_cod_ruta_mb',$this->rg_cod_ruta_mb,true);
		$criteria->compare('rg_nombre_ruta',$this->rg_nombre_ruta,true);
		$criteria->compare('rg_estado_ruta',$this->rg_estado_ruta);
		$criteria->compare('rg_fecha_ingreso',$this->rg_fecha_ingreso,true);
		$criteria->compare('rg_fecha_modifica',$this->rg_fecha_modifica,true);
		$criteria->compare('rg_cod_usuario_ingresa_modifica',$this->rg_cod_usuario_ingresa_modifica);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RutaGestionModel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
