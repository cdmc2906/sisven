<?php
/* @var $this ClienteController */
/* @var $model ClienteModel */

$this->breadcrumbs=array(
	'Cliente Models'=>array('index'),
	$model->ID_CLI=>array('view','id'=>$model->ID_CLI),
	'Update',
);

$this->menu=array(
	array('label'=>'List ClienteModel', 'url'=>array('index')),
	array('label'=>'Create ClienteModel', 'url'=>array('create')),
	array('label'=>'View ClienteModel', 'url'=>array('view', 'id'=>$model->ID_CLI)),
	array('label'=>'Manage ClienteModel', 'url'=>array('admin')),
);
?>

<h1>Update ClienteModel <?php echo $model->ID_CLI; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>