<?php
/* @var $this RutaGestionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Ruta Gestion Models',
);

$this->menu=array(
	array('label'=>'Create RutaGestionModel', 'url'=>array('create')),
	array('label'=>'Manage RutaGestionModel', 'url'=>array('admin')),
);
?>

<h1>Ruta Gestion Models</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
