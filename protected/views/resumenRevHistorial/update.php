<?php
/* @var $this ResumenRevHistorialController */
/* @var $model ResumenRevHistorialModel */

$this->breadcrumbs=array(
	'Resumen Rev Historial Models'=>array('index'),
	$model->rrh_id=>array('view','id'=>$model->rrh_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ResumenRevHistorialModel', 'url'=>array('index')),
	array('label'=>'Create ResumenRevHistorialModel', 'url'=>array('create')),
	array('label'=>'View ResumenRevHistorialModel', 'url'=>array('view', 'id'=>$model->rrh_id)),
	array('label'=>'Manage ResumenRevHistorialModel', 'url'=>array('admin')),
);
?>

<h1>Update ResumenRevHistorialModel <?php echo $model->rrh_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>