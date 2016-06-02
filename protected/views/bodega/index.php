<?php
/* @var $this BodegaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Bodega Models',
);

$this->menu=array(
	array('label'=>'Create BodegaModel', 'url'=>array('create')),
	array('label'=>'Manage BodegaModel', 'url'=>array('admin')),
);
?>

<h1>Bodega Models</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
