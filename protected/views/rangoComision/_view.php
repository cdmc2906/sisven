<?php
/* @var $this RangoComisionController */
/* @var $data RangoComisionModel */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_RCOM')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID_RCOM), array('view', 'id'=>$data->ID_RCOM)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('RANGOMIN_RCOM')); ?>:</b>
	<?php echo CHtml::encode($data->RANGOMIN_RCOM); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('RANGOMAX_RCOM')); ?>:</b>
	<?php echo CHtml::encode($data->RANGOMAX_RCOM); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PORCENTAJE_RCOM')); ?>:</b>
	<?php echo CHtml::encode($data->PORCENTAJE_RCOM); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FECHAINGRESO_RCOM')); ?>:</b>
	<?php echo CHtml::encode($data->FECHAINGRESO_RCOM); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FECHAMODIFICACION_RCOM')); ?>:</b>
	<?php echo CHtml::encode($data->FECHAMODIFICACION_RCOM); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('IDUSR_RCOM')); ?>:</b>
	<?php echo CHtml::encode($data->IDUSR_RCOM); ?>
	<br />


</div>