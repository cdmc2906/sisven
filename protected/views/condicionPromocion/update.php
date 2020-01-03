<?php
/* @var $this CondicionPromocionController */
/* @var $model CondicionPromocionModel */

$this->breadcrumbs=array(
	'Condicion Promocion Models'=>array('index'),
	$model->cpr_id=>array('view','id'=>$model->cpr_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List CondicionPromocionModel', 'url'=>array('index')),
	array('label'=>'Create CondicionPromocionModel', 'url'=>array('create')),
	array('label'=>'View CondicionPromocionModel', 'url'=>array('view', 'id'=>$model->cpr_id)),
	array('label'=>'Manage CondicionPromocionModel', 'url'=>array('admin')),
);
?>

<h1>Update CondicionPromocionModel <?php echo $model->cpr_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>