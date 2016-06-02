<?php
/* @var $this TipoClienteController */
/* @var $model TipoClienteModel */

$this->breadcrumbs=array(
	'Tipo Cliente Models'=>array('index'),
	$model->ID_TCLI,
);

$this->menu=array(
	array('label'=>'List TipoClienteModel', 'url'=>array('index')),
	array('label'=>'Create TipoClienteModel', 'url'=>array('create')),
	array('label'=>'Update TipoClienteModel', 'url'=>array('update', 'id'=>$model->ID_TCLI)),
	array('label'=>'Delete TipoClienteModel', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID_TCLI),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TipoClienteModel', 'url'=>array('admin')),
);
?>

<h1>View TipoClienteModel #<?php echo $model->ID_TCLI; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID_TCLI',
		'ID_EST',
		'NOMBRE_TCLI',
	),
)); ?>
