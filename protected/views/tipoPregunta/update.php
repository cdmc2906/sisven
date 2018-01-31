<?php
/* @var $this TipoPreguntaController */
/* @var $model TipoPreguntaModel */

$this->breadcrumbs=array(
	'Tipo Pregunta Models'=>array('index'),
	$model->tpreg_id=>array('view','id'=>$model->tpreg_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List TipoPreguntaModel', 'url'=>array('index')),
	array('label'=>'Create TipoPreguntaModel', 'url'=>array('create')),
	array('label'=>'View TipoPreguntaModel', 'url'=>array('view', 'id'=>$model->tpreg_id)),
	array('label'=>'Manage TipoPreguntaModel', 'url'=>array('admin')),
);
?>

<h1>Update TipoPreguntaModel <?php echo $model->tpreg_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>