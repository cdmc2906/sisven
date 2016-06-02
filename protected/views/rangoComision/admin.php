<?php
/* @var $this RangoComisionController */
/* @var $model RangoComisionModel */

$this->breadcrumbs=array(
	'Rango Comision Models'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Listar Rangos de comision', 'url'=>array('index')),
	array('label'=>'Crear Rangos de comision', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#rango-comision-model-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Rango Comision Models</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Busqueda avanzada','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'rango-comision-model-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'ID_RCOM',
		'RANGOMIN_RCOM',
		'RANGOMAX_RCOM',
		'PORCENTAJE_RCOM',
		'FECHAINGRESO_RCOM',
		'FECHAMODIFICACION_RCOM',
		/*
		'IDUSR_RCOM',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
