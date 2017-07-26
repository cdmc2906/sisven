<?php
/* @var $this ResumenRevHistorialController */
/* @var $data ResumenRevHistorialModel */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('rrh_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->rrh_id), array('view', 'id'=>$data->rrh_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rrh_fecha')); ?>:</b>
	<?php echo CHtml::encode($data->rrh_fecha); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rrh_ejecutivo')); ?>:</b>
	<?php echo CHtml::encode($data->rrh_ejecutivo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rrh_nivel_cumplimiento')); ?>:</b>
	<?php echo CHtml::encode($data->rrh_nivel_cumplimiento); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rrh_visitas_efectuadas')); ?>:</b>
	<?php echo CHtml::encode($data->rrh_visitas_efectuadas); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rrh_clientes_ruta')); ?>:</b>
	<?php echo CHtml::encode($data->rrh_clientes_ruta); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rrh_cliente_no_visitados')); ?>:</b>
	<?php echo CHtml::encode($data->rrh_cliente_no_visitados); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('rrh_visitas_fuera_ruta')); ?>:</b>
	<?php echo CHtml::encode($data->rrh_visitas_fuera_ruta); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rrh_cantidad_venta_ruta')); ?>:</b>
	<?php echo CHtml::encode($data->rrh_cantidad_venta_ruta); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rrh_cantidad_venta_fuera_ruta')); ?>:</b>
	<?php echo CHtml::encode($data->rrh_cantidad_venta_fuera_ruta); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rrh_clientes_venta')); ?>:</b>
	<?php echo CHtml::encode($data->rrh_clientes_venta); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rrh_total_venta_reportada')); ?>:</b>
	<?php echo CHtml::encode($data->rrh_total_venta_reportada); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rrh_fecha_ingreso')); ?>:</b>
	<?php echo CHtml::encode($data->rrh_fecha_ingreso); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rrh_fecha_modificar')); ?>:</b>
	<?php echo CHtml::encode($data->rrh_fecha_modificar); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rrh_usr_ingresa')); ?>:</b>
	<?php echo CHtml::encode($data->rrh_usr_ingresa); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rrh_usr_modifica')); ?>:</b>
	<?php echo CHtml::encode($data->rrh_usr_modifica); ?>
	<br />

	*/ ?>

</div>