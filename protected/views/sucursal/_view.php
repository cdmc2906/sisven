<?php
/* @var $this SucursalController */
/* @var $data SucursalModel */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_SUC')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID_SUC), array('view', 'id'=>$data->ID_SUC)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_EST')); ?>:</b>
	<?php echo CHtml::encode($data->ID_EST); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NOMBRE_SUC')); ?>:</b>
	<?php echo CHtml::encode($data->NOMBRE_SUC); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DIRECCION_SUC')); ?>:</b>
	<?php echo CHtml::encode($data->DIRECCION_SUC); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TELEFONO_SUC')); ?>:</b>
	<?php echo CHtml::encode($data->TELEFONO_SUC); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_EMP')); ?>:</b>
	<?php echo CHtml::encode($data->ID_EMP); ?>
	<br />


</div>