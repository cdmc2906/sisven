<?php
/* @var $this PromocionController */
/* @var $data PromocionModel */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('pr_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->pr_id), array('view', 'id'=>$data->pr_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pr_nombre')); ?>:</b>
	<?php echo CHtml::encode($data->pr_nombre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pr_fecha_inicio')); ?>:</b>
	<?php echo CHtml::encode($data->pr_fecha_inicio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pr_fecha_fin')); ?>:</b>
	<?php echo CHtml::encode($data->pr_fecha_fin); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pr_estado')); ?>:</b>
	<?php echo CHtml::encode($data->pr_estado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pr_ingreso')); ?>:</b>
	<?php echo CHtml::encode($data->pr_ingreso); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pr_modificacion')); ?>:</b>
	<?php echo CHtml::encode($data->pr_modificacion); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('pr_id_usr_ing_mod')); ?>:</b>
	<?php echo CHtml::encode($data->pr_id_usr_ing_mod); ?>
	<br />

	*/ ?>

</div>