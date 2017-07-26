<?php
/* @var $this RangoCumplimientoController */
/* @var $data RangoCumplimientoModel */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('c_cod')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->c_cod), array('view', 'id'=>$data->c_cod)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('c_rango_min')); ?>:</b>
	<?php echo CHtml::encode($data->c_rango_min); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('c_rango_max')); ?>:</b>
	<?php echo CHtml::encode($data->c_rango_max); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('c_nombre_rango')); ?>:</b>
	<?php echo CHtml::encode($data->c_nombre_rango); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('c_estado_rango')); ?>:</b>
	<?php echo CHtml::encode($data->c_estado_rango); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('c_fecha_ingreso')); ?>:</b>
	<?php echo CHtml::encode($data->c_fecha_ingreso); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('c_fecha_modificacion')); ?>:</b>
	<?php echo CHtml::encode($data->c_fecha_modificacion); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('c_codigo_usuario_ingresa')); ?>:</b>
	<?php echo CHtml::encode($data->c_codigo_usuario_ingresa); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('c_codigo_usuario_modifica')); ?>:</b>
	<?php echo CHtml::encode($data->c_codigo_usuario_modifica); ?>
	<br />

	*/ ?>

</div>