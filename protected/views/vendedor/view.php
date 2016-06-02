<?php
/* @var $this VendedorController */
/* @var $model VendedorModel */

$this->breadcrumbs=array(
	'Vendedor Models'=>array('index'),
	$model->ID_VEND,
);

$this->menu=array(
	array('label'=>'List VendedorModel', 'url'=>array('index')),
	array('label'=>'Create VendedorModel', 'url'=>array('create')),
	array('label'=>'Update VendedorModel', 'url'=>array('update', 'id'=>$model->ID_VEND)),
	array('label'=>'Delete VendedorModel', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID_VEND),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage VendedorModel', 'url'=>array('admin')),
);
?>

<h1>View VendedorModel #<?php echo $model->ID_VEND; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID_VEND',
		'ID_EST',
		'NOMBRE_VEND',
		'TELEFONO_VEND',
		'CORREO_VEND',
	),
)); ?>
