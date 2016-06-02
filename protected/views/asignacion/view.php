<?php
/* @var $this AsignacionController */
/* @var $model AsignacionModel */

$this->breadcrumbs=array(
	'Asignacion Models'=>array('index'),
	$model->ID_ASIG,
);

$this->menu=array(
	array('label'=>'List AsignacionModel', 'url'=>array('index')),
	array('label'=>'Create AsignacionModel', 'url'=>array('create')),
	array('label'=>'Update AsignacionModel', 'url'=>array('update', 'id'=>$model->ID_ASIG)),
	array('label'=>'Delete AsignacionModel', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID_ASIG),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage AsignacionModel', 'url'=>array('admin')),
);
?>

<h1>View AsignacionModel #<?php echo $model->ID_ASIG; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID_ASIG',
		'ID_PRO',
		'ID_VEND',
		'FECHAINGRESO_ASIG',
		'IDUSR_ASIF',
	),
)); ?>
