<?php
/* @var $this ComentarioSupervisionController */
/* @var $model ComentarioSupervisionModel */

$this->breadcrumbs=array(
	'Comentario Supervision Models'=>array('index'),
	$model->cs_id,
);

$this->menu=array(
	array('label'=>'List ComentarioSupervisionModel', 'url'=>array('index')),
	array('label'=>'Create ComentarioSupervisionModel', 'url'=>array('create')),
	array('label'=>'Update ComentarioSupervisionModel', 'url'=>array('update', 'id'=>$model->cs_id)),
	array('label'=>'Delete ComentarioSupervisionModel', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->cs_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ComentarioSupervisionModel', 'url'=>array('admin')),
);
?>

<h1>View ComentarioSupervisionModel #<?php echo $model->cs_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'cs_id',
		'cs_fecha_historial_supervisado',
		'cs_ejecutivo_supervisado',
		'cs_comentario',
		'co_estado',
		'cs_fecha_ingreso',
		'cs_fecha_modificacion',
		'cs_usuario_ingresa_modifica',
	),
)); ?>
