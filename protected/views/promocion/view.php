<?php
/* @var $this PromocionController */
/* @var $model PromocionModel */

$this->breadcrumbs=array(
	'Promocion Models'=>array('index'),
	$model->pr_id,
);

$this->menu=array(
	array('label'=>'List PromocionModel', 'url'=>array('index')),
	array('label'=>'Create PromocionModel', 'url'=>array('create')),
	array('label'=>'Update PromocionModel', 'url'=>array('update', 'id'=>$model->pr_id)),
	array('label'=>'Delete PromocionModel', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->pr_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PromocionModel', 'url'=>array('admin')),
);
?>

<h1>View PromocionModel #<?php echo $model->pr_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'pr_id',
		'pr_nombre',
		'pr_fecha_inicio',
		'pr_fecha_fin',
		'pr_estado',
		'pr_ingreso',
		'pr_modificacion',
		'pr_id_usr_ing_mod',
	),
)); ?>
