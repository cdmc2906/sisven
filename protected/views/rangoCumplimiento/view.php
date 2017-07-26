<?php
/* @var $this RangoCumplimientoController */
/* @var $model RangoCumplimientoModel */

$this->breadcrumbs=array(
	'Rango Cumplimiento Models'=>array('index'),
	$model->c_cod,
);

$this->menu=array(
	array('label'=>'List RangoCumplimientoModel', 'url'=>array('index')),
	array('label'=>'Create RangoCumplimientoModel', 'url'=>array('create')),
	array('label'=>'Update RangoCumplimientoModel', 'url'=>array('update', 'id'=>$model->c_cod)),
	array('label'=>'Delete RangoCumplimientoModel', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->c_cod),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage RangoCumplimientoModel', 'url'=>array('admin')),
);
?>

<h1>View RangoCumplimientoModel #<?php echo $model->c_cod; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'c_cod',
		'c_rango_min',
		'c_rango_max',
		'c_nombre_rango',
		'c_estado_rango',
		'c_fecha_ingreso',
		'c_fecha_modificacion',
		'c_codigo_usuario_ingresa',
		'c_codigo_usuario_modifica',
	),
)); ?>
