<?php
/* @var $this EjecutivoController */
/* @var $data EjecutivoModel */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('e_cod')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->e_cod), array('view', 'id'=>$data->e_cod)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('e_nombre')); ?>:</b>
	<?php echo CHtml::encode($data->e_nombre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('e_usr_mobilvendor')); ?>:</b>
	<?php echo CHtml::encode($data->e_usr_mobilvendor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('e_iniciales')); ?>:</b>
	<?php echo CHtml::encode($data->e_iniciales); ?>
	<br />


</div>