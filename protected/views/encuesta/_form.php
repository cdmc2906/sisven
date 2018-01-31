<?php
/* @var $this EncuestaController */
/* @var $model EncuestaModel */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'encuesta-model-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'enc_codigo'); ?>
		<?php echo $form->textField($model,'enc_codigo',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'enc_codigo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'enc_nombre'); ?>
		<?php echo $form->textField($model,'enc_nombre',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'enc_nombre'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->