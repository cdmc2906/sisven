<?php
/* @var $this PeriodoGestionController */
/* @var $model PeriodoGestionModel */

$this->breadcrumbs=array(
	'Periodo Gestion Models'=>array('index'),
	'Nuevo',
);

$this->menu=array(
	array('label'=>'List PeriodoGestionModel', 'url'=>array('index')),
	array('label'=>'Manage PeriodoGestionModel', 'url'=>array('admin')),
);
?>

<h1>Nuevo periodo de gestion</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>