<?php

/**
 * This is the model class for table "tb_cliente".
 *
 * The followings are the available columns in table 'tb_cliente':
 * @property integer $cli_codigo
 * @property string $cli_codigo_cliente
 * @property string $cli_nombre_cliente
 * @property string $cli_tipo_de_identificacion
 * @property string $cli_identificacion
 * @property string $cli_nombre_de_compania
 * @property string $cli_nombre_comercial
 * @property string $cli_contacto
 * @property string $cli_moneda
 * @property string $cli_moneda_nombre
 * @property string $cli_tipo_de_negocio
 * @property string $cli_tipo_de_negocio_nombre
 * @property string $cli_subcanal
 * @property string $cli_subcanal_nombre
 * @property string $cli_lista_de_precios
 * @property string $cli_lista_de_precios_nombre
 * @property string $cli_lista_de_precios_2
 * @property string $cli_lista_de_precios_2_nombre
 * @property string $cli_termino_de_pago
 * @property string $cli_termino_de_pago_nombre
 * @property string $cli_metodo_de_pago
 * @property string $cli_metodo_de_pago_nombre
 * @property string $cli_grupo
 * @property string $cli_grupo_nombre
 * @property string $cli_usuario
 * @property string $cli_usuario_nombre
 * @property string $cli_comentario
 * @property string $cli_objetivo_de_venta
 * @property string $cli_maximo_descuento_porcentaje
 * @property string $cli_retencion_porcentaje
 * @property integer $cli_tiene_credito
 * @property string $cli_estatus
 * @property string $cli_creado
 * @property string $cli_creado_por
 * @property string $cli_latitud
 * @property string $cli_longitud
 * @property integer $cli_estado
 * @property string $cli_fecha_ingreso
 * @property string $cli_fecha_modificacion
 * @property integer $cli_usuario_ingresa_modifica
 *
 * The followings are the available model relations:
 * @property TbNovedadCliente[] $tbNovedadClientes
 */
