<?php
/* @var $this OrdenesMbController */
/* @var $model OrdenesMbModel */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ordenes-mb-model-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'o_id'); ?>
		<?php echo $form->textField($model,'o_id'); ?>
		<?php echo $form->error($model,'o_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'o_concepto'); ?>
		<?php echo $form->textField($model,'o_concepto',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'o_concepto'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'o_codigo_mb'); ?>
		<?php echo $form->textField($model,'o_codigo_mb',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'o_codigo_mb'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'o_comentario'); ?>
		<?php echo $form->textField($model,'o_comentario',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'o_comentario'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'o_fch_venta'); ?>
		<?php echo $form->textField($model,'o_fch_venta'); ?>
		<?php echo $form->error($model,'o_fch_venta'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'o_fch_creacion'); ?>
		<?php echo $form->textField($model,'o_fch_creacion'); ?>
		<?php echo $form->error($model,'o_fch_creacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'o_fch_despacho'); ?>
		<?php echo $form->textField($model,'o_fch_despacho'); ?>
		<?php echo $form->error($model,'o_fch_despacho'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'o_tipo'); ?>
		<?php echo $form->textField($model,'o_tipo',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'o_tipo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'o_estatus'); ?>
		<?php echo $form->textField($model,'o_estatus',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'o_estatus'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'o_cod_cliente'); ?>
		<?php echo $form->textField($model,'o_cod_cliente',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'o_cod_cliente'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'o_nom_cliente'); ?>
		<?php echo $form->textField($model,'o_nom_cliente',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'o_nom_cliente'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'o_id_cliente'); ?>
		<?php echo $form->textField($model,'o_id_cliente',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'o_id_cliente'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'o_direccion'); ?>
		<?php echo $form->textField($model,'o_direccion',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'o_direccion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'o_lista_precio'); ?>
		<?php echo $form->textField($model,'o_lista_precio',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'o_lista_precio'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'o_nom_lista_precio'); ?>
		<?php echo $form->textField($model,'o_nom_lista_precio',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'o_nom_lista_precio'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'o_bodega_origen'); ?>
		<?php echo $form->textField($model,'o_bodega_origen',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'o_bodega_origen'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'o_nom_bodega_origen'); ?>
		<?php echo $form->textField($model,'o_nom_bodega_origen',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'o_nom_bodega_origen'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'o_termino_pago'); ?>
		<?php echo $form->textField($model,'o_termino_pago',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'o_termino_pago'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'o_nom_termino_pago'); ?>
		<?php echo $form->textField($model,'o_nom_termino_pago',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'o_nom_termino_pago'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'o_usuario'); ?>
		<?php echo $form->textField($model,'o_usuario',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'o_usuario'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'o_nom_usuario'); ?>
		<?php echo $form->textField($model,'o_nom_usuario',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'o_nom_usuario'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'o_oficina'); ?>
		<?php echo $form->textField($model,'o_oficina',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'o_oficina'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'o_nom_oficina'); ?>
		<?php echo $form->textField($model,'o_nom_oficina',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'o_nom_oficina'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'o_tipo_secuencia'); ?>
		<?php echo $form->textField($model,'o_tipo_secuencia',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'o_tipo_secuencia'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'o_iva_12_base'); ?>
		<?php echo $form->textField($model,'o_iva_12_base',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'o_iva_12_base'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'o_iva_12_valor'); ?>
		<?php echo $form->textField($model,'o_iva_12_valor',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'o_iva_12_valor'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'o_iva_0_base'); ?>
		<?php echo $form->textField($model,'o_iva_0_base',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'o_iva_0_base'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'o_iva_0_valor'); ?>
		<?php echo $form->textField($model,'o_iva_0_valor',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'o_iva_0_valor'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'o_iva_14_base'); ?>
		<?php echo $form->textField($model,'o_iva_14_base',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'o_iva_14_base'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'o_iva_14_valor'); ?>
		<?php echo $form->textField($model,'o_iva_14_valor',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'o_iva_14_valor'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'o_subtotal'); ?>
		<?php echo $form->textField($model,'o_subtotal',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'o_subtotal'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'o_porcentaje_descuento'); ?>
		<?php echo $form->textField($model,'o_porcentaje_descuento',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'o_porcentaje_descuento'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'o_descuento'); ?>
		<?php echo $form->textField($model,'o_descuento',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'o_descuento'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'o_impuestos'); ?>
		<?php echo $form->textField($model,'o_impuestos',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'o_impuestos'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'o_otros_cargos'); ?>
		<?php echo $form->textField($model,'o_otros_cargos',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'o_otros_cargos'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'o_total'); ?>
		<?php echo $form->textField($model,'o_total',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'o_total'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'o_datos'); ?>
		<?php echo $form->textField($model,'o_datos',array('size'=>60,'maxlength'=>1024)); ?>
		<?php echo $form->error($model,'o_datos'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'o_referencia'); ?>
		<?php echo $form->textField($model,'o_referencia',array('size'=>60,'maxlength'=>1024)); ?>
		<?php echo $form->error($model,'o_referencia'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'o_estado_proceso'); ?>
		<?php echo $form->textField($model,'o_estado_proceso',array('size'=>60,'maxlength'=>1024)); ?>
		<?php echo $form->error($model,'o_estado_proceso'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'o_fch_ingreso'); ?>
		<?php echo $form->textField($model,'o_fch_ingreso'); ?>
		<?php echo $form->error($model,'o_fch_ingreso'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'o_fch_modificacion'); ?>
		<?php echo $form->textField($model,'o_fch_modificacion'); ?>
		<?php echo $form->error($model,'o_fch_modificacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'o_fch_desde'); ?>
		<?php echo $form->textField($model,'o_fch_desde'); ?>
		<?php echo $form->error($model,'o_fch_desde'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'o_fch_hasta'); ?>
		<?php echo $form->textField($model,'o_fch_hasta'); ?>
		<?php echo $form->error($model,'o_fch_hasta'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'o_usr_ing_mod'); ?>
		<?php echo $form->textField($model,'o_usr_ing_mod'); ?>
		<?php echo $form->error($model,'o_usr_ing_mod'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->