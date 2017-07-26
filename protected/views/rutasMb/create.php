<?php
/* @var $this RutaMbController */
/* @var $model RutaMbModel */

$this->breadcrumbs=array(
	'Ruta Mb Models'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List RutaMbModel', 'url'=>array('index')),
	array('label'=>'Manage RutaMbModel', 'url'=>array('admin')),
);
?>

<h1>Create RutaMbModel</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>