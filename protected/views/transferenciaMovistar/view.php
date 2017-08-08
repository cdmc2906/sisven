<?php
/* @var $this TransferenciaMovistarController */
/* @var $model TransferenciaMovistarModel */

$this->breadcrumbs=array(
	'Transferencia Movistar Models'=>array('index'),
	$model->tm_codigo,
);

$this->menu=array(
	array('label'=>'List TransferenciaMovistarModel', 'url'=>array('index')),
	array('label'=>'Create TransferenciaMovistarModel', 'url'=>array('create')),
	array('label'=>'Update TransferenciaMovistarModel', 'url'=>array('update', 'id'=>$model->tm_codigo)),
	array('label'=>'Delete TransferenciaMovistarModel', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->tm_codigo),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TransferenciaMovistarModel', 'url'=>array('admin')),
);
?>

<h1>View TransferenciaMovistarModel #<?php echo $model->tm_codigo; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'tm_codigo',
		'tm_fecha',
		'tm_codigotransferencia',
		'tm_iddistribuidor',
		'tm_nombredistribuidor',
		'tm_codigoscl',
		'tm_inventarioanteriorfuente',
		'tm_inventarioactualfuente',
		'tm_tiposim',
		'tm_icc',
		'tm_min',
		'tm_estado',
		'tm_iddestino',
		'tm_nombredestino',
		'tm_inventarioanteriordestino',
		'tm_inventarioactualdestino',
		'tm_canal',
		'tm_numero_lote',
		'tm_zona',
		'tm_fecha_ingreso',
		'tm_fecha_modifica',
		'tm_usuario_ingresa_modifica',
	),
)); ?>
