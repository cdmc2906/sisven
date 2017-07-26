<?php
/* @var $this ResumenRevHistorialController */
/* @var $model ResumenRevHistorialModel */

$this->breadcrumbs=array(
	'Resumen Rev Historial Models'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List ResumenRevHistorialModel', 'url'=>array('index')),
	array('label'=>'Create ResumenRevHistorialModel', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#resumen-rev-historial-model-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Resumen Rev Historial Models</h1>

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
	'id'=>'resumen-rev-historial-model-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'rrh_id',
		'rrh_fecha',
		'rrh_ejecutivo',
		'rrh_nivel_cumplimiento',
		'rrh_visitas_efectuadas',
		'rrh_clientes_ruta',
		/*
		'rrh_cliente_no_visitados',
		'rrh_visitas_fuera_ruta',
		'rrh_cantidad_venta_ruta',
		'rrh_cantidad_venta_fuera_ruta',
		'rrh_clientes_venta',
		'rrh_total_venta_reportada',
		'rrh_fecha_ingreso',
		'rrh_fecha_modificar',
		'rrh_usr_ingresa',
		'rrh_usr_modifica',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
