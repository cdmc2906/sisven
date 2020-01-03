<?php
/* @var $this CondicionPromocionController */
/* @var $model CondicionPromocionModel */

$this->breadcrumbs=array(
	'Condicion Promocion Models'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List CondicionPromocionModel', 'url'=>array('index')),
	array('label'=>'Create CondicionPromocionModel', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#condicion-promocion-model-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Condicion Promocion Models</h1>

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
	'id'=>'condicion-promocion-model-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'cpr_id',
		'pr_id',
		'cpr_parametro',
		'cpr_operador',
		'cpr_valor_min',
		'cpr_valor_max',
		/*
		'cpr_estado',
		'cpr_fecha_ingreso',
		'cpr_fecha_modifica',
		'cpr_usr_ing_mod',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
