<?php
/* @var $this EncuestaController */
/* @var $model EncuestaModel */

$this->breadcrumbs=array(
	'Encuesta Models'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List EncuestaModel', 'url'=>array('index')),
	array('label'=>'Manage EncuestaModel', 'url'=>array('admin')),
);
?>

<h1>Create EncuestaModel</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>