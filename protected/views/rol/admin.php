<?php
/* @var $this RolController */
/* @var $model RolModel */

$this->breadcrumbs=array(
	'Rol Models'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List RolModel', 'url'=>array('index')),
	array('label'=>'Create RolModel', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#rol-model-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Rol Models</h1>

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
	'id'=>'rol-model-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'r_id',
		'r_nombre_rol',
		'r_estado',
		'r_fecha_ingreso',
		'r_fecha_modifica',
		'r_cod_usuario_ing_mod',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
