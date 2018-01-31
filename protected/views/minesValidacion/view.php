<?php
/* @var $this MinesValidacionController */
/* @var $model MinesValidacionModel */

$this->breadcrumbs=array(
	'Mines Validacion Models'=>array('index'),
	$model->miva_id,
);

$this->menu=array(
	array('label'=>'List MinesValidacionModel', 'url'=>array('index')),
	array('label'=>'Create MinesValidacionModel', 'url'=>array('create')),
	array('label'=>'Update MinesValidacionModel', 'url'=>array('update', 'id'=>$model->miva_id)),
	array('label'=>'Delete MinesValidacionModel', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->miva_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage MinesValidacionModel', 'url'=>array('admin')),
);
?>

<h1>View MinesValidacionModel #<?php echo $model->miva_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'miva_id',
		'iduser',
		'miva_carga',
		'miva_tipo',
		'miva_fecha',
		'miva_bodega',
		'miva_nomcli',
		'miva_codgrup',
		'miva_detalle',
		'miva_imei',
		'miva_min',
		'miva_vendedor',
		'miva_estado',
		'miva_estado_reasignacion',
		'miva_usario_reasignado',
		'miva_fecha_ingreso',
		'miva_fecha_modifica',
		'miva_cod_usuario_ing_mod',
	),
)); ?>
