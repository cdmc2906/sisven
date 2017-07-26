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
		'cli_latitud',
		'cli_longitud',
		'cli_estado',
		'cli_fecha_ingreso',
		'cli_fecha_modificacion',
		'cli_usuario_ingresa_modifica',
	),
)); ?>
