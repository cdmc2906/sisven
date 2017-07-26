<?php
/* @var $this ControlHistorialRutaController */
/* @var $model ControlHistorialRutaModel */

$this->breadcrumbs=array(
	'Control Historial Ruta Models'=>array('index'),
	$model->rh_id=>array('view','id'=>$model->rh_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ControlHistorialRutaModel', 'url'=>array('index')),
	array('label'=>'Create ControlHistorialRutaModel', 'url'=>array('create')),
	array('label'=>'View ControlHistorialRutaModel', 'url'=>array('view', 'id'=>$model->rh_id)),
	array('label'=>'Manage ControlHistorialRutaModel', 'url'=>array('admin')),
);
?>

<h1>Update ControlHistorialRutaModel <?php echo $model->rh_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>