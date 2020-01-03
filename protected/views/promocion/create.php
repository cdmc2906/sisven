<?php
/* @var $this PromocionController */
/* @var $model PromocionModel */

$this->breadcrumbs=array(
	'Promocion Models'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List PromocionModel', 'url'=>array('index')),
	array('label'=>'Manage PromocionModel', 'url'=>array('admin')),
);
?>

<h1>Create PromocionModel</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>