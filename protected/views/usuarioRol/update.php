<?php
/* @var $this UsuarioRolController */
/* @var $model UsuarioRolModel */

$this->breadcrumbs=array(
	'Usuario Rol Models'=>array('index'),
	$model->usrl_id=>array('view','id'=>$model->usrl_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List UsuarioRolModel', 'url'=>array('index')),
	array('label'=>'Create UsuarioRolModel', 'url'=>array('create')),
	array('label'=>'View UsuarioRolModel', 'url'=>array('view', 'id'=>$model->usrl_id)),
	array('label'=>'Manage UsuarioRolModel', 'url'=>array('admin')),
);
?>

<h1>Update UsuarioRolModel <?php echo $model->usrl_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>