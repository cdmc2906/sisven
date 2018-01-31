<?php
/* @var $this UsuarioRolController */
/* @var $model UsuarioRolModel */

$this->breadcrumbs=array(
	'Usuario Rol Models'=>array('index'),
	$model->usrl_id,
);

$this->menu=array(
	array('label'=>'List UsuarioRolModel', 'url'=>array('index')),
	array('label'=>'Create UsuarioRolModel', 'url'=>array('create')),
	array('label'=>'Update UsuarioRolModel', 'url'=>array('update', 'id'=>$model->usrl_id)),
	array('label'=>'Delete UsuarioRolModel', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->usrl_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UsuarioRolModel', 'url'=>array('admin')),
);
?>

<h1>View UsuarioRolModel #<?php echo $model->usrl_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'usrl_id',
		'iduser',
		'r_id',
		'usrl_estado',
		'usrl_fecha_ingreso',
		'usrl_fecha_modifica',
		'usrl_cod_usuario_ing_mod',
		'usrl_nombre_usuario',
	),
)); ?>
