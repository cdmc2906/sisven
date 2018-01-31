<?php
/* @var $this NovedadesController */
/* @var $data NovedadesModel */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('nov_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->nov_id), array('view', 'id'=>$data->nov_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gno_id')); ?>:</b>
	<?php echo CHtml::encode($data->gno_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nov_descripcion')); ?>:</b>
	<?php echo CHtml::encode($data->nov_descripcion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nov_estado')); ?>:</b>
	<?php echo CHtml::encode($data->nov_estado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nov_fecha_ingreso')); ?>:</b>
	<?php echo CHtml::encode($data->nov_fecha_ingreso); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nov_fecha_modifica')); ?>:</b>
	<?php echo CHtml::encode($data->nov_fecha_modifica); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nov_cod_usuario_ingresa_modifica')); ?>:</b>
	<?php echo CHtml::encode($data->nov_cod_usuario_ingresa_modifica); ?>
	<br />


</div>