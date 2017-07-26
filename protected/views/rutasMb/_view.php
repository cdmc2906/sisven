<?php
/* @var $this RutaMbController */
/* @var $data RutaMbModel */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('r_cod')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->r_cod), array('view', 'id'=>$data->r_cod)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('r_ruta')); ?>:</b>
	<?php echo CHtml::encode($data->r_ruta); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('r_cod_cliente')); ?>:</b>
	<?php echo CHtml::encode($data->r_cod_cliente); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('r_nom_cliente')); ?>:</b>
	<?php echo CHtml::encode($data->r_nom_cliente); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('r_cod_direccion')); ?>:</b>
	<?php echo CHtml::encode($data->r_cod_direccion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('r_direccion')); ?>:</b>
	<?php echo CHtml::encode($data->r_direccion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('r_referencia')); ?>:</b>
	<?php echo CHtml::encode($data->r_referencia); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('r_semana')); ?>:</b>
	<?php echo CHtml::encode($data->r_semana); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('r_dia')); ?>:</b>
	<?php echo CHtml::encode($data->r_dia); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('r_secuencia')); ?>:</b>
	<?php echo CHtml::encode($data->r_secuencia); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('r_estatus')); ?>:</b>
	<?php echo CHtml::encode($data->r_estatus); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('r_fch_ingreso')); ?>:</b>
	<?php echo CHtml::encode($data->r_fch_ingreso); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('r_fch_modificacion')); ?>:</b>
	<?php echo CHtml::encode($data->r_fch_modificacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('r_fch_desde')); ?>:</b>
	<?php echo CHtml::encode($data->r_fch_desde); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('r_fch_hasta')); ?>:</b>
	<?php echo CHtml::encode($data->r_fch_hasta); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('r_usuario_ing_mod')); ?>:</b>
	<?php echo CHtml::encode($data->r_usuario_ing_mod); ?>
	<br />

	*/ ?>

</div>