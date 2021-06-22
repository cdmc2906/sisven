<?php
/* @var $this ResultadoValidaChipController */
/* @var $model ResultadoValidaChipModel */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'resultado-valida-chip-model-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'rvc_dato_chip'); ?>
		<?php echo $form->textField($model,'rvc_dato_chip',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'rvc_dato_chip'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rvc_tipo_validacion'); ?>
		<?php echo $form->textField($model,'rvc_tipo_validacion',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'rvc_tipo_validacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rvc_subtipo_validacion'); ?>
		<?php echo $form->textField($model,'rvc_subtipo_validacion',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'rvc_subtipo_validacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rvc_resultado_validacion'); ?>
		<?php echo $form->textField($model,'rvc_resultado_validacion',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'rvc_resultado_validacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rvc_ejecutivo'); ?>
		<?php echo $form->textField($model,'rvc_ejecutivo',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'rvc_ejecutivo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rvc_solicitud_fecha'); ?>
		<?php echo $form->textField($model,'rvc_solicitud_fecha'); ?>
		<?php echo $form->error($model,'rvc_solicitud_fecha'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rvc_solicitud_ip'); ?>
		<?php echo $form->textField($model,'rvc_solicitud_ip',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'rvc_solicitud_ip'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rvc_solicitud_dispositivo'); ?>
		<?php echo $form->textField($model,'rvc_solicitud_dispositivo',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'rvc_solicitud_dispositivo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rvc_solicitud_navegador'); ?>
		<?php echo $form->textField($model,'rvc_solicitud_navegador',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'rvc_solicitud_navegador'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rvc_estado_validacion'); ?>
		<?php echo $form->textField($model,'rvc_estado_validacion'); ?>
		<?php echo $form->error($model,'rvc_estado_validacion'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->