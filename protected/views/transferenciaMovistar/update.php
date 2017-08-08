<?php
/* @var $this TransferenciaMovistarController */
/* @var $model TransferenciaMovistarModel */

$this->breadcrumbs=array(
	'Transferencia Movistar Models'=>array('index'),
	$model->tm_codigo=>array('view','id'=>$model->tm_codigo),
	'Update',
);

$this->menu=array(
	array('label'=>'List TransferenciaMovistarModel', 'url'=>array('index')),
	array('label'=>'Create TransferenciaMovistarModel', 'url'=>array('create')),
	array('label'=>'View TransferenciaMovistarModel', 'url'=>array('view', 'id'=>$model->tm_codigo)),
	array('label'=>'Manage TransferenciaMovistarModel', 'url'=>array('admin')),
);
?>

<h1>Update TransferenciaMovistarModel <?php echo $model->tm_codigo; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>