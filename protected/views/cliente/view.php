<?php
/* @var $this ClienteController */
/* @var $model ClienteModel */

$this->breadcrumbs=array(
	'Cliente Models'=>array('index'),
	$model->cli_codigo,
);

$this->menu=array(
	array('label'=>'List ClienteModel', 'url'=>array('index')),
	array('label'=>'Create ClienteModel', 'url'=>array('create')),
	array('label'=>'Update ClienteModel', 'url'=>array('update', 'id'=>$model->cli_codigo)),
	array('label'=>'Delete ClienteModel', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->cli_codigo),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ClienteModel', 'url'=>array('admin')),
);
?>

<h1>View ClienteModel #<?php echo $model->cli_codigo; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'cli_codigo',
		'cli_codigo_cliente',
		'cli_nombre_cliente',
		'cli_tipo_de_identificacion',
		'cli_identificacion',
		'cli_nombre_de_compania',
		'cli_nombre_comercial',
		'cli_contacto',
		'cli_moneda',
		'cli_moneda_nombre',
		'cli_tipo_de_negocio',
		'cli_tipo_de_negocio_nombre',
		'cli_subcanal',
		'cli_subcanal_nombre',
		'cli_lista_de_precios',
		'cli_lista_de_precios_nombre',
		'cli_lista_de_precios_2',
		'cli_lista_de_precios_2_nombre',
		'cli_termino_de_pago',
		'cli_termino_de_pago_nombre',
		'cli_metodo_de_pago',
		'cli_metodo_de_pago_nombre',
		'cli_grupo',
		'cli_grupo_nombre',
		'cli_usuario',
		'cli_usuario_nombre',
		'cli_comentario',
		'cli_objetivo_de_venta',
		'cli_maximo_descuento_porcentaje',
		'cli_retencion_porcentaje',
		'cli_tiene_credito',
		'cli_estatus',
		'cli_creado',
		'cli_creado_por',
		'cli_latitud',
		'cli_longitud',
		'cli_estado',
		'cli_fecha_ingreso',
		'cli_fecha_modificacion',
		'cli_usuario_ingresa_modifica',
	),
)); ?>
