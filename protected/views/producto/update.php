<?php
/* @var $this ProductoController */
/* @var $model ProductoModel */

$this->breadcrumbs=array(
	'Producto Models'=>array('index'),
	$model->ID_PRO=>array('view','id'=>$model->ID_PRO),
	'Update',
);

$this->menu=array(
	array('label'=>'List ProductoModel', 'url'=>array('index')),
	array('label'=>'Create ProductoModel', 'url'=>array('create')),
	array('label'=>'View ProductoModel', 'url'=>array('view', 'id'=>$model->ID_PRO)),
	array('label'=>'Manage ProductoModel', 'url'=>array('admin')),
);
?>

<h1>Update ProductoModel <?php echo $model->ID_PRO; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>