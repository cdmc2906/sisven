<?php
/* @var $this NotifyiiController */
/* @var $model Notifyii */

$this->breadcrumbs=array(
	'Notificaciones'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Actualizaci�n',
);

$this->menu=array(
	array('label'=>'Listar Notificaciones', 'url'=>array('index')),
	array('label'=>'Crear Notificaciones', 'url'=>array('create')),
	array('label'=>'Ver Notificaciones', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Administrar Notificaciones', 'url'=>array('admin')),
);
?>

<h1>Actualizar Notificaci�n (<?php echo $model->id; ?>)</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>