<?php
/* @var $this OrdenesMbController */
/* @var $data OrdenesMbModel */
?>

<div class="view">
    <b><?php echo CHtml::encode($data->getAttributeLabel('o_codigo')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->o_codigo), array('view', 'id' => $data->o_codigo)); ?>
    <br />
    <b><?php echo CHtml::encode($data->getAttributeLabel('o_id')); ?>:</b>
    <?php echo CHtml::encode($data->o_id); ?>
    <?php /*
      <br />
      <b><?php echo CHtml::encode($data->getAttributeLabel('o_concepto'));    ?>:</b>
      <?php echo CHtml::encode($data->o_concepto); ?>

      <br />
      <b><?php echo CHtml::encode($data->getAttributeLabel('o_comentario'));    ?>:</b>
      <?php echo CHtml::encode($data->o_comentario); ?>
     */
    ?>

    <br />
    <b><?php echo CHtml::encode($data->getAttributeLabel('o_fch_creacion')); ?>:</b>
    <?php echo CHtml::encode($data->o_fch_creacion); ?>
    <?php /*
      <br />
      <b><?php echo CHtml::encode($data->getAttributeLabel('o_fch_despacho'));     ?>:</b>
      <?php echo CHtml::encode($data->o_fch_despacho);  ?>
      <br />
      <b><?php echo CHtml::encode($data->getAttributeLabel('o_tipo'));     ?>:</b>
      <?php echo CHtml::encode($data->o_tipo);  ?>
     */
    ?>

    <br />
    <b><?php echo CHtml::encode($data->getAttributeLabel('o_subtotal')); ?>:</b>
    <?php echo CHtml::encode($data->o_subtotal); ?>
    <br />
    <b><?php echo CHtml::encode($data->getAttributeLabel('o_nom_usuario')); ?>:</b>
    <?php echo CHtml::encode($data->o_nom_usuario); ?>
    <br />
    <?php
    /*
      <b><?php echo CHtml::encode($data->getAttributeLabel('o_estatus')); ?>:</b>
      <?php echo CHtml::encode($data->o_estatus); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('o_cod_cliente')); ?>:</b>
      <?php echo CHtml::encode($data->o_cod_cliente); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('o_nom_cliente')); ?>:</b>
      <?php echo CHtml::encode($data->o_nom_cliente); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('o_id_cliente')); ?>:</b>
      <?php echo CHtml::encode($data->o_id_cliente); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('o_direccion')); ?>:</b>
      <?php echo CHtml::encode($data->o_direccion); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('o_lista_precio')); ?>:</b>
      <?php echo CHtml::encode($data->o_lista_precio); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('o_nom_lista_precio')); ?>:</b>
      <?php echo CHtml::encode($data->o_nom_lista_precio); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('o_bodega_origen')); ?>:</b>
      <?php echo CHtml::encode($data->o_bodega_origen); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('o_nom_bodega_origen')); ?>:</b>
      <?php echo CHtml::encode($data->o_nom_bodega_origen); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('o_termino_pago')); ?>:</b>
      <?php echo CHtml::encode($data->o_termino_pago); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('o_nom_termino_pago')); ?>:</b>
      <?php echo CHtml::encode($data->o_nom_termino_pago); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('o_usuario')); ?>:</b>
      <?php echo CHtml::encode($data->o_usuario); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('o_oficina')); ?>:</b>
      <?php echo CHtml::encode($data->o_oficina); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('o_nom_oficina')); ?>:</b>
      <?php echo CHtml::encode($data->o_nom_oficina); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('o_tipo_secuencia')); ?>:</b>
      <?php echo CHtml::encode($data->o_tipo_secuencia); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('o_iva_12_base')); ?>:</b>
      <?php echo CHtml::encode($data->o_iva_12_base); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('o_iva_12_valor')); ?>:</b>
      <?php echo CHtml::encode($data->o_iva_12_valor); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('o_iva_0_base')); ?>:</b>
      <?php echo CHtml::encode($data->o_iva_0_base); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('o_iva_0_valor')); ?>:</b>
      <?php echo CHtml::encode($data->o_iva_0_valor); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('o_iva_14_base')); ?>:</b>
      <?php echo CHtml::encode($data->o_iva_14_base); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('o_iva_14_valor')); ?>:</b>
      <?php echo CHtml::encode($data->o_iva_14_valor); ?>
      <br />



      <b><?php echo CHtml::encode($data->getAttributeLabel('o_porcentaje_descuento')); ?>:</b>
      <?php echo CHtml::encode($data->o_porcentaje_descuento); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('o_descuento')); ?>:</b>
      <?php echo CHtml::encode($data->o_descuento); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('o_impuestos')); ?>:</b>
      <?php echo CHtml::encode($data->o_impuestos); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('o_otros_cargos')); ?>:</b>
      <?php echo CHtml::encode($data->o_otros_cargos); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('o_total')); ?>:</b>
      <?php echo CHtml::encode($data->o_total); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('o_datos')); ?>:</b>
      <?php echo CHtml::encode($data->o_datos); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('o_referencia')); ?>:</b>
      <?php echo CHtml::encode($data->o_referencia); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('o_estado_proceso')); ?>:</b>
      <?php echo CHtml::encode($data->o_estado_proceso); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('o_fch_ingreso')); ?>:</b>
      <?php echo CHtml::encode($data->o_fch_ingreso); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('o_fch_modificacion')); ?>:</b>
      <?php echo CHtml::encode($data->o_fch_modificacion); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('o_fch_desde')); ?>:</b>
      <?php echo CHtml::encode($data->o_fch_desde); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('o_fch_hasta')); ?>:</b>
      <?php echo CHtml::encode($data->o_fch_hasta); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('o_usr_ing_mod')); ?>:</b>
      <?php echo CHtml::encode($data->o_usr_ing_mod); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('o_codigo_mb')); ?>:</b>
      <?php echo CHtml::encode($data->o_codigo_mb); ?>
      <br />

     */
    ?>

</div>