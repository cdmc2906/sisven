<?php
/* @var $this ResumenHistorialDiarioController */
/* @var $model ResumenHistorialDiarioModel */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'resumen-historial-diario-model-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'rhd_cod_ejecutivo'); ?>
		<?php echo $form->textField($model,'rhd_cod_ejecutivo',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'rhd_cod_ejecutivo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rhd_fecha_historial'); ?>
		<?php echo $form->textField($model,'rhd_fecha_historial'); ?>
		<?php echo $form->error($model,'rhd_fecha_historial'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rhd_parametro'); ?>
		<?php echo $form->textField($model,'rhd_parametro',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'rhd_parametro'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rhd_valor'); ?>
		<?php echo $form->textField($model,'rhd_valor',array('size'=>6,'maxlength'=>6)); ?>
		<?php echo $form->error($model,'rhd_valor'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rhd_fecha_ingreso'); ?>
		<?php echo $form->textField($model,'rhd_fecha_ingreso'); ?>
		<?php echo $form->error($model,'rhd_fecha_ingreso'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rhd_fecha_modificacion'); ?>
		<?php echo $form->textField($model,'rhd_fecha_modificacion'); ?>
		<?php echo $form->error($model,'rhd_fecha_modificacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rhd_usuario_ingresa_modifica'); ?>
		<?php echo $form->textField($model,'rhd_usuario_ingresa_modifica'); ?>
		<?php echo $form->error($model,'rhd_usuario_ingresa_modifica'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rhd_observacion_supervisor'); ?>
		<?php echo $form->textField($model,'rhd_observacion_supervisor',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'rhd_observacion_supervisor'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rhd_usuario_supervisor'); ?>
		<?php echo $form->textField($model,'rhd_usuario_supervisor'); ?>
		<?php echo $form->error($model,'rhd_usuario_supervisor'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rhd_fecha_modifica_observacion'); ?>
		<?php echo $form->textField($model,'rhd_fecha_modifica_observacion'); ?>
		<?php echo $form->error($model,'rhd_fecha_modifica_observacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rhd_semana'); ?>
		<?php echo $form->textField($model,'rhd_semana'); ?>
		<?php echo $form->error($model,'rhd_semana'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rhd_fecha_ingreso_observacion'); ?>
		<?php echo $form->textField($model,'rhd_fecha_ingreso_observacion'); ?>
		<?php echo $form->error($model,'rhd_fecha_ingreso_observacion'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->