<?php
/* @var $this RevisionMinesController */
/* @var $model RevisionMinesModel */

$this->breadcrumbs=array(
	'Revision Mines Models'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List RevisionMinesModel', 'url'=>array('index')),
	array('label'=>'Create RevisionMinesModel', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#revision-mines-model-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Revision Mines Models</h1>

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
	'id'=>'revision-mines-model-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'rmva_id',
		'iduser',
		'rmva_tipo',
		'rmva_fecha_gestion',
		'rmva_resultado_llamad',
		'rmva_motivo_no_contado',
		/*
		'rmva_operadora',
		'rmva_lugar_compra',
		'rmva_precio',
		'rmva_estado',
		'rmva_fecha_ingreso',
		'rmva_fecha_modifica',
		'rmva_cod_usuario_ing_mod',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
