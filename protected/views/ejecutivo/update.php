<?php
/* @var $this EjecutivoController */
/* @var $model EjecutivoModel */

$this->breadcrumbs=array(
	'Ejecutivo Models'=>array('index'),
	$model->e_cod=>array('view','id'=>$model->e_cod),
	'Update',
);

$this->menu=array(
	array('label'=>'List EjecutivoModel', 'url'=>array('index')),
	array('label'=>'Create EjecutivoModel', 'url'=>array('create')),
	array('label'=>'View EjecutivoModel', 'url'=>array('view', 'id'=>$model->e_cod)),
	array('label'=>'Manage EjecutivoModel', 'url'=>array('admin')),
);
?>

<h1>Update EjecutivoModel <?php echo $model->e_cod; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>