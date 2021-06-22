<?php
/* @var $this ResultadoValidaChipController */
/* @var $model ResultadoValidaChipModel */

$this->breadcrumbs=array(
	'Resultado Valida Chip Models'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List ResultadoValidaChipModel', 'url'=>array('index')),
	array('label'=>'Create ResultadoValidaChipModel', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#resultado-valida-chip-model-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Resultado Valida Chip Models</h1>

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
	'id'=>'resultado-valida-chip-model-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'rvc_id',
		'rvc_dato_chip',
		'rvc_tipo_validacion',
		'rvc_subtipo_validacion',
		'rvc_resultado_validacion',
		'rvc_ejecutivo',
		/*
		'rvc_solicitud_fecha',
		'rvc_solicitud_ip',
		'rvc_solicitud_dispositivo',
		'rvc_solicitud_navegador',
		'rvc_estado_validacion',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
