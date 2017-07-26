<?php
/* @var $this EjecutivoRutaController */
/* @var $data EjecutivoRutaModel */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('er_cod')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->er_cod), array('view', 'id'=>$data->er_cod)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('er_usuario')); ?>:</b>
	<?php echo CHtml::encode($data->er_usuario); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('er_usuario_nombre')); ?>:</b>
	<?php echo CHtml::encode($data->er_usuario_nombre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('er_ruta')); ?>:</b>
	<?php echo CHtml::encode($data->er_ruta); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('er_ruta_nombre')); ?>:</b>
	<?php echo CHtml::encode($data->er_ruta_nombre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('er_estatus')); ?>:</b>
	<?php echo CHtml::encode($data->er_estatus); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('er_fecha_ingreso')); ?>:</b>
	<?php echo CHtml::encode($data->er_fecha_ingreso); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('er_fecha_asignacion')); ?>:</b>
	<?php echo CHtml::encode($data->er_fecha_asignacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('er_fecha_modificacion')); ?>:</b>
	<?php echo CHtml::encode($data->er_fecha_modificacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('er_cod_usr_ing')); ?>:</b>
	<?php echo CHtml::encode($data->er_cod_usr_ing); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('er_cod_usr_mod')); ?>:</b>
	<?php echo CHtml::encode($data->er_cod_usr_mod); ?>
	<br />

	*/ ?>

</div>