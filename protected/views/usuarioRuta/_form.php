<?php
/* @var $this UsuarioRutaController */
/* @var $model UsuarioRutaModel */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'usuario-ruta-model-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'rg_id'); ?>
		<?php echo $form->textField($model,'rg_id'); ?>
		<?php echo $form->error($model,'rg_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'iduser'); ?>
		<?php echo $form->textField($model,'iduser'); ?>
		<?php echo $form->error($model,'iduser'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ur_nombre_ejecutivo'); ?>
		<?php echo $form->textField($model,'ur_nombre_ejecutivo',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'ur_nombre_ejecutivo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ur_estado'); ?>
		<?php echo $form->textField($model,'ur_estado'); ?>
		<?php echo $form->error($model,'ur_estado'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ur_zona_gestion'); ?>
		<?php echo $form->textField($model,'ur_zona_gestion',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'ur_zona_gestion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ur_fecha_ingreso'); ?>
		<?php echo $form->textField($model,'ur_fecha_ingreso'); ?>
		<?php echo $form->error($model,'ur_fecha_ingreso'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ur_fecha_modifica'); ?>
		<?php echo $form->textField($model,'ur_fecha_modifica'); ?>
		<?php echo $form->error($model,'ur_fecha_modifica'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ur_cod_usuario_ingresa_modifica'); ?>
		<?php echo $form->textField($model,'ur_cod_usuario_ingresa_modifica'); ?>
		<?php echo $form->error($model,'ur_cod_usuario_ingresa_modifica'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->