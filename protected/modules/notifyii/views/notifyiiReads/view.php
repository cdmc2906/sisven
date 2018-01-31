<?php
/* @var $this NotifyiiReadsController */
/* @var $model NotifyiiReads */

$this->breadcrumbs=array(
	'Notificaciones Leidas'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Listar Notificaciones Leidas', 'url'=>array('index')),
	array('label'=>'Crear Notificaciones Leidas', 'url'=>array('create')),
	array('label'=>'Actualizar Notificaciones Leidas', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Borrar Notificaciones Leidas', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Administrar Notificaciones Leidas', 'url'=>array('admin')),
);
?>

<h1>Ver Notificacion Leida #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'username',
		'notification_id',
		'readed',
	),
)); ?>
