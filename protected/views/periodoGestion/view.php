<?php
/* @var $this PeriodoGestionController */
/* @var $model PeriodoGestionModel */

$this->breadcrumbs=array(
	'Periodo Gestion Models'=>array('index'),
	$model->pg_id,
);

$this->menu=array(
	array('label'=>'List PeriodoGestionModel', 'url'=>array('index')),
	array('label'=>'Create PeriodoGestionModel', 'url'=>array('create')),
	array('label'=>'Update PeriodoGestionModel', 'url'=>array('update', 'id'=>$model->pg_id)),
	array('label'=>'Delete PeriodoGestionModel', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->pg_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PeriodoGestionModel', 'url'=>array('admin')),
);
?>

<h1>View PeriodoGestionModel #<?php echo $model->pg_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'pg_id',
		'pg_descripcion',
		'pg_fecha_inicio',
		'pg_fecha_fin',
		'pg_estado',
		'pg_tipo',
		'pg_fecha_ingreso',
		'pg_fecha_modificacion',
		'pg_cod_usuario_ing_mod',
	),
)); ?>
