<?php
/* @var $this UsuarioRutaController */
/* @var $model UsuarioRutaModel */

$this->breadcrumbs=array(
	'Usuario Ruta Models'=>array('index'),
	$model->ur_id=>array('view','id'=>$model->ur_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List UsuarioRutaModel', 'url'=>array('index')),
	array('label'=>'Create UsuarioRutaModel', 'url'=>array('create')),
	array('label'=>'View UsuarioRutaModel', 'url'=>array('view', 'id'=>$model->ur_id)),
	array('label'=>'Manage UsuarioRutaModel', 'url'=>array('admin')),
);
?>

<h1>Update UsuarioRutaModel <?php echo $model->ur_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>