<?php
/* @var $this TipoVendedorController */
/* @var $model TipoVendedorModel */

$this->breadcrumbs=array(
	'Tipo Vendedor Models'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TipoVendedorModel', 'url'=>array('index')),
	array('label'=>'Manage TipoVendedorModel', 'url'=>array('admin')),
);
?>

<h1>Create TipoVendedorModel</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>