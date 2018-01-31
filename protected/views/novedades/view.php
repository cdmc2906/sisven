<?php
/* @var $this NovedadesController */
/* @var $model NovedadesModel */

$this->breadcrumbs=array(
	'Novedades Models'=>array('index'),
	$model->nov_id,
);

$this->menu=array(
	array('label'=>'List NovedadesModel', 'url'=>array('index')),
	array('label'=>'Create NovedadesModel', 'url'=>array('create')),
	array('label'=>'Update NovedadesModel', 'url'=>array('update', 'id'=>$model->nov_id)),
	array('label'=>'Delete NovedadesModel', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->nov_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage NovedadesModel', 'url'=>array('admin')),
);
?>

<h1>View NovedadesModel #<?php echo $model->nov_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'nov_id',
		'gno_id',
		'nov_descripcion',
		'nov_estado',
		'nov_fecha_ingreso',
		'nov_fecha_modifica',
		'nov_cod_usuario_ingresa_modifica',
	),
)); ?>
