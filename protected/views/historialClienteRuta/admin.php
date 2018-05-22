<?php
/* @var $this HistorialClienteRutaController */
/* @var $model HistorialClienteRutaModel */

$this->breadcrumbs=array(
	'Historial Cliente Ruta Models'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List HistorialClienteRutaModel', 'url'=>array('index')),
	array('label'=>'Create HistorialClienteRutaModel', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#historial-cliente-ruta-model-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Historial Cliente Ruta Models</h1>

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
	'id'=>'historial-cliente-ruta-model-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'hcr_id',
		'hcr_codigo_cliente',
		'hcr_ruta_anterior',
		'hcr_ruta_nueva',
		'hcr_direccion_anterior',
		'hcr_direccion_nueva',
		/*
		'hcr_semana_anterior',
		'hcr_semana_nueva',
		'hcr_dia_anterior',
		'hcr_dia_nuevo',
		'hcr_secuencia_anterior',
		'hcr_secuencia_nueva',
		'hcr_estado_anterior',
		'hcr_estado_nuevo',
		'hcr_fch_actualiza_ruta',
		'hcr_cambios',
		'hcr_fch_ingreso',
		'hcr_fch_modificacion',
		'hcr_cod_usuario_ing_mod',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
