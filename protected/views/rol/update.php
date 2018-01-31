<?php
/* @var $this RolController */
/* @var $model RolModel */

$this->breadcrumbs=array(
	'Rol Models'=>array('index'),
	$model->r_id=>array('view','id'=>$model->r_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List RolModel', 'url'=>array('index')),
	array('label'=>'Create RolModel', 'url'=>array('create')),
	array('label'=>'View RolModel', 'url'=>array('view', 'id'=>$model->r_id)),
	array('label'=>'Manage RolModel', 'url'=>array('admin')),
);
?>

<h1>Update RolModel <?php echo $model->r_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>