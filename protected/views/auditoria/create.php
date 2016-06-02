<?php
/* @var $this AuditoriaController */
/* @var $model AuditoriaModel */

$this->breadcrumbs=array(
	'Auditoria Models'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List AuditoriaModel', 'url'=>array('index')),
	array('label'=>'Manage AuditoriaModel', 'url'=>array('admin')),
);
?>

<h1>Create AuditoriaModel</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>