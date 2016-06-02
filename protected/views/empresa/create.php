<?php
/* @var $this EmpresaController */
/* @var $model EmpresaModel */

$this->breadcrumbs=array(
	'Empresa Models'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List EmpresaModel', 'url'=>array('index')),
	array('label'=>'Manage EmpresaModel', 'url'=>array('admin')),
);
?>

<h1>Create EmpresaModel</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>