<?php
/* @var $this StockMovistarController */
/* @var $model StockMovistarModel */

$this->breadcrumbs=array(
	'Stock Movistar Models'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List StockMovistarModel', 'url'=>array('index')),
	array('label'=>'Manage StockMovistarModel', 'url'=>array('admin')),
);
?>

<h1>Create StockMovistarModel</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>