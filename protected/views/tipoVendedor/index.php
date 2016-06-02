<?php
/* @var $this TipoVendedorController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tipo Vendedor Models',
);

$this->menu=array(
	array('label'=>'Create TipoVendedorModel', 'url'=>array('create')),
	array('label'=>'Manage TipoVendedorModel', 'url'=>array('admin')),
);
?>

<h1>Tipo Vendedor Models</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
