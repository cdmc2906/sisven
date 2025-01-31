<?php
/* @var $this OrdenesMbController */
/* @var $model OrdenesMbModel */

$this->breadcrumbs=array(
	'Ordenes Mb Models'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List OrdenesMbModel', 'url'=>array('index')),
	array('label'=>'Create OrdenesMbModel', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#ordenes-mb-model-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Ordenes Mb Models</h1>

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
	'id'=>'ordenes-mb-model-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'o_codigo',
		'pg_id',
		'o_id',
		'o_concepto',
		'o_codigo_mb',
		'o_comentario',
		/*
		'o_fch_venta',
		'o_fch_creacion',
		'o_fch_despacho',
		'o_tipo',
		'o_estatus',
		'o_cod_cliente',
		'o_nom_cliente',
		'o_id_cliente',
		'o_direccion',
		'o_lista_precio',
		'o_nom_lista_precio',
		'o_bodega_origen',
		'o_nom_bodega_origen',
		'o_termino_pago',
		'o_nom_termino_pago',
		'o_usuario',
		'o_nom_usuario',
		'o_departamento_ventas',
		'o_oficina',
		'o_nom_oficina',
		'o_tipo_secuencia',
		'o_iva_12_base',
		'o_iva_12_valor',
		'o_iva_0_base',
		'o_iva_0_valor',
		'o_iva_14_base',
		'o_iva_14_valor',
		'o_subtotal',
		'o_porcentaje_descuento',
		'o_descuento',
		'o_impuestos',
		'o_otros_cargos',
		'o_total',
		'o_datos',
		'o_referencia',
		'o_estado_proceso',
		'o_fch_ingreso',
		'o_fch_modificacion',
		'o_fch_desde',
		'o_fch_hasta',
		'o_usr_ing_mod',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
