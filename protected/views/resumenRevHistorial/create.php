<?php
/* @var $this ResumenRevHistorialController */
/* @var $model ResumenRevHistorialModel */

$this->breadcrumbs=array(
	'Resumen Rev Historial Models'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ResumenRevHistorialModel', 'url'=>array('index')),
	array('label'=>'Manage ResumenRevHistorialModel', 'url'=>array('admin')),
);
?>

<h1>Create ResumenRevHistorialModel</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>