<?php
/* @var $this EstadoController */
/* @var $data EstadoModel */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_EST')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID_EST), array('view', 'id'=>$data->ID_EST)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NOMBRE_EST')); ?>:</b>
	<?php echo CHtml::encode($data->NOMBRE_EST); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FECHAINGRESO_EST')); ?>:</b>
	<?php echo CHtml::encode($data->FECHAINGRESO_EST); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FECHAMODIFICACION_EST')); ?>:</b>
	<?php echo CHtml::encode($data->FECHAMODIFICACION_EST); ?>
	<br />


</div>