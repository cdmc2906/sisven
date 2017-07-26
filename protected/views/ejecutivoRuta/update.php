<?php
/* @var $this EjecutivoRutaController */
/* @var $model EjecutivoRutaModel */

$this->breadcrumbs=array(
	'Ejecutivo Ruta Models'=>array('index'),
	$model->er_cod=>array('view','id'=>$model->er_cod),
	'Update',
);

$this->menu=array(
	array('label'=>'List EjecutivoRutaModel', 'url'=>array('index')),
	array('label'=>'Create EjecutivoRutaModel', 'url'=>array('create')),
	array('label'=>'View EjecutivoRutaModel', 'url'=>array('view', 'id'=>$model->er_cod)),
	array('label'=>'Manage EjecutivoRutaModel', 'url'=>array('admin')),
);
?>

<h1>Update EjecutivoRutaModel <?php echo $model->er_cod; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>