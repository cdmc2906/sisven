<?php
/* @var $this UsuarioRolController */
/* @var $model UsuarioRolModel */

$this->breadcrumbs=array(
	'Usuario Rol Models'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UsuarioRolModel', 'url'=>array('index')),
	array('label'=>'Manage UsuarioRolModel', 'url'=>array('admin')),
);
?>

<h1>Create UsuarioRolModel</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>