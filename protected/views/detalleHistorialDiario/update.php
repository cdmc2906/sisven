<?php
/* @var $this DetalleHistorialDiarioController */
/* @var $model DetalleHistorialDiarioModel */

$this->breadcrumbs=array(
	'Detalle Historial Diario Models'=>array('index'),
	$model->rh_id=>array('view','id'=>$model->rh_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List DetalleHistorialDiarioModel', 'url'=>array('index')),
	array('label'=>'Create DetalleHistorialDiarioModel', 'url'=>array('create')),
	array('label'=>'View DetalleHistorialDiarioModel', 'url'=>array('view', 'id'=>$model->rh_id)),
	array('label'=>'Manage DetalleHistorialDiarioModel', 'url'=>array('admin')),
);
?>

<h1>Update DetalleHistorialDiarioModel <?php echo $model->rh_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>