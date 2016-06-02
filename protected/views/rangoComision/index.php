<?php
/* @var $this RangoComisionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Rango Comision Models',
);

$this->menu=array(
	array('label'=>'Create RangoComisionModel', 'url'=>array('create')),
	array('label'=>'Manage RangoComisionModel', 'url'=>array('admin')),
);
?>

<h1>Rango Comision Models</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
