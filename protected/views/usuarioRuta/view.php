<?php
/* @var $this UsuarioRutaController */
/* @var $model UsuarioRutaModel */

$this->breadcrumbs=array(
	'Usuario Ruta Models'=>array('index'),
	$model->ur_id,
);

$this->menu=array(
	array('label'=>'List UsuarioRutaModel', 'url'=>array('index')),
	array('label'=>'Create UsuarioRutaModel', 'url'=>array('create')),
	array('label'=>'Update UsuarioRutaModel', 'url'=>array('update', 'id'=>$model->ur_id)),
	array('label'=>'Delete UsuarioRutaModel', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ur_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UsuarioRutaModel', 'url'=>array('admin')),
);
?>

<h1>View UsuarioRutaModel #<?php echo $model->ur_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ur_id',
		'rg_id',
		'iduser',
		'ur_nombre_ejecutivo',
		'ur_estado',
		'ur_zona_gestion',
		'ur_fecha_ingreso',
		'ur_fecha_modifica',
		'ur_cod_usuario_ingresa_modifica',
	),
)); ?>
