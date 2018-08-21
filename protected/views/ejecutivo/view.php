<?php
/* @var $this EjecutivoController */
/* @var $model EjecutivoModel */

$this->breadcrumbs=array(
	'Ejecutivo Models'=>array('index'),
	$model->e_cod,
);

$this->menu=array(
	array('label'=>'List EjecutivoModel', 'url'=>array('index')),
	array('label'=>'Create EjecutivoModel', 'url'=>array('create')),
	array('label'=>'Update EjecutivoModel', 'url'=>array('update', 'id'=>$model->e_cod)),
	array('label'=>'Delete EjecutivoModel', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->e_cod),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage EjecutivoModel', 'url'=>array('admin')),
);
?>

<h1>View EjecutivoModel #<?php echo $model->e_cod; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'e_cod',
		'e_nombre',
		'e_usr_mobilvendor',
		'e_iniciales',
		'e_estado',
		'e_tipo',
	),
)); ?>
