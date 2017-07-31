<?php
/* @var $this ResumenHistorialDiarioController */
/* @var $data ResumenHistorialDiarioModel */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('rhd_codigo')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->rhd_codigo), array('view', 'id'=>$data->rhd_codigo)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rhd_cod_ejecutivo')); ?>:</b>
	<?php echo CHtml::encode($data->rhd_cod_ejecutivo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rhd_fecha_historial')); ?>:</b>
	<?php echo CHtml::encode($data->rhd_fecha_historial); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rhd_parametro')); ?>:</b>
	<?php echo CHtml::encode($data->rhd_parametro); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rhd_valor')); ?>:</b>
	<?php echo CHtml::encode($data->rhd_valor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rhd_fecha_ingreso')); ?>:</b>
	<?php echo CHtml::encode($data->rhd_fecha_ingreso); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rhd_fecha_modificacion')); ?>:</b>
	<?php echo CHtml::encode($data->rhd_fecha_modificacion); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('rhd_usuario_ingresa_modifica')); ?>:</b>
	<?php echo CHtml::encode($data->rhd_usuario_ingresa_modifica); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rhd_observacion_supervisor')); ?>:</b>
	<?php echo CHtml::encode($data->rhd_observacion_supervisor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rhd_usuario_supervisor')); ?>:</b>
	<?php echo CHtml::encode($data->rhd_usuario_supervisor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rhd_fecha_modifica_observacion')); ?>:</b>
	<?php echo CHtml::encode($data->rhd_fecha_modifica_observacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rhd_semana')); ?>:</b>
	<?php echo CHtml::encode($data->rhd_semana); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rhd_fecha_ingreso_observacion')); ?>:</b>
	<?php echo CHtml::encode($data->rhd_fecha_ingreso_observacion); ?>
	<br />

	*/ ?>

</div>