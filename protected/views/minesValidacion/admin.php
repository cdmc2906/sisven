<?php
/* @var $this MinesValidacionController */
/* @var $model MinesValidacionModel */

$this->breadcrumbs=array(
	'Mines Validacion Models'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List MinesValidacionModel', 'url'=>array('index')),
	array('label'=>'Create MinesValidacionModel', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#mines-validacion-model-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Mines Validacion Models</h1>

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
	'id'=>'mines-validacion-model-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'miva_id',
		'iduser',
		'miva_carga',
		'miva_tipo',
		'miva_fecha',
		'miva_bodega',
		/*
		'miva_nomcli',
		'miva_codgrup',
		'miva_detalle',
		'miva_imei',
		'miva_min',
		'miva_vendedor',
		'miva_estado',
		'miva_estado_reasignacion',
		'miva_usario_reasignado',
		'miva_fecha_ingreso',
		'miva_fecha_modifica',
		'miva_cod_usuario_ing_mod',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
