<?php
/* @var $this IndicadoresController */
/* @var $model IndicadoresModel */

$this->breadcrumbs=array(
	'Indicadores Models'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List IndicadoresModel', 'url'=>array('index')),
	array('label'=>'Create IndicadoresModel', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#indicadores-model-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Indicadores Models</h1>

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
	'id'=>'indicadores-model-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'i_codigo',
		'i_fecha',
		'i_sucursal',
		'i_numero_bodega',
		'i_bodega',
		'i_numero_serie',
		/*
		'i_numero_factura',
		'i_cod_cliente',
		'i_tipo_cliente',
		'i_nombre_cliente',
		'i_ruc',
		'i_direccion',
		'i_ciudad',
		'i_telefono',
		'i_codigo_producto',
		'i_descripcion_producto',
		'i_codigo_grupo',
		'i_grupo',
		'i_cantidad',
		'i_detalle',
		'i_imei',
		'i_min',
		'i_icc',
		'i_costo',
		'i_precio1',
		'i_precio2',
		'i_precio3',
		'i_precio4',
		'i_precio5',
		'i_precio',
		'i_porcendes',
		'i_descuento',
		'i_subtotal',
		'i_iva',
		'i_total',
		'i_e_codigo',
		'i_vendedor',
		'i_mes',
		'i_semana',
		'i_cedula',
		'i_listado_operadora',
		'i_provincia',
		'i_estatus',
		'i_fecha_ingreso',
		'i_fecha_modificacion',
		'i_usuario_ingresa_modifica',
		'i_estado_icc',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
