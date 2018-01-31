<?php
/* @var $this NovedadesController */
/* @var $model NovedadesModel */

$this->breadcrumbs=array(
	'Novedades Models'=>array('index'),
	$model->nov_id=>array('view','id'=>$model->nov_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List NovedadesModel', 'url'=>array('index')),
	array('label'=>'Create NovedadesModel', 'url'=>array('create')),
	array('label'=>'View NovedadesModel', 'url'=>array('view', 'id'=>$model->nov_id)),
	array('label'=>'Manage NovedadesModel', 'url'=>array('admin')),
);
?>

<h1>Update NovedadesModel <?php echo $model->nov_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>