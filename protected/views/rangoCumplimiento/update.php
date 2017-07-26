<?php
/* @var $this RangoCumplimientoController */
/* @var $model RangoCumplimientoModel */

$this->breadcrumbs=array(
	'Rango Cumplimiento Models'=>array('index'),
	$model->c_cod=>array('view','id'=>$model->c_cod),
	'Update',
);

$this->menu=array(
	array('label'=>'List RangoCumplimientoModel', 'url'=>array('index')),
	array('label'=>'Create RangoCumplimientoModel', 'url'=>array('create')),
	array('label'=>'View RangoCumplimientoModel', 'url'=>array('view', 'id'=>$model->c_cod)),
	array('label'=>'Manage RangoCumplimientoModel', 'url'=>array('admin')),
);
?>

<h1>Update RangoCumplimientoModel <?php echo $model->c_cod; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>