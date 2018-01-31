<?php
/* @var $this RevisionMinesController */
/* @var $model RevisionMinesModel */

$this->breadcrumbs=array(
	'Revision Mines Models'=>array('index'),
	$model->rmva_id,
);

$this->menu=array(
	array('label'=>'List RevisionMinesModel', 'url'=>array('index')),
	array('label'=>'Create RevisionMinesModel', 'url'=>array('create')),
	array('label'=>'Update RevisionMinesModel', 'url'=>array('update', 'id'=>$model->rmva_id)),
	array('label'=>'Delete RevisionMinesModel', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->rmva_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage RevisionMinesModel', 'url'=>array('admin')),
);
?>

<h1>View RevisionMinesModel #<?php echo $model->rmva_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'rmva_id',
		'iduser',
		'rmva_tipo',
		'rmva_fecha_gestion',
		'rmva_resultado_llamad',
		'rmva_motivo_no_contado',
		'rmva_operadora',
		'rmva_lugar_compra',
		'rmva_precio',
		'rmva_estado',
		'rmva_fecha_ingreso',
		'rmva_fecha_modifica',
		'rmva_cod_usuario_ing_mod',
	),
)); ?>
