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

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('cli_fecha_modificacion')); ?>:</b>
	<?php echo CHtml::encode($data->cli_fecha_modificacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cli_usuario_ingresa_modifica')); ?>:</b>
	<?php echo CHtml::encode($data->cli_usuario_ingresa_modifica); ?>
	<br />

	*/ ?>

</div>