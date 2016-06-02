<?php
/* @var $this EmpresaController */
/* @var $model EmpresaModel */

$this->breadcrumbs=array(
	'Empresa Models'=>array('index'),
	$model->ID_EMP=>array('view','id'=>$model->ID_EMP),
	'Update',
);

$this->menu=array(
	array('label'=>'List EmpresaModel', 'url'=>array('index')),
	array('label'=>'Create EmpresaModel', 'url'=>array('create')),
	array('label'=>'View EmpresaModel', 'url'=>array('view', 'id'=>$model->ID_EMP)),
	array('label'=>'Manage EmpresaModel', 'url'=>array('admin')),
);
?>

<h1>Update EmpresaModel <?php echo $model->ID_EMP; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>