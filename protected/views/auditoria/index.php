<?php
/* @var $this AuditoriaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Auditoria Models',
);

$this->menu=array(
	array('label'=>'Create AuditoriaModel', 'url'=>array('create')),
	array('label'=>'Manage AuditoriaModel', 'url'=>array('admin')),
);
?>

<h1>Auditoria Models</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
