<?php
/* @var $this ComentarioOficinaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Comentario Oficina Models',
);

$this->menu=array(
	array('label'=>'Create ComentarioOficinaModel', 'url'=>array('create')),
	array('label'=>'Manage ComentarioOficinaModel', 'url'=>array('admin')),
);
?>

<h1>Comentario Oficina Models</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
