<?php
/* @var $this ControlHistorialRutaController */
/* @var $model ControlHistorialRutaModel */

$this->breadcrumbs=array(
	'Control Historial Ruta Models'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ControlHistorialRutaModel', 'url'=>array('index')),
	array('label'=>'Manage ControlHistorialRutaModel', 'url'=>array('admin')),
);
?>

<h1>Create ControlHistorialRutaModel</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>