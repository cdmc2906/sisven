<?php
/* @var $this HistorialMbControllerController */
/* @var $data HistorialMbModel */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('h_cod')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->h_cod), array('view', 'id'=>$data->h_cod)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('h_id')); ?>:</b>
	<?php echo CHtml::encode($data->h_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('h_fecha')); ?>:</b>
	<?php echo CHtml::encode($data->h_fecha); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('h_usuario')); ?>:</b>
	<?php echo CHtml::encode($data->h_usuario); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('h_ruta')); ?>:</b>
	<?php echo CHtml::encode($data->h_ruta); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('h_ruta_nombre')); ?>:</b>
	<?php echo CHtml::encode($data->h_ruta_nombre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('h_semana')); ?>:</b>
	<?php echo CHtml::encode($data->h_semana); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('h_dia')); ?>:</b>
	<?php echo CHtml::encode($data->h_dia); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('h_cod_cliente')); ?>:</b>
	<?php echo CHtml::encode($data->h_cod_cliente); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('h_nom_cliente')); ?>:</b>
	<?php echo CHtml::encode($data->h_nom_cliente); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('h_direccion')); ?>:</b>
	<?php echo CHtml::encode($data->h_direccion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('h_accion')); ?>:</b>
	<?php echo CHtml::encode($data->h_accion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('h_cod_accion')); ?>:</b>
	<?php echo CHtml::encode($data->h_cod_accion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('h_cod_comentario')); ?>:</b>
	<?php echo CHtml::encode($data->h_cod_comentario); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('h_comentario')); ?>:</b>
	<?php echo CHtml::encode($data->h_comentario); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('h_monto')); ?>:</b>
	<?php echo CHtml::encode($data->h_monto); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('h_latitud')); ?>:</b>
	<?php echo CHtml::encode($data->h_latitud); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('h_longitud')); ?>:</b>
	<?php echo CHtml::encode($data->h_longitud); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('h_romper_secuencia')); ?>:</b>
	<?php echo CHtml::encode($data->h_romper_secuencia); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('h_fch_ingreso')); ?>:</b>
	<?php echo CHtml::encode($data->h_fch_ingreso); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('h_fch_modificacion')); ?>:</b>
	<?php echo CHtml::encode($data->h_fch_modificacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('h_fch_desde')); ?>:</b>
	<?php echo CHtml::encode($data->h_fch_desde); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('h_fch_hasta')); ?>:</b>
	<?php echo CHtml::encode($data->h_fch_hasta); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('h_usr_ing_mod')); ?>:</b>
	<?php echo CHtml::encode($data->h_usr_ing_mod); ?>
	<br />

	*/ ?>

</div>