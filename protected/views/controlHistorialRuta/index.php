<?php
/* @var $this ControlHistorialRutaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Control Historial Ruta Models',
);

$this->menu=array(
	array('label'=>'Create ControlHistorialRutaModel', 'url'=>array('create')),
	array('label'=>'Manage ControlHistorialRutaModel', 'url'=>array('admin')),
);
?>

<h1>Control Historial Ruta Models</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
