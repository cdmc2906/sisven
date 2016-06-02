<?php
/* @var $this TipoVendedorController */
/* @var $model TipoVendedorModel */

$this->breadcrumbs=array(
	'Tipo Vendedor Models'=>array('index'),
	$model->ID_TVE=>array('view','id'=>$model->ID_TVE),
	'Update',
);

$this->menu=array(
	array('label'=>'List TipoVendedorModel', 'url'=>array('index')),
	array('label'=>'Create TipoVendedorModel', 'url'=>array('create')),
	array('label'=>'View TipoVendedorModel', 'url'=>array('view', 'id'=>$model->ID_TVE)),
	array('label'=>'Manage TipoVendedorModel', 'url'=>array('admin')),
);
?>

<h1>Update TipoVendedorModel <?php echo $model->ID_TVE; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>