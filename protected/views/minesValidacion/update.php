<?php
/* @var $this MinesValidacionController */
/* @var $model MinesValidacionModel */

$this->breadcrumbs=array(
	'Mines Validacion Models'=>array('index'),
	$model->miva_id=>array('view','id'=>$model->miva_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List MinesValidacionModel', 'url'=>array('index')),
	array('label'=>'Create MinesValidacionModel', 'url'=>array('create')),
	array('label'=>'View MinesValidacionModel', 'url'=>array('view', 'id'=>$model->miva_id)),
	array('label'=>'Manage MinesValidacionModel', 'url'=>array('admin')),
);
?>

<h1>Update MinesValidacionModel <?php echo $model->miva_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>