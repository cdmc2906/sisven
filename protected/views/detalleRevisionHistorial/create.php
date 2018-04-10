<?php
/* @var $this DetalleRevisionHistorialController */
/* @var $model DetalleRevisionHistorialModel */

$this->breadcrumbs=array(
	'Detalle Revision Historial Models'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List DetalleRevisionHistorialModel', 'url'=>array('index')),
	array('label'=>'Manage DetalleRevisionHistorialModel', 'url'=>array('admin')),
);
?>

<h1>Create DetalleRevisionHistorialModel</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>