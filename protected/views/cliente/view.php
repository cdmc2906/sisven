<?php
/* @var $this ClienteController */
/* @var $model ClienteModel */

$this->breadcrumbs=array(
	'Cliente Models'=>array('index'),
	$model->ID_CLI,
);

$this->menu=array(
	array('label'=>'List ClienteModel', 'url'=>array('index')),
	array('label'=>'Create ClienteModel', 'url'=>array('create')),
	array('label'=>'Update ClienteModel', 'url'=>array('update', 'id'=>$model->ID_CLI)),
	array('label'=>'Delete ClienteModel', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID_CLI),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ClienteModel', 'url'=>array('admin')),
);
?>

<h1>View ClienteModel #<?php echo $model->ID_CLI; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID_CLI',
		'ID_EST',
		'ID_TCLI',
		'NOMBRE_CLI',
		'DOCUMENTO_CLI',
		'DIRECCION_CLI',
		'TELEFONO_CLI',
		'EMAIL_CLI',
		'FECHAINGRESO_CLI',
		'FECHAMODIFICACION_CLI',
		'IDUSR_CLI',
		'IDDELTA_CLI',
	),
)); ?>
