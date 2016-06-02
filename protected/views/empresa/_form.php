<?php
/* @var $this EmpresaController */
/* @var $model EmpresaModel */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'empresa-model-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'NOMBRE_EMP'); ?>
		<?php echo $form->textField($model,'NOMBRE_EMP',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'NOMBRE_EMP'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'IDUSR_EMP'); ?>
		<?php echo $form->textField($model,'IDUSR_EMP'); ?>
		<?php echo $form->error($model,'IDUSR_EMP'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'FECHAINGRESO_EMP'); ?>
		<?php echo $form->textField($model,'FECHAINGRESO_EMP'); ?>
		<?php echo $form->error($model,'FECHAINGRESO_EMP'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'FECHAMODIFICACION_EMP'); ?>
		<?php echo $form->textField($model,'FECHAMODIFICACION_EMP'); ?>
		<?php echo $form->error($model,'FECHAMODIFICACION_EMP'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->