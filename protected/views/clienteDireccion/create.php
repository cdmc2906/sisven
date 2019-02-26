<?php
/* @var $this ClienteDireccionController */
/* @var $model ClienteDireccionModel */

$this->breadcrumbs=array(
	'Cliente Direccion Models'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ClienteDireccionModel', 'url'=>array('index')),
	array('label'=>'Manage ClienteDireccionModel', 'url'=>array('admin')),
);
?>

<h1>Create ClienteDireccionModel</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>