<?php
/* @var $this VendedorController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Vendedor Models',
);

$this->menu=array(
	array('label'=>'Create VendedorModel', 'url'=>array('create')),
	array('label'=>'Manage VendedorModel', 'url'=>array('admin')),
);
?>

<h1>Vendedor Models</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
