<?php
/* @var $this RangoCumplimientoController */
/* @var $model RangoCumplimientoModel */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'rango-cumplimiento-model-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'c_rango_min'); ?>
		<?php echo $form->textField($model,'c_rango_min',array('size'=>4,'maxlength'=>4)); ?>
		<?php echo $form->error($model,'c_rango_min'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'c_rango_max'); ?>
		<?php echo $form->textField($model,'c_rango_max',array('size'=>4,'maxlength'=>4)); ?>
		<?php echo $form->error($model,'c_rango_max'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'c_nombre_rango'); ?>
		<?php echo $form->textField($model,'c_nombre_rango',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'c_nombre_rango'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'c_estado_rango'); ?>
		<?php echo $form->textField($model,'c_estado_rango'); ?>
		<?php echo $form->error($model,'c_estado_rango'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'c_fecha_ingreso'); ?>
		<?php echo $form->textField($model,'c_fecha_ingreso'); ?>
		<?php echo $form->error($model,'c_fecha_ingreso'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'c_fecha_modificacion'); ?>
		<?php echo $form->textField($model,'c_fecha_modificacion'); ?>
		<?php echo $form->error($model,'c_fecha_modificacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'c_codigo_usuario_ingresa'); ?>
		<?php echo $form->textField($model,'c_codigo_usuario_ingresa'); ?>
		<?php echo $form->error($model,'c_codigo_usuario_ingresa'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'c_codigo_usuario_modifica'); ?>
		<?php echo $form->textField($model,'c_codigo_usuario_modifica'); ?>
		<?php echo $form->error($model,'c_codigo_usuario_modifica'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->