<?php
/* @var $this HistorialMbController */
/* @var $model HistorialMbModel */

$this->breadcrumbs=array(
	'Historial Mb Models'=>array('index'),
	$model->h_cod,
);

$this->menu=array(
	array('label'=>'List HistorialMbModel', 'url'=>array('index')),
	array('label'=>'Create HistorialMbModel', 'url'=>array('create')),
	array('label'=>'Update HistorialMbModel', 'url'=>array('update', 'id'=>$model->h_cod)),
	array('label'=>'Delete HistorialMbModel', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->h_cod),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage HistorialMbModel', 'url'=>array('admin')),
);
?>

<h1>View HistorialMbModel #<?php echo $model->h_cod; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'h_cod',
		'pg_id',
		'h_id',
		'h_fecha',
		'h_usuario',
		'h_ruta',
		'h_ruta_nombre',
		'h_semana',
		'h_dia',
		'h_cod_cliente',
		'h_nom_cliente',
		'h_direccion',
		'h_accion',
		'h_cod_accion',
		'h_cod_comentario',
		'h_comentario',
		'h_monto',
		'h_latitud',
		'h_longitud',
		'h_romper_secuencia',
		'h_fch_ingreso',
		'h_fch_modificacion',
		'h_fch_desde',
		'h_fch_hasta',
		'h_usr_ing_mod',
		'h_usuario_nombre',
	),
)); ?>
