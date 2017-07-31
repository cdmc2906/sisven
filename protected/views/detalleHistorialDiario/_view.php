<?php
/* @var $this DetalleHistorialDiarioController */
/* @var $data DetalleHistorialDiarioModel */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('rh_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->rh_id), array('view', 'id'=>$data->rh_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rh_item')); ?>:</b>
	<?php echo CHtml::encode($data->rh_item); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rh_fecha_item')); ?>:</b>
	<?php echo CHtml::encode($data->rh_fecha_item); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rh_fecha_revision')); ?>:</b>
	<?php echo CHtml::encode($data->rh_fecha_revision); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rh_codigo_vendedor')); ?>:</b>
	<?php echo CHtml::encode($data->rh_codigo_vendedor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rh_cod_cliente')); ?>:</b>
	<?php echo CHtml::encode($data->rh_cod_cliente); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rh_ruta_visita')); ?>:</b>
	<?php echo CHtml::encode($data->rh_ruta_visita); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('rh_orden_visita')); ?>:</b>
	<?php echo CHtml::encode($data->rh_orden_visita); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rh_ruta_ejecutivo')); ?>:</b>
	<?php echo CHtml::encode($data->rh_ruta_ejecutivo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rh_secuencia_ruta')); ?>:</b>
	<?php echo CHtml::encode($data->rh_secuencia_ruta); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rh_observacion_ruta')); ?>:</b>
	<?php echo CHtml::encode($data->rh_observacion_ruta); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rh_observacion_secuencia')); ?>:</b>
	<?php echo CHtml::encode($data->rh_observacion_secuencia); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rh_chips_compra')); ?>:</b>
	<?php echo CHtml::encode($data->rh_chips_compra); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rh_metros')); ?>:</b>
	<?php echo CHtml::encode($data->rh_metros); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rh_validacion')); ?>:</b>
	<?php echo CHtml::encode($data->rh_validacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rh_precision')); ?>:</b>
	<?php echo CHtml::encode($data->rh_precision); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rh_latitud_cliente')); ?>:</b>
	<?php echo CHtml::encode($data->rh_latitud_cliente); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rh_longitud_cliente')); ?>:</b>
	<?php echo CHtml::encode($data->rh_longitud_cliente); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rh_latitud_historial')); ?>:</b>
	<?php echo CHtml::encode($data->rh_latitud_historial); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rh_longitud_historial')); ?>:</b>
	<?php echo CHtml::encode($data->rh_longitud_historial); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rh_estado')); ?>:</b>
	<?php echo CHtml::encode($data->rh_estado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rh_fecha_ingreso')); ?>:</b>
	<?php echo CHtml::encode($data->rh_fecha_ingreso); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rh_fecha_modificacion')); ?>:</b>
	<?php echo CHtml::encode($data->rh_fecha_modificacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rh_usuario_revisa')); ?>:</b>
	<?php echo CHtml::encode($data->rh_usuario_revisa); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rh_fecha_ruta')); ?>:</b>
	<?php echo CHtml::encode($data->rh_fecha_ruta); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rh_cliente')); ?>:</b>
	<?php echo CHtml::encode($data->rh_cliente); ?>
	<br />

	*/ ?>

</div>