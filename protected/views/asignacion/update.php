<?php
/* @var $this AsignacionController */
/* @var $model AsignacionModel */

$this->breadcrumbs=array(
	'Asignacion Models'=>array('index'),
	$model->ID_ASIG=>array('view','id'=>$model->ID_ASIG),
	'Update',
);

$this->menu=array(
	array('label'=>'List AsignacionModel', 'url'=>array('index')),
	array('label'=>'Create AsignacionModel', 'url'=>array('create')),
	array('label'=>'View AsignacionModel', 'url'=>array('view', 'id'=>$model->ID_ASIG)),
	array('label'=>'Manage AsignacionModel', 'url'=>array('admin')),
);
?>

<h1>Update AsignacionModel <?php echo $model->ID_ASIG; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>