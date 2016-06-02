<?php
/* @var $this EstadoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Estado Models',
);

$this->menu=array(
	array('label'=>'Create EstadoModel', 'url'=>array('create')),
	array('label'=>'Manage EstadoModel', 'url'=>array('admin')),
);
?>

<h1>Estado Models</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
