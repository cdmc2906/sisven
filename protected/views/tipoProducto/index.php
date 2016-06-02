<?php
/* @var $this TipoProductoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tipo Producto Models',
);

$this->menu=array(
	array('label'=>'Create TipoProductoModel', 'url'=>array('create')),
	array('label'=>'Manage TipoProductoModel', 'url'=>array('admin')),
);
?>

<h1>Tipo Producto Models</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
