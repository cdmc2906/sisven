<?php
/* @var $this RutaMbController */
/* @var $model RutaMbModel */

$this->breadcrumbs=array(
	'Ruta Mb Models'=>array('index'),
	$model->r_cod,
);

$this->menu=array(
	array('label'=>'List RutaMbModel', 'url'=>array('index')),
	array('label'=>'Create RutaMbModel', 'url'=>array('create')),
	array('label'=>'Update RutaMbModel', 'url'=>array('update', 'id'=>$model->r_cod)),
	array('label'=>'Delete RutaMbModel', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->r_cod),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage RutaMbModel', 'url'=>array('admin')),
);
?>

<h1>View RutaMbModel #<?php echo $model->r_cod; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'r_cod',
		'r_ruta',
		'r_cod_cliente',
		'r_nom_cliente',
		'r_cod_direccion',
		'r_direccion',
		'r_referencia',
		'r_semana',
		'r_dia',
		'r_secuencia',
		'r_estatus',
		'r_fch_ingreso',
		'r_fch_modificacion',
		'r_fch_desde',
		'r_fch_hasta',
		'r_usuario_ing_mod',
	),
)); ?>
