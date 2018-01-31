<?php
/* @var $this NovedadesController */
/* @var $model NovedadesModel */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'novedades-model-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'gno_id'); ?>
		<?php echo $form->textField($model,'gno_id'); ?>
		<?php echo $form->error($model,'gno_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nov_descripcion'); ?>
		<?php echo $form->textField($model,'nov_descripcion',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'nov_descripcion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nov_estado'); ?>
		<?php echo $form->textField($model,'nov_estado'); ?>
		<?php echo $form->error($model,'nov_estado'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nov_fecha_ingreso'); ?>
		<?php echo $form->textField($model,'nov_fecha_ingreso'); ?>
		<?php echo $form->error($model,'nov_fecha_ingreso'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nov_fecha_modifica'); ?>
		<?php echo $form->textField($model,'nov_fecha_modifica'); ?>
		<?php echo $form->error($model,'nov_fecha_modifica'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nov_cod_usuario_ingresa_modifica'); ?>
		<?php echo $form->textField($model,'nov_cod_usuario_ingresa_modifica'); ?>
		<?php echo $form->error($model,'nov_cod_usuario_ingresa_modifica'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->