<?php
/* @var $this NotifyiiReadsController */
/* @var $model NotifyiiReads */

$this->breadcrumbs=array(
	'Notificaciones Leidas'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'List Notificaciones Leidas', 'url'=>array('index')),
	array('label'=>'Crear Notificaciones Leidas', 'url'=>array('create')),
	array('label'=>'Ver Notificaciones Leidas', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Administrar Notificaciones Leidas', 'url'=>array('admin')),
);
?>

<h1>Update NotifyiiReads <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>