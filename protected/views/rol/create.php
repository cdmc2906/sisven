<?php
/* @var $this RolController */
/* @var $model RolModel */

$this->breadcrumbs=array(
	'Rol Models'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List RolModel', 'url'=>array('index')),
	array('label'=>'Manage RolModel', 'url'=>array('admin')),
);
?>

<h1>Create RolModel</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>