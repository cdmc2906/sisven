<?php
/* @var $this DetalleRevisionHistorialController */
/* @var $model DetalleRevisionHistorialModel */

$this->breadcrumbs=array(
	'Detalle Revision Historial Models'=>array('index'),
	$model->drh_id=>array('view','id'=>$model->drh_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List DetalleRevisionHistorialModel', 'url'=>array('index')),
	array('label'=>'Create DetalleRevisionHistorialModel', 'url'=>array('create')),
	array('label'=>'View DetalleRevisionHistorialModel', 'url'=>array('view', 'id'=>$model->drh_id)),
	array('label'=>'Manage DetalleRevisionHistorialModel', 'url'=>array('admin')),
);
?>

<h1>Update DetalleRevisionHistorialModel <?php echo $model->drh_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>