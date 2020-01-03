<?php
/* @var $this CondicionPromocionModelController */
/* @var $data CondicionPromocionModel */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('cpr_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->cpr_id), array('view', 'id'=>$data->cpr_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pr_id')); ?>:</b>
	<?php echo CHtml::encode($data->pr_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cpr_parametro')); ?>:</b>
	<?php echo CHtml::encode($data->cpr_parametro); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cpr_operador')); ?>:</b>
	<?php echo CHtml::encode($data->cpr_operador); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cpr_valor_min')); ?>:</b>
	<?php echo CHtml::encode($data->cpr_valor_min); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cpr_valor_max')); ?>:</b>
	<?php echo CHtml::encode($data->cpr_valor_max); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cpr_estado')); ?>:</b>
	<?php echo CHtml::encode($data->cpr_estado); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('cpr_fecha_ingreso')); ?>:</b>
	<?php echo CHtml::encode($data->cpr_fecha_ingreso); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cpr_fecha_modifica')); ?>:</b>
	<?php echo CHtml::encode($data->cpr_fecha_modifica); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cpr_usr_ing_mod')); ?>:</b>
	<?php echo CHtml::encode($data->cpr_usr_ing_mod); ?>
	<br />

	*/ ?>

</div>