<?php
/* @var $this ZonasGestionController */
/* @var $data ZonasGestionModel */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('zg_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->zg_id), array('view', 'id'=>$data->zg_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('zg_nombre_zona')); ?>:</b>
	<?php echo CHtml::encode($data->zg_nombre_zona); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('zg_cod_ejecutivo_asignado')); ?>:</b>
	<?php echo CHtml::encode($data->zg_cod_ejecutivo_asignado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('zg_nomb_ejecutivo_asignado')); ?>:</b>
	<?php echo CHtml::encode($data->zg_nomb_ejecutivo_asignado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('zg_estado_zona')); ?>:</b>
	<?php echo CHtml::encode($data->zg_estado_zona); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('zg_fecha_ingreso')); ?>:</b>
	<?php echo CHtml::encode($data->zg_fecha_ingreso); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('zg_fecha_modifica')); ?>:</b>
	<?php echo CHtml::encode($data->zg_fecha_modifica); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('zg_cod_usuario_ingresa_modifica')); ?>:</b>
	<?php echo CHtml::encode($data->zg_cod_usuario_ingresa_modifica); ?>
	<br />

	*/ ?>

</div>