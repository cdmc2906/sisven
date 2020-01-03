<?php
/* @var $this StockMovistarController */
/* @var $model StockMovistarModel */

$this->breadcrumbs=array(
	'Stock Movistar Models'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List StockMovistarModel', 'url'=>array('index')),
	array('label'=>'Create StockMovistarModel', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#stock-movistar-model-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Stock Movistar Models</h1>

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
	'id'=>'stock-movistar-model-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'sm_codigo',
		'pg_id',
		'sm_distribuidor_id',
		'sm_nombre_del_distribuidor',
		'sm_zona',
		'sm_provincia',
		/*
		'sm_ciudad',
		'sm_principal_distribuidor_id',
		'sm_nombre_del_distribuidor_principal',
		'sm_tipo_de_codigo_de_sim',
		'sm_sim_inventario_saldo',
		'sm_estado_de_sim',
		'sm_fecha_ingreso',
		'sm_fecha_modifica',
		'sm_usuario_ingresa_modifica',
		'sm_numero_carga',
		'sm_estado',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
