<?php
/* @var $this PreguntaController */
/* @var $model PreguntaModel */

$this->breadcrumbs=array(
	'Pregunta Models'=>array('index'),
	$model->preg_id,
);

$this->menu=array(
	array('label'=>'List PreguntaModel', 'url'=>array('index')),
	array('label'=>'Create PreguntaModel', 'url'=>array('create')),
	array('label'=>'Update PreguntaModel', 'url'=>array('update', 'id'=>$model->preg_id)),
	array('label'=>'Delete PreguntaModel', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->preg_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PreguntaModel', 'url'=>array('admin')),
);
?>

<h1>View PreguntaModel #<?php echo $model->preg_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'preg_id',
		'tpreg_id',
		'preg_codigo',
		'preg_descripcion',
		'preg_estado',
		'preg_ingreso',
		'preg_modifica',
	),
)); ?>
