<?php
/* @var $this AuditoriaController */
/* @var $data AuditoriaModel */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_AUD')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID_AUD), array('view', 'id'=>$data->ID_AUD)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FECHA_AUD')); ?>:</b>
	<?php echo CHtml::encode($data->FECHA_AUD); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('IDUSR_AUD')); ?>:</b>
	<?php echo CHtml::encode($data->IDUSR_AUD); ?>
	<br />


</div>