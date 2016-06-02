<?php
/* @var $this VendedorController */
/* @var $model VendedorModel */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'vendedor-model-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'ID_EST'); ?>
		<?php echo $form->textField($model,'ID_EST'); ?>
		<?php echo $form->error($model,'ID_EST'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'NOMBRE_VEND'); ?>
		<?php echo $form->textField($model,'NOMBRE_VEND',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'NOMBRE_VEND'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'TELEFONO_VEND'); ?>
		<?php echo $form->textField($model,'TELEFONO_VEND',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'TELEFONO_VEND'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'CORREO_VEND'); ?>
		<?php echo $form->textField($model,'CORREO_VEND',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'CORREO_VEND'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->