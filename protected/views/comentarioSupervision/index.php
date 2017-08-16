<?php
/* @var $this ComentarioSupervisionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Comentario Supervision Models',
);

$this->menu=array(
	array('label'=>'Create ComentarioSupervisionModel', 'url'=>array('create')),
	array('label'=>'Manage ComentarioSupervisionModel', 'url'=>array('admin')),
);
?>

<h1>Comentario Supervision Models</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
