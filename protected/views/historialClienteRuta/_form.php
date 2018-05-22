<?php
/* @var $this HistorialClienteRutaController */
/* @var $model HistorialClienteRutaModel */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'historial-cliente-ruta-model-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'hcr_codigo_cliente'); ?>
		<?php echo $form->textField($model,'hcr_codigo_cliente',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'hcr_codigo_cliente'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'hcr_ruta_anterior'); ?>
		<?php echo $form->textField($model,'hcr_ruta_anterior',array('size'=>60,'maxlength'=>150)); ?>
		<?php echo $form->error($model,'hcr_ruta_anterior'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'hcr_ruta_nueva'); ?>
		<?php echo $form->textField($model,'hcr_ruta_nueva',array('size'=>60,'maxlength'=>150)); ?>
		<?php echo $form->error($model,'hcr_ruta_nueva'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'hcr_direccion_anterior'); ?>
		<?php echo $form->textField($model,'hcr_direccion_anterior',array('size'=>60,'maxlength'=>150)); ?>
		<?php echo $form->error($model,'hcr_direccion_anterior'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'hcr_direccion_nueva'); ?>
		<?php echo $form->textField($model,'hcr_direccion_nueva',array('size'=>60,'maxlength'=>150)); ?>
		<?php echo $form->error($model,'hcr_direccion_nueva'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'hcr_semana_anterior'); ?>
		<?php echo $form->textField($model,'hcr_semana_anterior'); ?>
		<?php echo $form->error($model,'hcr_semana_anterior'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'hcr_semana_nueva'); ?>
		<?php echo $form->textField($model,'hcr_semana_nueva'); ?>
		<?php echo $form->error($model,'hcr_semana_nueva'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'hcr_dia_anterior'); ?>
		<?php echo $form->textField($model,'hcr_dia_anterior'); ?>
		<?php echo $form->error($model,'hcr_dia_anterior'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'hcr_dia_nuevo'); ?>
		<?php echo $form->textField($model,'hcr_dia_nuevo'); ?>
		<?php echo $form->error($model,'hcr_dia_nuevo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'hcr_secuencia_anterior'); ?>
		<?php echo $form->textField($model,'hcr_secuencia_anterior'); ?>
		<?php echo $form->error($model,'hcr_secuencia_anterior'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'hcr_secuencia_nueva'); ?>
		<?php echo $form->textField($model,'hcr_secuencia_nueva'); ?>
		<?php echo $form->error($model,'hcr_secuencia_nueva'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'hcr_estado_anterior'); ?>
		<?php echo $form->textField($model,'hcr_estado_anterior'); ?>
		<?php echo $form->error($model,'hcr_estado_anterior'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'hcr_estado_nuevo'); ?>
		<?php echo $form->textField($model,'hcr_estado_nuevo'); ?>
		<?php echo $form->error($model,'hcr_estado_nuevo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'hcr_fch_actualiza_ruta'); ?>
		<?php echo $form->textField($model,'hcr_fch_actualiza_ruta'); ?>
		<?php echo $form->error($model,'hcr_fch_actualiza_ruta'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'hcr_cambios'); ?>
		<?php echo $form->textField($model,'hcr_cambios',array('size'=>60,'maxlength'=>150)); ?>
		<?php echo $form->error($model,'hcr_cambios'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'hcr_fch_ingreso'); ?>
		<?php echo $form->textField($model,'hcr_fch_ingreso'); ?>
		<?php echo $form->error($model,'hcr_fch_ingreso'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'hcr_fch_modificacion'); ?>
		<?php echo $form->textField($model,'hcr_fch_modificacion'); ?>
		<?php echo $form->error($model,'hcr_fch_modificacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'hcr_cod_usuario_ing_mod'); ?>
		<?php echo $form->textField($model,'hcr_cod_usuario_ing_mod'); ?>
		<?php echo $form->error($model,'hcr_cod_usuario_ing_mod'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->