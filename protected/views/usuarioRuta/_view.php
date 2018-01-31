<?php
/* @var $this UsuarioRutaController */
/* @var $data UsuarioRutaModel */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ur_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ur_id), array('view', 'id'=>$data->ur_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rg_id')); ?>:</b>
	<?php echo CHtml::encode($data->rg_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('iduser')); ?>:</b>
	<?php echo CHtml::encode($data->iduser); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ur_nombre_ejecutivo')); ?>:</b>
	<?php echo CHtml::encode($data->ur_nombre_ejecutivo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ur_estado')); ?>:</b>
	<?php echo CHtml::encode($data->ur_estado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ur_zona_gestion')); ?>:</b>
	<?php echo CHtml::encode($data->ur_zona_gestion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ur_fecha_ingreso')); ?>:</b>
	<?php echo CHtml::encode($data->ur_fecha_ingreso); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('ur_fecha_modifica')); ?>:</b>
	<?php echo CHtml::encode($data->ur_fecha_modifica); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ur_cod_usuario_ingresa_modifica')); ?>:</b>
	<?php echo CHtml::encode($data->ur_cod_usuario_ingresa_modifica); ?>
	<br />

	*/ ?>

</div>