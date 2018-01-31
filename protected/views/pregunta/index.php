<?php
/* @var $this PreguntaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Pregunta Models',
);

$this->menu=array(
	array('label'=>'Create PreguntaModel', 'url'=>array('create')),
	array('label'=>'Manage PreguntaModel', 'url'=>array('admin')),
);
?>

<h1>Pregunta Models</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
