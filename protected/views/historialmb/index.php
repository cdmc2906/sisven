<?php
/* @var $this HistorialMbControllerController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Historial',
);

$this->menu=array(
//	array('label'=>'Ingresar item Historial', 'url'=>array('create')),
	array('label'=>'Administrar Historial', 'url'=>array('admin')),
);
?>

<h1>Historial</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