class ClienteModel extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tb_cliente';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cli_tiene_credito, cli_estado, cli_usuario_ingresa_modifica', 'numerical', 'integerOnly'=>true),
			array('cli_codigo_cliente, cli_tipo_de_identificacion, cli_identificacion, cli_estatus, cli_creado_por', 'length', 'max'=>50),
			array('cli_nombre_cliente, cli_nombre_comercial, cli_contacto, cli_moneda, cli_moneda_nombre, cli_tipo_de_negocio, cli_tipo_de_negocio_nombre, cli_subcanal, cli_subcanal_nombre, cli_lista_de_precios, cli_lista_de_precios_nombre, cli_lista_de_precios_2, cli_lista_de_precios_2_nombre, cli_termino_de_pago, cli_termino_de_pago_nombre, cli_metodo_de_pago, cli_metodo_de_pago_nombre, cli_grupo, cli_grupo_nombre, cli_usuario, cli_usuario_nombre, cli_comentario, cli_objetivo_de_venta, cli_latitud, cli_longitud', 'length', 'max'=>250),
			array('cli_nombre_de_compania', 'length', 'max'=>500),
			array('cli_maximo_descuento_porcentaje, cli_retencion_porcentaje', 'length', 'max'=>10),
			array('cli_creado, cli_fecha_ingreso, cli_fecha_modificacion', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('cli_codigo, cli_codigo_cliente, cli_nombre_cliente, cli_tipo_de_identificacion, cli_identificacion, cli_nombre_de_compania, cli_nombre_comercial, cli_contacto, cli_moneda, cli_moneda_nombre, cli_tipo_de_negocio, cli_tipo_de_negocio_nombre, cli_subcanal, cli_subcanal_nombre, cli_lista_de_precios, cli_lista_de_precios_nombre, cli_lista_de_precios_2, cli_lista_de_precios_2_nombre, cli_termino_de_pago, cli_termino_de_pago_nombre, cli_metodo_de_pago, cli_metodo_de_pago_nombre, cli_grupo, cli_grupo_nombre, cli_usuario, cli_usuario_nombre, cli_comentario, cli_objetivo_de_venta, cli_maximo_descuento_porcentaje, cli_retencion_porcentaje, cli_tiene_credito, cli_estatus, cli_creado, cli_creado_por, cli_latitud, cli_longitud, cli_estado, cli_fecha_ingreso, cli_fecha_modificacion, cli_usuario_ingresa_modifica', 'safe', 'on'=>'search'),
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
			'tbNovedadClientes' => array(self::HAS_MANY, 'TbNovedadCliente', 'cli_codigo'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'cli_codigo' => 'Cli Codigo',
			'cli_codigo_cliente' => 'Cli Codigo Cliente',
			'cli_nombre_cliente' => 'Cli Nombre Cliente',
			'cli_tipo_de_identificacion' => 'Cli Tipo De Identificacion',
			'cli_identificacion' => 'Cli Identificacion',
			'cli_nombre_de_compania' => 'Cli Nombre De Compania',
			'cli_nombre_comercial' => 'Cli Nombre Comercial',
			'cli_contacto' => 'Cli Contacto',
			'cli_moneda' => 'Cli Moneda',
			'cli_moneda_nombre' => 'Cli Moneda Nombre',
			'cli_tipo_de_negocio' => 'Cli Tipo De Negocio',
			'cli_tipo_de_negocio_nombre' => 'Cli Tipo De Negocio Nombre',
			'cli_subcanal' => 'Cli Subcanal',
			'cli_subcanal_nombre' => 'Cli Subcanal Nombre',
			'cli_lista_de_precios' => 'Cli Lista De Precios',
			'cli_lista_de_precios_nombre' => 'Cli Lista De Precios Nombre',
			'cli_lista_de_precios_2' => 'Cli Lista De Precios 2',
			'cli_lista_de_precios_2_nombre' => 'Cli Lista De Precios 2 Nombre',
			'cli_termino_de_pago' => 'Cli Termino De Pago',
			'cli_termino_de_pago_nombre' => 'Cli Termino De Pago Nombre',
			'cli_metodo_de_pago' => 'Cli Metodo De Pago',
			'cli_metodo_de_pago_nombre' => 'Cli Metodo De Pago Nombre',
			'cli_grupo' => 'Cli Grupo',
			'cli_grupo_nombre' => 'Cli Grupo Nombre',
			'cli_usuario' => 'Cli Usuario',
			'cli_usuario_nombre' => 'Cli Usuario Nombre',
			'cli_comentario' => 'Cli Comentario',
			'cli_objetivo_de_venta' => 'Cli Objetivo De Venta',
			'cli_maximo_descuento_porcentaje' => 'Cli Maximo Descuento Porcentaje',
			'cli_retencion_porcentaje' => 'Cli Retencion Porcentaje',
			'cli_tiene_credito' => 'Cli Tiene Credito',
			'cli_estatus' => 'Cli Estatus',
			'cli_creado' => 'Cli Creado',
			'cli_creado_por' => 'Cli Creado Por',
			'cli_latitud' => 'Cli Latitud',
			'cli_longitud' => 'Cli Longitud',
			'cli_estado' => 'Cli Estado',
			'cli_fecha_ingreso' => 'Cli Fecha Ingreso',
			'cli_fecha_modificacion' => 'Cli Fecha Modificacion',
			'cli_usuario_ingresa_modifica' => 'Cli Usuario Ingresa Modifica',
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

		$criteria->compare('cli_codigo',$this->cli_codigo);
		$criteria->compare('cli_codigo_cliente',$this->cli_codigo_cliente,true);
		$criteria->compare('cli_nombre_cliente',$this->cli_nombre_cliente,true);
		$criteria->compare('cli_tipo_de_identificacion',$this->cli_tipo_de_identificacion,true);
		$criteria->compare('cli_identificacion',$this->cli_identificacion,true);
		$criteria->compare('cli_nombre_de_compania',$this->cli_nombre_de_compania,true);
		$criteria->compare('cli_nombre_comercial',$this->cli_nombre_comercial,true);
		$criteria->compare('cli_contacto',$this->cli_contacto,true);
		$criteria->compare('cli_moneda',$this->cli_moneda,true);
		$criteria->compare('cli_moneda_nombre',$this->cli_moneda_nombre,true);
		$criteria->compare('cli_tipo_de_negocio',$this->cli_tipo_de_negocio,true);
		$criteria->compare('cli_tipo_de_negocio_nombre',$this->cli_tipo_de_negocio_nombre,true);
		$criteria->compare('cli_subcanal',$this->cli_subcanal,true);
		$criteria->compare('cli_subcanal_nombre',$this->cli_subcanal_nombre,true);
		$criteria->compare('cli_lista_de_precios',$this->cli_lista_de_precios,true);
		$criteria->compare('cli_lista_de_precios_nombre',$this->cli_lista_de_precios_nombre,true);
		$criteria->compare('cli_lista_de_precios_2',$this->cli_lista_de_precios_2,true);
		$criteria->compare('cli_lista_de_precios_2_nombre',$this->cli_lista_de_precios_2_nombre,true);
		$criteria->compare('cli_termino_de_pago',$this->cli_termino_de_pago,true);
		$criteria->compare('cli_termino_de_pago_nombre',$this->cli_termino_de_pago_nombre,true);
		$criteria->compare('cli_metodo_de_pago',$this->cli_metodo_de_pago,true);
		$criteria->compare('cli_metodo_de_pago_nombre',$this->cli_metodo_de_pago_nombre,true);
		$criteria->compare('cli_grupo',$this->cli_grupo,true);
		$criteria->compare('cli_grupo_nombre',$this->cli_grupo_nombre,true);
		$criteria->compare('cli_usuario',$this->cli_usuario,true);
		$criteria->compare('cli_usuario_nombre',$this->cli_usuario_nombre,true);
		$criteria->compare('cli_comentario',$this->cli_comentario,true);
		$criteria->compare('cli_objetivo_de_venta',$this->cli_objetivo_de_venta,true);
		$criteria->compare('cli_maximo_descuento_porcentaje',$this->cli_maximo_descuento_porcentaje,true);
		$criteria->compare('cli_retencion_porcentaje',$this->cli_retencion_porcentaje,true);
		$criteria->compare('cli_tiene_credito',$this->cli_tiene_credito);
		$criteria->compare('cli_estatus',$this->cli_estatus,true);
		$criteria->compare('cli_creado',$this->cli_creado,true);
		$criteria->compare('cli_creado_por',$this->cli_creado_por,true);
		$criteria->compare('cli_latitud',$this->cli_latitud,true);
		$criteria->compare('cli_longitud',$this->cli_longitud,true);
		$criteria->compare('cli_estado',$this->cli_estado);
		$criteria->compare('cli_fecha_ingreso',$this->cli_fecha_ingreso,true);
		$criteria->compare('cli_fecha_modificacion',$this->cli_fecha_modificacion,true);
		$criteria->compare('cli_usuario_ingresa_modifica',$this->cli_usuario_ingresa_modifica);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ClienteModel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
