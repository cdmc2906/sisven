<?php
/* @var $this NotifyiiController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Notificaciones',
);

$this->menu=array(
	array('label'=>'Crear Notificaciones', 'url'=>array('create')),
	array('label'=>'Administrar Notificaciones', 'url'=>array('admin')),
);
?>

<h1>Notificaciones</h1>

<div class="box">
    <h3>En esta página puedes ver todas las notificaciones creadas.</h3>
</div>

<a href="<?php echo $this->createUrl('/notifyii/modelNotifyii/aggregate'); ?>">Mostrar datos agregados para el rol</a>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
