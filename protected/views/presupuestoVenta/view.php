<?php
/* @var $this PresupuestoVentaController */
/* @var $model PresupuestoVentaModel */

$this->breadcrumbs=array(
	'Presupuesto Venta Models'=>array('index'),
	$model->p_id,
);

$this->menu=array(
	array('label'=>'List PresupuestoVentaModel', 'url'=>array('index')),
	array('label'=>'Create PresupuestoVentaModel', 'url'=>array('create')),
	array('label'=>'Update PresupuestoVentaModel', 'url'=>array('update', 'id'=>$model->p_id)),
	array('label'=>'Delete PresupuestoVentaModel', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->p_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PresupuestoVentaModel', 'url'=>array('admin')),
);
?>

<h1>View PresupuestoVentaModel #<?php echo $model->p_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'p_id',
		'p_codigo_vendedor',
		'p_fecha_ini_validez',
		'p_fecha_fin_validez',
		'p_dias_laborables',
		'p_valor_presupuesto',
		'p_tipo_presupuesto',
		'p_cantidad_feriados',
		'p_venta_diaria_esperada',
		'p_estado_presupuesto',
		'p_fecha_ingreso',
		'p_fecha_modifica',
		'p_cod_usuario_ing_mod',
	),
)); ?>
