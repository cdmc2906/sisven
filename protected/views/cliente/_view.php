<?php
/* @var $this ClienteController */
/* @var $data ClienteModel */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('cli_codigo')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->cli_codigo), array('view', 'id'=>$data->cli_codigo)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cli_codigo_cliente')); ?>:</b>
	<?php echo CHtml::encode($data->cli_codigo_cliente); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cli_nombre_cliente')); ?>:</b>
	<?php echo CHtml::encode($data->cli_nombre_cliente); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cli_tipo_de_identificacion')); ?>:</b>
	<?php echo CHtml::encode($data->cli_tipo_de_identificacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cli_identificacion')); ?>:</b>
	<?php echo CHtml::encode($data->cli_identificacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cli_nombre_de_compania')); ?>:</b>
	<?php echo CHtml::encode($data->cli_nombre_de_compania); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cli_nombre_comercial')); ?>:</b>
	<?php echo CHtml::encode($data->cli_nombre_comercial); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('cli_contacto')); ?>:</b>
	<?php echo CHtml::encode($data->cli_contacto); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cli_moneda')); ?>:</b>
	<?php echo CHtml::encode($data->cli_moneda); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cli_moneda_nombre')); ?>:</b>
	<?php echo CHtml::encode($data->cli_moneda_nombre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cli_tipo_de_negocio')); ?>:</b>
	<?php echo CHtml::encode($data->cli_tipo_de_negocio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cli_tipo_de_negocio_nombre')); ?>:</b>
	<?php echo CHtml::encode($data->cli_tipo_de_negocio_nombre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cli_subcanal')); ?>:</b>
	<?php echo CHtml::encode($data->cli_subcanal); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cli_subcanal_nombre')); ?>:</b>
	<?php echo CHtml::encode($data->cli_subcanal_nombre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cli_lista_de_precios')); ?>:</b>
	<?php echo CHtml::encode($data->cli_lista_de_precios); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cli_lista_de_precios_nombre')); ?>:</b>
	<?php echo CHtml::encode($data->cli_lista_de_precios_nombre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cli_lista_de_precios_2')); ?>:</b>
	<?php echo CHtml::encode($data->cli_lista_de_precios_2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cli_lista_de_precios_2_nombre')); ?>:</b>
	<?php echo CHtml::encode($data->cli_lista_de_precios_2_nombre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cli_termino_de_pago')); ?>:</b>
	<?php echo CHtml::encode($data->cli_termino_de_pago); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cli_termino_de_pago_nombre')); ?>:</b>
	<?php echo CHtml::encode($data->cli_termino_de_pago_nombre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cli_metodo_de_pago')); ?>:</b>
	<?php echo CHtml::encode($data->cli_metodo_de_pago); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cli_metodo_de_pago_nombre')); ?>:</b>
	<?php echo CHtml::encode($data->cli_metodo_de_pago_nombre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cli_grupo')); ?>:</b>
	<?php echo CHtml::encode($data->cli_grupo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cli_grupo_nombre')); ?>:</b>
	<?php echo CHtml::encode($data->cli_grupo_nombre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cli_usuario')); ?>:</b>
	<?php echo CHtml::encode($data->cli_usuario); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cli_usuario_nombre')); ?>:</b>
	<?php echo CHtml::encode($data->cli_usuario_nombre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cli_comentario')); ?>:</b>
	<?php echo CHtml::encode($data->cli_comentario); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cli_objetivo_de_venta')); ?>:</b>
	<?php echo CHtml::encode($data->cli_objetivo_de_venta); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cli_maximo_descuento_porcentaje')); ?>:</b>
	<?php echo CHtml::encode($data->cli_maximo_descuento_porcentaje); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cli_retencion_porcentaje')); ?>:</b>
	<?php echo CHtml::encode($data->cli_retencion_porcentaje); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cli_tiene_credito')); ?>:</b>
	<?php echo CHtml::encode($data->cli_tiene_credito); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cli_estatus')); ?>:</b>
	<?php echo CHtml::encode($data->cli_estatus); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cli_creado')); ?>:</b>
	<?php echo CHtml::encode($data->cli_creado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cli_creado_por')); ?>:</b>
	<?php echo CHtml::encode($data->cli_creado_por); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cli_latitud')); ?>:</b>
	<?php echo CHtml::encode($data->cli_latitud); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cli_longitud')); ?>:</b>
	<?php echo CHtml::encode($data->cli_longitud); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cli_estado')); ?>:</b>
	<?php echo CHtml::encode($data->cli_estado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cli_fecha_ingreso')); ?>:</b>
	<?php echo CHtml::encode($data->cli_fecha_ingreso); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cli_fecha_modificacion')); ?>:</b>
	<?php echo CHtml::encode($data->cli_fecha_modificacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cli_usuario_ingresa_modifica')); ?>:</b>
	<?php echo CHtml::encode($data->cli_usuario_ingresa_modifica); ?>
	<br />

	*/ ?>

</div>