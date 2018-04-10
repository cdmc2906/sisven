<?php
/* @var $this PeriodoGestionController */
/* @var $model PeriodoGestionModel */

$this->breadcrumbs=array(
	'Periodo Gestion Models'=>array('index'),
	$model->pg_id=>array('view','id'=>$model->pg_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List PeriodoGestionModel', 'url'=>array('index')),
	array('label'=>'Create PeriodoGestionModel', 'url'=>array('create')),
	array('label'=>'View PeriodoGestionModel', 'url'=>array('view', 'id'=>$model->pg_id)),
	array('label'=>'Manage PeriodoGestionModel', 'url'=>array('admin')),
);
?>

<h1>Update PeriodoGestionModel <?php echo $model->pg_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>