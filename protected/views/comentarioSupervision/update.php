<?php
/* @var $this ComentarioSupervisionController */
/* @var $model ComentarioSupervisionModel */

$this->breadcrumbs=array(
	'Comentario Supervision Models'=>array('index'),
	$model->cs_id=>array('view','id'=>$model->cs_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ComentarioSupervisionModel', 'url'=>array('index')),
	array('label'=>'Create ComentarioSupervisionModel', 'url'=>array('create')),
	array('label'=>'View ComentarioSupervisionModel', 'url'=>array('view', 'id'=>$model->cs_id)),
	array('label'=>'Manage ComentarioSupervisionModel', 'url'=>array('admin')),
);
?>

<h1>Update ComentarioSupervisionModel <?php echo $model->cs_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>