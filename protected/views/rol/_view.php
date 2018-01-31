<?php
/* @var $this RolController */
/* @var $data RolModel */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('r_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->r_id), array('view', 'id'=>$data->r_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('r_nombre_rol')); ?>:</b>
	<?php echo CHtml::encode($data->r_nombre_rol); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('r_estado')); ?>:</b>
	<?php echo CHtml::encode($data->r_estado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('r_fecha_ingreso')); ?>:</b>
	<?php echo CHtml::encode($data->r_fecha_ingreso); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('r_fecha_modifica')); ?>:</b>
	<?php echo CHtml::encode($data->r_fecha_modifica); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('r_cod_usuario_ing_mod')); ?>:</b>
	<?php echo CHtml::encode($data->r_cod_usuario_ing_mod); ?>
	<br />


</div>