<?php
/* @var $this BodegaController */
/* @var $model BodegaModel */

$this->breadcrumbs=array(
	'Bodega Models'=>array('index'),
	$model->ID_BODEGA,
);

$this->menu=array(
	array('label'=>'List BodegaModel', 'url'=>array('index')),
	array('label'=>'Create BodegaModel', 'url'=>array('create')),
	array('label'=>'Update BodegaModel', 'url'=>array('update', 'id'=>$model->ID_BODEGA)),
	array('label'=>'Delete BodegaModel', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID_BODEGA),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage BodegaModel', 'url'=>array('admin')),
);
?>

<h1>View BodegaModel #<?php echo $model->ID_BODEGA; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID_BODEGA',
		'ID_SUC',
		'ID_EST',
		'NOMBRE_BODEGA',
	),
)); ?>
