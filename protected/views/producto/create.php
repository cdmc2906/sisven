<?php
/* @var $this ProductoController */
/* @var $model ProductoModel */

$this->breadcrumbs=array(
	'Producto Models'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ProductoModel', 'url'=>array('index')),
	array('label'=>'Manage ProductoModel', 'url'=>array('admin')),
);
?>

<h1>Create ProductoModel</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>