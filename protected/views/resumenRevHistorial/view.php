<?php
/* @var $this ResumenRevHistorialController */
/* @var $model ResumenRevHistorialModel */

$this->breadcrumbs=array(
	'Resumen Rev Historial Models'=>array('index'),
	$model->rrh_id,
);

$this->menu=array(
	array('label'=>'List ResumenRevHistorialModel', 'url'=>array('index')),
	array('label'=>'Create ResumenRevHistorialModel', 'url'=>array('create')),
	array('label'=>'Update ResumenRevHistorialModel', 'url'=>array('update', 'id'=>$model->rrh_id)),
	array('label'=>'Delete ResumenRevHistorialModel', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->rrh_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ResumenRevHistorialModel', 'url'=>array('admin')),
);
?>

<h1>View ResumenRevHistorialModel #<?php echo $model->rrh_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'rrh_id',
		'rrh_fecha',
		'rrh_ejecutivo',
		'rrh_nivel_cumplimiento',
		'rrh_visitas_efectuadas',
		'rrh_clientes_ruta',
		'rrh_cliente_no_visitados',
		'rrh_visitas_fuera_ruta',
		'rrh_cantidad_venta_ruta',
		'rrh_cantidad_venta_fuera_ruta',
		'rrh_clientes_venta',
		'rrh_total_venta_reportada',
		'rrh_fecha_ingreso',
		'rrh_fecha_modificar',
		'rrh_usr_ingresa',
		'rrh_usr_modifica',
	),
)); ?>
