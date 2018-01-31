<?php
/* @var $this MinesValidacionController */
/* @var $data MinesValidacionModel */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('miva_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->miva_id), array('view', 'id'=>$data->miva_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('iduser')); ?>:</b>
	<?php echo CHtml::encode($data->iduser); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('miva_carga')); ?>:</b>
	<?php echo CHtml::encode($data->miva_carga); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('miva_tipo')); ?>:</b>
	<?php echo CHtml::encode($data->miva_tipo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('miva_fecha')); ?>:</b>
	<?php echo CHtml::encode($data->miva_fecha); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('miva_bodega')); ?>:</b>
	<?php echo CHtml::encode($data->miva_bodega); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('miva_nomcli')); ?>:</b>
	<?php echo CHtml::encode($data->miva_nomcli); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('miva_codgrup')); ?>:</b>
	<?php echo CHtml::encode($data->miva_codgrup); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('miva_detalle')); ?>:</b>
	<?php echo CHtml::encode($data->miva_detalle); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('miva_imei')); ?>:</b>
	<?php echo CHtml::encode($data->miva_imei); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('miva_min')); ?>:</b>
	<?php echo CHtml::encode($data->miva_min); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('miva_vendedor')); ?>:</b>
	<?php echo CHtml::encode($data->miva_vendedor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('miva_estado')); ?>:</b>
	<?php echo CHtml::encode($data->miva_estado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('miva_estado_reasignacion')); ?>:</b>
	<?php echo CHtml::encode($data->miva_estado_reasignacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('miva_usario_reasignado')); ?>:</b>
	<?php echo CHtml::encode($data->miva_usario_reasignado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('miva_fecha_ingreso')); ?>:</b>
	<?php echo CHtml::encode($data->miva_fecha_ingreso); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('miva_fecha_modifica')); ?>:</b>
	<?php echo CHtml::encode($data->miva_fecha_modifica); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('miva_cod_usuario_ing_mod')); ?>:</b>
	<?php echo CHtml::encode($data->miva_cod_usuario_ing_mod); ?>
	<br />

	*/ ?>

</div>