<?php
/* @var $this ComentarioSupervisionController */
/* @var $model ComentarioSupervisionModel */

$this->breadcrumbs=array(
	'Comentario Supervision Models'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ComentarioSupervisionModel', 'url'=>array('index')),
	array('label'=>'Manage ComentarioSupervisionModel', 'url'=>array('admin')),
);
?>

<h1>Create ComentarioSupervisionModel</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>