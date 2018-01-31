<?php
/* @var $this ZonasGestionController */
/* @var $model ZonasGestionModel */

$this->breadcrumbs=array(
	'Zonas Gestion Models'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ZonasGestionModel', 'url'=>array('index')),
	array('label'=>'Manage ZonasGestionModel', 'url'=>array('admin')),
);
?>

<h1>Create ZonasGestionModel</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>