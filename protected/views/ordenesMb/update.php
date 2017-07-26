<?php
/* @var $this OrdenesMbController */
/* @var $model OrdenesMbModel */

$this->breadcrumbs=array(
	'Ordenes Mb Models'=>array('index'),
	$model->o_codigo=>array('view','id'=>$model->o_codigo),
	'Update',
);

$this->menu=array(
	array('label'=>'List OrdenesMbModel', 'url'=>array('index')),
	array('label'=>'Create OrdenesMbModel', 'url'=>array('create')),
	array('label'=>'View OrdenesMbModel', 'url'=>array('view', 'id'=>$model->o_codigo)),
	array('label'=>'Manage OrdenesMbModel', 'url'=>array('admin')),
);
?>

<h1>Update OrdenesMbModel <?php echo $model->o_codigo; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>