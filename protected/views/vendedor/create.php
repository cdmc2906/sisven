<?php
/* @var $this VendedorController */
/* @var $model VendedorModel */

$this->breadcrumbs=array(
	'Vendedor Models'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List VendedorModel', 'url'=>array('index')),
	array('label'=>'Manage VendedorModel', 'url'=>array('admin')),
);
?>

<h1>Create VendedorModel</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>