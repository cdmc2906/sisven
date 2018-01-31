<?php
/* @var $this RolController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Rol Models',
);

$this->menu=array(
	array('label'=>'Create RolModel', 'url'=>array('create')),
	array('label'=>'Manage RolModel', 'url'=>array('admin')),
);
?>

<h1>Rol Models</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
