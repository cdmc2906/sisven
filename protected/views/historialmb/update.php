<?php
/* @var $this HistorialMbControllerController */
/* @var $model HistorialMbModel */

$this->breadcrumbs=array(
	'Historial'=>array('index'),
	$model->h_cod=>array('view','id'=>$model->h_cod),
	'Actualizar item',
);

$this->menu=array(
//	array('label'=>'List HistorialMbModel', 'url'=>array('index')),
//	array('label'=>'Ingresar item Historial', 'url'=>array('create')),
//	array('label'=>'Mostrar item Historial', 'url'=>array('view', 'id'=>$model->h_cod)),
	array('label'=>'Administracion Historial', 'url'=>array('admin')),
);
?>

<h1>Actualizacion item Historial codigo: <?php echo $model->h_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>