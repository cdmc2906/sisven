<?php
/* @var $this HistorialMbController */
/* @var $model HistorialMbModel */

$this->breadcrumbs=array(
	'Historial Mb Models'=>array('index'),
	$model->h_cod=>array('view','id'=>$model->h_cod),
	'Update',
);

$this->menu=array(
	array('label'=>'List HistorialMbModel', 'url'=>array('index')),
	array('label'=>'Create HistorialMbModel', 'url'=>array('create')),
	array('label'=>'View HistorialMbModel', 'url'=>array('view', 'id'=>$model->h_cod)),
	array('label'=>'Manage HistorialMbModel', 'url'=>array('admin')),
);
?>

<h1>Update HistorialMbModel <?php echo $model->h_cod; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>