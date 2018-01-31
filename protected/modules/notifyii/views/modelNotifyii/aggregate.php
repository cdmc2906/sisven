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

<h1>Notifyiis</h1>

<div class="box">
    <h3>En esta página puedes ver todas las notificaciones creadas.</h3>
</div>

<?php $this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view_aggregate',
)); ?>
