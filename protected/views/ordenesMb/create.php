<?php
/* @var $this OrdenesMbController */
/* @var $model OrdenesMbModel */

$this->breadcrumbs=array(
	'Ordenes Mb Models'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List OrdenesMbModel', 'url'=>array('index')),
	array('label'=>'Manage OrdenesMbModel', 'url'=>array('admin')),
);
?>

<h1>Create OrdenesMbModel</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>