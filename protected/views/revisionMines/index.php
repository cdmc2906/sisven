<?php
/* @var $this RevisionMinesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Revision Mines Models',
);

$this->menu=array(
	array('label'=>'Create RevisionMinesModel', 'url'=>array('create')),
	array('label'=>'Manage RevisionMinesModel', 'url'=>array('admin')),
);
?>

<h1>Revision Mines Models</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
