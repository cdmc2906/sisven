<?php
/* @var $this RevisionMinesController */
/* @var $model RevisionMinesModel */

$this->breadcrumbs=array(
	'Revision Mines Models'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List RevisionMinesModel', 'url'=>array('index')),
	array('label'=>'Manage RevisionMinesModel', 'url'=>array('admin')),
);
?>

<h1>Create RevisionMinesModel</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>