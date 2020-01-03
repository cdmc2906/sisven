<?php
/* @var $this CondicionPromocionController */
/* @var $model CondicionPromocionModel */

$this->breadcrumbs=array(
	'Condicion Promocion Models'=>array('index'),
	$model->cpr_id,
);

$this->menu=array(
	array('label'=>'List CondicionPromocionModel', 'url'=>array('index')),
	array('label'=>'Create CondicionPromocionModel', 'url'=>array('create')),
	array('label'=>'Update CondicionPromocionModel', 'url'=>array('update', 'id'=>$model->cpr_id)),
	array('label'=>'Delete CondicionPromocionModel', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->cpr_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CondicionPromocionModel', 'url'=>array('admin')),
);
?>

<h1>View CondicionPromocionModel #<?php echo $model->cpr_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'cpr_id',
		'pr_id',
		'cpr_parametro',
		'cpr_operador',
		'cpr_valor_min',
		'cpr_valor_max',
		'cpr_estado',
		'cpr_fecha_ingreso',
		'cpr_fecha_modifica',
		'cpr_usr_ing_mod',
	),
)); ?>
