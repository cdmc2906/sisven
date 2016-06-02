<?php
/* @var $this EstadoController */
/* @var $model EstadoModel */

$this->breadcrumbs=array(
	'Estado Models'=>array('index'),
	$model->ID_EST,
);

$this->menu=array(
	array('label'=>'List EstadoModel', 'url'=>array('index')),
	array('label'=>'Create EstadoModel', 'url'=>array('create')),
	array('label'=>'Update EstadoModel', 'url'=>array('update', 'id'=>$model->ID_EST)),
	array('label'=>'Delete EstadoModel', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID_EST),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage EstadoModel', 'url'=>array('admin')),
);
?>

<h1>View EstadoModel #<?php echo $model->ID_EST; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID_EST',
		'NOMBRE_EST',
		'FECHAINGRESO_EST',
		'FECHAMODIFICACION_EST',
	),
)); ?>
