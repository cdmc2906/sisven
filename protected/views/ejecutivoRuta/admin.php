<?php
/* @var $this EjecutivoRutaController */
/* @var $model EjecutivoRutaModel */

$this->breadcrumbs=array(
	'Ejecutivo Ruta Models'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List EjecutivoRutaModel', 'url'=>array('index')),
	array('label'=>'Create EjecutivoRutaModel', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#ejecutivo-ruta-model-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Ejecutivo Ruta Models</h1>

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
	'id'=>'ejecutivo-ruta-model-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'er_cod',
		'er_usuario',
		'er_usuario_nombre',
		'er_ruta',
		'er_ruta_nombre',
		'er_estatus',
		/*
		'er_fecha_ingreso',
		'er_fecha_asignacion',
		'er_fecha_modificacion',
		'er_cod_usr_ing',
		'er_cod_usr_mod',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
