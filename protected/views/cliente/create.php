<?php
/* @var $this ClienteController */
/* @var $model ClienteModel */

$this->breadcrumbs=array(
	'Cliente Models'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ClienteModel', 'url'=>array('index')),
	array('label'=>'Manage ClienteModel', 'url'=>array('admin')),
);
?>

<h1>Create ClienteModel</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>