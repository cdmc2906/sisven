<?php
/* @var $this ComentarioSupervisionController */
/* @var $data ComentarioSupervisionModel */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('cs_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->cs_id), array('view', 'id'=>$data->cs_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cs_fecha_historial_supervisado')); ?>:</b>
	<?php echo CHtml::encode($data->cs_fecha_historial_supervisado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cs_ejecutivo_supervisado')); ?>:</b>
	<?php echo CHtml::encode($data->cs_ejecutivo_supervisado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cs_comentario')); ?>:</b>
	<?php echo CHtml::encode($data->cs_comentario); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cs_estado')); ?>:</b>
	<?php echo CHtml::encode($data->cs_estado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cs_fecha_ingreso')); ?>:</b>
	<?php echo CHtml::encode($data->cs_fecha_ingreso); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cs_fecha_modificacion')); ?>:</b>
	<?php echo CHtml::encode($data->cs_fecha_modificacion); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('cs_usuario_ingresa_modifica')); ?>:</b>
	<?php echo CHtml::encode($data->cs_usuario_ingresa_modifica); ?>
	<br />

	*/ ?>

</div>