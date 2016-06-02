<?php
/* @var $this TipoProductoController */
/* @var $model TipoProductoModel */

$this->breadcrumbs=array(
	'Tipo Producto Models'=>array('index'),
	$model->ID_TPRO=>array('view','id'=>$model->ID_TPRO),
	'Update',
);

$this->menu=array(
	array('label'=>'List TipoProductoModel', 'url'=>array('index')),
	array('label'=>'Create TipoProductoModel', 'url'=>array('create')),
	array('label'=>'View TipoProductoModel', 'url'=>array('view', 'id'=>$model->ID_TPRO)),
	array('label'=>'Manage TipoProductoModel', 'url'=>array('admin')),
);
?>

<h1>Update TipoProductoModel <?php echo $model->ID_TPRO; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>