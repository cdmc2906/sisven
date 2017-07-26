<?php
/* @var $this IndicadoresController */
/* @var $model IndicadoresModel */

$this->breadcrumbs=array(
	'Indicadores Models'=>array('index'),
	$model->i_codigo=>array('view','id'=>$model->i_codigo),
	'Update',
);

$this->menu=array(
	array('label'=>'List IndicadoresModel', 'url'=>array('index')),
	array('label'=>'Create IndicadoresModel', 'url'=>array('create')),
	array('label'=>'View IndicadoresModel', 'url'=>array('view', 'id'=>$model->i_codigo)),
	array('label'=>'Manage IndicadoresModel', 'url'=>array('admin')),
);
?>

<h1>Update IndicadoresModel <?php echo $model->i_codigo; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>