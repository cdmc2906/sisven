<?php
/* @var $this PreguntaController */
/* @var $data PreguntaModel */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('preg_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->preg_id), array('view', 'id'=>$data->preg_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tpreg_id')); ?>:</b>
	<?php echo CHtml::encode($data->tpreg_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('preg_codigo')); ?>:</b>
	<?php echo CHtml::encode($data->preg_codigo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('preg_descripcion')); ?>:</b>
	<?php echo CHtml::encode($data->preg_descripcion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('preg_estado')); ?>:</b>
	<?php echo CHtml::encode($data->preg_estado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('preg_ingreso')); ?>:</b>
	<?php echo CHtml::encode($data->preg_ingreso); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('preg_modifica')); ?>:</b>
	<?php echo CHtml::encode($data->preg_modifica); ?>
	<br />


</div>