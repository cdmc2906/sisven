<?php
/* @var $this RangoCumplimientoController */
/* @var $model RangoCumplimientoModel */

$this->breadcrumbs=array(
	'Rango Cumplimiento Models'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List RangoCumplimientoModel', 'url'=>array('index')),
	array('label'=>'Manage RangoCumplimientoModel', 'url'=>array('admin')),
);
?>

<h1>Create RangoCumplimientoModel</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>