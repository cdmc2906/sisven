<?php
/* @var $this DetalleRevisionHistorialController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Detalle Revision Historial Models',
);

$this->menu=array(
	array('label'=>'Create DetalleRevisionHistorialModel', 'url'=>array('create')),
	array('label'=>'Manage DetalleRevisionHistorialModel', 'url'=>array('admin')),
);
?>

<h1>Detalle Revision Historial Models</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
