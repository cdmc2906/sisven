<?php
/* @var $this TipoVendedorController */
/* @var $data TipoVendedorModel */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_TVE')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID_TVE), array('view', 'id'=>$data->ID_TVE)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NOMBRE_TVE')); ?>:</b>
	<?php echo CHtml::encode($data->NOMBRE_TVE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FECHAINGRESO_TVE')); ?>:</b>
	<?php echo CHtml::encode($data->FECHAINGRESO_TVE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FECHAMODIFICACION_TVE')); ?>:</b>
	<?php echo CHtml::encode($data->FECHAMODIFICACION_TVE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('IDUSR_TVE')); ?>:</b>
	<?php echo CHtml::encode($data->IDUSR_TVE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_EST')); ?>:</b>
	<?php echo CHtml::encode($data->ID_EST); ?>
	<br />


</div>