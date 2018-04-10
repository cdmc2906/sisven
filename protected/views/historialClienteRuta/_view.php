<?php
/* @var $this HistorialClienteRutaController */
/* @var $data HistorialClienteRutaModel */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('hcr_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->hcr_id), array('view', 'id'=>$data->hcr_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hcr_ruta_anterior')); ?>:</b>
	<?php echo CHtml::encode($data->hcr_ruta_anterior); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hcr_ruta_nueva')); ?>:</b>
	<?php echo CHtml::encode($data->hcr_ruta_nueva); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hcr_direccion_anterior')); ?>:</b>
	<?php echo CHtml::encode($data->hcr_direccion_anterior); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hcr_direccion_nueva')); ?>:</b>
	<?php echo CHtml::encode($data->hcr_direccion_nueva); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hcr_semana_anterior')); ?>:</b>
	<?php echo CHtml::encode($data->hcr_semana_anterior); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hcr_semana_nueva')); ?>:</b>
	<?php echo CHtml::encode($data->hcr_semana_nueva); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('hcr_dia_anterior')); ?>:</b>
	<?php echo CHtml::encode($data->hcr_dia_anterior); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hcr_dia_nuevo')); ?>:</b>
	<?php echo CHtml::encode($data->hcr_dia_nuevo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hcr_secuencia_anterior')); ?>:</b>
	<?php echo CHtml::encode($data->hcr_secuencia_anterior); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hcr_secuencia_nueva')); ?>:</b>
	<?php echo CHtml::encode($data->hcr_secuencia_nueva); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hcr_estado_anterior')); ?>:</b>
	<?php echo CHtml::encode($data->hcr_estado_anterior); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hcr_estado_nuevo')); ?>:</b>
	<?php echo CHtml::encode($data->hcr_estado_nuevo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hcr_fch_actualiza_ruta')); ?>:</b>
	<?php echo CHtml::encode($data->hcr_fch_actualiza_ruta); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hcr_cambios')); ?>:</b>
	<?php echo CHtml::encode($data->hcr_cambios); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hcr_fch_ingreso')); ?>:</b>
	<?php echo CHtml::encode($data->hcr_fch_ingreso); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hcr_fch_modificacion')); ?>:</b>
	<?php echo CHtml::encode($data->hcr_fch_modificacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hcr_cod_usuario_ing_mod')); ?>:</b>
	<?php echo CHtml::encode($data->hcr_cod_usuario_ing_mod); ?>
	<br />

	*/ ?>

</div>