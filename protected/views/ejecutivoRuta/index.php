<?php
/* @var $this EjecutivoRutaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Ejecutivo Ruta Models',
);

$this->menu=array(
	array('label'=>'Create EjecutivoRutaModel', 'url'=>array('create')),
	array('label'=>'Manage EjecutivoRutaModel', 'url'=>array('admin')),
);
?>

<h1>Ejecutivo Ruta Models</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
