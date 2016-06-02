<?php
/* @var $this AsignacionController */
/* @var $model AsignacionModel */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'asignacion-model-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'ID_PRO'); ?>
		<?php echo $form->textField($model,'ID_PRO'); ?>
		<?php echo $form->error($model,'ID_PRO'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ID_VEND'); ?>
		<?php echo $form->textField($model,'ID_VEND'); ?>
		<?php echo $form->error($model,'ID_VEND'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'FECHAINGRESO_ASIG'); ?>
		<?php echo $form->textField($model,'FECHAINGRESO_ASIG'); ?>
		<?php echo $form->error($model,'FECHAINGRESO_ASIG'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'IDUSR_ASIF'); ?>
		<?php echo $form->textField($model,'IDUSR_ASIF'); ?>
		<?php echo $form->error($model,'IDUSR_ASIF'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->