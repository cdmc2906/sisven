<?php
/* @var $this ComentarioSupervisionController */
/* @var $model ComentarioSupervisionModel */

$this->breadcrumbs=array(
	'Comentario Supervision Models'=>array('index'),
	'Crear',
);

$this->menu=array(
//	array('label'=>'List ComentarioSupervisionModel', 'url'=>array('index')),
	array('label'=>'Administrar Comentarios Supervision', 'url'=>array('admin')),
);
?>

<h1>Ingresar Comentario Supervisor</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>