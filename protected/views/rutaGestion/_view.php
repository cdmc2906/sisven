<?php
/* @var $this RutaGestionController */
/* @var $data RutaGestionModel */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('rg_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->rg_id), array('view', 'id'=>$data->rg_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('zg_id')); ?>:</b>
	<?php echo CHtml::encode($data->zg_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rg_cod_ruta_mb')); ?>:</b>
	<?php echo CHtml::encode($data->rg_cod_ruta_mb); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rg_nombre_ruta')); ?>:</b>
	<?php echo CHtml::encode($data->rg_nombre_ruta); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rg_estado_ruta')); ?>:</b>
	<?php echo CHtml::encode($data->rg_estado_ruta); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rg_fecha_ingreso')); ?>:</b>
	<?php echo CHtml::encode($data->rg_fecha_ingreso); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rg_fecha_modifica')); ?>:</b>
	<?php echo CHtml::encode($data->rg_fecha_modifica); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('rg_cod_usuario_ingresa_modifica')); ?>:</b>
	<?php echo CHtml::encode($data->rg_cod_usuario_ingresa_modifica); ?>
	<br />

	*/ ?>

</div>