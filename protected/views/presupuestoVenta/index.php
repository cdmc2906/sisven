<?php
/* @var $this PresupuestoVentaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Presupuesto Venta Models',
);

$this->menu=array(
	array('label'=>'Create PresupuestoVentaModel', 'url'=>array('create')),
	array('label'=>'Manage PresupuestoVentaModel', 'url'=>array('admin')),
);
?>

<h1>Presupuesto Venta Models</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
