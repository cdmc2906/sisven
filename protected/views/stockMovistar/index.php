<?php
/* @var $this StockMovistarController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Stock Movistar Models',
);

$this->menu=array(
	array('label'=>'Create StockMovistarModel', 'url'=>array('create')),
	array('label'=>'Manage StockMovistarModel', 'url'=>array('admin')),
);
?>

<h1>Stock Movistar Models</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
