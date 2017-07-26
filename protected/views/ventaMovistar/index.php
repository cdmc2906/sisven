<?php
/* @var $this VentaMovistarController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Venta Movistar Models',
);

$this->menu=array(
	array('label'=>'Create VentaMovistarModel', 'url'=>array('create')),
	array('label'=>'Manage VentaMovistarModel', 'url'=>array('admin')),
);
?>

<h1>Venta Movistar Models</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
