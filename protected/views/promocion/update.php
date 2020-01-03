<?php
/* @var $this PromocionController */
/* @var $model PromocionModel */

$this->breadcrumbs=array(
	'Promocion Models'=>array('index'),
	$model->pr_id=>array('view','id'=>$model->pr_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List PromocionModel', 'url'=>array('index')),
	array('label'=>'Create PromocionModel', 'url'=>array('create')),
	array('label'=>'View PromocionModel', 'url'=>array('view', 'id'=>$model->pr_id)),
	array('label'=>'Manage PromocionModel', 'url'=>array('admin')),
);
?>

<h1>Update PromocionModel <?php echo $model->pr_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>