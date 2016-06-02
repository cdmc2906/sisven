<?php
/* @var $this TipoVendedorController */
/* @var $model TipoVendedorModel */

$this->breadcrumbs=array(
	'Tipo Vendedor Models'=>array('index'),
	$model->ID_TVE,
);

$this->menu=array(
	array('label'=>'List TipoVendedorModel', 'url'=>array('index')),
	array('label'=>'Create TipoVendedorModel', 'url'=>array('create')),
	array('label'=>'Update TipoVendedorModel', 'url'=>array('update', 'id'=>$model->ID_TVE)),
	array('label'=>'Delete TipoVendedorModel', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID_TVE),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TipoVendedorModel', 'url'=>array('admin')),
);
?>

<h1>View TipoVendedorModel #<?php echo $model->ID_TVE; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID_TVE',
		'NOMBRE_TVE',
		'FECHAINGRESO_TVE',
		'FECHAMODIFICACION_TVE',
		'IDUSR_TVE',
		'ID_EST',
	),
)); ?>
