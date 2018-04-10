<?php
/* @var $this DetalleRevisionHistorialController */
/* @var $model DetalleRevisionHistorialModel */

$this->breadcrumbs=array(
	'Detalle Revision Historial Models'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List DetalleRevisionHistorialModel', 'url'=>array('index')),
	array('label'=>'Create DetalleRevisionHistorialModel', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#detalle-revision-historial-model-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Detalle Revision Historial Models</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'detalle-revision-historial-model-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'drh_id',
		'pg_id',
		'drh_semana',
		'drh_tipo_historial',
		'drh_fecha_revision',
		'drh_fecha_ruta',
		/*
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
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
