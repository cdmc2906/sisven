<?php
/* @var $this VentaMovistarController */
/* @var $model VentaMovistarModel */

$this->breadcrumbs=array(
	'Venta Movistar Models'=>array('index'),
	$model->vm_cod=>array('view','id'=>$model->vm_cod),
	'Update',
);

$this->menu=array(
	array('label'=>'List VentaMovistarModel', 'url'=>array('index')),
	array('label'=>'Create VentaMovistarModel', 'url'=>array('create')),
	array('label'=>'View VentaMovistarModel', 'url'=>array('view', 'id'=>$model->vm_cod)),
	array('label'=>'Manage VentaMovistarModel', 'url'=>array('admin')),
);
?>

<h1>Update VentaMovistarModel <?php echo $model->vm_cod; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>