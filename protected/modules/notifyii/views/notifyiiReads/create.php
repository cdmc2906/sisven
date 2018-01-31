<?php
/* @var $this NotifyiiReadsController */
/* @var $model NotifyiiReads */

$this->breadcrumbs=array(
	'Notificaciones Leidas'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar Notificaciones Leidas', 'url'=>array('index')),
	array('label'=>'Administrar Notificaciones Leidas', 'url'=>array('admin')),
);
?>

<h1>Crear Notificaciones Leidas</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>