<?php
/* @var $this RevisionMinesController */
/* @var $data RevisionMinesModel */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('rmva_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->rmva_id), array('view', 'id'=>$data->rmva_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('iduser')); ?>:</b>
	<?php echo CHtml::encode($data->iduser); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rmva_tipo')); ?>:</b>
	<?php echo CHtml::encode($data->rmva_tipo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rmva_fecha_gestion')); ?>:</b>
	<?php echo CHtml::encode($data->rmva_fecha_gestion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rmva_resultado_llamad')); ?>:</b>
	<?php echo CHtml::encode($data->rmva_resultado_llamad); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rmva_motivo_no_contado')); ?>:</b>
	<?php echo CHtml::encode($data->rmva_motivo_no_contado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rmva_operadora')); ?>:</b>
	<?php echo CHtml::encode($data->rmva_operadora); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('rmva_lugar_compra')); ?>:</b>
	<?php echo CHtml::encode($data->rmva_lugar_compra); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rmva_precio')); ?>:</b>
	<?php echo CHtml::encode($data->rmva_precio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rmva_estado')); ?>:</b>
	<?php echo CHtml::encode($data->rmva_estado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rmva_fecha_ingreso')); ?>:</b>
	<?php echo CHtml::encode($data->rmva_fecha_ingreso); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rmva_fecha_modifica')); ?>:</b>
	<?php echo CHtml::encode($data->rmva_fecha_modifica); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rmva_cod_usuario_ing_mod')); ?>:</b>
	<?php echo CHtml::encode($data->rmva_cod_usuario_ing_mod); ?>
	<br />

	*/ ?>

</div>