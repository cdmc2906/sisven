<?php
/* @var $this CondicionPromocionModelController */
/* @var $model CondicionPromocionModel */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'condicion-promocion-model-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'pr_id'); ?>
		<?php echo $form->textField($model,'pr_id'); ?>
		<?php echo $form->error($model,'pr_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cpr_parametro'); ?>
		<?php echo $form->textField($model,'cpr_parametro',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'cpr_parametro'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cpr_operador'); ?>
		<?php echo $form->textField($model,'cpr_operador',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'cpr_operador'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cpr_valor_min'); ?>
		<?php echo $form->textField($model,'cpr_valor_min',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'cpr_valor_min'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cpr_valor_max'); ?>
		<?php echo $form->textField($model,'cpr_valor_max',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'cpr_valor_max'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cpr_estado'); ?>
		<?php echo $form->textField($model,'cpr_estado'); ?>
		<?php echo $form->error($model,'cpr_estado'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cpr_fecha_ingreso'); ?>
		<?php echo $form->textField($model,'cpr_fecha_ingreso'); ?>
		<?php echo $form->error($model,'cpr_fecha_ingreso'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cpr_fecha_modifica'); ?>
		<?php echo $form->textField($model,'cpr_fecha_modifica'); ?>
		<?php echo $form->error($model,'cpr_fecha_modifica'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cpr_usr_ing_mod'); ?>
		<?php echo $form->textField($model,'cpr_usr_ing_mod'); ?>
		<?php echo $form->error($model,'cpr_usr_ing_mod'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->