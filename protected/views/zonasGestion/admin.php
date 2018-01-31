<?php
/* @var $this ZonasGestionController */
/* @var $model ZonasGestionModel */

$this->breadcrumbs=array(
	'Zonas Gestion Models'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List ZonasGestionModel', 'url'=>array('index')),
	array('label'=>'Create ZonasGestionModel', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#zonas-gestion-model-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Zonas Gestion Models</h1>

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
	'id'=>'zonas-gestion-model-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'zg_id',
		'zg_nombre_zona',
		'zg_cod_ejecutivo_asignado',
		'zg_nomb_ejecutivo_asignado',
		'zg_estado_zona',
		'zg_fecha_ingreso',
		/*
		'zg_fecha_modifica',
		'zg_cod_usuario_ingresa_modifica',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
