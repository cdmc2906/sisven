<?php
/* @var $this ZonasGestionController */
/* @var $model ZonasGestionModel */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'zonas-gestion-model-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'zg_nombre_zona'); ?>
		<?php echo $form->textField($model,'zg_nombre_zona',array('size'=>60,'maxlength'=>150)); ?>
		<?php echo $form->error($model,'zg_nombre_zona'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'zg_cod_ejecutivo_asignado'); ?>
		<?php echo $form->textField($model,'zg_cod_ejecutivo_asignado',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'zg_cod_ejecutivo_asignado'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'zg_nomb_ejecutivo_asignado'); ?>
		<?php echo $form->textField($model,'zg_nomb_ejecutivo_asignado',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'zg_nomb_ejecutivo_asignado'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'zg_estado_zona'); ?>
		<?php echo $form->textField($model,'zg_estado_zona'); ?>
		<?php echo $form->error($model,'zg_estado_zona'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'zg_fecha_ingreso'); ?>
		<?php echo $form->textField($model,'zg_fecha_ingreso'); ?>
		<?php echo $form->error($model,'zg_fecha_ingreso'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'zg_fecha_modifica'); ?>
		<?php echo $form->textField($model,'zg_fecha_modifica'); ?>
		<?php echo $form->error($model,'zg_fecha_modifica'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'zg_cod_usuario_ingresa_modifica'); ?>
		<?php echo $form->textField($model,'zg_cod_usuario_ingresa_modifica'); ?>
		<?php echo $form->error($model,'zg_cod_usuario_ingresa_modifica'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->