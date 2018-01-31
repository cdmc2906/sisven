<?php
/* @var $this NotifyiiController */
/* @var $model Notifyii */

$this->breadcrumbs=array(
	'Notificaciones'=>array('index'),
	'Creacion',
);

$this->menu=array(
	array('label'=>'Listar Notificaciones', 'url'=>array('index')),
	array('label'=>'Administrar Notificaciones', 'url'=>array('admin')),
);
?>

<h1>Creacion de Notificacion</h1>

<div class="box">
    <h3>En esta página usted puede crear su notitication.</h3>
</div>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
