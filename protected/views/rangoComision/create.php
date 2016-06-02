<?php
/* @var $this RangoComisionController */
/* @var $model RangoComisionModel */

$this->breadcrumbs=array(
	'Rango Comision Models'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List RangoComisionModel', 'url'=>array('index')),
	array('label'=>'Manage RangoComisionModel', 'url'=>array('admin')),
);
?>

<h1>Create RangoComisionModel</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>