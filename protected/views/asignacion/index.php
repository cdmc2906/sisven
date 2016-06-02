<?php
/* @var $this AsignacionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Asignacion Models',
);

$this->menu=array(
	array('label'=>'Create AsignacionModel', 'url'=>array('create')),
	array('label'=>'Manage AsignacionModel', 'url'=>array('admin')),
);
?>

<h1>Asignacion Models</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
