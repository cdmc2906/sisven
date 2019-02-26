<?php
/* @var $this ClienteDireccionController */
/* @var $model ClienteDireccionModel */

$this->breadcrumbs=array(
	'Cliente Direccion Models'=>array('index'),
	$model->dcli_id,
);

$this->menu=array(
	array('label'=>'List ClienteDireccionModel', 'url'=>array('index')),
	array('label'=>'Create ClienteDireccionModel', 'url'=>array('create')),
	array('label'=>'Update ClienteDireccionModel', 'url'=>array('update', 'id'=>$model->dcli_id)),
	array('label'=>'Delete ClienteDireccionModel', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->dcli_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ClienteDireccionModel', 'url'=>array('admin')),
);
?>

<h1>View ClienteDireccionModel #<?php echo $model->dcli_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'dcli_id',
		'dcli_codigo',
		'dcli_cliente',
		'dcli_cliente_nombre',
		'dcli_cliente_identificacion',
		'dcli_cliente_comentario',
		'dcli_oficina',
		'dcli_oficina_nombre',
		'dcli_codigo_de_barras',
		'dcli_descripcion',
		'dcli_contacto',
		'dcli_geo_area',
		'dcli_geo_area_nombre',
		'dcli_geo_area_codigo_recorrido',
		'dcli_geo_area_descripcion_recorrido',
		'dcli_provincia',
		'dcli_canton',
		'dcli_parroquia',
		'dcli_calle_principal',
		'dcli_nomenclatura',
		'dcli_calle_secundaria',
		'dcli_referencia',
		'dcli_codigo_postal',
		'dcli_telefono',
		'dcli_fax',
		'dcli_email',
		'dcli_latitud',
		'dcli_longitud',
		'dcli_ultima_visita',
		'dcli_estado_de_localizacion',
		'dcli_fecha_ingreso',
		'dcli_usr_ingresa',
		'dcli_fecha_modifica',
		'dcli_usr_modifica',
	),
)); ?>
