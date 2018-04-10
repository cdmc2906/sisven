<?php
/* @var $this HistorialMbController */
/* @var $model HistorialMbModel */

$this->breadcrumbs=array(
	'Historial Mb Models'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List HistorialMbModel', 'url'=>array('index')),
	array('label'=>'Manage HistorialMbModel', 'url'=>array('admin')),
);
?>

<h1>Create HistorialMbModel</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>