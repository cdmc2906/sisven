<?php
/* @var $this TipoPreguntaController */
/* @var $model TipoPreguntaModel */

$this->breadcrumbs=array(
	'Tipo Pregunta Models'=>array('index'),
	$model->tpreg_id,
);

$this->menu=array(
	array('label'=>'List TipoPreguntaModel', 'url'=>array('index')),
	array('label'=>'Create TipoPreguntaModel', 'url'=>array('create')),
	array('label'=>'Update TipoPreguntaModel', 'url'=>array('update', 'id'=>$model->tpreg_id)),
	array('label'=>'Delete TipoPreguntaModel', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->tpreg_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TipoPreguntaModel', 'url'=>array('admin')),
);
?>

<h1>View TipoPreguntaModel #<?php echo $model->tpreg_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'tpreg_id',
		'tpreg_nombre',
		'tpreg_estado',
		'tpreg_fecha_inicio',
		'tpreg_fecha_modifica',
		'tpreg_cod_usuario_ing_mod',
	),
)); ?>
