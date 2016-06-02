<?php
/* @var $this AsignacionController */
/* @var $data AsignacionModel */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_ASIG')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID_ASIG), array('view', 'id'=>$data->ID_ASIG)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_PRO')); ?>:</b>
	<?php echo CHtml::encode($data->ID_PRO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_VEND')); ?>:</b>
	<?php echo CHtml::encode($data->ID_VEND); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FECHAINGRESO_ASIG')); ?>:</b>
	<?php echo CHtml::encode($data->FECHAINGRESO_ASIG); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('IDUSR_ASIF')); ?>:</b>
	<?php echo CHtml::encode($data->IDUSR_ASIF); ?>
	<br />


</div>