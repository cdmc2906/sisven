<?php
/* @var $this NovedadesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Novedades Models',
);

$this->menu=array(
	array('label'=>'Create NovedadesModel', 'url'=>array('create')),
	array('label'=>'Manage NovedadesModel', 'url'=>array('admin')),
);
?>

<h1>Novedades Models</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
