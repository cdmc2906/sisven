<?php
/* @var $this EjecutivoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Ejecutivo Models',
);

$this->menu=array(
	array('label'=>'Create EjecutivoModel', 'url'=>array('create')),
	array('label'=>'Manage EjecutivoModel', 'url'=>array('admin')),
);
?>

<h1>Ejecutivo Models</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
