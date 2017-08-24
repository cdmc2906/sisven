<?php
/* @var $this ComentarioSupervisionController */
/* @var $model ComentarioSupervisionModel */

$this->breadcrumbs=array(
	'Comentarios Supervision'=>array('admin'),
	'Administrar',
);

$this->menu=array(
	array('label'=>'Comentarios Supervision', 'url'=>array('admin')),
	array('label'=>'Crear Comentario Supervision', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#comentario-supervision-model-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Administracion Comentarios Supervision</h1>

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
	'id'=>'comentario-supervision-model-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
//		'cs_id',
		'cs_fecha_historial_supervisado',
		'cs_ejecutivo_supervisado',
		'cs_comentario',
//		'cs_estado',
//		'cs_fecha_ingreso',
//		'cs_fecha_modificacion',
		'cs_usuario_ingresa_modifica',
		
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
