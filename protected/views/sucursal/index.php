<?php
/* @var $this SucursalController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Sucursal Models',
);

$this->menu=array(
	array('label'=>'Create SucursalModel', 'url'=>array('create')),
	array('label'=>'Manage SucursalModel', 'url'=>array('admin')),
);
?>

<h1>Sucursal Models</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
