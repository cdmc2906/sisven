<?php
/* @var $this RutaMbController */
/* @var $model RutaMbModel */

$this->breadcrumbs=array(
	'Ruta Mb Models'=>array('index'),
	$model->r_cod=>array('view','id'=>$model->r_cod),
	'Update',
);

$this->menu=array(
	array('label'=>'List RutaMbModel', 'url'=>array('index')),
	array('label'=>'Create RutaMbModel', 'url'=>array('create')),
	array('label'=>'View RutaMbModel', 'url'=>array('view', 'id'=>$model->r_cod)),
	array('label'=>'Manage RutaMbModel', 'url'=>array('admin')),
);
?>

<h1>Update RutaMbModel <?php echo $model->r_cod; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>