<?php
/* @var $this ResumenHistorialDiarioController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Resumen Historial Diario Models',
);

$this->menu=array(
	array('label'=>'Create ResumenHistorialDiarioModel', 'url'=>array('create')),
	array('label'=>'Manage ResumenHistorialDiarioModel', 'url'=>array('admin')),
);
?>

<h1>Resumen Historial Diario Models</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
