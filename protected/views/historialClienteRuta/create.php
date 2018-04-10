<?php
/* @var $this HistorialClienteRutaController */
/* @var $model HistorialClienteRutaModel */

$this->breadcrumbs=array(
	'Historial Cliente Ruta Models'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List HistorialClienteRutaModel', 'url'=>array('index')),
	array('label'=>'Manage HistorialClienteRutaModel', 'url'=>array('admin')),
);
?>

<h1>Create HistorialClienteRutaModel</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>