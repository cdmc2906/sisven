<?php
/* @var $this TipoPreguntaController */
/* @var $model TipoPreguntaModel */

$this->breadcrumbs=array(
	'Tipo Pregunta Models'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List TipoPreguntaModel', 'url'=>array('index')),
	array('label'=>'Create TipoPreguntaModel', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#tipo-pregunta-model-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Tipo Pregunta Models</h1>

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
	'id'=>'tipo-pregunta-model-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'tpreg_id',
		'tpreg_nombre',
		'tpreg_estado',
		'tpreg_fecha_inicio',
		'tpreg_fecha_modifica',
		'tpreg_cod_usuario_ing_mod',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
