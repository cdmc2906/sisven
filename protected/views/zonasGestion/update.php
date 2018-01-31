<?php
/* @var $this ZonasGestionController */
/* @var $model ZonasGestionModel */

$this->breadcrumbs=array(
	'Zonas Gestion Models'=>array('index'),
	$model->zg_id=>array('view','id'=>$model->zg_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ZonasGestionModel', 'url'=>array('index')),
	array('label'=>'Create ZonasGestionModel', 'url'=>array('create')),
	array('label'=>'View ZonasGestionModel', 'url'=>array('view', 'id'=>$model->zg_id)),
	array('label'=>'Manage ZonasGestionModel', 'url'=>array('admin')),
);
?>

<h1>Update ZonasGestionModel <?php echo $model->zg_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>