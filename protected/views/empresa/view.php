<?php
/* @var $this EmpresaController */
/* @var $model EmpresaModel */

$this->breadcrumbs=array(
	'Empresa Models'=>array('index'),
	$model->ID_EMP,
);

$this->menu=array(
	array('label'=>'List EmpresaModel', 'url'=>array('index')),
	array('label'=>'Create EmpresaModel', 'url'=>array('create')),
	array('label'=>'Update EmpresaModel', 'url'=>array('update', 'id'=>$model->ID_EMP)),
	array('label'=>'Delete EmpresaModel', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID_EMP),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage EmpresaModel', 'url'=>array('admin')),
);
?>

<h1>View EmpresaModel #<?php echo $model->ID_EMP; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID_EMP',
		'NOMBRE_EMP',
		'IDUSR_EMP',
		'FECHAINGRESO_EMP',
		'FECHAMODIFICACION_EMP',
	),
)); ?>
