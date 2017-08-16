<?php
/* @var $this ComentarioOficinaController */
/* @var $model ComentarioOficinaModel */

$this->breadcrumbs=array(
	'Comentario Oficina Models'=>array('index'),
	$model->co_id,
);

$this->menu=array(
	array('label'=>'List ComentarioOficinaModel', 'url'=>array('index')),
	array('label'=>'Create ComentarioOficinaModel', 'url'=>array('create')),
	array('label'=>'Update ComentarioOficinaModel', 'url'=>array('update', 'id'=>$model->co_id)),
	array('label'=>'Delete ComentarioOficinaModel', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->co_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ComentarioOficinaModel', 'url'=>array('admin')),
);
?>

<h1>View ComentarioOficinaModel #<?php echo $model->co_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'co_id',
		'co_fecha_historial_revisado',
		'co_ejecutivo_revisado',
		'co_comentario',
		'co_enlace_mapa',
		'co_enlace_imagen',
		'co_estado',
		'co_fecha_ingreso',
		'co_fecha_modificacion',
		'co_usuario_ingresa_modifica',
	),
)); ?>
