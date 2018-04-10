<?php
/* @var $this HistorialClienteRutaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Historial Cliente Ruta Models',
);

$this->menu=array(
	array('label'=>'Create HistorialClienteRutaModel', 'url'=>array('create')),
	array('label'=>'Manage HistorialClienteRutaModel', 'url'=>array('admin')),
);
?>

<h1>Historial Cliente Ruta Models</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
