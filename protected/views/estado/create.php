<?php
/* @var $this EstadoController */
/* @var $model EstadoModel */

$this->breadcrumbs=array(
	'Estado Models'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List EstadoModel', 'url'=>array('index')),
	array('label'=>'Manage EstadoModel', 'url'=>array('admin')),
);
?>

<h1>Create EstadoModel</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>