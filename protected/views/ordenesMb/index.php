<?php
/* @var $this OrdenesMbController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Ordenes Mb Models',
);

$this->menu=array(
	array('label'=>'Create OrdenesMbModel', 'url'=>array('create')),
	array('label'=>'Manage OrdenesMbModel', 'url'=>array('admin')),
);
?>

<h1>Ordenes Mb Models</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
