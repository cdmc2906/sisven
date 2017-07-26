<?php
/* @var $this VentaMovistarController */
/* @var $data VentaMovistarModel */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('vm_cod')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->vm_cod), array('view', 'id'=>$data->vm_cod)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vm_fecha')); ?>:</b>
	<?php echo CHtml::encode($data->vm_fecha); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vm_transaccion')); ?>:</b>
	<?php echo CHtml::encode($data->vm_transaccion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vm_distribuidor')); ?>:</b>
	<?php echo CHtml::encode($data->vm_distribuidor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vm_nombredistribuidor')); ?>:</b>
	<?php echo CHtml::encode($data->vm_nombredistribuidor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vm_codigoscl')); ?>:</b>
	<?php echo CHtml::encode($data->vm_codigoscl); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vm_inventarioanteriorfuente')); ?>:</b>
	<?php echo CHtml::encode($data->vm_inventarioanteriorfuente); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('vm_inventarioactualfuente')); ?>:</b>
	<?php echo CHtml::encode($data->vm_inventarioactualfuente); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vm_tiposim')); ?>:</b>
	<?php echo CHtml::encode($data->vm_tiposim); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vm_icc')); ?>:</b>
	<?php echo CHtml::encode($data->vm_icc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vm_min')); ?>:</b>
	<?php echo CHtml::encode($data->vm_min); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vm_estado')); ?>:</b>
	<?php echo CHtml::encode($data->vm_estado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vm_iddestino')); ?>:</b>
	<?php echo CHtml::encode($data->vm_iddestino); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vm_nombredestino')); ?>:</b>
	<?php echo CHtml::encode($data->vm_nombredestino); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vm_inventarioanteriordestino')); ?>:</b>
	<?php echo CHtml::encode($data->vm_inventarioanteriordestino); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vm_inventarioactualdestino')); ?>:</b>
	<?php echo CHtml::encode($data->vm_inventarioactualdestino); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vm_canal')); ?>:</b>
	<?php echo CHtml::encode($data->vm_canal); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vm_lote')); ?>:</b>
	<?php echo CHtml::encode($data->vm_lote); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vm_zona')); ?>:</b>
	<?php echo CHtml::encode($data->vm_zona); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vm_fecha_ingreso')); ?>:</b>
	<?php echo CHtml::encode($data->vm_fecha_ingreso); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vm_fecha_modificacion')); ?>:</b>
	<?php echo CHtml::encode($data->vm_fecha_modificacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vm_usuario_ingresa_modifica')); ?>:</b>
	<?php echo CHtml::encode($data->vm_usuario_ingresa_modifica); ?>
	<br />

	*/ ?>

</div>