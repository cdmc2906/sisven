<?php
/* @var $this TipoProductoController */
/* @var $data TipoProductoModel */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_TPRO')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID_TPRO), array('view', 'id'=>$data->ID_TPRO)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_EST')); ?>:</b>
	<?php echo CHtml::encode($data->ID_EST); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TIPO_TPRO')); ?>:</b>
	<?php echo CHtml::encode($data->TIPO_TPRO); ?>
	<br />


</div>