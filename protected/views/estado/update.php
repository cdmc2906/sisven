<?php
/* @var $this EstadoController */
/* @var $model EstadoModel */

$this->breadcrumbs=array(
	'Estado Models'=>array('index'),
	$model->ID_EST=>array('view','id'=>$model->ID_EST),
	'Update',
);

$this->menu=array(
	array('label'=>'List EstadoModel', 'url'=>array('index')),
	array('label'=>'Create EstadoModel', 'url'=>array('create')),
	array('label'=>'View EstadoModel', 'url'=>array('view', 'id'=>$model->ID_EST)),
	array('label'=>'Manage EstadoModel', 'url'=>array('admin')),
);
?>

<h1>Update EstadoModel <?php echo $model->ID_EST; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>