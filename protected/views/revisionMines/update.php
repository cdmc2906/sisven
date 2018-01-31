<?php
/* @var $this RevisionMinesController */
/* @var $model RevisionMinesModel */

$this->breadcrumbs=array(
	'Revision Mines Models'=>array('index'),
	$model->rmva_id=>array('view','id'=>$model->rmva_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List RevisionMinesModel', 'url'=>array('index')),
	array('label'=>'Create RevisionMinesModel', 'url'=>array('create')),
	array('label'=>'View RevisionMinesModel', 'url'=>array('view', 'id'=>$model->rmva_id)),
	array('label'=>'Manage RevisionMinesModel', 'url'=>array('admin')),
);
?>

<h1>Update RevisionMinesModel <?php echo $model->rmva_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>