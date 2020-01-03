<?php
/* @var $this StockMovistarController */
/* @var $model StockMovistarModel */

$this->breadcrumbs=array(
	'Stock Movistar Models'=>array('index'),
	$model->sm_codigo=>array('view','id'=>$model->sm_codigo),
	'Update',
);

$this->menu=array(
	array('label'=>'List StockMovistarModel', 'url'=>array('index')),
	array('label'=>'Create StockMovistarModel', 'url'=>array('create')),
	array('label'=>'View StockMovistarModel', 'url'=>array('view', 'id'=>$model->sm_codigo)),
	array('label'=>'Manage StockMovistarModel', 'url'=>array('admin')),
);
?>

<h1>Update StockMovistarModel <?php echo $model->sm_codigo; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>