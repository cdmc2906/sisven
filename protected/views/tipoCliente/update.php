<?php
/* @var $this TipoClienteController */
/* @var $model TipoClienteModel */

$this->breadcrumbs=array(
	'Tipo Cliente Models'=>array('index'),
	$model->ID_TCLI=>array('view','id'=>$model->ID_TCLI),
	'Update',
);

$this->menu=array(
	array('label'=>'List TipoClienteModel', 'url'=>array('index')),
	array('label'=>'Create TipoClienteModel', 'url'=>array('create')),
	array('label'=>'View TipoClienteModel', 'url'=>array('view', 'id'=>$model->ID_TCLI)),
	array('label'=>'Manage TipoClienteModel', 'url'=>array('admin')),
);
?>

<h1>Update TipoClienteModel <?php echo $model->ID_TCLI; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>