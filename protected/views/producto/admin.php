<?php
/* @var $this ProductoController */
/* @var $model ProductoModel */

$this->breadcrumbs=array(
	'Producto Models'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List ProductoModel', 'url'=>array('index')),
	array('label'=>'Create ProductoModel', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#producto-model-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Producto Models</h1>

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
	'id'=>'producto-model-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'ID_PRO',
		'ID_EST',
		'ID_COMP',
		'ID_TPRO',
		'ID_BODEGA',
		'NOMBRE_PROD',
		/*
		'MIN_PROD',
		'ICC_PROD',
		'IMEI_PROD',
		'NUMSERIE_PROD',
		'PRECIO_PROD',
		'COSTO_PROD',
		'PORCENTAJEDESCUENTO_PROD',
		'PRECIO1_PROD',
		'PRECIO2_PROD',
		'PRECIO3_PROD',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
