<?php
/* @var $this ComentarioOficinaController */
/* @var $data ComentarioOficinaModel */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('co_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->co_id), array('view', 'id'=>$data->co_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('co_fecha_historial_revisado')); ?>:</b>
	<?php echo CHtml::encode($data->co_fecha_historial_revisado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('co_ejecutivo_revisado')); ?>:</b>
	<?php echo CHtml::encode($data->co_ejecutivo_revisado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('co_comentario')); ?>:</b>
	<?php echo CHtml::encode($data->co_comentario); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('co_enlace_mapa')); ?>:</b>
	<?php echo CHtml::encode($data->co_enlace_mapa); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('co_enlace_imagen')); ?>:</b>
	<?php echo CHtml::encode($data->co_enlace_imagen); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('co_estado')); ?>:</b>
	<?php echo CHtml::encode($data->co_estado); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('co_fecha_ingreso')); ?>:</b>
	<?php echo CHtml::encode($data->co_fecha_ingreso); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('co_fecha_modificacion')); ?>:</b>
	<?php echo CHtml::encode($data->co_fecha_modificacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('co_usuario_ingresa_modifica')); ?>:</b>
	<?php echo CHtml::encode($data->co_usuario_ingresa_modifica); ?>
	<br />

	*/ ?>

</div>