<?php
/* @var $this DetalleRevisionHistorialController */
/* @var $data DetalleRevisionHistorialModel */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('drh_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->drh_id), array('view', 'id'=>$data->drh_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pg_id')); ?>:</b>
	<?php echo CHtml::encode($data->pg_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drh_semana')); ?>:</b>
	<?php echo CHtml::encode($data->drh_semana); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drh_tipo_historial')); ?>:</b>
	<?php echo CHtml::encode($data->drh_tipo_historial); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drh_fecha_revision')); ?>:</b>
	<?php echo CHtml::encode($data->drh_fecha_revision); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drh_fecha_ruta')); ?>:</b>
	<?php echo CHtml::encode($data->drh_fecha_ruta); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drh_codigo_ejecutivo')); ?>:</b>
	<?php echo CHtml::encode($data->drh_codigo_ejecutivo); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('drh_nombre_ejecutivo')); ?>:</b>
	<?php echo CHtml::encode($data->drh_nombre_ejecutivo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drh_codigo_cliente')); ?>:</b>
	<?php echo CHtml::encode($data->drh_codigo_cliente); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drh_nombre_cliente')); ?>:</b>
	<?php echo CHtml::encode($data->drh_nombre_cliente); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drh_ruta_usada')); ?>:</b>
	<?php echo CHtml::encode($data->drh_ruta_usada); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drh_secuencia_visita')); ?>:</b>
	<?php echo CHtml::encode($data->drh_secuencia_visita); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drh_ruta_cliente')); ?>:</b>
	<?php echo CHtml::encode($data->drh_ruta_cliente); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drh_secuencia_ruta')); ?>:</b>
	<?php echo CHtml::encode($data->drh_secuencia_ruta); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drh_estado_revision_ruta')); ?>:</b>
	<?php echo CHtml::encode($data->drh_estado_revision_ruta); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drh_estado_revision_sec')); ?>:</b>
	<?php echo CHtml::encode($data->drh_estado_revision_sec); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drh_cantidad_chips_venta')); ?>:</b>
	<?php echo CHtml::encode($data->drh_cantidad_chips_venta); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drh_metros')); ?>:</b>
	<?php echo CHtml::encode($data->drh_metros); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drh_precision_usada')); ?>:</b>
	<?php echo CHtml::encode($data->drh_precision_usada); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drh_validacion')); ?>:</b>
	<?php echo CHtml::encode($data->drh_validacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drh_latitud_cliente')); ?>:</b>
	<?php echo CHtml::encode($data->drh_latitud_cliente); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drh_longitud_cliente')); ?>:</b>
	<?php echo CHtml::encode($data->drh_longitud_cliente); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drh_latitud_visita')); ?>:</b>
	<?php echo CHtml::encode($data->drh_latitud_visita); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drh_longitud_visita')); ?>:</b>
	<?php echo CHtml::encode($data->drh_longitud_visita); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drh_inicio_visita')); ?>:</b>
	<?php echo CHtml::encode($data->drh_inicio_visita); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drh_fin_visita')); ?>:</b>
	<?php echo CHtml::encode($data->drh_fin_visita); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drh_tiempo_gestion')); ?>:</b>
	<?php echo CHtml::encode($data->drh_tiempo_gestion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drh_tiempo_traslado')); ?>:</b>
	<?php echo CHtml::encode($data->drh_tiempo_traslado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drh_distancia_cli_eje')); ?>:</b>
	<?php echo CHtml::encode($data->drh_distancia_cli_eje); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drh_distancia_cli_anterior')); ?>:</b>
	<?php echo CHtml::encode($data->drh_distancia_cli_anterior); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drh_fch_ingreso')); ?>:</b>
	<?php echo CHtml::encode($data->drh_fch_ingreso); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drh_fch_modifica')); ?>:</b>
	<?php echo CHtml::encode($data->drh_fch_modifica); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drh_cod_usr_ing_mod')); ?>:</b>
	<?php echo CHtml::encode($data->drh_cod_usr_ing_mod); ?>
	<br />

	*/ ?>

</div>