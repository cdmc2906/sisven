<?php

/**
 * This is the model class for table "tb_indicadores".
 *
 * The followings are the available columns in table 'tb_indicadores':
 * @property integer $i_codigo
 * @property string $i_fecha
 * @property string $i_sucursal
 * @property integer $i_numero_bodega
 * @property string $i_bodega
 * @property string $i_numero_serie
 * @property string $i_numero_factura
 * @property string $i_cod_cliente
 * @property string $i_tipo_cliente
 * @property string $i_nombre_cliente
 * @property string $i_ruc
 * @property string $i_direccion
 * @property string $i_ciudad
 * @property string $i_telefono
 * @property string $i_codigo_producto
 * @property string $i_descripcion_producto
 * @property string $i_codigo_grupo
 * @property string $i_grupo
 * @property integer $i_cantidad
 * @property string $i_detalle
 * @property string $i_imei
 * @property string $i_min
 * @property string $i_icc
 * @property string $i_costo
 * @property string $i_precio1
 * @property string $i_precio2
 * @property string $i_precio3
 * @property string $i_precio4
 * @property string $i_precio5
 * @property string $i_precio
 * @property string $i_porcendes
 * @property string $i_descuento
 * @property string $i_subtotal
 * @property string $i_iva
 * @property string $i_total
 * @property string $i_e_codigo
 * @property string $i_vendedor
 * @property string $i_provincia
 * @property string $i_fecha_ingreso
 * @property string $i_fecha_modificacion
 * @property integer $i_usuario_ingresa_modifica
 * @property string $i_estado_icc
 */
