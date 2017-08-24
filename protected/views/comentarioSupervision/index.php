<?php
/* @var $this ComentarioSupervisionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Comentario Supervision',
);

$this->menu=array(
	array('label'=>'Crear Comentario Supervision', 'url'=>array('create')),
	array('label'=>'Administrar Comentarios Supervision', 'url'=>array('admin')),
);
?>

<h1>Comentario Supervision</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
