<?php
/* @var $this NotifyiiReadsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Notificaciones Leidas',
);

$this->menu=array(
	array('label'=>'Crear Notificaciones Leidas', 'url'=>array('create')),
	array('label'=>'Administrar Notificaciones Leidas', 'url'=>array('admin')),
);
?>

<h1>Notificaciones Leidas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
