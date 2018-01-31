<?php
/* @var $this ZonasGestionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Zonas Gestion Models',
);

$this->menu=array(
	array('label'=>'Create ZonasGestionModel', 'url'=>array('create')),
	array('label'=>'Manage ZonasGestionModel', 'url'=>array('admin')),
);
?>

<h1>Zonas Gestion Models</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
