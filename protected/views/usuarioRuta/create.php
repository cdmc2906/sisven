<?php
/* @var $this UsuarioRutaController */
/* @var $model UsuarioRutaModel */

$this->breadcrumbs=array(
	'Usuario Ruta Models'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UsuarioRutaModel', 'url'=>array('index')),
	array('label'=>'Manage UsuarioRutaModel', 'url'=>array('admin')),
);
?>

<h1>Create UsuarioRutaModel</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>