<?php
/* @var $this VendedorController */
/* @var $data VendedorModel */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_VEND')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID_VEND), array('view', 'id'=>$data->ID_VEND)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_EST')); ?>:</b>
	<?php echo CHtml::encode($data->ID_EST); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NOMBRE_VEND')); ?>:</b>
	<?php echo CHtml::encode($data->NOMBRE_VEND); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TELEFONO_VEND')); ?>:</b>
	<?php echo CHtml::encode($data->TELEFONO_VEND); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CORREO_VEND')); ?>:</b>
	<?php echo CHtml::encode($data->CORREO_VEND); ?>
	<br />


</div>