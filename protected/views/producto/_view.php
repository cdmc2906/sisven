<?php
/* @var $this ProductoController */
/* @var $data ProductoModel */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_PRO')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID_PRO), array('view', 'id'=>$data->ID_PRO)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_EST')); ?>:</b>
	<?php echo CHtml::encode($data->ID_EST); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_COMP')); ?>:</b>
	<?php echo CHtml::encode($data->ID_COMP); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_TPRO')); ?>:</b>
	<?php echo CHtml::encode($data->ID_TPRO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_BODEGA')); ?>:</b>
	<?php echo CHtml::encode($data->ID_BODEGA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NOMBRE_PROD')); ?>:</b>
	<?php echo CHtml::encode($data->NOMBRE_PROD); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('MIN_PROD')); ?>:</b>
	<?php echo CHtml::encode($data->MIN_PROD); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('ICC_PROD')); ?>:</b>
	<?php echo CHtml::encode($data->ICC_PROD); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('IMEI_PROD')); ?>:</b>
	<?php echo CHtml::encode($data->IMEI_PROD); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NUMSERIE_PROD')); ?>:</b>
	<?php echo CHtml::encode($data->NUMSERIE_PROD); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PRECIO_PROD')); ?>:</b>
	<?php echo CHtml::encode($data->PRECIO_PROD); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('COSTO_PROD')); ?>:</b>
	<?php echo CHtml::encode($data->COSTO_PROD); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PORCENTAJEDESCUENTO_PROD')); ?>:</b>
	<?php echo CHtml::encode($data->PORCENTAJEDESCUENTO_PROD); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PRECIO1_PROD')); ?>:</b>
	<?php echo CHtml::encode($data->PRECIO1_PROD); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PRECIO2_PROD')); ?>:</b>
	<?php echo CHtml::encode($data->PRECIO2_PROD); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PRECIO3_PROD')); ?>:</b>
	<?php echo CHtml::encode($data->PRECIO3_PROD); ?>
	<br />

	*/ ?>

</div>