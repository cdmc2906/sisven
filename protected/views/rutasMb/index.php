<?php
/* @var $this RutasMbController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Ruta Mb Models',
);

$this->menu=array(
	array('label'=>'Create RutaMbModel', 'url'=>array('create')),
	array('label'=>'Manage RutaMbModel', 'url'=>array('admin')),
);
?>

<h1>Ruta Mb Models</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
