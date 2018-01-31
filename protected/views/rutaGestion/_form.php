<?php
/* @var $this RutaGestionController */
/* @var $model RutaGestionModel */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ruta-gestion-model-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'zg_id'); ?>
		<?php echo $form->textField($model,'zg_id'); ?>
		<?php echo $form->error($model,'zg_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rg_cod_ruta_mb'); ?>
		<?php echo $form->textField($model,'rg_cod_ruta_mb',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'rg_cod_ruta_mb'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rg_nombre_ruta'); ?>
		<?php echo $form->textField($model,'rg_nombre_ruta',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'rg_nombre_ruta'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rg_dia_visita'); ?>
		<?php echo $form->textField($model,'rg_dia_visita'); ?>
		<?php echo $form->error($model,'rg_dia_visita'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rg_ejecutivo_visita'); ?>
		<?php echo $form->textField($model,'rg_ejecutivo_visita',array('size'=>60,'maxlength'=>150)); ?>
		<?php echo $form->error($model,'rg_ejecutivo_visita'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rg_estado_ruta'); ?>
		<?php echo $form->textField($model,'rg_estado_ruta'); ?>
		<?php echo $form->error($model,'rg_estado_ruta'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rg_fecha_ingreso'); ?>
		<?php echo $form->textField($model,'rg_fecha_ingreso'); ?>
		<?php echo $form->error($model,'rg_fecha_ingreso'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rg_fecha_modifica'); ?>
		<?php echo $form->textField($model,'rg_fecha_modifica'); ?>
		<?php echo $form->error($model,'rg_fecha_modifica'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rg_cod_usuario_ingresa_modifica'); ?>
		<?php echo $form->textField($model,'rg_cod_usuario_ingresa_modifica'); ?>
		<?php echo $form->error($model,'rg_cod_usuario_ingresa_modifica'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->