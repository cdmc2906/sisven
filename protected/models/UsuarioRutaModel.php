<?php

/**
 * This is the model class for table "tb_usuario_ruta".
 *
 * The followings are the available columns in table 'tb_usuario_ruta':
 * @property integer $ur_id
 * @property integer $rg_id
 * @property integer $iduser
 * @property string $ur_nombre_ejecutivo
 * @property integer $ur_estado
 * @property string $ur_zona_gestion
 * @property string $ur_fecha_ingreso
 * @property string $ur_fecha_modifica
 * @property integer $ur_cod_usuario_ingresa_modifica
 *
 * The followings are the available model relations:
 * @property CrugeUser $iduser0
 * @property TbRutaGestion $rg
 */
class UsuarioRutaModel extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tb_usuario_ruta';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('rg_id, iduser, ur_estado, ur_cod_usuario_ingresa_modifica', 'numerical', 'integerOnly'=>true),
			array('ur_nombre_ejecutivo', 'length', 'max'=>250),
			array('ur_zona_gestion', 'length', 'max'=>50),
			array('ur_fecha_ingreso, ur_fecha_modifica', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ur_id, rg_id, iduser, ur_nombre_ejecutivo, ur_estado, ur_zona_gestion, ur_fecha_ingreso, ur_fecha_modifica, ur_cod_usuario_ingresa_modifica', 'safe', 'on'=>'search'),
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
			'rg' => array(self::BELONGS_TO, 'TbRutaGestion', 'rg_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ur_id' => 'Codigo usuario ruta',
			'rg_id' => 'Codigo Ruta',
			'iduser' => 'Codigo Usuario',
			'ur_nombre_ejecutivo' => 'Nombre Usuario',
			'ur_estado' => 'Estado',
			'ur_zona_gestion' => 'Codigo Zona Ruta',
			'ur_fecha_ingreso' => 'Fecha Ingreso',
			'ur_fecha_modifica' => 'Fecha Modifica',
			'ur_cod_usuario_ingresa_modifica' => 'Cod Usuario Ing-Mod',
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

		$criteria->compare('ur_id',$this->ur_id);
		$criteria->compare('rg_id',$this->rg_id);
		$criteria->compare('iduser',$this->iduser);
		$criteria->compare('ur_nombre_ejecutivo',$this->ur_nombre_ejecutivo,true);
		$criteria->compare('ur_estado',$this->ur_estado);
		$criteria->compare('ur_zona_gestion',$this->ur_zona_gestion,true);
		$criteria->compare('ur_fecha_ingreso',$this->ur_fecha_ingreso,true);
		$criteria->compare('ur_fecha_modifica',$this->ur_fecha_modifica,true);
		$criteria->compare('ur_cod_usuario_ingresa_modifica',$this->ur_cod_usuario_ingresa_modifica);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UsuarioRutaModel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
