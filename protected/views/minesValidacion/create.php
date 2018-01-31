<?php
/* @var $this MinesValidacionController */
/* @var $model MinesValidacionModel */

$this->breadcrumbs=array(
	'Mines Validacion Models'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List MinesValidacionModel', 'url'=>array('index')),
	array('label'=>'Manage MinesValidacionModel', 'url'=>array('admin')),
);
?>

<h1>Create MinesValidacionModel</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>