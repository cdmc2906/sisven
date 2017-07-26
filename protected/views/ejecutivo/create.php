<?php
/* @var $this EjecutivoController */
/* @var $model EjecutivoModel */

$this->breadcrumbs=array(
	'Ejecutivo Models'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List EjecutivoModel', 'url'=>array('index')),
	array('label'=>'Manage EjecutivoModel', 'url'=>array('admin')),
);
?>

<h1>Create EjecutivoModel</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>