<?php
/* @var $this TipoClienteController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tipo Cliente Models',
);

$this->menu=array(
	array('label'=>'Create TipoClienteModel', 'url'=>array('create')),
	array('label'=>'Manage TipoClienteModel', 'url'=>array('admin')),
);
?>

<h1>Tipo Cliente Models</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
