<?php
/* @var $this RangoComisionController */
/* @var $model RangoComisionModel */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'rango-comision-model-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'RANGOMIN_RCOM'); ?>
		<?php echo $form->textField($model,'RANGOMIN_RCOM'); ?>
		<?php echo $form->error($model,'RANGOMIN_RCOM'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'RANGOMAX_RCOM'); ?>
		<?php echo $form->textField($model,'RANGOMAX_RCOM'); ?>
		<?php echo $form->error($model,'RANGOMAX_RCOM'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'PORCENTAJE_RCOM'); ?>
		<?php echo $form->textField($model,'PORCENTAJE_RCOM',array('size'=>4,'maxlength'=>4)); ?>
		<?php echo $form->error($model,'PORCENTAJE_RCOM'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->