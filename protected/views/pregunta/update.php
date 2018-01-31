<?php
/* @var $this PreguntaController */
/* @var $model PreguntaModel */

$this->breadcrumbs=array(
	'Pregunta Models'=>array('index'),
	$model->preg_id=>array('view','id'=>$model->preg_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List PreguntaModel', 'url'=>array('index')),
	array('label'=>'Create PreguntaModel', 'url'=>array('create')),
	array('label'=>'View PreguntaModel', 'url'=>array('view', 'id'=>$model->preg_id)),
	array('label'=>'Manage PreguntaModel', 'url'=>array('admin')),
);
?>

<h1>Update PreguntaModel <?php echo $model->preg_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>