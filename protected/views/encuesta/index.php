<?php
/* @var $this EncuestaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Encuesta Models',
);

$this->menu=array(
	array('label'=>'Create EncuestaModel', 'url'=>array('create')),
	array('label'=>'Manage EncuestaModel', 'url'=>array('admin')),
);
?>

<h1>Encuesta Models</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
