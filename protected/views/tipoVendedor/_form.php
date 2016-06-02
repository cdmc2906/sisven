<?php
/* @var $this TipoVendedorController */
/* @var $model TipoVendedorModel */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tipo-vendedor-model-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'ID_TVE'); ?>
		<?php echo $form->textField($model,'ID_TVE'); ?>
		<?php echo $form->error($model,'ID_TVE'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'NOMBRE_TVE'); ?>
		<?php echo $form->textField($model,'NOMBRE_TVE',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'NOMBRE_TVE'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'FECHAINGRESO_TVE'); ?>
		<?php echo $form->textField($model,'FECHAINGRESO_TVE'); ?>
		<?php echo $form->error($model,'FECHAINGRESO_TVE'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'FECHAMODIFICACION_TVE'); ?>
		<?php echo $form->textField($model,'FECHAMODIFICACION_TVE'); ?>
		<?php echo $form->error($model,'FECHAMODIFICACION_TVE'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'IDUSR_TVE'); ?>
		<?php echo $form->textField($model,'IDUSR_TVE'); ?>
		<?php echo $form->error($model,'IDUSR_TVE'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ID_EST'); ?>
		<?php echo $form->textField($model,'ID_EST'); ?>
		<?php echo $form->error($model,'ID_EST'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->