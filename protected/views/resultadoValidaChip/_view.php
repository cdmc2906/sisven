<?php
/* @var $this ResultadoValidaChipController */
/* @var $data ResultadoValidaChipModel */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('rvc_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->rvc_id), array('view', 'id'=>$data->rvc_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rvc_dato_chip')); ?>:</b>
	<?php echo CHtml::encode($data->rvc_dato_chip); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rvc_tipo_validacion')); ?>:</b>
	<?php echo CHtml::encode($data->rvc_tipo_validacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rvc_subtipo_validacion')); ?>:</b>
	<?php echo CHtml::encode($data->rvc_subtipo_validacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rvc_resultado_validacion')); ?>:</b>
	<?php echo CHtml::encode($data->rvc_resultado_validacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rvc_ejecutivo')); ?>:</b>
	<?php echo CHtml::encode($data->rvc_ejecutivo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rvc_solicitud_fecha')); ?>:</b>
	<?php echo CHtml::encode($data->rvc_solicitud_fecha); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('rvc_solicitud_ip')); ?>:</b>
	<?php echo CHtml::encode($data->rvc_solicitud_ip); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rvc_solicitud_dispositivo')); ?>:</b>
	<?php echo CHtml::encode($data->rvc_solicitud_dispositivo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rvc_solicitud_navegador')); ?>:</b>
	<?php echo CHtml::encode($data->rvc_solicitud_navegador); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rvc_estado_validacion')); ?>:</b>
	<?php echo CHtml::encode($data->rvc_estado_validacion); ?>
	<br />

	*/ ?>

</div>