<?php
/* @var $this PeriodoGestionController */
/* @var $data PeriodoGestionModel */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('pg_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->pg_id), array('view', 'id'=>$data->pg_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pg_descripcion')); ?>:</b>
	<?php echo CHtml::encode($data->pg_descripcion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pg_fecha_inicio')); ?>:</b>
	<?php echo CHtml::encode($data->pg_fecha_inicio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pg_fecha_fin')); ?>:</b>
	<?php echo CHtml::encode($data->pg_fecha_fin); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pg_estado')); ?>:</b>
	<?php echo CHtml::encode($data->pg_estado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pg_tipo')); ?>:</b>
	<?php echo CHtml::encode($data->pg_tipo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pg_fecha_ingreso')); ?>:</b>
	<?php echo CHtml::encode($data->pg_fecha_ingreso); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('pg_fecha_modificacion')); ?>:</b>
	<?php echo CHtml::encode($data->pg_fecha_modificacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pg_cod_usuario_ing_mod')); ?>:</b>
	<?php echo CHtml::encode($data->pg_cod_usuario_ing_mod); ?>
	<br />

	*/ ?>

</div>