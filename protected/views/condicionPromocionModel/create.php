<?php
/* @var $this CondicionPromocionModelController */
/* @var $model CondicionPromocionModel */

$this->breadcrumbs=array(
	'Condicion Promocion Models'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CondicionPromocionModel', 'url'=>array('index')),
	array('label'=>'Manage CondicionPromocionModel', 'url'=>array('admin')),
);
?>

<h1>Create CondicionPromocionModel</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>