<?php
/* @var $this RangoCumplimientoController */
/* @var $model RangoCumplimientoModel */

$this->breadcrumbs=array(
	'Rango Cumplimiento Models'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List RangoCumplimientoModel', 'url'=>array('index')),
	array('label'=>'Create RangoCumplimientoModel', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#rango-cumplimiento-model-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Rango Cumplimiento Models</h1>

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
	'id'=>'rango-cumplimiento-model-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'c_cod',
		'c_rango_min',
		'c_rango_max',
		'c_nombre_rango',
		'c_estado_rango',
		'c_fecha_ingreso',
		/*
		'c_fecha_modificacion',
		'c_codigo_usuario_ingresa',
		'c_codigo_usuario_modifica',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
