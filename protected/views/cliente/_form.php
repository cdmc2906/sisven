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
		<?php echo $form->labelEx($model,'ID_CLI'); ?>
		<?php echo $form->textField($model,'ID_CLI'); ?>
		<?php echo $form->error($model,'ID_CLI'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ID_EST'); ?>
		<?php echo $form->textField($model,'ID_EST'); ?>
		<?php echo $form->error($model,'ID_EST'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ID_TCLI'); ?>
		<?php echo $form->textField($model,'ID_TCLI'); ?>
		<?php echo $form->error($model,'ID_TCLI'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'NOMBRE_CLI'); ?>
		<?php echo $form->textField($model,'NOMBRE_CLI',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'NOMBRE_CLI'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'DOCUMENTO_CLI'); ?>
		<?php echo $form->textField($model,'DOCUMENTO_CLI',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'DOCUMENTO_CLI'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'DIRECCION_CLI'); ?>
		<?php echo $form->textField($model,'DIRECCION_CLI',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'DIRECCION_CLI'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'TELEFONO_CLI'); ?>
		<?php echo $form->textField($model,'TELEFONO_CLI',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'TELEFONO_CLI'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'EMAIL_CLI'); ?>
		<?php echo $form->textField($model,'EMAIL_CLI',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'EMAIL_CLI'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'FECHAINGRESO_CLI'); ?>
		<?php echo $form->textField($model,'FECHAINGRESO_CLI'); ?>
		<?php echo $form->error($model,'FECHAINGRESO_CLI'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'FECHAMODIFICACION_CLI'); ?>
		<?php echo $form->textField($model,'FECHAMODIFICACION_CLI'); ?>
		<?php echo $form->error($model,'FECHAMODIFICACION_CLI'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'IDUSR_CLI'); ?>
		<?php echo $form->textField($model,'IDUSR_CLI'); ?>
		<?php echo $form->error($model,'IDUSR_CLI'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'IDDELTA_CLI'); ?>
		<?php echo $form->textField($model,'IDDELTA_CLI'); ?>
		<?php echo $form->error($model,'IDDELTA_CLI'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->