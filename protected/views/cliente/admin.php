<?php
/* @var $this ClienteController */
/* @var $model ClienteModel */

$this->breadcrumbs=array(
	'Cliente Models'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List ClienteModel', 'url'=>array('index')),
	array('label'=>'Create ClienteModel', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#cliente-model-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Cliente Models</h1>

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
	'id'=>'cliente-model-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'cli_codigo',
		'cli_codigo_cliente',
		'cli_nombre_cliente',
		'cli_tipo_de_identificacion',
		'cli_identificacion',
		'cli_nombre_de_compania',
		/*
		'cli_nombre_comercial',
		'cli_contacto',
		'cli_moneda',
		'cli_moneda_nombre',
		'cli_tipo_de_negocio',
		'cli_tipo_de_negocio_nombre',
		'cli_subcanal',
		'cli_subcanal_nombre',
		'cli_lista_de_precios',
		'cli_lista_de_precios_nombre',
		'cli_lista_de_precios_2',
		'cli_lista_de_precios_2_nombre',
		'cli_termino_de_pago',
		'cli_termino_de_pago_nombre',
		'cli_metodo_de_pago',
		'cli_metodo_de_pago_nombre',
		'cli_grupo',
		'cli_grupo_nombre',
		'cli_usuario',
		'cli_usuario_nombre',
		'cli_comentario',
		'cli_objetivo_de_venta',
		'cli_maximo_descuento_porcentaje',
		'cli_retencion_porcentaje',
		'cli_tiene_credito',
		'cli_estatus',
		'cli_creado',
		'cli_creado_por',
		'cli_latitud',
		'cli_longitud',
		'cli_estado',
		'cli_fecha_ingreso',
		'cli_fecha_modificacion',
		'cli_usuario_ingresa_modifica',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
