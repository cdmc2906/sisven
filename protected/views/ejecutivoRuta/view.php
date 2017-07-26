<?php
/* @var $this EjecutivoRutaController */
/* @var $model EjecutivoRutaModel */

$this->breadcrumbs=array(
	'Ejecutivo Ruta Models'=>array('index'),
	$model->er_cod,
);

$this->menu=array(
	array('label'=>'List EjecutivoRutaModel', 'url'=>array('index')),
	array('label'=>'Create EjecutivoRutaModel', 'url'=>array('create')),
	array('label'=>'Update EjecutivoRutaModel', 'url'=>array('update', 'id'=>$model->er_cod)),
	array('label'=>'Delete EjecutivoRutaModel', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->er_cod),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage EjecutivoRutaModel', 'url'=>array('admin')),
);
?>

<h1>View EjecutivoRutaModel #<?php echo $model->er_cod; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'er_cod',
		'er_usuario',
		'er_usuario_nombre',
		'er_ruta',
		'er_ruta_nombre',
		'er_estatus',
		'er_fecha_ingreso',
		'er_fecha_asignacion',
		'er_fecha_modificacion',
		'er_cod_usr_ing',
		'er_cod_usr_mod',
	),
)); ?>
