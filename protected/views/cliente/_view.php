<?php
/* @var $this ClienteController */
/* @var $data ClienteModel */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_CLI')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID_CLI), array('view', 'id'=>$data->ID_CLI)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_EST')); ?>:</b>
	<?php echo CHtml::encode($data->ID_EST); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_TCLI')); ?>:</b>
	<?php echo CHtml::encode($data->ID_TCLI); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NOMBRE_CLI')); ?>:</b>
	<?php echo CHtml::encode($data->NOMBRE_CLI); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DOCUMENTO_CLI')); ?>:</b>
	<?php echo CHtml::encode($data->DOCUMENTO_CLI); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DIRECCION_CLI')); ?>:</b>
	<?php echo CHtml::encode($data->DIRECCION_CLI); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TELEFONO_CLI')); ?>:</b>
	<?php echo CHtml::encode($data->TELEFONO_CLI); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('EMAIL_CLI')); ?>:</b>
	<?php echo CHtml::encode($data->EMAIL_CLI); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FECHAINGRESO_CLI')); ?>:</b>
	<?php echo CHtml::encode($data->FECHAINGRESO_CLI); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FECHAMODIFICACION_CLI')); ?>:</b>
	<?php echo CHtml::encode($data->FECHAMODIFICACION_CLI); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('IDUSR_CLI')); ?>:</b>
	<?php echo CHtml::encode($data->IDUSR_CLI); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('IDDELTA_CLI')); ?>:</b>
	<?php echo CHtml::encode($data->IDDELTA_CLI); ?>
	<br />

	*/ ?>

</div>