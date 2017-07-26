<?php
/* @var $this IndicadoresController */
/* @var $model IndicadoresModel */

$this->breadcrumbs=array(
	'Indicadores Models'=>array('index'),
	$model->i_codigo,
);

$this->menu=array(
	array('label'=>'List IndicadoresModel', 'url'=>array('index')),
	array('label'=>'Create IndicadoresModel', 'url'=>array('create')),
	array('label'=>'Update IndicadoresModel', 'url'=>array('update', 'id'=>$model->i_codigo)),
	array('label'=>'Delete IndicadoresModel', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->i_codigo),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage IndicadoresModel', 'url'=>array('admin')),
);
?>

<h1>View IndicadoresModel #<?php echo $model->i_codigo; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'i_codigo',
		'i_fecha',
		'i_sucursal',
		'i_numero_bodega',
		'i_bodega',
		'i_numero_serie',
		'i_numero_factura',
		'i_cod_cliente',
		'i_tipo_cliente',
		'i_nombre_cliente',
		'i_ruc',
		'i_direccion',
		'i_ciudad',
		'i_telefono',
		'i_codigo_producto',
		'i_descripcion_producto',
		'i_codigo_grupo',
		'i_grupo',
		'i_cantidad',
		'i_detalle',
		'i_imei',
		'i_min',
		'i_icc',
		'i_costo',
		'i_precio1',
		'i_precio2',
		'i_precio3',
		'i_precio4',
		'i_precio5',
		'i_precio',
		'i_porcendes',
		'i_descuento',
		'i_subtotal',
		'i_iva',
		'i_total',
		'i_e_codigo',
		'i_vendedor',
		'i_provincia',
		'i_fecha_ingreso',
		'i_fecha_modificacion',
		'i_usuario_ingresa_modifica',
		'i_estado_icc',
	),
)); ?>
