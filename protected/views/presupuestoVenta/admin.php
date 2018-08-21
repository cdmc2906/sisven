<?php
/* @var $this PresupuestoVentaController */
/* @var $model PresupuestoVentaModel */

$this->breadcrumbs=array(
	'Presupuesto Venta Models'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List PresupuestoVentaModel', 'url'=>array('index')),
	array('label'=>'Create PresupuestoVentaModel', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#presupuesto-venta-model-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Presupuesto Venta Models</h1>

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
	'id'=>'presupuesto-venta-model-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'p_id',
		'pg_id',
		'p_codigo_vendedor',
		'p_fecha_ini_validez',
		'p_fecha_fin_validez',
		'p_dias_laborables',
		/*
		'p_valor_presupuesto',
		'p_tipo_presupuesto',
		'p_cantidad_feriados',
		'p_cumplimiento_diario_esperado',
		'p_estado_presupuesto',
		'p_fecha_ingreso',
		'p_fecha_modifica',
		'p_cod_usuario_ing_mod',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
