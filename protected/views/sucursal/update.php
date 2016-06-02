<?php
/* @var $this SucursalController */
/* @var $model SucursalModel */

$this->breadcrumbs=array(
	'Sucursal Models'=>array('index'),
	$model->ID_SUC=>array('view','id'=>$model->ID_SUC),
	'Update',
);

$this->menu=array(
	array('label'=>'List SucursalModel', 'url'=>array('index')),
	array('label'=>'Create SucursalModel', 'url'=>array('create')),
	array('label'=>'View SucursalModel', 'url'=>array('view', 'id'=>$model->ID_SUC)),
	array('label'=>'Manage SucursalModel', 'url'=>array('admin')),
);
?>

<h1>Update SucursalModel <?php echo $model->ID_SUC; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>