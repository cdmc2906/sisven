<?php
/* @var $this TipoClienteController */
/* @var $model TipoClienteModel */

$this->breadcrumbs=array(
	'Tipo Cliente Models'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TipoClienteModel', 'url'=>array('index')),
	array('label'=>'Manage TipoClienteModel', 'url'=>array('admin')),
);
?>

<h1>Create TipoClienteModel</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>