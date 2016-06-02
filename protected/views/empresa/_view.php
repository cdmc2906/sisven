<?php
/* @var $this EmpresaController */
/* @var $data EmpresaModel */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_EMP')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID_EMP), array('view', 'id'=>$data->ID_EMP)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NOMBRE_EMP')); ?>:</b>
	<?php echo CHtml::encode($data->NOMBRE_EMP); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('IDUSR_EMP')); ?>:</b>
	<?php echo CHtml::encode($data->IDUSR_EMP); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FECHAINGRESO_EMP')); ?>:</b>
	<?php echo CHtml::encode($data->FECHAINGRESO_EMP); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FECHAMODIFICACION_EMP')); ?>:</b>
	<?php echo CHtml::encode($data->FECHAMODIFICACION_EMP); ?>
	<br />


</div>