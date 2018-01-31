<?php
/* @var $this TipoPreguntaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tipo Pregunta Models',
);

$this->menu=array(
	array('label'=>'Create TipoPreguntaModel', 'url'=>array('create')),
	array('label'=>'Manage TipoPreguntaModel', 'url'=>array('admin')),
);
?>

<h1>Tipo Pregunta Models</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
