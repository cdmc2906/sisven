<?php

/**
 * This is the model class for table "tb_ruta_mb".
 *
 * The followings are the available columns in table 'tb_ruta_mb':
 * @property integer $r_cod
 * @property integer $pg_id
 * @property string $r_ruta
 * @property string $r_cod_cliente
 * @property string $r_nom_cliente
 * @property string $r_tipo_negocio
 * @property string $r_cod_direccion
 * @property string $r_direccion
 * @property string $r_referencia
 * @property integer $r_semana
 * @property integer $r_dia
 * @property integer $r_secuencia
 * @property integer $r_estatus
 * @property integer $r_numero_carga_informacion
 * @property string $r_fch_ingreso
 * @property string $r_fch_modificacion
 * @property string $r_fch_desde
 * @property string $r_fch_hasta
 * @property integer $r_usuario_ing_mod
 *
 * The followings are the available model relations:
 * @property TbPeriodoGestion $pg
 */
class RutaMbModel extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tb_ruta_mb';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pg_id, r_semana, r_dia, r_secuencia, r_estatus, r_numero_carga_informacion, r_usuario_ing_mod', 'numerical', 'integerOnly'=>true),
			array('r_ruta, r_cod_cliente', 'length', 'max'=>100),
			array('r_nom_cliente, r_tipo_negocio, r_cod_direccion', 'length', 'max'=>200),
			array('r_direccion, r_referencia', 'length', 'max'=>500),
			array('r_fch_ingreso, r_fch_modificacion, r_fch_desde, r_fch_hasta', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('r_cod, pg_id, r_ruta, r_cod_cliente, r_nom_cliente, r_tipo_negocio, r_cod_direccion, r_direccion, r_referencia, r_semana, r_dia, r_secuencia, r_estatus, r_numero_carga_informacion, r_fch_ingreso, r_fch_modificacion, r_fch_desde, r_fch_hasta, r_usuario_ing_mod', 'safe', 'on'=>'search'),
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
			'pg' => array(self::BELONGS_TO, 'TbPeriodoGestion', 'pg_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'r_cod' => 'R Cod',
			'pg_id' => 'Pg',
			'r_ruta' => 'R Ruta',
			'r_cod_cliente' => 'R Cod Cliente',
			'r_nom_cliente' => 'R Nom Cliente',
			'r_tipo_negocio' => 'R Tipo Negocio',
			'r_cod_direccion' => 'R Cod Direccion',
			'r_direccion' => 'R Direccion',
			'r_referencia' => 'R Referencia',
			'r_semana' => 'R Semana',
			'r_dia' => 'R Dia',
			'r_secuencia' => 'R Secuencia',
			'r_estatus' => 'R Estatus',
			'r_numero_carga_informacion' => 'R Numero Carga Informacion',
			'r_fch_ingreso' => 'R Fch Ingreso',
			'r_fch_modificacion' => 'R Fch Modificacion',
			'r_fch_desde' => 'R Fch Desde',
			'r_fch_hasta' => 'R Fch Hasta',
			'r_usuario_ing_mod' => 'R Usuario Ing Mod',
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

		$criteria->compare('r_cod',$this->r_cod);
		$criteria->compare('pg_id',$this->pg_id);
		$criteria->compare('r_ruta',$this->r_ruta,true);
		$criteria->compare('r_cod_cliente',$this->r_cod_cliente,true);
		$criteria->compare('r_nom_cliente',$this->r_nom_cliente,true);
		$criteria->compare('r_tipo_negocio',$this->r_tipo_negocio,true);
		$criteria->compare('r_cod_direccion',$this->r_cod_direccion,true);
		$criteria->compare('r_direccion',$this->r_direccion,true);
		$criteria->compare('r_referencia',$this->r_referencia,true);
		$criteria->compare('r_semana',$this->r_semana);
		$criteria->compare('r_dia',$this->r_dia);
		$criteria->compare('r_secuencia',$this->r_secuencia);
		$criteria->compare('r_estatus',$this->r_estatus);
		$criteria->compare('r_numero_carga_informacion',$this->r_numero_carga_informacion);
		$criteria->compare('r_fch_ingreso',$this->r_fch_ingreso,true);
		$criteria->compare('r_fch_modificacion',$this->r_fch_modificacion,true);
		$criteria->compare('r_fch_desde',$this->r_fch_desde,true);
		$criteria->compare('r_fch_hasta',$this->r_fch_hasta,true);
		$criteria->compare('r_usuario_ing_mod',$this->r_usuario_ing_mod);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RutaMbModel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
