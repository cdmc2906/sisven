<?php
/* @var $this DetalleHistorialDiarioController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Detalle Historial Diario Models',
);

$this->menu=array(
	array('label'=>'Create DetalleHistorialDiarioModel', 'url'=>array('create')),
	array('label'=>'Manage DetalleHistorialDiarioModel', 'url'=>array('admin')),
);
?>

<h1>Detalle Historial Diario Models</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
