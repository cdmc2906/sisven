<?php
/* @var $this RutaGestionController */
/* @var $model RutaGestionModel */

$this->breadcrumbs=array(
	'Ruta Gestion Models'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List RutaGestionModel', 'url'=>array('index')),
	array('label'=>'Manage RutaGestionModel', 'url'=>array('admin')),
);
?>

<h1>Create RutaGestionModel</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>