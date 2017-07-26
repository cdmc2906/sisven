<?php
/* @var $this IndicadoresController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Indicadores Models',
);

$this->menu=array(
	array('label'=>'Create IndicadoresModel', 'url'=>array('create')),
	array('label'=>'Manage IndicadoresModel', 'url'=>array('admin')),
);
?>

<h1>Indicadores Models</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
