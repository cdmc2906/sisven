<?php
/* @var $this AuditoriaController */
/* @var $model AuditoriaModel */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'auditoria-model-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'FECHA_AUD'); ?>
		<?php echo $form->textField($model,'FECHA_AUD'); ?>
		<?php echo $form->error($model,'FECHA_AUD'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'IDUSR_AUD'); ?>
		<?php echo $form->textField($model,'IDUSR_AUD'); ?>
		<?php echo $form->error($model,'IDUSR_AUD'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->