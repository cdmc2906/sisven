<?php
/* @var $this IndicadoresController */
/* @var $model IndicadoresModel */

$this->breadcrumbs=array(
	'Indicadores Models'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List IndicadoresModel', 'url'=>array('index')),
	array('label'=>'Manage IndicadoresModel', 'url'=>array('admin')),
);
?>

<h1>Create IndicadoresModel</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>