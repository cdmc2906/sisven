<?php
/* @var $this SucursalController */
/* @var $model SucursalModel */

$this->breadcrumbs=array(
	'Sucursal Models'=>array('index'),
	$model->ID_SUC,
);

$this->menu=array(
	array('label'=>'List SucursalModel', 'url'=>array('index')),
	array('label'=>'Create SucursalModel', 'url'=>array('create')),
	array('label'=>'Update SucursalModel', 'url'=>array('update', 'id'=>$model->ID_SUC)),
	array('label'=>'Delete SucursalModel', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID_SUC),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SucursalModel', 'url'=>array('admin')),
);
?>

<h1>View SucursalModel #<?php echo $model->ID_SUC; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID_SUC',
		'ID_EST',
		'NOMBRE_SUC',
		'DIRECCION_SUC',
		'TELEFONO_SUC',
		'ID_EMP',
	),
)); ?>
