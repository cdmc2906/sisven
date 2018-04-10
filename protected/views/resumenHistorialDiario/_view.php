<?php
/* @var $this ResumenHistorialDiarioController */
/* @var $data ResumenHistorialDiarioModel */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('rhd_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->rhd_id), array('view', 'id'=>$data->rhd_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pg_id')); ?>:</b>
	<?php echo CHtml::encode($data->pg_id); ?>
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('rhd_semana')); ?>:</b>
	<?php echo CHtml::encode($data->rhd_semana); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('rhd_tipo')); ?>:</b>
	<?php echo CHtml::encode($data->rhd_tipo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rhd_estado')); ?>:</b>
	<?php echo CHtml::encode($data->rhd_estado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rhd_fecha_ingreso')); ?>:</b>
	<?php echo CHtml::encode($data->rhd_fecha_ingreso); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rhd_fecha_modificacion')); ?>:</b>
	<?php echo CHtml::encode($data->rhd_fecha_modificacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rhd_usuario_ingresa_modifica')); ?>:</b>
	<?php echo CHtml::encode($data->rhd_usuario_ingresa_modifica); ?>
	<br />

	*/ ?>

</div>