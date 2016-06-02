<?php
/* @var $this ProductoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Producto Models',
);

$this->menu=array(
	array('label'=>'Create ProductoModel', 'url'=>array('create')),
	array('label'=>'Manage ProductoModel', 'url'=>array('admin')),
);
?>

<h1>Producto Models</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
