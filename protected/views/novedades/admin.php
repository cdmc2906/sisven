<?php
/* @var $this NovedadesController */
/* @var $model NovedadesModel */

$this->breadcrumbs=array(
	'Novedades Models'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List NovedadesModel', 'url'=>array('index')),
	array('label'=>'Create NovedadesModel', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#novedades-model-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Novedades Models</h1>

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
	'id'=>'novedades-model-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'nov_id',
		'gno_id',
		'nov_descripcion',
		'nov_estado',
		'nov_fecha_ingreso',
		'nov_fecha_modifica',
		/*
		'nov_cod_usuario_ingresa_modifica',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
