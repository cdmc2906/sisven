<?php

/**
 * This is the model class for table "tb_ordenes_mb".
 *
 * The followings are the available columns in table 'tb_ordenes_mb':
 * @property integer $o_codigo
 * @property integer $o_id
 * @property string $o_concepto
 * @property string $o_comentario
 * @property string $o_fch_creacion
 * @property string $o_fch_despacho
 * @property string $o_tipo
 * @property string $o_estatus
 * @property string $o_cod_cliente
 * @property string $o_nom_cliente
 * @property string $o_id_cliente
 * @property string $o_direccion
 * @property string $o_lista_precio
 * @property string $o_nom_lista_precio
 * @property string $o_bodega_origen
 * @property string $o_nom_bodega_origen
 * @property string $o_termino_pago
 * @property string $o_nom_termino_pago
 * @property string $o_usuario
 * @property string $o_nom_usuario
 * @property string $o_oficina
 * @property string $o_nom_oficina
 * @property string $o_tipo_secuencia
 * @property string $o_iva_12_base
 * @property string $o_iva_12_valor
 * @property string $o_iva_0_base
 * @property string $o_iva_0_valor
 * @property string $o_iva_14_base
 * @property string $o_iva_14_valor
 * @property string $o_subtotal
 * @property string $o_porcentaje_descuento
 * @property string $o_descuento
 * @property string $o_impuestos
 * @property string $o_otros_cargos
 * @property string $o_total
 * @property string $o_datos
 * @property string $o_referencia
 * @property string $o_estado_proceso
 * @property string $o_fch_ingreso
 * @property string $o_fch_modificacion
 * @property string $o_fch_desde
 * @property string $o_fch_hasta
 * @property integer $o_usr_ing_mod
 * @property string $o_codigo_mb
 */
