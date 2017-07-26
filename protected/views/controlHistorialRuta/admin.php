<?php
/* @var $this ControlHistorialRutaController */
/* @var $model ControlHistorialRutaModel */

$this->breadcrumbs=array(
	'Control Historial Ruta Models'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List ControlHistorialRutaModel', 'url'=>array('index')),
	array('label'=>'Create ControlHistorialRutaModel', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#control-historial-ruta-model-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Control Historial Ruta Models</h1>

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
	'id'=>'control-historial-ruta-model-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'rh_id',
		'rh_item',
		'rh_fecha_item',
		'rh_fecha_revision',
		'rh_codigo_vendedor',
		'rh_cod_cliente',
		/*
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
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
