<?php
/* @var $this HistorialClienteRutaController */
/* @var $model HistorialClienteRutaModel */

$this->breadcrumbs=array(
	'Historial Cliente Ruta Models'=>array('index'),
	$model->hcr_id,
);

$this->menu=array(
	array('label'=>'List HistorialClienteRutaModel', 'url'=>array('index')),
	array('label'=>'Create HistorialClienteRutaModel', 'url'=>array('create')),
	array('label'=>'Update HistorialClienteRutaModel', 'url'=>array('update', 'id'=>$model->hcr_id)),
	array('label'=>'Delete HistorialClienteRutaModel', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->hcr_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage HistorialClienteRutaModel', 'url'=>array('admin')),
);
?>

<h1>View HistorialClienteRutaModel #<?php echo $model->hcr_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'hcr_id',
		'hcr_codigo_cliente',
		'hcr_ruta_anterior',
		'hcr_ruta_nueva',
		'hcr_direccion_anterior',
		'hcr_direccion_nueva',
		'hcr_semana_anterior',
		'hcr_semana_nueva',
		'hcr_dia_anterior',
		'hcr_dia_nuevo',
		'hcr_secuencia_anterior',
		'hcr_secuencia_nueva',
		'hcr_estado_anterior',
		'hcr_estado_nuevo',
		'hcr_fch_actualiza_ruta',
		'hcr_cambios',
		'hcr_fch_ingreso',
		'hcr_fch_modificacion',
		'hcr_cod_usuario_ing_mod',
	),
)); ?>
