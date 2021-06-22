<?php
/* @var $this IndicadoresController */
/* @var $model IndicadoresModel */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'indicadores-model-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'i_fecha'); ?>
		<?php echo $form->textField($model,'i_fecha'); ?>
		<?php echo $form->error($model,'i_fecha'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'i_sucursal'); ?>
		<?php echo $form->textField($model,'i_sucursal',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'i_sucursal'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'i_numero_bodega'); ?>
		<?php echo $form->textField($model,'i_numero_bodega'); ?>
		<?php echo $form->error($model,'i_numero_bodega'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'i_bodega'); ?>
		<?php echo $form->textField($model,'i_bodega',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'i_bodega'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'i_numero_serie'); ?>
		<?php echo $form->textField($model,'i_numero_serie',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'i_numero_serie'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'i_numero_factura'); ?>
		<?php echo $form->textField($model,'i_numero_factura',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'i_numero_factura'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'i_cod_cliente'); ?>
		<?php echo $form->textField($model,'i_cod_cliente',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'i_cod_cliente'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'i_tipo_cliente'); ?>
		<?php echo $form->textField($model,'i_tipo_cliente',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'i_tipo_cliente'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'i_nombre_cliente'); ?>
		<?php echo $form->textField($model,'i_nombre_cliente',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'i_nombre_cliente'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'i_ruc'); ?>
		<?php echo $form->textField($model,'i_ruc',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'i_ruc'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'i_direccion'); ?>
		<?php echo $form->textField($model,'i_direccion',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'i_direccion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'i_ciudad'); ?>
		<?php echo $form->textField($model,'i_ciudad',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'i_ciudad'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'i_telefono'); ?>
		<?php echo $form->textField($model,'i_telefono',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'i_telefono'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'i_codigo_producto'); ?>
		<?php echo $form->textField($model,'i_codigo_producto',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'i_codigo_producto'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'i_descripcion_producto'); ?>
		<?php echo $form->textField($model,'i_descripcion_producto',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'i_descripcion_producto'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'i_codigo_grupo'); ?>
		<?php echo $form->textField($model,'i_codigo_grupo',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'i_codigo_grupo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'i_grupo'); ?>
		<?php echo $form->textField($model,'i_grupo',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'i_grupo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'i_cantidad'); ?>
		<?php echo $form->textField($model,'i_cantidad'); ?>
		<?php echo $form->error($model,'i_cantidad'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'i_detalle'); ?>
		<?php echo $form->textField($model,'i_detalle',array('size'=>60,'maxlength'=>1024)); ?>
		<?php echo $form->error($model,'i_detalle'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'i_imei'); ?>
		<?php echo $form->textField($model,'i_imei',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'i_imei'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'i_min'); ?>
		<?php echo $form->textField($model,'i_min',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'i_min'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'i_icc'); ?>
		<?php echo $form->textField($model,'i_icc',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'i_icc'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'i_costo'); ?>
		<?php echo $form->textField($model,'i_costo',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'i_costo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'i_precio1'); ?>
		<?php echo $form->textField($model,'i_precio1',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'i_precio1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'i_precio2'); ?>
		<?php echo $form->textField($model,'i_precio2',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'i_precio2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'i_precio3'); ?>
		<?php echo $form->textField($model,'i_precio3',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'i_precio3'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'i_precio4'); ?>
		<?php echo $form->textField($model,'i_precio4',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'i_precio4'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'i_precio5'); ?>
		<?php echo $form->textField($model,'i_precio5',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'i_precio5'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'i_precio'); ?>
		<?php echo $form->textField($model,'i_precio',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'i_precio'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'i_porcendes'); ?>
		<?php echo $form->textField($model,'i_porcendes',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'i_porcendes'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'i_descuento'); ?>
		<?php echo $form->textField($model,'i_descuento',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'i_descuento'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'i_subtotal'); ?>
		<?php echo $form->textField($model,'i_subtotal',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'i_subtotal'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'i_iva'); ?>
		<?php echo $form->textField($model,'i_iva',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'i_iva'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'i_total'); ?>
		<?php echo $form->textField($model,'i_total',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'i_total'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'i_e_codigo'); ?>
		<?php echo $form->textField($model,'i_e_codigo',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'i_e_codigo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'i_vendedor'); ?>
		<?php echo $form->textField($model,'i_vendedor',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'i_vendedor'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'i_mes'); ?>
		<?php echo $form->textField($model,'i_mes',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'i_mes'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'i_semana'); ?>
		<?php echo $form->textField($model,'i_semana',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'i_semana'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'i_cedula'); ?>
		<?php echo $form->textField($model,'i_cedula',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'i_cedula'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'i_listado_operadora'); ?>
		<?php echo $form->textField($model,'i_listado_operadora',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'i_listado_operadora'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'i_provincia'); ?>
		<?php echo $form->textField($model,'i_provincia',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'i_provincia'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'i_estatus'); ?>
		<?php echo $form->textField($model,'i_estatus',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'i_estatus'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'i_fecha_ingreso'); ?>
		<?php echo $form->textField($model,'i_fecha_ingreso'); ?>
		<?php echo $form->error($model,'i_fecha_ingreso'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'i_fecha_modificacion'); ?>
		<?php echo $form->textField($model,'i_fecha_modificacion'); ?>
		<?php echo $form->error($model,'i_fecha_modificacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'i_usuario_ingresa_modifica'); ?>
		<?php echo $form->textField($model,'i_usuario_ingresa_modifica'); ?>
		<?php echo $form->error($model,'i_usuario_ingresa_modifica'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'i_estado_icc'); ?>
		<?php echo $form->textField($model,'i_estado_icc',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'i_estado_icc'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->