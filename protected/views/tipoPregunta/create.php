<?php
/* @var $this TipoPreguntaController */
/* @var $model TipoPreguntaModel */

$this->breadcrumbs=array(
	'Tipo Pregunta Models'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TipoPreguntaModel', 'url'=>array('index')),
	array('label'=>'Manage TipoPreguntaModel', 'url'=>array('admin')),
);
?>

<h1>Create TipoPreguntaModel</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>