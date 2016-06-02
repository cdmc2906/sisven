<?php
/* @var $this SucursalController */
/* @var $model SucursalModel */

$this->breadcrumbs=array(
	'Sucursal Models'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SucursalModel', 'url'=>array('index')),
	array('label'=>'Manage SucursalModel', 'url'=>array('admin')),
);
?>

<h1>Create SucursalModel</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>