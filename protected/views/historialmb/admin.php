<?php
/* @var $this HistorialMbControllerController */
/* @var $model HistorialMbModel */

$this->breadcrumbs=array(
	'Historial'=>array('index'),
	'Administracion',
);

$this->menu=array(
//	array('label'=>'List HistorialMbModel', 'url'=>array('index')),
	array('label'=>'Ingresar accion Historial', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#historial-mb-model-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Administracion Historial</h1>

<p>
    Para la busqueda puede utilizar los operadores (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) al inicio de cada valor de busqueda para especificar como desea realizar la busqueda.
</p>

<?php echo CHtml::link('Busqueda avanzada','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'historial-mb-model-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
//		'h_cod',
//		'h_id',
		'h_fecha',
		'h_usuario',
		'h_ruta',
		'h_ruta_nombre',
//		'h_semana',
//		'h_dia',
		'h_cod_cliente',
		'h_nom_cliente',
//		'h_direccion',
		'h_accion',
//		'h_cod_accion',
//		'h_cod_comentario',
//		'h_comentario',
//		'h_monto',
		'h_latitud',
		'h_longitud',
//		'h_romper_secuencia',
//		'h_fch_ingreso',
//		'h_fch_modificacion',
//		'h_fch_desde',
//		'h_fch_hasta',
//		'h_usr_ing_mod',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
