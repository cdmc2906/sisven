<?php
/* @var $this EncuestaController */
/* @var $model EncuestaModel */

$this->breadcrumbs=array(
	'Encuesta Models'=>array('index'),
	$model->enc_id=>array('view','id'=>$model->enc_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List EncuestaModel', 'url'=>array('index')),
	array('label'=>'Create EncuestaModel', 'url'=>array('create')),
	array('label'=>'View EncuestaModel', 'url'=>array('view', 'id'=>$model->enc_id)),
	array('label'=>'Manage EncuestaModel', 'url'=>array('admin')),
);
?>

<h1>Update EncuestaModel <?php echo $model->enc_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>