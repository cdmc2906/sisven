<?php
/* @var $this PromocionController */
/* @var $model PromocionModel */

$this->breadcrumbs=array(
	'Promocion Models'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List PromocionModel', 'url'=>array('index')),
	array('label'=>'Create PromocionModel', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#promocion-model-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Promocion Models</h1>

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
	'id'=>'promocion-model-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'pr_id',
		'pr_nombre',
		'pr_fecha_inicio',
		'pr_fecha_fin',
		'pr_estado',
		'pr_ingreso',
		/*
		'pr_modificacion',
		'pr_id_usr_ing_mod',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
