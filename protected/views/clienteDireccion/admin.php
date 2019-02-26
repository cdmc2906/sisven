<?php
/* @var $this ClienteDireccionController */
/* @var $model ClienteDireccionModel */

$this->breadcrumbs=array(
	'Cliente Direccion Models'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List ClienteDireccionModel', 'url'=>array('index')),
	array('label'=>'Create ClienteDireccionModel', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#cliente-direccion-model-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Cliente Direccion Models</h1>

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
	'id'=>'cliente-direccion-model-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'dcli_id',
		'dcli_codigo',
		'dcli_cliente',
		'dcli_cliente_nombre',
		'dcli_cliente_identificacion',
		'dcli_cliente_comentario',
		/*
		'dcli_oficina',
		'dcli_oficina_nombre',
		'dcli_codigo_de_barras',
		'dcli_descripcion',
		'dcli_contacto',
		'dcli_geo_area',
		'dcli_geo_area_nombre',
		'dcli_geo_area_codigo_recorrido',
		'dcli_geo_area_descripcion_recorrido',
		'dcli_provincia',
		'dcli_canton',
		'dcli_parroquia',
		'dcli_calle_principal',
		'dcli_nomenclatura',
		'dcli_calle_secundaria',
		'dcli_referencia',
		'dcli_codigo_postal',
		'dcli_telefono',
		'dcli_fax',
		'dcli_email',
		'dcli_latitud',
		'dcli_longitud',
		'dcli_ultima_visita',
		'dcli_estado_de_localizacion',
		'dcli_fecha_ingreso',
		'dcli_usr_ingresa',
		'dcli_fecha_modifica',
		'dcli_usr_modifica',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
