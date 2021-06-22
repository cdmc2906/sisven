<?php
/* @var $this ResultadoValidaChipController */
/* @var $model ResultadoValidaChipModel */

$this->breadcrumbs=array(
	'Resultado Valida Chip Models'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ResultadoValidaChipModel', 'url'=>array('index')),
	array('label'=>'Manage ResultadoValidaChipModel', 'url'=>array('admin')),
);
?>

<h1>Create ResultadoValidaChipModel</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>