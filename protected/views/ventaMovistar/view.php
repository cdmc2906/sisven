<?php
/* @var $this VentaMovistarController */
/* @var $model VentaMovistarModel */

$this->breadcrumbs=array(
	'Venta Movistar Models'=>array('index'),
	$model->vm_cod,
);

$this->menu=array(
	array('label'=>'List VentaMovistarModel', 'url'=>array('index')),
	array('label'=>'Create VentaMovistarModel', 'url'=>array('create')),
	array('label'=>'Update VentaMovistarModel', 'url'=>array('update', 'id'=>$model->vm_cod)),
	array('label'=>'Delete VentaMovistarModel', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->vm_cod),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage VentaMovistarModel', 'url'=>array('admin')),
);
?>

<h1>View VentaMovistarModel #<?php echo $model->vm_cod; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'vm_cod',
		'vm_fecha',
		'vm_transaccion',
		'vm_distribuidor',
		'vm_nombredistribuidor',
		'vm_codigoscl',
		'vm_inventarioanteriorfuente',
		'vm_inventarioactualfuente',
		'vm_tiposim',
		'vm_icc',
		'vm_min',
		'vm_estado',
		'vm_iddestino',
		'vm_nombredestino',
		'vm_inventarioanteriordestino',
		'vm_inventarioactualdestino',
		'vm_canal',
		'vm_lote',
		'vm_zona',
		'vm_fecha_ingreso',
		'vm_fecha_modificacion',
		'vm_usuario_ingresa_modifica',
		'vm_estado_icc',
	),
)); ?>
