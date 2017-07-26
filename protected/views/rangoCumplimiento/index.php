<?php
/* @var $this RangoCumplimientoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Rango Cumplimiento Models',
);

$this->menu=array(
	array('label'=>'Create RangoCumplimientoModel', 'url'=>array('create')),
	array('label'=>'Manage RangoCumplimientoModel', 'url'=>array('admin')),
);
?>

<h1>Rango Cumplimiento Models</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
