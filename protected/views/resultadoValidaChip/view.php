<?php
/* @var $this ResultadoValidaChipController */
/* @var $model ResultadoValidaChipModel */

$this->breadcrumbs=array(
	'Resultado Valida Chip Models'=>array('index'),
	$model->rvc_id,
);

$this->menu=array(
	array('label'=>'List ResultadoValidaChipModel', 'url'=>array('index')),
	array('label'=>'Create ResultadoValidaChipModel', 'url'=>array('create')),
	array('label'=>'Update ResultadoValidaChipModel', 'url'=>array('update', 'id'=>$model->rvc_id)),
	array('label'=>'Delete ResultadoValidaChipModel', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->rvc_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ResultadoValidaChipModel', 'url'=>array('admin')),
);
?>

<h1>View ResultadoValidaChipModel #<?php echo $model->rvc_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'rvc_id',
		'rvc_dato_chip',
		'rvc_tipo_validacion',
		'rvc_subtipo_validacion',
		'rvc_resultado_validacion',
		'rvc_ejecutivo',
		'rvc_solicitud_fecha',
		'rvc_solicitud_ip',
		'rvc_solicitud_dispositivo',
		'rvc_solicitud_navegador',
		'rvc_estado_validacion',
	),
)); ?>
