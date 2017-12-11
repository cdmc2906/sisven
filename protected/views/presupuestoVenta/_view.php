<?php
/* @var $this PresupuestoVentaController */
/* @var $data PresupuestoVentaModel */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('p_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->p_id), array('view', 'id'=>$data->p_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('p_codigo_vendedor')); ?>:</b>
	<?php echo CHtml::encode($data->p_codigo_vendedor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('p_fecha_ini_validez')); ?>:</b>
	<?php echo CHtml::encode($data->p_fecha_ini_validez); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('p_fecha_fin_validez')); ?>:</b>
	<?php echo CHtml::encode($data->p_fecha_fin_validez); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('p_dias_laborables')); ?>:</b>
	<?php echo CHtml::encode($data->p_dias_laborables); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('p_valor_presupuesto')); ?>:</b>
	<?php echo CHtml::encode($data->p_valor_presupuesto); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('p_tipo_presupuesto')); ?>:</b>
	<?php echo CHtml::encode($data->p_tipo_presupuesto); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('p_cantidad_feriados')); ?>:</b>
	<?php echo CHtml::encode($data->p_cantidad_feriados); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('p_venta_diaria_esperada')); ?>:</b>
	<?php echo CHtml::encode($data->p_venta_diaria_esperada); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('p_estado_presupuesto')); ?>:</b>
	<?php echo CHtml::encode($data->p_estado_presupuesto); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('p_fecha_ingreso')); ?>:</b>
	<?php echo CHtml::encode($data->p_fecha_ingreso); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('p_fecha_modifica')); ?>:</b>
	<?php echo CHtml::encode($data->p_fecha_modifica); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('p_cod_usuario_ing_mod')); ?>:</b>
	<?php echo CHtml::encode($data->p_cod_usuario_ing_mod); ?>
	<br />

	*/ ?>

</div>