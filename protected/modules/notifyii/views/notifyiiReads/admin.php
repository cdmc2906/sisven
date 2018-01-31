<?php
/* @var $this NotifyiiReadsController */
/* @var $model NotifyiiReads */

$this->breadcrumbs=array(
	'Notificaciones Leidas'=>array('index'),
	'Administrar',
);

$this->menu=array(
	array('label'=>'Listar Notificaciones Leidas', 'url'=>array('index')),
	array('label'=>'Crear Notificaciones Leidas', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('notifyii-reads-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Administrar Notificaciones Leidas</h1>

<p>
También puede escribir un operador de comparación (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>, <b>=</b>) al inicio de cada uno de los valores de búsqueda para especificar cómo se debe hacer la comparación.
</p>

<?php echo CHtml::link('Busqueda Avanzada','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'notifyii-reads-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'username',
		'notification_id',
		'readed',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
