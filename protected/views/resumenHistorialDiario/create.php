<?php
/* @var $this ResumenHistorialDiarioController */
/* @var $model ResumenHistorialDiarioModel */

$this->breadcrumbs=array(
	'Resumen Historial Diario Models'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ResumenHistorialDiarioModel', 'url'=>array('index')),
	array('label'=>'Manage ResumenHistorialDiarioModel', 'url'=>array('admin')),
);
?>

<h1>Create ResumenHistorialDiarioModel</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>