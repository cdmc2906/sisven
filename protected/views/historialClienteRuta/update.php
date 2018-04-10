<?php
/* @var $this HistorialClienteRutaController */
/* @var $model HistorialClienteRutaModel */

$this->breadcrumbs=array(
	'Historial Cliente Ruta Models'=>array('index'),
	$model->hcr_id=>array('view','id'=>$model->hcr_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List HistorialClienteRutaModel', 'url'=>array('index')),
	array('label'=>'Create HistorialClienteRutaModel', 'url'=>array('create')),
	array('label'=>'View HistorialClienteRutaModel', 'url'=>array('view', 'id'=>$model->hcr_id)),
	array('label'=>'Manage HistorialClienteRutaModel', 'url'=>array('admin')),
);
?>

<h1>Update HistorialClienteRutaModel <?php echo $model->hcr_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>