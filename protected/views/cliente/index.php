<?php
/* @var $this ClienteController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Cliente Models',
);

$this->menu=array(
	array('label'=>'Create ClienteModel', 'url'=>array('create')),
	array('label'=>'Manage ClienteModel', 'url'=>array('admin')),
);
?>

<h1>Cliente Models</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
