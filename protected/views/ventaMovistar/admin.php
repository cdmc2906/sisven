<?php
/* @var $this VentaMovistarController */
/* @var $model VentaMovistarModel */

$this->breadcrumbs=array(
	'Venta Movistar Models'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List VentaMovistarModel', 'url'=>array('index')),
	array('label'=>'Create VentaMovistarModel', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#venta-movistar-model-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Venta Movistar Models</h1>

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
	'id'=>'venta-movistar-model-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'vm_cod',
		'vm_fecha',
		'vm_transaccion',
		'vm_distribuidor',
		'vm_nombredistribuidor',
		'vm_codigoscl',
		/*
		'vm_inventarioanteriorfuente',
		'vm_inventarioactualfuente',
		'vm_tiposim',
		'vm_icc',
		'vm_min',
		'vm_estado',
		'vm_iddestino',
		'vm_nombredestino',
		'vm_inventarioanteriordestino',
		'vm_inventarioactualdestino',
		'vm_canal',
		'vm_lote',
		'vm_zona',
		'vm_fecha_ingreso',
		'vm_fecha_modificacion',
		'vm_usuario_ingresa_modifica',
		'vm_estado_icc',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
