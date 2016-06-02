<?php
/* @var $this RangoComisionController */
/* @var $model RangoComisionModel */

$this->breadcrumbs=array(
	'Rango Comision Models'=>array('index'),
	$model->ID_RCOM=>array('view','id'=>$model->ID_RCOM),
	'Update',
);

$this->menu=array(
	array('label'=>'List RangoComisionModel', 'url'=>array('index')),
	array('label'=>'Create RangoComisionModel', 'url'=>array('create')),
	array('label'=>'View RangoComisionModel', 'url'=>array('view', 'id'=>$model->ID_RCOM)),
	array('label'=>'Manage RangoComisionModel', 'url'=>array('admin')),
);
?>

<h1>Update RangoComisionModel <?php echo $model->ID_RCOM; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>