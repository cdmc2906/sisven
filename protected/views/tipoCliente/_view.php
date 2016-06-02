<?php
/* @var $this TipoClienteController */
/* @var $data TipoClienteModel */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_TCLI')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID_TCLI), array('view', 'id'=>$data->ID_TCLI)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_EST')); ?>:</b>
	<?php echo CHtml::encode($data->ID_EST); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NOMBRE_TCLI')); ?>:</b>
	<?php echo CHtml::encode($data->NOMBRE_TCLI); ?>
	<br />


</div>