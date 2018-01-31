<?php
/* @var $this EncuestaController */
/* @var $data EncuestaModel */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('enc_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->enc_id), array('view', 'id'=>$data->enc_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('enc_codigo')); ?>:</b>
	<?php echo CHtml::encode($data->enc_codigo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('enc_nombre')); ?>:</b>
	<?php echo CHtml::encode($data->enc_nombre); ?>
	<br />


</div>