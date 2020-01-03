<?php
/* @var $this PromocionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Promocion Models',
);

$this->menu=array(
	array('label'=>'Create PromocionModel', 'url'=>array('create')),
	array('label'=>'Manage PromocionModel', 'url'=>array('admin')),
);
?>

<h1>Promocion Models</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
