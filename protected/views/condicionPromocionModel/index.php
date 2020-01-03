<?php
/* @var $this CondicionPromocionModelController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Condicion Promocion Models',
);

$this->menu=array(
	array('label'=>'Create CondicionPromocionModel', 'url'=>array('create')),
	array('label'=>'Manage CondicionPromocionModel', 'url'=>array('admin')),
);
?>

<h1>Condicion Promocion Models</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
