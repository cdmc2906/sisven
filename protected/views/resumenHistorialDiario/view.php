<?php
/* @var $this ResumenHistorialDiarioController */
/* @var $model ResumenHistorialDiarioModel */

$this->breadcrumbs=array(
	'Resumen Historial Diario Models'=>array('index'),
	$model->rhd_id,
);

$this->menu=array(
	array('label'=>'List ResumenHistorialDiarioModel', 'url'=>array('index')),
	array('label'=>'Create ResumenHistorialDiarioModel', 'url'=>array('create')),
	array('label'=>'Update ResumenHistorialDiarioModel', 'url'=>array('update', 'id'=>$model->rhd_id)),
	array('label'=>'Delete ResumenHistorialDiarioModel', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->rhd_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ResumenHistorialDiarioModel', 'url'=>array('admin')),
);
?>

<h1>View ResumenHistorialDiarioModel #<?php echo $model->rhd_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'rhd_id',
		'pg_id',
		'rhd_cod_ejecutivo',
		'rhd_fecha_historial',
		'rhd_parametro',
		'rhd_valor',
		'rhd_semana',
		'rhd_tipo',
		'rhd_estado',
		'rhd_orden',
		'rhd_fecha_ingreso',
		'rhd_fecha_modificacion',
		'rhd_usuario_ingresa_modifica',
	),
)); ?>
