<?php
/* @var $this ComentarioOficinaController */
/* @var $model ComentarioOficinaModel */

$this->breadcrumbs=array(
	'Comentario Oficina Models'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List ComentarioOficinaModel', 'url'=>array('index')),
	array('label'=>'Create ComentarioOficinaModel', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#comentario-oficina-model-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Comentario Oficina Models</h1>

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
	'id'=>'comentario-oficina-model-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'co_id',
		'co_fecha_historial_revisado',
		'co_ejecutivo_revisado',
		'co_comentario',
		'co_enlace_mapa',
		'co_enlace_imagen',
		/*
		'co_estado',
		'co_fecha_ingreso',
		'co_fecha_modificacion',
		'co_usuario_ingresa_modifica',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
