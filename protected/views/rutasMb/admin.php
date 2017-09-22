<?php
/* @var $this RutaMbController */
/* @var $model RutaMbModel */

$this->breadcrumbs=array(
	'Ruta Mb Models'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List RutaMbModel', 'url'=>array('index')),
	array('label'=>'Create RutaMbModel', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#ruta-mb-model-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Ruta Mb Models</h1>

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
	'id'=>'ruta-mb-model-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
//		'r_cod',
		'r_ruta',
		'r_cod_cliente',
		'r_nom_cliente',
//		'r_cod_direccion',
//		'r_direccion',
//		'r_referencia',
//		'r_semana',
		'r_dia',
		'r_secuencia',
		'r_estatus',
//		'r_fch_ingreso',
//		'r_fch_modificacion',
//		'r_fch_desde',
//		'r_fch_hasta',
//		'r_usuario_ing_mod',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
