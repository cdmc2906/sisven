<?php
/* @var $this UsuarioRolController */
/* @var $data UsuarioRolModel */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('usrl_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->usrl_id), array('view', 'id'=>$data->usrl_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('iduser')); ?>:</b>
	<?php echo CHtml::encode($data->iduser); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('r_id')); ?>:</b>
	<?php echo CHtml::encode($data->r_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('usrl_estado')); ?>:</b>
	<?php echo CHtml::encode($data->usrl_estado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('usrl_fecha_ingreso')); ?>:</b>
	<?php echo CHtml::encode($data->usrl_fecha_ingreso); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('usrl_fecha_modifica')); ?>:</b>
	<?php echo CHtml::encode($data->usrl_fecha_modifica); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('usrl_cod_usuario_ing_mod')); ?>:</b>
	<?php echo CHtml::encode($data->usrl_cod_usuario_ing_mod); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('usrl_nombre_usuario')); ?>:</b>
	<?php echo CHtml::encode($data->usrl_nombre_usuario); ?>
	<br />

	*/ ?>

</div>