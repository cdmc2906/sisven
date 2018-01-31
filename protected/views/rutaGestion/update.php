<?php
/* @var $this RutaGestionController */
/* @var $model RutaGestionModel */

$this->breadcrumbs=array(
	'Ruta Gestion Models'=>array('index'),
	$model->rg_id=>array('view','id'=>$model->rg_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List RutaGestionModel', 'url'=>array('index')),
	array('label'=>'Create RutaGestionModel', 'url'=>array('create')),
	array('label'=>'View RutaGestionModel', 'url'=>array('view', 'id'=>$model->rg_id)),
	array('label'=>'Manage RutaGestionModel', 'url'=>array('admin')),
);
?>

<h1>Update RutaGestionModel <?php echo $model->rg_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>