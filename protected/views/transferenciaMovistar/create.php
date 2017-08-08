<?php
/* @var $this TransferenciaMovistarController */
/* @var $model TransferenciaMovistarModel */

$this->breadcrumbs=array(
	'Transferencia Movistar Models'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TransferenciaMovistarModel', 'url'=>array('index')),
	array('label'=>'Manage TransferenciaMovistarModel', 'url'=>array('admin')),
);
?>

<h1>Create TransferenciaMovistarModel</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>