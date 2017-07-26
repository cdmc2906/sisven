<?php
/* @var $this VentaMovistarController */
/* @var $model VentaMovistarModel */

$this->breadcrumbs=array(
	'Venta Movistar Models'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List VentaMovistarModel', 'url'=>array('index')),
	array('label'=>'Manage VentaMovistarModel', 'url'=>array('admin')),
);
?>

<h1>Create VentaMovistarModel</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>