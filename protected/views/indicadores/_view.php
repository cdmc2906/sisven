<?php
/* @var $this IndicadoresController */
/* @var $data IndicadoresModel */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('i_codigo')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->i_codigo), array('view', 'id'=>$data->i_codigo)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('i_fecha')); ?>:</b>
	<?php echo CHtml::encode($data->i_fecha); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('i_sucursal')); ?>:</b>
	<?php echo CHtml::encode($data->i_sucursal); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('i_numero_bodega')); ?>:</b>
	<?php echo CHtml::encode($data->i_numero_bodega); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('i_bodega')); ?>:</b>
	<?php echo CHtml::encode($data->i_bodega); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('i_numero_serie')); ?>:</b>
	<?php echo CHtml::encode($data->i_numero_serie); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('i_numero_factura')); ?>:</b>
	<?php echo CHtml::encode($data->i_numero_factura); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('i_cod_cliente')); ?>:</b>
	<?php echo CHtml::encode($data->i_cod_cliente); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('i_tipo_cliente')); ?>:</b>
	<?php echo CHtml::encode($data->i_tipo_cliente); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('i_nombre_cliente')); ?>:</b>
	<?php echo CHtml::encode($data->i_nombre_cliente); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('i_ruc')); ?>:</b>
	<?php echo CHtml::encode($data->i_ruc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('i_direccion')); ?>:</b>
	<?php echo CHtml::encode($data->i_direccion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('i_ciudad')); ?>:</b>
	<?php echo CHtml::encode($data->i_ciudad); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('i_telefono')); ?>:</b>
	<?php echo CHtml::encode($data->i_telefono); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('i_codigo_producto')); ?>:</b>
	<?php echo CHtml::encode($data->i_codigo_producto); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('i_descripcion_producto')); ?>:</b>
	<?php echo CHtml::encode($data->i_descripcion_producto); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('i_codigo_grupo')); ?>:</b>
	<?php echo CHtml::encode($data->i_codigo_grupo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('i_grupo')); ?>:</b>
	<?php echo CHtml::encode($data->i_grupo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('i_cantidad')); ?>:</b>
	<?php echo CHtml::encode($data->i_cantidad); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('i_detalle')); ?>:</b>
	<?php echo CHtml::encode($data->i_detalle); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('i_imei')); ?>:</b>
	<?php echo CHtml::encode($data->i_imei); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('i_min')); ?>:</b>
	<?php echo CHtml::encode($data->i_min); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('i_icc')); ?>:</b>
	<?php echo CHtml::encode($data->i_icc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('i_costo')); ?>:</b>
	<?php echo CHtml::encode($data->i_costo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('i_precio1')); ?>:</b>
	<?php echo CHtml::encode($data->i_precio1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('i_precio2')); ?>:</b>
	<?php echo CHtml::encode($data->i_precio2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('i_precio3')); ?>:</b>
	<?php echo CHtml::encode($data->i_precio3); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('i_precio4')); ?>:</b>
	<?php echo CHtml::encode($data->i_precio4); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('i_precio5')); ?>:</b>
	<?php echo CHtml::encode($data->i_precio5); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('i_precio')); ?>:</b>
	<?php echo CHtml::encode($data->i_precio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('i_porcendes')); ?>:</b>
	<?php echo CHtml::encode($data->i_porcendes); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('i_descuento')); ?>:</b>
	<?php echo CHtml::encode($data->i_descuento); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('i_subtotal')); ?>:</b>
	<?php echo CHtml::encode($data->i_subtotal); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('i_iva')); ?>:</b>
	<?php echo CHtml::encode($data->i_iva); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('i_total')); ?>:</b>
	<?php echo CHtml::encode($data->i_total); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('i_e_codigo')); ?>:</b>
	<?php echo CHtml::encode($data->i_e_codigo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('i_vendedor')); ?>:</b>
	<?php echo CHtml::encode($data->i_vendedor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('i_provincia')); ?>:</b>
	<?php echo CHtml::encode($data->i_provincia); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('i_fecha_ingreso')); ?>:</b>
	<?php echo CHtml::encode($data->i_fecha_ingreso); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('i_fecha_modificacion')); ?>:</b>
	<?php echo CHtml::encode($data->i_fecha_modificacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('i_usuario_ingresa_modifica')); ?>:</b>
	<?php echo CHtml::encode($data->i_usuario_ingresa_modifica); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('i_estado_icc')); ?>:</b>
	<?php echo CHtml::encode($data->i_estado_icc); ?>
	<br />

	*/ ?>

</div>