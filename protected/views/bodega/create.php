<?php
/* @var $this BodegaController */
/* @var $model BodegaModel */

$this->breadcrumbs=array(
	'Bodega Models'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List BodegaModel', 'url'=>array('index')),
	array('label'=>'Manage BodegaModel', 'url'=>array('admin')),
);
?>

<h1>Create BodegaModel</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>