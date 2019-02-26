<?php
/* @var $this ClienteController */
/* @var $model ClienteModel */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cliente-model-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'cli_codigo_cliente'); ?>
		<?php echo $form->textField($model,'cli_codigo_cliente',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'cli_codigo_cliente'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cli_nombre_cliente'); ?>
		<?php echo $form->textField($model,'cli_nombre_cliente',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'cli_nombre_cliente'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cli_tipo_de_identificacion'); ?>
		<?php echo $form->textField($model,'cli_tipo_de_identificacion',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'cli_tipo_de_identificacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cli_identificacion'); ?>
		<?php echo $form->textField($model,'cli_identificacion',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'cli_identificacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cli_nombre_de_compania'); ?>
		<?php echo $form->textField($model,'cli_nombre_de_compania',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'cli_nombre_de_compania'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cli_nombre_comercial'); ?>
		<?php echo $form->textField($model,'cli_nombre_comercial',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'cli_nombre_comercial'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cli_contacto'); ?>
		<?php echo $form->textField($model,'cli_contacto',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'cli_contacto'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cli_moneda'); ?>
		<?php echo $form->textField($model,'cli_moneda',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'cli_moneda'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cli_moneda_nombre'); ?>
		<?php echo $form->textField($model,'cli_moneda_nombre',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'cli_moneda_nombre'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cli_tipo_de_negocio'); ?>
		<?php echo $form->textField($model,'cli_tipo_de_negocio',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'cli_tipo_de_negocio'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cli_tipo_de_negocio_nombre'); ?>
		<?php echo $form->textField($model,'cli_tipo_de_negocio_nombre',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'cli_tipo_de_negocio_nombre'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cli_subcanal'); ?>
		<?php echo $form->textField($model,'cli_subcanal',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'cli_subcanal'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cli_subcanal_nombre'); ?>
		<?php echo $form->textField($model,'cli_subcanal_nombre',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'cli_subcanal_nombre'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cli_lista_de_precios'); ?>
		<?php echo $form->textField($model,'cli_lista_de_precios',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'cli_lista_de_precios'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cli_lista_de_precios_nombre'); ?>
		<?php echo $form->textField($model,'cli_lista_de_precios_nombre',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'cli_lista_de_precios_nombre'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cli_lista_de_precios_2'); ?>
		<?php echo $form->textField($model,'cli_lista_de_precios_2',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'cli_lista_de_precios_2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cli_lista_de_precios_2_nombre'); ?>
		<?php echo $form->textField($model,'cli_lista_de_precios_2_nombre',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'cli_lista_de_precios_2_nombre'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cli_termino_de_pago'); ?>
		<?php echo $form->textField($model,'cli_termino_de_pago',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'cli_termino_de_pago'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cli_termino_de_pago_nombre'); ?>
		<?php echo $form->textField($model,'cli_termino_de_pago_nombre',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'cli_termino_de_pago_nombre'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cli_metodo_de_pago'); ?>
		<?php echo $form->textField($model,'cli_metodo_de_pago',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'cli_metodo_de_pago'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cli_metodo_de_pago_nombre'); ?>
		<?php echo $form->textField($model,'cli_metodo_de_pago_nombre',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'cli_metodo_de_pago_nombre'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cli_grupo'); ?>
		<?php echo $form->textField($model,'cli_grupo',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'cli_grupo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cli_grupo_nombre'); ?>
		<?php echo $form->textField($model,'cli_grupo_nombre',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'cli_grupo_nombre'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cli_usuario'); ?>
		<?php echo $form->textField($model,'cli_usuario',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'cli_usuario'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cli_usuario_nombre'); ?>
		<?php echo $form->textField($model,'cli_usuario_nombre',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'cli_usuario_nombre'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cli_comentario'); ?>
		<?php echo $form->textField($model,'cli_comentario',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'cli_comentario'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cli_objetivo_de_venta'); ?>
		<?php echo $form->textField($model,'cli_objetivo_de_venta',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'cli_objetivo_de_venta'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cli_maximo_descuento_porcentaje'); ?>
		<?php echo $form->textField($model,'cli_maximo_descuento_porcentaje',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'cli_maximo_descuento_porcentaje'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cli_retencion_porcentaje'); ?>
		<?php echo $form->textField($model,'cli_retencion_porcentaje',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'cli_retencion_porcentaje'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cli_tiene_credito'); ?>
		<?php echo $form->textField($model,'cli_tiene_credito'); ?>
		<?php echo $form->error($model,'cli_tiene_credito'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cli_estatus'); ?>
		<?php echo $form->textField($model,'cli_estatus',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'cli_estatus'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cli_creado'); ?>
		<?php echo $form->textField($model,'cli_creado'); ?>
		<?php echo $form->error($model,'cli_creado'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cli_creado_por'); ?>
		<?php echo $form->textField($model,'cli_creado_por',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'cli_creado_por'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cli_latitud'); ?>
		<?php echo $form->textField($model,'cli_latitud',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'cli_latitud'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cli_longitud'); ?>
		<?php echo $form->textField($model,'cli_longitud',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'cli_longitud'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cli_estado'); ?>
		<?php echo $form->textField($model,'cli_estado'); ?>
		<?php echo $form->error($model,'cli_estado'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cli_fecha_ingreso'); ?>
		<?php echo $form->textField($model,'cli_fecha_ingreso'); ?>
		<?php echo $form->error($model,'cli_fecha_ingreso'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cli_fecha_modificacion'); ?>
		<?php echo $form->textField($model,'cli_fecha_modificacion'); ?>
		<?php echo $form->error($model,'cli_fecha_modificacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cli_usuario_ingresa_modifica'); ?>
		<?php echo $form->textField($model,'cli_usuario_ingresa_modifica'); ?>
		<?php echo $form->error($model,'cli_usuario_ingresa_modifica'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->