<?php
/* @var $this DetalleHistorialDiarioController */
/* @var $model DetalleHistorialDiarioModel */

$this->breadcrumbs=array(
	'Detalle Historial Diario Models'=>array('index'),
	$model->rh_id,
);

$this->menu=array(
	array('label'=>'List DetalleHistorialDiarioModel', 'url'=>array('index')),
	array('label'=>'Create DetalleHistorialDiarioModel', 'url'=>array('create')),
	array('label'=>'Update DetalleHistorialDiarioModel', 'url'=>array('update', 'id'=>$model->rh_id)),
	array('label'=>'Delete DetalleHistorialDiarioModel', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->rh_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage DetalleHistorialDiarioModel', 'url'=>array('admin')),
);
?>

<h1>View DetalleHistorialDiarioModel #<?php echo $model->rh_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'rh_id',
		'rh_item',
		'rh_fecha_item',
		'rh_fecha_revision',
		'rh_codigo_vendedor',
		'rh_cod_cliente',
		'rh_ruta_visita',
		'rh_orden_visita',
		'rh_ruta_ejecutivo',
		'rh_secuencia_ruta',
		'rh_observacion_ruta',
		'rh_observacion_secuencia',
		'rh_chips_compra',
		'rh_metros',
		'rh_validacion',
		'rh_precision',
		'rh_latitud_cliente',
		'rh_longitud_cliente',
		'rh_latitud_historial',
		'rh_longitud_historial',
		'rh_estado',
		'rh_fecha_ingreso',
		'rh_fecha_modificacion',
		'rh_usuario_revisa',
		'rh_fecha_ruta',
		'rh_cliente',
	),
)); ?>
