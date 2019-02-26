<?php
/* @var $this ClienteDireccionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Cliente Direccion Models',
);

$this->menu=array(
	array('label'=>'Create ClienteDireccionModel', 'url'=>array('create')),
	array('label'=>'Manage ClienteDireccionModel', 'url'=>array('admin')),
);
?>

<h1>Cliente Direccion Models</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
