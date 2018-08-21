<?php
/* @var $this PresupuestoVentaController */
/* @var $model PresupuestoVentaModel */

$this->breadcrumbs=array(
	'Presupuesto Venta Models'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List PresupuestoVentaModel', 'url'=>array('index')),
	array('label'=>'Manage PresupuestoVentaModel', 'url'=>array('admin')),
);
?>

<h1>Create PresupuestoVentaModel</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>