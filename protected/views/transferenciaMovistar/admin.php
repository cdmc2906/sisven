<?php
/* @var $this TransferenciaMovistarController */
/* @var $model TransferenciaMovistarModel */

$this->breadcrumbs=array(
	'Transferencia Movistar Models'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List TransferenciaMovistarModel', 'url'=>array('index')),
	array('label'=>'Create TransferenciaMovistarModel', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#transferencia-movistar-model-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Transferencia Movistar Models</h1>

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
	'id'=>'transferencia-movistar-model-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'tm_codigo',
		'tm_fecha',
		'tm_codigotransferencia',
		'tm_iddistribuidor',
		'tm_nombredistribuidor',
		'tm_codigoscl',
		/*
		'tm_inventarioanteriorfuente',
		'tm_inventarioactualfuente',
		'tm_tiposim',
		'tm_icc',
		'tm_min',
		'tm_estado',
		'tm_iddestino',
		'tm_nombredestino',
		'tm_inventarioanteriordestino',
		'tm_inventarioactualdestino',
		'tm_canal',
		'tm_numero_lote',
		'tm_zona',
		'tm_fecha_ingreso',
		'tm_fecha_modifica',
		'tm_usuario_ingresa_modifica',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
