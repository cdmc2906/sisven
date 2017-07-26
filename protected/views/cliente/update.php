<?php
/* @var $this ClienteController */
/* @var $model ClienteModel */

$this->breadcrumbs=array(
	'Cliente Models'=>array('index'),
	$model->cli_codigo=>array('view','id'=>$model->cli_codigo),
	'Update',
);

$this->menu=array(
	array('label'=>'List ClienteModel', 'url'=>array('index')),
	array('label'=>'Create ClienteModel', 'url'=>array('create')),
	array('label'=>'View ClienteModel', 'url'=>array('view', 'id'=>$model->cli_codigo)),
	array('label'=>'Manage ClienteModel', 'url'=>array('admin')),
);
?>

<h1>Update ClienteModel <?php echo $model->cli_codigo; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>