<?php
/* @var $this EncuestaController */
/* @var $model EncuestaModel */

$this->breadcrumbs=array(
	'Encuesta Models'=>array('index'),
	$model->enc_id,
);

$this->menu=array(
	array('label'=>'List EncuestaModel', 'url'=>array('index')),
	array('label'=>'Create EncuestaModel', 'url'=>array('create')),
	array('label'=>'Update EncuestaModel', 'url'=>array('update', 'id'=>$model->enc_id)),
	array('label'=>'Delete EncuestaModel', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->enc_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage EncuestaModel', 'url'=>array('admin')),
);
?>

<h1>View EncuestaModel #<?php echo $model->enc_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'enc_id',
		'enc_codigo',
		'enc_nombre',
	),
)); ?>
