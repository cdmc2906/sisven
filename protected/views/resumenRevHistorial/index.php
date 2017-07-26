<?php
/* @var $this ResumenRevHistorialController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Resumen Rev Historial Models',
);

$this->menu=array(
	array('label'=>'Create ResumenRevHistorialModel', 'url'=>array('create')),
	array('label'=>'Manage ResumenRevHistorialModel', 'url'=>array('admin')),
);
?>

<h1>Resumen Rev Historial Models</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
