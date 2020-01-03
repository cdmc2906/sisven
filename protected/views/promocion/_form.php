<?php
/* @var $this PromocionController */
/* @var $model PromocionModel */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'promocion-model-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'pr_nombre'); ?>
		<?php echo $form->textField($model,'pr_nombre',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'pr_nombre'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pr_fecha_inicio'); ?>
		<?php echo $form->textField($model,'pr_fecha_inicio'); ?>
		<?php echo $form->error($model,'pr_fecha_inicio'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pr_fecha_fin'); ?>
		<?php echo $form->textField($model,'pr_fecha_fin'); ?>
		<?php echo $form->error($model,'pr_fecha_fin'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pr_estado'); ?>
		<?php echo $form->textField($model,'pr_estado'); ?>
		<?php echo $form->error($model,'pr_estado'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pr_ingreso'); ?>
		<?php echo $form->textField($model,'pr_ingreso'); ?>
		<?php echo $form->error($model,'pr_ingreso'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pr_modificacion'); ?>
		<?php echo $form->textField($model,'pr_modificacion'); ?>
		<?php echo $form->error($model,'pr_modificacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pr_id_usr_ing_mod'); ?>
		<?php echo $form->textField($model,'pr_id_usr_ing_mod'); ?>
		<?php echo $form->error($model,'pr_id_usr_ing_mod'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->