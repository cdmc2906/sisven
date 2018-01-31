<?php
/* @var $this UsuarioRolController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Usuario Rol Models',
);

$this->menu=array(
	array('label'=>'Create UsuarioRolModel', 'url'=>array('create')),
	array('label'=>'Manage UsuarioRolModel', 'url'=>array('admin')),
);
?>

<h1>Usuario Rol Models</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
