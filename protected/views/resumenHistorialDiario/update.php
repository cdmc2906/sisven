<?php
/* @var $this ResumenHistorialDiarioController */
/* @var $model ResumenHistorialDiarioModel */

$this->breadcrumbs=array(
	'Resumen Historial Diario Models'=>array('index'),
	$model->rhd_codigo=>array('view','id'=>$model->rhd_codigo),
	'Update',
);

$this->menu=array(
	array('label'=>'List ResumenHistorialDiarioModel', 'url'=>array('index')),
	array('label'=>'Create ResumenHistorialDiarioModel', 'url'=>array('create')),
	array('label'=>'View ResumenHistorialDiarioModel', 'url'=>array('view', 'id'=>$model->rhd_codigo)),
	array('label'=>'Manage ResumenHistorialDiarioModel', 'url'=>array('admin')),
);
?>

<h1>Update ResumenHistorialDiarioModel <?php echo $model->rhd_codigo; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>