<?php
/* @var $this ComentarioOficinaController */
/* @var $model ComentarioOficinaModel */

$this->breadcrumbs=array(
	'Comentario Oficina Models'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ComentarioOficinaModel', 'url'=>array('index')),
	array('label'=>'Manage ComentarioOficinaModel', 'url'=>array('admin')),
);
?>

<h1>Create ComentarioOficinaModel</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>