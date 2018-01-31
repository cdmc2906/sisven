<?php
/* @var $this UsuarioRolController */
/* @var $model UsuarioRolModel */

$this->breadcrumbs=array(
	'Usuario Rol Models'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List UsuarioRolModel', 'url'=>array('index')),
	array('label'=>'Create UsuarioRolModel', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#usuario-rol-model-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Usuario Rol Models</h1>

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
	'id'=>'usuario-rol-model-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'usrl_id',
		'iduser',
		'r_id',
		'usrl_estado',
		'usrl_fecha_ingreso',
		'usrl_fecha_modifica',
		/*
		'usrl_cod_usuario_ing_mod',
		'usrl_nombre_usuario',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
