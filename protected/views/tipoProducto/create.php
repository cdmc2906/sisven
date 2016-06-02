<?php
/* @var $this TipoProductoController */
/* @var $model TipoProductoModel */

$this->breadcrumbs=array(
	'Tipo Producto Models'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TipoProductoModel', 'url'=>array('index')),
	array('label'=>'Manage TipoProductoModel', 'url'=>array('admin')),
);
?>

<h1>Create TipoProductoModel</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>