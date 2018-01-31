<?php
/* @var $this NotifyiiController */
/* @var $model Notifyii */

$this->breadcrumbs=array(
	'Notificaciones'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'Listar Notificaciones', 'url'=>array('index')),
	array('label'=>'Crear Notificaciones', 'url'=>array('create')),
	array('label'=>'Actualizar Notificaciones', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Borrar Notificaciones', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Est&aacute; seguro que desea eliminar este elemento?')),
	array('label'=>'Administrar Notificaciones', 'url'=>array('admin')),
);
?>

<h3>Notificación: <strong><?php echo $model->content; ?></strong></h3>

<div class="box">
    <h3>En esta página se puede ver un detalle de una notificación.</h3>
</div>

<?php $this->widget('zii.widgets.CDetailView', array(
    'data'=>$model,
    'attributes'=>array(
        'expire',
        'alert_after_date',
        'alert_before_date',
        'role',
    ),
)); ?>

<div class="clear">&nbsp;</div>
<hr />

<div class="box">
    
    <h3>Leidos</h3>

    <?php $readers = NotifyiiReads::model()->findAll(new CDbCriteria(array(
        'condition' => 'notification_id=:notification_id',
        'params' => array(
            'notification_id' => $model->id
        )
    ))); ?>
    <?php if(count($readers) === 0) : ?>
        <em>No hay leidos</em>
    <?php else: ?>
        <?php foreach($readers as $reader) : ?>
            <?php echo $reader->username; ?>
        <?php endforeach; ?>
    <?php endif; ?>

</div>