class IndicadoresModel extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tb_indicadores';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('i_numero_bodega, i_cantidad, i_usuario_ingresa_modifica', 'numerical', 'integerOnly'=>true),
			array('i_sucursal, i_bodega, i_numero_serie, i_numero_factura, i_cod_cliente, i_tipo_cliente, i_nombre_cliente, i_ruc, i_direccion, i_ciudad, i_telefono, i_codigo_producto, i_descripcion_producto, i_codigo_grupo, i_grupo', 'length', 'max'=>500),
			array('i_detalle', 'length', 'max'=>1024),
			array('i_imei, i_min, i_icc, i_e_codigo, i_vendedor, i_provincia', 'length', 'max'=>20),
			array('i_costo, i_precio1, i_precio2, i_precio3, i_precio4, i_precio5, i_precio, i_porcendes, i_descuento, i_subtotal, i_iva, i_total', 'length', 'max'=>6),
			array('i_estado_icc', 'length', 'max'=>250),
			array('i_fecha, i_fecha_ingreso, i_fecha_modificacion', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('i_codigo, i_fecha, i_sucursal, i_numero_bodega, i_bodega, i_numero_serie, i_numero_factura, i_cod_cliente, i_tipo_cliente, i_nombre_cliente, i_ruc, i_direccion, i_ciudad, i_telefono, i_codigo_producto, i_descripcion_producto, i_codigo_grupo, i_grupo, i_cantidad, i_detalle, i_imei, i_min, i_icc, i_costo, i_precio1, i_precio2, i_precio3, i_precio4, i_precio5, i_precio, i_porcendes, i_descuento, i_subtotal, i_iva, i_total, i_e_codigo, i_vendedor, i_provincia, i_fecha_ingreso, i_fecha_modificacion, i_usuario_ingresa_modifica, i_estado_icc', 'safe', 'on'=>'search'),
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
			'i_codigo' => 'I Codigo',
			'i_fecha' => 'I Fecha',
			'i_sucursal' => 'I Sucursal',
			'i_numero_bodega' => 'I Numero Bodega',
			'i_bodega' => 'I Bodega',
			'i_numero_serie' => 'I Numero Serie',
			'i_numero_factura' => 'I Numero Factura',
			'i_cod_cliente' => 'I Cod Cliente',
			'i_tipo_cliente' => 'I Tipo Cliente',
			'i_nombre_cliente' => 'I Nombre Cliente',
			'i_ruc' => 'I Ruc',
			'i_direccion' => 'I Direccion',
			'i_ciudad' => 'I Ciudad',
			'i_telefono' => 'I Telefono',
			'i_codigo_producto' => 'I Codigo Producto',
			'i_descripcion_producto' => 'I Descripcion Producto',
			'i_codigo_grupo' => 'I Codigo Grupo',
			'i_grupo' => 'I Grupo',
			'i_cantidad' => 'I Cantidad',
			'i_detalle' => 'I Detalle',
			'i_imei' => 'I Imei',
			'i_min' => 'I Min',
			'i_icc' => 'I Icc',
			'i_costo' => 'I Costo',
			'i_precio1' => 'I Precio1',
			'i_precio2' => 'I Precio2',
			'i_precio3' => 'I Precio3',
			'i_precio4' => 'I Precio4',
			'i_precio5' => 'I Precio5',
			'i_precio' => 'I Precio',
			'i_porcendes' => 'I Porcendes',
			'i_descuento' => 'I Descuento',
			'i_subtotal' => 'I Subtotal',
			'i_iva' => 'I Iva',
			'i_total' => 'I Total',
			'i_e_codigo' => 'I E Codigo',
			'i_vendedor' => 'I Vendedor',
			'i_provincia' => 'I Provincia',
			'i_fecha_ingreso' => 'I Fecha Ingreso',
			'i_fecha_modificacion' => 'I Fecha Modificacion',
			'i_usuario_ingresa_modifica' => 'I Usuario Ingresa Modifica',
			'i_estado_icc' => 'I Estado Icc',
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

		$criteria->compare('i_codigo',$this->i_codigo);
		$criteria->compare('i_fecha',$this->i_fecha,true);
		$criteria->compare('i_sucursal',$this->i_sucursal,true);
		$criteria->compare('i_numero_bodega',$this->i_numero_bodega);
		$criteria->compare('i_bodega',$this->i_bodega,true);
		$criteria->compare('i_numero_serie',$this->i_numero_serie,true);
		$criteria->compare('i_numero_factura',$this->i_numero_factura,true);
		$criteria->compare('i_cod_cliente',$this->i_cod_cliente,true);
		$criteria->compare('i_tipo_cliente',$this->i_tipo_cliente,true);
		$criteria->compare('i_nombre_cliente',$this->i_nombre_cliente,true);
		$criteria->compare('i_ruc',$this->i_ruc,true);
		$criteria->compare('i_direccion',$this->i_direccion,true);
		$criteria->compare('i_ciudad',$this->i_ciudad,true);
		$criteria->compare('i_telefono',$this->i_telefono,true);
		$criteria->compare('i_codigo_producto',$this->i_codigo_producto,true);
		$criteria->compare('i_descripcion_producto',$this->i_descripcion_producto,true);
		$criteria->compare('i_codigo_grupo',$this->i_codigo_grupo,true);
		$criteria->compare('i_grupo',$this->i_grupo,true);
		$criteria->compare('i_cantidad',$this->i_cantidad);
		$criteria->compare('i_detalle',$this->i_detalle,true);
		$criteria->compare('i_imei',$this->i_imei,true);
		$criteria->compare('i_min',$this->i_min,true);
		$criteria->compare('i_icc',$this->i_icc,true);
		$criteria->compare('i_costo',$this->i_costo,true);
		$criteria->compare('i_precio1',$this->i_precio1,true);
		$criteria->compare('i_precio2',$this->i_precio2,true);
		$criteria->compare('i_precio3',$this->i_precio3,true);
		$criteria->compare('i_precio4',$this->i_precio4,true);
		$criteria->compare('i_precio5',$this->i_precio5,true);
		$criteria->compare('i_precio',$this->i_precio,true);
		$criteria->compare('i_porcendes',$this->i_porcendes,true);
		$criteria->compare('i_descuento',$this->i_descuento,true);
		$criteria->compare('i_subtotal',$this->i_subtotal,true);
		$criteria->compare('i_iva',$this->i_iva,true);
		$criteria->compare('i_total',$this->i_total,true);
		$criteria->compare('i_e_codigo',$this->i_e_codigo,true);
		$criteria->compare('i_vendedor',$this->i_vendedor,true);
		$criteria->compare('i_provincia',$this->i_provincia,true);
		$criteria->compare('i_fecha_ingreso',$this->i_fecha_ingreso,true);
		$criteria->compare('i_fecha_modificacion',$this->i_fecha_modificacion,true);
		$criteria->compare('i_usuario_ingresa_modifica',$this->i_usuario_ingresa_modifica);
		$criteria->compare('i_estado_icc',$this->i_estado_icc,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return IndicadoresModel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
