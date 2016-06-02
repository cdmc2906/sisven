<?php
/* @var $this VendedorController */
/* @var $model VendedorModel */

$this->breadcrumbs=array(
	'Vendedor Models'=>array('index'),
	$model->ID_VEND=>array('view','id'=>$model->ID_VEND),
	'Update',
);

$this->menu=array(
	array('label'=>'List VendedorModel', 'url'=>array('index')),
	array('label'=>'Create VendedorModel', 'url'=>array('create')),
	array('label'=>'View VendedorModel', 'url'=>array('view', 'id'=>$model->ID_VEND)),
	array('label'=>'Manage VendedorModel', 'url'=>array('admin')),
);
?>

<h1>Update VendedorModel <?php echo $model->ID_VEND; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>