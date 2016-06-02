<?php
/* @var $this BodegaController */
/* @var $model BodegaModel */

$this->breadcrumbs=array(
	'Bodega Models'=>array('index'),
	$model->ID_BODEGA=>array('view','id'=>$model->ID_BODEGA),
	'Update',
);

$this->menu=array(
	array('label'=>'List BodegaModel', 'url'=>array('index')),
	array('label'=>'Create BodegaModel', 'url'=>array('create')),
	array('label'=>'View BodegaModel', 'url'=>array('view', 'id'=>$model->ID_BODEGA)),
	array('label'=>'Manage BodegaModel', 'url'=>array('admin')),
);
?>

<h1>Update BodegaModel <?php echo $model->ID_BODEGA; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>