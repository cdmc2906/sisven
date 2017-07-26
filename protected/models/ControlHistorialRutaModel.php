<?php

/**
 * This is the model class for table "tb_control_historial_ruta".
 *
 * The followings are the available columns in table 'tb_control_historial_ruta':
 * @property integer $rh_id
 * @property string $rh_item
 * @property string $rh_fecha_item
 * @property string $rh_fecha_revision
 * @property string $rh_codigo_vendedor
 * @property string $rh_cod_cliente
 * @property string $rh_ruta_visita
 * @property integer $rh_orden_visita
 * @property string $rh_ruta_ejecutivo
 * @property integer $rh_secuencia_ruta
 * @property string $rh_observacion_ruta
 * @property string $rh_observacion_secuencia
 * @property integer $rh_chips_compra
 * @property string $rh_estado
 * @property string $rh_fecha_ingreso
 * @property string $rh_fecha_modificacion
 * @property integer $rh_usuario_revisa
 */
class ControlHistorialRutaModel extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tb_control_historial_ruta';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('rh_orden_visita, rh_secuencia_ruta, rh_chips_compra, rh_usuario_revisa', 'numerical', 'integerOnly'=>true),
			array('rh_item', 'length', 'max'=>25),
			array('rh_codigo_vendedor, rh_cod_cliente, rh_ruta_visita, rh_ruta_ejecutivo, rh_estado', 'length', 'max'=>50),
			array('rh_observacion_ruta, rh_observacion_secuencia', 'length', 'max'=>250),
			array('rh_fecha_item, rh_fecha_revision, rh_fecha_ingreso, rh_fecha_modificacion', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('rh_id, rh_item, rh_fecha_item, rh_fecha_revision, rh_codigo_vendedor, rh_cod_cliente, rh_ruta_visita, rh_orden_visita, rh_ruta_ejecutivo, rh_secuencia_ruta, rh_observacion_ruta, rh_observacion_secuencia, rh_chips_compra, rh_estado, rh_fecha_ingreso, rh_fecha_modificacion, rh_usuario_revisa', 'safe', 'on'=>'search'),
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
			'rh_id' => 'Rh',
			'rh_item' => 'Rh Item',
			'rh_fecha_item' => 'Rh Fecha Item',
			'rh_fecha_revision' => 'Rh Fecha Revision',
			'rh_codigo_vendedor' => 'Rh Codigo Vendedor',
			'rh_cod_cliente' => 'Rh Cod Cliente',
			'rh_ruta_visita' => 'Rh Ruta Visita',
			'rh_orden_visita' => 'Rh Orden Visita',
			'rh_ruta_ejecutivo' => 'Rh Ruta Ejecutivo',
			'rh_secuencia_ruta' => 'Rh Secuencia Ruta',
			'rh_observacion_ruta' => 'Rh Observacion Ruta',
			'rh_observacion_secuencia' => 'Rh Observacion Secuencia',
			'rh_chips_compra' => 'Rh Chips Compra',
			'rh_estado' => 'Rh Estado',
			'rh_fecha_ingreso' => 'Rh Fecha Ingreso',
			'rh_fecha_modificacion' => 'Rh Fecha Modificacion',
			'rh_usuario_revisa' => 'Rh Usuario Revisa',
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

		$criteria->compare('rh_id',$this->rh_id);
		$criteria->compare('rh_item',$this->rh_item,true);
		$criteria->compare('rh_fecha_item',$this->rh_fecha_item,true);
		$criteria->compare('rh_fecha_revision',$this->rh_fecha_revision,true);
		$criteria->compare('rh_codigo_vendedor',$this->rh_codigo_vendedor,true);
		$criteria->compare('rh_cod_cliente',$this->rh_cod_cliente,true);
		$criteria->compare('rh_ruta_visita',$this->rh_ruta_visita,true);
		$criteria->compare('rh_orden_visita',$this->rh_orden_visita);
		$criteria->compare('rh_ruta_ejecutivo',$this->rh_ruta_ejecutivo,true);
		$criteria->compare('rh_secuencia_ruta',$this->rh_secuencia_ruta);
		$criteria->compare('rh_observacion_ruta',$this->rh_observacion_ruta,true);
		$criteria->compare('rh_observacion_secuencia',$this->rh_observacion_secuencia,true);
		$criteria->compare('rh_chips_compra',$this->rh_chips_compra);
		$criteria->compare('rh_estado',$this->rh_estado,true);
		$criteria->compare('rh_fecha_ingreso',$this->rh_fecha_ingreso,true);
		$criteria->compare('rh_fecha_modificacion',$this->rh_fecha_modificacion,true);
		$criteria->compare('rh_usuario_revisa',$this->rh_usuario_revisa);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ControlHistorialRutaModel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
