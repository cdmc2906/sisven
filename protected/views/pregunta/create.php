<?php
/* @var $this PreguntaController */
/* @var $model PreguntaModel */

$this->breadcrumbs=array(
	'Pregunta Models'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List PreguntaModel', 'url'=>array('index')),
	array('label'=>'Manage PreguntaModel', 'url'=>array('admin')),
);
?>

<h1>Create PreguntaModel</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>