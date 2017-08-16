<?php
/* @var $this ComentarioOficinaController */
/* @var $model ComentarioOficinaModel */

$this->breadcrumbs=array(
	'Comentario Oficina Models'=>array('index'),
	$model->co_id=>array('view','id'=>$model->co_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ComentarioOficinaModel', 'url'=>array('index')),
	array('label'=>'Create ComentarioOficinaModel', 'url'=>array('create')),
	array('label'=>'View ComentarioOficinaModel', 'url'=>array('view', 'id'=>$model->co_id)),
	array('label'=>'Manage ComentarioOficinaModel', 'url'=>array('admin')),
);
?>

<h1>Update ComentarioOficinaModel <?php echo $model->co_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>