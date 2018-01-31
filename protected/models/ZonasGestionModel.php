<?php

/**
 * This is the model class for table "tb_zonas_gestion".
 *
 * The followings are the available columns in table 'tb_zonas_gestion':
 * @property integer $zg_id
 * @property string $zg_nombre_zona
 * @property string $zg_cod_ejecutivo_asignado
 * @property string $zg_nomb_ejecutivo_asignado
 * @property integer $zg_estado_zona
 * @property string $zg_fecha_ingreso
 * @property string $zg_fecha_modifica
 * @property integer $zg_cod_usuario_ingresa_modifica
 *
 * The followings are the available model relations:
 * @property TbRutaGestion[] $tbRutaGestions
 */
class ZonasGestionModel extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tb_zonas_gestion';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('zg_estado_zona, zg_cod_usuario_ingresa_modifica', 'numerical', 'integerOnly'=>true),
			array('zg_nombre_zona', 'length', 'max'=>150),
			array('zg_cod_ejecutivo_asignado', 'length', 'max'=>50),
			array('zg_nomb_ejecutivo_asignado', 'length', 'max'=>250),
			array('zg_fecha_ingreso, zg_fecha_modifica', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('zg_id, zg_nombre_zona, zg_cod_ejecutivo_asignado, zg_nomb_ejecutivo_asignado, zg_estado_zona, zg_fecha_ingreso, zg_fecha_modifica, zg_cod_usuario_ingresa_modifica', 'safe', 'on'=>'search'),
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
			'tbRutaGestions' => array(self::HAS_MANY, 'TbRutaGestion', 'zg_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'zg_id' => 'Zg',
			'zg_nombre_zona' => 'Zg Nombre Zona',
			'zg_cod_ejecutivo_asignado' => 'Zg Cod Ejecutivo Asignado',
			'zg_nomb_ejecutivo_asignado' => 'Zg Nomb Ejecutivo Asignado',
			'zg_estado_zona' => 'Zg Estado Zona',
			'zg_fecha_ingreso' => 'Zg Fecha Ingreso',
			'zg_fecha_modifica' => 'Zg Fecha Modifica',
			'zg_cod_usuario_ingresa_modifica' => 'Zg Cod Usuario Ingresa Modifica',
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

		$criteria->compare('zg_id',$this->zg_id);
		$criteria->compare('zg_nombre_zona',$this->zg_nombre_zona,true);
		$criteria->compare('zg_cod_ejecutivo_asignado',$this->zg_cod_ejecutivo_asignado,true);
		$criteria->compare('zg_nomb_ejecutivo_asignado',$this->zg_nomb_ejecutivo_asignado,true);
		$criteria->compare('zg_estado_zona',$this->zg_estado_zona);
		$criteria->compare('zg_fecha_ingreso',$this->zg_fecha_ingreso,true);
		$criteria->compare('zg_fecha_modifica',$this->zg_fecha_modifica,true);
		$criteria->compare('zg_cod_usuario_ingresa_modifica',$this->zg_cod_usuario_ingresa_modifica);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ZonasGestionModel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
