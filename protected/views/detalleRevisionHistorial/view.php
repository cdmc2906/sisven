<?php
/* @var $this DetalleRevisionHistorialController */
/* @var $model DetalleRevisionHistorialModel */

$this->breadcrumbs=array(
	'Detalle Revision Historial Models'=>array('index'),
	$model->drh_id,
);

$this->menu=array(
	array('label'=>'List DetalleRevisionHistorialModel', 'url'=>array('index')),
	array('label'=>'Create DetalleRevisionHistorialModel', 'url'=>array('create')),
	array('label'=>'Update DetalleRevisionHistorialModel', 'url'=>array('update', 'id'=>$model->drh_id)),
	array('label'=>'Delete DetalleRevisionHistorialModel', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->drh_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage DetalleRevisionHistorialModel', 'url'=>array('admin')),
);
?>

<h1>View DetalleRevisionHistorialModel #<?php echo $model->drh_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'drh_id',
		'pg_id',
		'drh_semana',
		'drh_tipo_historial',
		'drh_fecha_revision',
		'drh_fecha_ruta',
		'drh_codigo_ejecutivo',
		'drh_nombre_ejecutivo',
		'drh_codigo_cliente',
		'drh_nombre_cliente',
		'drh_ruta_usada',
		'drh_secuencia_visita',
		'drh_ruta_cliente',
		'drh_secuencia_ruta',
		'drh_estado_revision_ruta',
		'drh_estado_revision_sec',
		'drh_cantidad_chips_venta',
		'drh_metros',
		'drh_precision_usada',
		'drh_validacion',
		'drh_latitud_cliente',
		'drh_longitud_cliente',
		'drh_latitud_visita',
		'drh_longitud_visita',
		'drh_inicio_visita',
		'drh_fin_visita',
		'drh_tiempo_gestion',
		'drh_tiempo_traslado',
		'drh_distancia_cli_eje',
		'drh_distancia_cli_anterior',
		'drh_fch_ingreso',
		'drh_fch_modifica',
		'drh_cod_usr_ing_mod',
	),
)); ?>
