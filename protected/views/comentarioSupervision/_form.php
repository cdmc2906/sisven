<?php
/* @var $this ComentarioSupervisionController */
/* @var $model ComentarioSupervisionModel */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'comentario-supervision-model-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'cs_fecha_historial_supervisado'); ?>
		<?php echo $form->textField($model,'cs_fecha_historial_supervisado'); ?>
		<?php echo $form->error($model,'cs_fecha_historial_supervisado'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cs_ejecutivo_supervisado'); ?>
		<?php echo $form->textField($model,'cs_ejecutivo_supervisado',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'cs_ejecutivo_supervisado'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cs_comentario'); ?>
		<?php echo $form->textField($model,'cs_comentario',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'cs_comentario'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cs_estado'); ?>
		<?php echo $form->textField($model,'cs_estado'); ?>
		<?php echo $form->error($model,'cs_estado'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cs_fecha_ingreso'); ?>
		<?php echo $form->textField($model,'cs_fecha_ingreso'); ?>
		<?php echo $form->error($model,'cs_fecha_ingreso'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cs_fecha_modificacion'); ?>
		<?php echo $form->textField($model,'cs_fecha_modificacion'); ?>
		<?php echo $form->error($model,'cs_fecha_modificacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cs_usuario_ingresa_modifica'); ?>
		<?php echo $form->textField($model,'cs_usuario_ingresa_modifica'); ?>
		<?php echo $form->error($model,'cs_usuario_ingresa_modifica'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->