<?php
/* @var $this ControlHistorialRutaController */
/* @var $model ControlHistorialRutaModel */

$this->breadcrumbs=array(
	'Control Historial Ruta Models'=>array('index'),
	$model->rh_id,
);

$this->menu=array(
	array('label'=>'List ControlHistorialRutaModel', 'url'=>array('index')),
	array('label'=>'Create ControlHistorialRutaModel', 'url'=>array('create')),
	array('label'=>'Update ControlHistorialRutaModel', 'url'=>array('update', 'id'=>$model->rh_id)),
	array('label'=>'Delete ControlHistorialRutaModel', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->rh_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ControlHistorialRutaModel', 'url'=>array('admin')),
);
?>

<h1>View ControlHistorialRutaModel #<?php echo $model->rh_id; ?></h1>

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
		'rh_estado',
		'rh_fecha_ingreso',
		'rh_fecha_modificacion',
		'rh_usuario_revisa',
	),
)); ?>
