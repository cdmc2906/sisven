<?php
/* @var $this TipoPreguntaController */
/* @var $data TipoPreguntaModel */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('tpreg_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->tpreg_id), array('view', 'id'=>$data->tpreg_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tpreg_nombre')); ?>:</b>
	<?php echo CHtml::encode($data->tpreg_nombre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tpreg_estado')); ?>:</b>
	<?php echo CHtml::encode($data->tpreg_estado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tpreg_fecha_inicio')); ?>:</b>
	<?php echo CHtml::encode($data->tpreg_fecha_inicio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tpreg_fecha_modifica')); ?>:</b>
	<?php echo CHtml::encode($data->tpreg_fecha_modifica); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tpreg_cod_usuario_ing_mod')); ?>:</b>
	<?php echo CHtml::encode($data->tpreg_cod_usuario_ing_mod); ?>
	<br />


</div>