class OrdenesMbModel extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tb_ordenes_mb';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('o_id, o_usr_ing_mod', 'numerical', 'integerOnly'=>true),
			array('o_concepto, o_comentario, o_codigo_mb', 'length', 'max'=>500),
			array('o_tipo, o_estatus, o_cod_cliente', 'length', 'max'=>50),
			array('o_nom_cliente, o_id_cliente, o_lista_precio, o_nom_lista_precio, o_bodega_origen, o_nom_bodega_origen, o_termino_pago, o_nom_termino_pago, o_usuario, o_nom_usuario, o_oficina, o_nom_oficina, o_tipo_secuencia', 'length', 'max'=>100),
			array('o_direccion', 'length', 'max'=>250),
			array('o_iva_12_base, o_iva_12_valor, o_iva_0_base, o_iva_0_valor, o_iva_14_base, o_iva_14_valor, o_subtotal, o_porcentaje_descuento, o_descuento, o_impuestos, o_otros_cargos, o_total', 'length', 'max'=>10),
			array('o_datos, o_referencia, o_estado_proceso', 'length', 'max'=>1024),
			array('o_fch_creacion, o_fch_despacho, o_fch_ingreso, o_fch_modificacion, o_fch_desde, o_fch_hasta', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('o_codigo, o_id, o_concepto, o_comentario, o_fch_creacion, o_fch_despacho, o_tipo, o_estatus, o_cod_cliente, o_nom_cliente, o_id_cliente, o_direccion, o_lista_precio, o_nom_lista_precio, o_bodega_origen, o_nom_bodega_origen, o_termino_pago, o_nom_termino_pago, o_usuario, o_nom_usuario, o_oficina, o_nom_oficina, o_tipo_secuencia, o_iva_12_base, o_iva_12_valor, o_iva_0_base, o_iva_0_valor, o_iva_14_base, o_iva_14_valor, o_subtotal, o_porcentaje_descuento, o_descuento, o_impuestos, o_otros_cargos, o_total, o_datos, o_referencia, o_estado_proceso, o_fch_ingreso, o_fch_modificacion, o_fch_desde, o_fch_hasta, o_usr_ing_mod, o_codigo_mb', 'safe', 'on'=>'search'),
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
			'o_codigo' => 'O Codigo',
			'o_id' => 'O',
			'o_concepto' => 'O Concepto',
			'o_comentario' => 'O Comentario',
			'o_fch_creacion' => 'O Fch Creacion',
			'o_fch_despacho' => 'O Fch Despacho',
			'o_tipo' => 'O Tipo',
			'o_estatus' => 'O Estatus',
			'o_cod_cliente' => 'O Cod Cliente',
			'o_nom_cliente' => 'O Nom Cliente',
			'o_id_cliente' => 'O Id Cliente',
			'o_direccion' => 'O Direccion',
			'o_lista_precio' => 'O Lista Precio',
			'o_nom_lista_precio' => 'O Nom Lista Precio',
			'o_bodega_origen' => 'O Bodega Origen',
			'o_nom_bodega_origen' => 'O Nom Bodega Origen',
			'o_termino_pago' => 'O Termino Pago',
			'o_nom_termino_pago' => 'O Nom Termino Pago',
			'o_usuario' => 'O Usuario',
			'o_nom_usuario' => 'O Nom Usuario',
			'o_oficina' => 'O Oficina',
			'o_nom_oficina' => 'O Nom Oficina',
			'o_tipo_secuencia' => 'O Tipo Secuencia',
			'o_iva_12_base' => 'O Iva 12 Base',
			'o_iva_12_valor' => 'O Iva 12 Valor',
			'o_iva_0_base' => 'O Iva 0 Base',
			'o_iva_0_valor' => 'O Iva 0 Valor',
			'o_iva_14_base' => 'O Iva 14 Base',
			'o_iva_14_valor' => 'O Iva 14 Valor',
			'o_subtotal' => 'O Subtotal',
			'o_porcentaje_descuento' => 'O Porcentaje Descuento',
			'o_descuento' => 'O Descuento',
			'o_impuestos' => 'O Impuestos',
			'o_otros_cargos' => 'O Otros Cargos',
			'o_total' => 'O Total',
			'o_datos' => 'O Datos',
			'o_referencia' => 'O Referencia',
			'o_estado_proceso' => 'O Estado Proceso',
			'o_fch_ingreso' => 'O Fch Ingreso',
			'o_fch_modificacion' => 'O Fch Modificacion',
			'o_fch_desde' => 'O Fch Desde',
			'o_fch_hasta' => 'O Fch Hasta',
			'o_usr_ing_mod' => 'O Usr Ing Mod',
			'o_codigo_mb' => 'O Codigo Mb',
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

		$criteria->compare('o_codigo',$this->o_codigo);
		$criteria->compare('o_id',$this->o_id);
		$criteria->compare('o_concepto',$this->o_concepto,true);
		$criteria->compare('o_comentario',$this->o_comentario,true);
		$criteria->compare('o_fch_creacion',$this->o_fch_creacion,true);
		$criteria->compare('o_fch_despacho',$this->o_fch_despacho,true);
		$criteria->compare('o_tipo',$this->o_tipo,true);
		$criteria->compare('o_estatus',$this->o_estatus,true);
		$criteria->compare('o_cod_cliente',$this->o_cod_cliente,true);
		$criteria->compare('o_nom_cliente',$this->o_nom_cliente,true);
		$criteria->compare('o_id_cliente',$this->o_id_cliente,true);
		$criteria->compare('o_direccion',$this->o_direccion,true);
		$criteria->compare('o_lista_precio',$this->o_lista_precio,true);
		$criteria->compare('o_nom_lista_precio',$this->o_nom_lista_precio,true);
		$criteria->compare('o_bodega_origen',$this->o_bodega_origen,true);
		$criteria->compare('o_nom_bodega_origen',$this->o_nom_bodega_origen,true);
		$criteria->compare('o_termino_pago',$this->o_termino_pago,true);
		$criteria->compare('o_nom_termino_pago',$this->o_nom_termino_pago,true);
		$criteria->compare('o_usuario',$this->o_usuario,true);
		$criteria->compare('o_nom_usuario',$this->o_nom_usuario,true);
		$criteria->compare('o_oficina',$this->o_oficina,true);
		$criteria->compare('o_nom_oficina',$this->o_nom_oficina,true);
		$criteria->compare('o_tipo_secuencia',$this->o_tipo_secuencia,true);
		$criteria->compare('o_iva_12_base',$this->o_iva_12_base,true);
		$criteria->compare('o_iva_12_valor',$this->o_iva_12_valor,true);
		$criteria->compare('o_iva_0_base',$this->o_iva_0_base,true);
		$criteria->compare('o_iva_0_valor',$this->o_iva_0_valor,true);
		$criteria->compare('o_iva_14_base',$this->o_iva_14_base,true);
		$criteria->compare('o_iva_14_valor',$this->o_iva_14_valor,true);
		$criteria->compare('o_subtotal',$this->o_subtotal,true);
		$criteria->compare('o_porcentaje_descuento',$this->o_porcentaje_descuento,true);
		$criteria->compare('o_descuento',$this->o_descuento,true);
		$criteria->compare('o_impuestos',$this->o_impuestos,true);
		$criteria->compare('o_otros_cargos',$this->o_otros_cargos,true);
		$criteria->compare('o_total',$this->o_total,true);
		$criteria->compare('o_datos',$this->o_datos,true);
		$criteria->compare('o_referencia',$this->o_referencia,true);
		$criteria->compare('o_estado_proceso',$this->o_estado_proceso,true);
		$criteria->compare('o_fch_ingreso',$this->o_fch_ingreso,true);
		$criteria->compare('o_fch_modificacion',$this->o_fch_modificacion,true);
		$criteria->compare('o_fch_desde',$this->o_fch_desde,true);
		$criteria->compare('o_fch_hasta',$this->o_fch_hasta,true);
		$criteria->compare('o_usr_ing_mod',$this->o_usr_ing_mod);
		$criteria->compare('o_codigo_mb',$this->o_codigo_mb,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return OrdenesMbModel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
