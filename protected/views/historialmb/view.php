<?php
/* @var $this HistorialMbControllerController */
/* @var $model HistorialMbModel */

$this->breadcrumbs=array(
	'Historial'=>array('index'),
	$model->h_cod,
);

$this->menu=array(
//	array('label'=>'List HistorialMbModel', 'url'=>array('index')),
	array('label'=>'Ingresar item Historial', 'url'=>array('create')),
	array('label'=>'Actualizar item Historial', 'url'=>array('update', 'id'=>$model->h_cod)),
	array('label'=>'Eliminiar item Historial', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->h_cod),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Administracion Historial', 'url'=>array('admin')),
);
?>

<h1>Informacion item Historial codigo: <?php echo $model->h_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'h_cod',
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
	),
)); ?>
