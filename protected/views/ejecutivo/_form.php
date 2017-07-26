<?php
/* @var $this EjecutivoController */
/* @var $model EjecutivoModel */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ejecutivo-model-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'e_nombre'); ?>
		<?php echo $form->textField($model,'e_nombre',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'e_nombre'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'e_usr_mobilvendor'); ?>
		<?php echo $form->textField($model,'e_usr_mobilvendor',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'e_usr_mobilvendor'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'e_iniciales'); ?>
		<?php echo $form->textField($model,'e_iniciales',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'e_iniciales'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->