<?php
/* @var $this ZonasGestionController */
/* @var $model ZonasGestionModel */

$this->breadcrumbs=array(
	'Zonas Gestion Models'=>array('index'),
	$model->zg_id,
);

$this->menu=array(
	array('label'=>'List ZonasGestionModel', 'url'=>array('index')),
	array('label'=>'Create ZonasGestionModel', 'url'=>array('create')),
	array('label'=>'Update ZonasGestionModel', 'url'=>array('update', 'id'=>$model->zg_id)),
	array('label'=>'Delete ZonasGestionModel', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->zg_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ZonasGestionModel', 'url'=>array('admin')),
);
?>

<h1>View ZonasGestionModel #<?php echo $model->zg_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'zg_id',
		'zg_nombre_zona',
		'zg_cod_ejecutivo_asignado',
		'zg_nomb_ejecutivo_asignado',
		'zg_estado_zona',
		'zg_fecha_ingreso',
		'zg_fecha_modifica',
		'zg_cod_usuario_ingresa_modifica',
	),
)); ?>
