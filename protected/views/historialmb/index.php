<?php
/* @var $this HistorialMbController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Historial Mb Models',
);

$this->menu=array(
	array('label'=>'Create HistorialMbModel', 'url'=>array('create')),
	array('label'=>'Manage HistorialMbModel', 'url'=>array('admin')),
);
?>

<h1>Historial Mb Models</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
