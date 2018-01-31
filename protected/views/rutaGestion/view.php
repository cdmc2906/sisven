<?php
/* @var $this RutaGestionController */
/* @var $model RutaGestionModel */

$this->breadcrumbs=array(
	'Ruta Gestion Models'=>array('index'),
	$model->rg_id,
);

$this->menu=array(
	array('label'=>'List RutaGestionModel', 'url'=>array('index')),
	array('label'=>'Create RutaGestionModel', 'url'=>array('create')),
	array('label'=>'Update RutaGestionModel', 'url'=>array('update', 'id'=>$model->rg_id)),
	array('label'=>'Delete RutaGestionModel', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->rg_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage RutaGestionModel', 'url'=>array('admin')),
);
?>

<h1>View RutaGestionModel #<?php echo $model->rg_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'rg_id',
		'zg_id',
		'rg_cod_ruta_mb',
		'rg_nombre_ruta',
		'rg_dia_visita',
		'rg_ejecutivo_visita',
		'rg_estado_ruta',
		'rg_fecha_ingreso',
		'rg_fecha_modifica',
		'rg_cod_usuario_ingresa_modifica',
	),
)); ?>
