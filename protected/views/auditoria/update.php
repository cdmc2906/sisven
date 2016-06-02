<?php
/* @var $this AuditoriaController */
/* @var $model AuditoriaModel */

$this->breadcrumbs=array(
	'Auditoria Models'=>array('index'),
	$model->ID_AUD=>array('view','id'=>$model->ID_AUD),
	'Update',
);

$this->menu=array(
	array('label'=>'List AuditoriaModel', 'url'=>array('index')),
	array('label'=>'Create AuditoriaModel', 'url'=>array('create')),
	array('label'=>'View AuditoriaModel', 'url'=>array('view', 'id'=>$model->ID_AUD)),
	array('label'=>'Manage AuditoriaModel', 'url'=>array('admin')),
);
?>

<h1>Update AuditoriaModel <?php echo $model->ID_AUD; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>