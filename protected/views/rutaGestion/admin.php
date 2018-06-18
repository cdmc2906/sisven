<?php
/* @var $this RutaGestionController */
/* @var $model RutaGestionModel */

$this->breadcrumbs=array(
	'Ruta Gestion Models'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List RutaGestionModel', 'url'=>array('index')),
	array('label'=>'Create RutaGestionModel', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#ruta-gestion-model-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Ruta Gestion Models</h1>

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
	'id'=>'ruta-gestion-model-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'rg_id',
		'zg_id',
		'rg_cod_ruta_mb',
		'rg_nombre_ruta',
		'rg_estado_ruta',
		'rg_fecha_ingreso',
		/*
		'rg_fecha_modifica',
		'rg_cod_usuario_ingresa_modifica',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
