<?php
/* @var $this TipoProductoController */
/* @var $model TipoProductoModel */

$this->breadcrumbs=array(
	'Tipo Producto Models'=>array('index'),
	$model->ID_TPRO,
);

$this->menu=array(
	array('label'=>'List TipoProductoModel', 'url'=>array('index')),
	array('label'=>'Create TipoProductoModel', 'url'=>array('create')),
	array('label'=>'Update TipoProductoModel', 'url'=>array('update', 'id'=>$model->ID_TPRO)),
	array('label'=>'Delete TipoProductoModel', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID_TPRO),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TipoProductoModel', 'url'=>array('admin')),
);
?>

<h1>View TipoProductoModel #<?php echo $model->ID_TPRO; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID_TPRO',
		'ID_EST',
		'TIPO_TPRO',
	),
)); ?>
