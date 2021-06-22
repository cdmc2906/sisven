<?php
/* @var $this ResultadoValidaChipController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Resultado Valida Chip Models',
);

$this->menu=array(
	array('label'=>'Create ResultadoValidaChipModel', 'url'=>array('create')),
	array('label'=>'Manage ResultadoValidaChipModel', 'url'=>array('admin')),
);
?>

<h1>Resultado Valida Chip Models</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
