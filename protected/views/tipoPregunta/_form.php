<?php
/* @var $this TipoPreguntaController */
/* @var $model TipoPreguntaModel */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tipo-pregunta-model-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'tpreg_nombre'); ?>
		<?php echo $form->textField($model,'tpreg_nombre',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'tpreg_nombre'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tpreg_estado'); ?>
		<?php echo $form->textField($model,'tpreg_estado'); ?>
		<?php echo $form->error($model,'tpreg_estado'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tpreg_fecha_inicio'); ?>
		<?php echo $form->textField($model,'tpreg_fecha_inicio'); ?>
		<?php echo $form->error($model,'tpreg_fecha_inicio'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tpreg_fecha_modifica'); ?>
		<?php echo $form->textField($model,'tpreg_fecha_modifica'); ?>
		<?php echo $form->error($model,'tpreg_fecha_modifica'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tpreg_cod_usuario_ing_mod'); ?>
		<?php echo $form->textField($model,'tpreg_cod_usuario_ing_mod'); ?>
		<?php echo $form->error($model,'tpreg_cod_usuario_ing_mod'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->