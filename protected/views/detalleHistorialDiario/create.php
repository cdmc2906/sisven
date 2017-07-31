<?php
/* @var $this DetalleHistorialDiarioController */
/* @var $model DetalleHistorialDiarioModel */

$this->breadcrumbs=array(
	'Detalle Historial Diario Models'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List DetalleHistorialDiarioModel', 'url'=>array('index')),
	array('label'=>'Manage DetalleHistorialDiarioModel', 'url'=>array('admin')),
);
?>

<h1>Create DetalleHistorialDiarioModel</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>