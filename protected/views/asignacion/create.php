<?php
/* @var $this AsignacionController */
/* @var $model AsignacionModel */

$this->breadcrumbs=array(
	'Asignacion Models'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List AsignacionModel', 'url'=>array('index')),
	array('label'=>'Manage AsignacionModel', 'url'=>array('admin')),
);
?>

<h1>Create AsignacionModel</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>