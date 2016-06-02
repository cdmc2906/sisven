<?php
/* @var $this BodegaController */
/* @var $data BodegaModel */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_BODEGA')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID_BODEGA), array('view', 'id'=>$data->ID_BODEGA)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_SUC')); ?>:</b>
	<?php echo CHtml::encode($data->ID_SUC); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_EST')); ?>:</b>
	<?php echo CHtml::encode($data->ID_EST); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NOMBRE_BODEGA')); ?>:</b>
	<?php echo CHtml::encode($data->NOMBRE_BODEGA); ?>
	<br />


</div>