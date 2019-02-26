<?php
/* @var $this ClienteDireccionController */
/* @var $data ClienteDireccionModel */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('dcli_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->dcli_id), array('view', 'id'=>$data->dcli_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dcli_codigo')); ?>:</b>
	<?php echo CHtml::encode($data->dcli_codigo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dcli_cliente')); ?>:</b>
	<?php echo CHtml::encode($data->dcli_cliente); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dcli_cliente_nombre')); ?>:</b>
	<?php echo CHtml::encode($data->dcli_cliente_nombre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dcli_cliente_identificacion')); ?>:</b>
	<?php echo CHtml::encode($data->dcli_cliente_identificacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dcli_cliente_comentario')); ?>:</b>
	<?php echo CHtml::encode($data->dcli_cliente_comentario); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dcli_oficina')); ?>:</b>
	<?php echo CHtml::encode($data->dcli_oficina); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('dcli_oficina_nombre')); ?>:</b>
	<?php echo CHtml::encode($data->dcli_oficina_nombre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dcli_codigo_de_barras')); ?>:</b>
	<?php echo CHtml::encode($data->dcli_codigo_de_barras); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dcli_descripcion')); ?>:</b>
	<?php echo CHtml::encode($data->dcli_descripcion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dcli_contacto')); ?>:</b>
	<?php echo CHtml::encode($data->dcli_contacto); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dcli_geo_area')); ?>:</b>
	<?php echo CHtml::encode($data->dcli_geo_area); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dcli_geo_area_nombre')); ?>:</b>
	<?php echo CHtml::encode($data->dcli_geo_area_nombre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dcli_geo_area_codigo_recorrido')); ?>:</b>
	<?php echo CHtml::encode($data->dcli_geo_area_codigo_recorrido); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dcli_geo_area_descripcion_recorrido')); ?>:</b>
	<?php echo CHtml::encode($data->dcli_geo_area_descripcion_recorrido); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dcli_provincia')); ?>:</b>
	<?php echo CHtml::encode($data->dcli_provincia); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dcli_canton')); ?>:</b>
	<?php echo CHtml::encode($data->dcli_canton); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dcli_parroquia')); ?>:</b>
	<?php echo CHtml::encode($data->dcli_parroquia); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dcli_calle_principal')); ?>:</b>
	<?php echo CHtml::encode($data->dcli_calle_principal); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dcli_nomenclatura')); ?>:</b>
	<?php echo CHtml::encode($data->dcli_nomenclatura); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dcli_calle_secundaria')); ?>:</b>
	<?php echo CHtml::encode($data->dcli_calle_secundaria); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dcli_referencia')); ?>:</b>
	<?php echo CHtml::encode($data->dcli_referencia); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dcli_codigo_postal')); ?>:</b>
	<?php echo CHtml::encode($data->dcli_codigo_postal); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dcli_telefono')); ?>:</b>
	<?php echo CHtml::encode($data->dcli_telefono); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dcli_fax')); ?>:</b>
	<?php echo CHtml::encode($data->dcli_fax); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dcli_email')); ?>:</b>
	<?php echo CHtml::encode($data->dcli_email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dcli_latitud')); ?>:</b>
	<?php echo CHtml::encode($data->dcli_latitud); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dcli_longitud')); ?>:</b>
	<?php echo CHtml::encode($data->dcli_longitud); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dcli_ultima_visita')); ?>:</b>
	<?php echo CHtml::encode($data->dcli_ultima_visita); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dcli_estado_de_localizacion')); ?>:</b>
	<?php echo CHtml::encode($data->dcli_estado_de_localizacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dcli_fecha_ingreso')); ?>:</b>
	<?php echo CHtml::encode($data->dcli_fecha_ingreso); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dcli_usr_ingresa')); ?>:</b>
	<?php echo CHtml::encode($data->dcli_usr_ingresa); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dcli_fecha_modifica')); ?>:</b>
	<?php echo CHtml::encode($data->dcli_fecha_modifica); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dcli_usr_modifica')); ?>:</b>
	<?php echo CHtml::encode($data->dcli_usr_modifica); ?>
	<br />

	*/ ?>

</div>