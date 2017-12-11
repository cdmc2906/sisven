<?php
/* @var $this PresupuestoVentaController */
/* @var $model PresupuestoVentaModel */

$this->breadcrumbs=array(
	'Presupuesto Venta Models'=>array('index'),
	$model->p_id=>array('view','id'=>$model->p_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List PresupuestoVentaModel', 'url'=>array('index')),
	array('label'=>'Create PresupuestoVentaModel', 'url'=>array('create')),
	array('label'=>'View PresupuestoVentaModel', 'url'=>array('view', 'id'=>$model->p_id)),
	array('label'=>'Manage PresupuestoVentaModel', 'url'=>array('admin')),
);
?>

<h1>Update PresupuestoVentaModel <?php echo $model->p_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>