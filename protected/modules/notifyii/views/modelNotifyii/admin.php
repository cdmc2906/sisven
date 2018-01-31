<?php
/* @var $this NotifyiiController */
/* @var $model Notifyii */

$this->breadcrumbs=array(
	'Notificaciones'=>array('index'),
	'Administrar',
);

$this->menu=array(
	array('label'=>'Listar Notificaciones', 'url'=>array('index')),
	array('label'=>'Crear Notificaciones', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('notifyii-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Administrar Notificaciones</h1>

<p>
Tambi�n puede escribir un operador de comparaci�n (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>, <b>=</b>) al inicio de cada uno de los valores de b�squeda para especificar c�mo se debe hacer la comparaci�n.
</p>

<?php echo CHtml::link('B�squeda Avanzada','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'notifyii-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'expire',
		'alert_after_date',
		'alert_before_date',
		'content',
		'role',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
