<?php
/* @var $this EjecutivoRutaController */
/* @var $model EjecutivoRutaModel */

$this->breadcrumbs=array(
	'Ejecutivo Ruta Models'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List EjecutivoRutaModel', 'url'=>array('index')),
	array('label'=>'Manage EjecutivoRutaModel', 'url'=>array('admin')),
);
?>

<h1>Create EjecutivoRutaModel</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>