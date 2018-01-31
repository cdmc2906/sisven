<?php
/* @var $this UsuarioRutaController */
/* @var $model UsuarioRutaModel */

$this->breadcrumbs=array(
	'Usuario Ruta Models'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List UsuarioRutaModel', 'url'=>array('index')),
	array('label'=>'Create UsuarioRutaModel', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#usuario-ruta-model-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Usuario Ruta Models</h1>

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
	'id'=>'usuario-ruta-model-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'ur_id',
		'rg_id',
		'iduser',
		'ur_nombre_ejecutivo',
		'ur_estado',
		'ur_zona_gestion',
		/*
		'ur_fecha_ingreso',
		'ur_fecha_modifica',
		'ur_cod_usuario_ingresa_modifica',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
