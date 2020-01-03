<?php
/* @var $this StockMovistarController */
/* @var $model StockMovistarModel */

$this->breadcrumbs=array(
	'Stock Movistar Models'=>array('index'),
	$model->sm_codigo,
);

$this->menu=array(
	array('label'=>'List StockMovistarModel', 'url'=>array('index')),
	array('label'=>'Create StockMovistarModel', 'url'=>array('create')),
	array('label'=>'Update StockMovistarModel', 'url'=>array('update', 'id'=>$model->sm_codigo)),
	array('label'=>'Delete StockMovistarModel', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->sm_codigo),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage StockMovistarModel', 'url'=>array('admin')),
);
?>

<h1>View StockMovistarModel #<?php echo $model->sm_codigo; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'sm_codigo',
		'pg_id',
		'sm_distribuidor_id',
		'sm_nombre_del_distribuidor',
		'sm_zona',
		'sm_provincia',
		'sm_ciudad',
		'sm_principal_distribuidor_id',
		'sm_nombre_del_distribuidor_principal',
		'sm_tipo_de_codigo_de_sim',
		'sm_sim_inventario_saldo',
		'sm_estado_de_sim',
		'sm_fecha_ingreso',
		'sm_fecha_modifica',
		'sm_usuario_ingresa_modifica',
		'sm_numero_carga',
		'sm_estado',
	),
)); ?>
