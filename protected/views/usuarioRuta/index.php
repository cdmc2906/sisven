<?php
/* @var $this UsuarioRutaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Usuario Ruta Models',
);

$this->menu=array(
	array('label'=>'Create UsuarioRutaModel', 'url'=>array('create')),
	array('label'=>'Manage UsuarioRutaModel', 'url'=>array('admin')),
);
?>

<h1>Usuario Ruta Models</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
