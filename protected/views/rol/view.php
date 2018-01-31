<?php
/* @var $this RolController */
/* @var $model RolModel */

$this->breadcrumbs=array(
	'Rol Models'=>array('index'),
	$model->r_id,
);

$this->menu=array(
	array('label'=>'List RolModel', 'url'=>array('index')),
	array('label'=>'Create RolModel', 'url'=>array('create')),
	array('label'=>'Update RolModel', 'url'=>array('update', 'id'=>$model->r_id)),
	array('label'=>'Delete RolModel', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->r_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage RolModel', 'url'=>array('admin')),
);
?>

<h1>View RolModel #<?php echo $model->r_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'r_id',
		'r_nombre_rol',
		'r_estado',
		'r_fecha_ingreso',
		'r_fecha_modifica',
		'r_cod_usuario_ing_mod',
	),
)); ?>
