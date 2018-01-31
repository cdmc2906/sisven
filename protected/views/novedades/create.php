<?php
/* @var $this NovedadesController */
/* @var $model NovedadesModel */

$this->breadcrumbs=array(
	'Novedades Models'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List NovedadesModel', 'url'=>array('index')),
	array('label'=>'Manage NovedadesModel', 'url'=>array('admin')),
);
?>

<h1>Create NovedadesModel</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>