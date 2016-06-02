<?php
/* @var $this ProductoController */
/* @var $model ProductoModel */

$this->breadcrumbs=array(
	'Producto Models'=>array('index'),
	$model->ID_PRO,
);

$this->menu=array(
	array('label'=>'List ProductoModel', 'url'=>array('index')),
	array('label'=>'Create ProductoModel', 'url'=>array('create')),
	array('label'=>'Update ProductoModel', 'url'=>array('update', 'id'=>$model->ID_PRO)),
	array('label'=>'Delete ProductoModel', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID_PRO),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ProductoModel', 'url'=>array('admin')),
);
?>

<h1>View ProductoModel #<?php echo $model->ID_PRO; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID_PRO',
		'ID_EST',
		'ID_COMP',
		'ID_TPRO',
		'ID_BODEGA',
		'NOMBRE_PROD',
		'MIN_PROD',
		'ICC_PROD',
		'IMEI_PROD',
		'NUMSERIE_PROD',
		'PRECIO_PROD',
		'COSTO_PROD',
		'PORCENTAJEDESCUENTO_PROD',
		'PRECIO1_PROD',
		'PRECIO2_PROD',
		'PRECIO3_PROD',
	),
)); ?>
