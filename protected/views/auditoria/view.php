<?php
/* @var $this AuditoriaController */
/* @var $model AuditoriaModel */

$this->breadcrumbs=array(
	'Auditoria Models'=>array('index'),
	$model->ID_AUD,
);

$this->menu=array(
	array('label'=>'List AuditoriaModel', 'url'=>array('index')),
	array('label'=>'Create AuditoriaModel', 'url'=>array('create')),
	array('label'=>'Update AuditoriaModel', 'url'=>array('update', 'id'=>$model->ID_AUD)),
	array('label'=>'Delete AuditoriaModel', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID_AUD),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage AuditoriaModel', 'url'=>array('admin')),
);
?>

<h1>View AuditoriaModel #<?php echo $model->ID_AUD; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID_AUD',
		'FECHA_AUD',
		'IDUSR_AUD',
	),
)); ?>
