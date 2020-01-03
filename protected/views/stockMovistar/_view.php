<?php
/* @var $this StockMovistarController */
/* @var $data StockMovistarModel */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('sm_codigo')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->sm_codigo), array('view', 'id'=>$data->sm_codigo)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pg_id')); ?>:</b>
	<?php echo CHtml::encode($data->pg_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sm_distribuidor_id')); ?>:</b>
	<?php echo CHtml::encode($data->sm_distribuidor_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sm_nombre_del_distribuidor')); ?>:</b>
	<?php echo CHtml::encode($data->sm_nombre_del_distribuidor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sm_zona')); ?>:</b>
	<?php echo CHtml::encode($data->sm_zona); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sm_provincia')); ?>:</b>
	<?php echo CHtml::encode($data->sm_provincia); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sm_ciudad')); ?>:</b>
	<?php echo CHtml::encode($data->sm_ciudad); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('sm_principal_distribuidor_id')); ?>:</b>
	<?php echo CHtml::encode($data->sm_principal_distribuidor_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sm_nombre_del_distribuidor_principal')); ?>:</b>
	<?php echo CHtml::encode($data->sm_nombre_del_distribuidor_principal); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sm_tipo_de_codigo_de_sim')); ?>:</b>
	<?php echo CHtml::encode($data->sm_tipo_de_codigo_de_sim); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sm_sim_inventario_saldo')); ?>:</b>
	<?php echo CHtml::encode($data->sm_sim_inventario_saldo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sm_estado_de_sim')); ?>:</b>
	<?php echo CHtml::encode($data->sm_estado_de_sim); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sm_fecha_ingreso')); ?>:</b>
	<?php echo CHtml::encode($data->sm_fecha_ingreso); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sm_fecha_modifica')); ?>:</b>
	<?php echo CHtml::encode($data->sm_fecha_modifica); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sm_usuario_ingresa_modifica')); ?>:</b>
	<?php echo CHtml::encode($data->sm_usuario_ingresa_modifica); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sm_numero_carga')); ?>:</b>
	<?php echo CHtml::encode($data->sm_numero_carga); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sm_estado')); ?>:</b>
	<?php echo CHtml::encode($data->sm_estado); ?>
	<br />

	*/ ?>

</div>