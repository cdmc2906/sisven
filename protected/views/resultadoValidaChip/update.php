<?php
/* @var $this ResultadoValidaChipController */
/* @var $model ResultadoValidaChipModel */

$this->breadcrumbs=array(
	'Resultado Valida Chip Models'=>array('index'),
	$model->rvc_id=>array('view','id'=>$model->rvc_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ResultadoValidaChipModel', 'url'=>array('index')),
	array('label'=>'Create ResultadoValidaChipModel', 'url'=>array('create')),
	array('label'=>'View ResultadoValidaChipModel', 'url'=>array('view', 'id'=>$model->rvc_id)),
	array('label'=>'Manage ResultadoValidaChipModel', 'url'=>array('admin')),
);
?>

<h1>Update ResultadoValidaChipModel <?php echo $model->rvc_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>