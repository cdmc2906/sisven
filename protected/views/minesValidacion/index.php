<?php
/* @var $this MinesValidacionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Mines Validacion Models',
);

$this->menu=array(
	array('label'=>'Create MinesValidacionModel', 'url'=>array('create')),
	array('label'=>'Manage MinesValidacionModel', 'url'=>array('admin')),
);
?>

<h1>Mines Validacion Models</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
