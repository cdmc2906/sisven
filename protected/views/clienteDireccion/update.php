<?php
/* @var $this ClienteDireccionController */
/* @var $model ClienteDireccionModel */

$this->breadcrumbs=array(
	'Cliente Direccion Models'=>array('index'),
	$model->dcli_id=>array('view','id'=>$model->dcli_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ClienteDireccionModel', 'url'=>array('index')),
	array('label'=>'Create ClienteDireccionModel', 'url'=>array('create')),
	array('label'=>'View ClienteDireccionModel', 'url'=>array('view', 'id'=>$model->dcli_id)),
	array('label'=>'Manage ClienteDireccionModel', 'url'=>array('admin')),
);
?>

<h1>Update ClienteDireccionModel <?php echo $model->dcli_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>