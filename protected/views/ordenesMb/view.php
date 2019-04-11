<?php
/* @var $this OrdenesMbController */
/* @var $model OrdenesMbModel */

$this->breadcrumbs=array(
	'Ordenes Mb Models'=>array('index'),
	$model->o_codigo,
);

$this->menu=array(
	array('label'=>'List OrdenesMbModel', 'url'=>array('index')),
	array('label'=>'Create OrdenesMbModel', 'url'=>array('create')),
	array('label'=>'Update OrdenesMbModel', 'url'=>array('update', 'id'=>$model->o_codigo)),
	array('label'=>'Delete OrdenesMbModel', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->o_codigo),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage OrdenesMbModel', 'url'=>array('admin')),
);
?>

<h1>View OrdenesMbModel #<?php echo $model->o_codigo; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'o_codigo',
		'pg_id',
		'o_id',
		'o_concepto',
		'o_codigo_mb',
		'o_comentario',
		'o_fch_venta',
		'o_fch_creacion',
		'o_fch_despacho',
		'o_tipo',
		'o_estatus',
		'o_cod_cliente',
		'o_nom_cliente',
		'o_id_cliente',
		'o_direccion',
		'o_lista_precio',
		'o_nom_lista_precio',
		'o_bodega_origen',
		'o_nom_bodega_origen',
		'o_termino_pago',
		'o_nom_termino_pago',
		'o_usuario',
		'o_nom_usuario',
		'o_departamento_ventas',
		'o_oficina',
		'o_nom_oficina',
		'o_tipo_secuencia',
		'o_iva_12_base',
		'o_iva_12_valor',
		'o_iva_0_base',
		'o_iva_0_valor',
		'o_iva_14_base',
		'o_iva_14_valor',
		'o_subtotal',
		'o_porcentaje_descuento',
		'o_descuento',
		'o_impuestos',
		'o_otros_cargos',
		'o_total',
		'o_datos',
		'o_referencia',
		'o_estado_proceso',
		'o_fch_ingreso',
		'o_fch_modificacion',
		'o_fch_desde',
		'o_fch_hasta',
		'o_usr_ing_mod',
	),
)); ?>
