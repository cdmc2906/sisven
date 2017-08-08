<?php
/* @var $this TransferenciaMovistarController */
/* @var $data TransferenciaMovistarModel */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('tm_codigo')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->tm_codigo), array('view', 'id'=>$data->tm_codigo)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tm_fecha')); ?>:</b>
	<?php echo CHtml::encode($data->tm_fecha); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tm_codigotransferencia')); ?>:</b>
	<?php echo CHtml::encode($data->tm_codigotransferencia); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tm_iddistribuidor')); ?>:</b>
	<?php echo CHtml::encode($data->tm_iddistribuidor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tm_nombredistribuidor')); ?>:</b>
	<?php echo CHtml::encode($data->tm_nombredistribuidor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tm_codigoscl')); ?>:</b>
	<?php echo CHtml::encode($data->tm_codigoscl); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tm_inventarioanteriorfuente')); ?>:</b>
	<?php echo CHtml::encode($data->tm_inventarioanteriorfuente); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('tm_inventarioactualfuente')); ?>:</b>
	<?php echo CHtml::encode($data->tm_inventarioactualfuente); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tm_tiposim')); ?>:</b>
	<?php echo CHtml::encode($data->tm_tiposim); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tm_icc')); ?>:</b>
	<?php echo CHtml::encode($data->tm_icc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tm_min')); ?>:</b>
	<?php echo CHtml::encode($data->tm_min); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tm_estado')); ?>:</b>
	<?php echo CHtml::encode($data->tm_estado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tm_iddestino')); ?>:</b>
	<?php echo CHtml::encode($data->tm_iddestino); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tm_nombredestino')); ?>:</b>
	<?php echo CHtml::encode($data->tm_nombredestino); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tm_inventarioanteriordestino')); ?>:</b>
	<?php echo CHtml::encode($data->tm_inventarioanteriordestino); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tm_inventarioactualdestino')); ?>:</b>
	<?php echo CHtml::encode($data->tm_inventarioactualdestino); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tm_canal')); ?>:</b>
	<?php echo CHtml::encode($data->tm_canal); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tm_numero_lote')); ?>:</b>
	<?php echo CHtml::encode($data->tm_numero_lote); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tm_zona')); ?>:</b>
	<?php echo CHtml::encode($data->tm_zona); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tm_fecha_ingreso')); ?>:</b>
	<?php echo CHtml::encode($data->tm_fecha_ingreso); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tm_fecha_modifica')); ?>:</b>
	<?php echo CHtml::encode($data->tm_fecha_modifica); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tm_usuario_ingresa_modifica')); ?>:</b>
	<?php echo CHtml::encode($data->tm_usuario_ingresa_modifica); ?>
	<br />

	*/ ?>

</div>