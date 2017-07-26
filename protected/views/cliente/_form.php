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
		<?php echo $form->labelEx($model,'cli_codigo_cliente'); ?>
		<?php echo $form->textField($model,'cli_codigo_cliente',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'cli_codigo_cliente'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cli_nombre_cliente'); ?>
		<?php echo $form->textField($model,'cli_nombre_cliente',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'cli_nombre_cliente'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cli_latitud'); ?>
		<?php echo $form->textField($model,'cli_latitud',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'cli_latitud'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cli_longitud'); ?>
		<?php echo $form->textField($model,'cli_longitud',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'cli_longitud'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cli_estado'); ?>
		<?php echo $form->textField($model,'cli_estado'); ?>
		<?php echo $form->error($model,'cli_estado'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cli_fecha_ingreso'); ?>
		<?php echo $form->textField($model,'cli_fecha_ingreso'); ?>
		<?php echo $form->error($model,'cli_fecha_ingreso'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cli_fecha_modificacion'); ?>
		<?php echo $form->textField($model,'cli_fecha_modificacion'); ?>
		<?php echo $form->error($model,'cli_fecha_modificacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cli_usuario_ingresa_modifica'); ?>
		<?php echo $form->textField($model,'cli_usuario_ingresa_modifica'); ?>
		<?php echo $form->error($model,'cli_usuario_ingresa_modifica'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->