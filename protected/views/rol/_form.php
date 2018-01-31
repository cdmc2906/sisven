<?php
/* @var $this RolController */
/* @var $model RolModel */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'rol-model-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'r_nombre_rol'); ?>
		<?php echo $form->textField($model,'r_nombre_rol',array('size'=>60,'maxlength'=>1024)); ?>
		<?php echo $form->error($model,'r_nombre_rol'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'r_estado'); ?>
		<?php echo $form->textField($model,'r_estado'); ?>
		<?php echo $form->error($model,'r_estado'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'r_fecha_ingreso'); ?>
		<?php echo $form->textField($model,'r_fecha_ingreso'); ?>
		<?php echo $form->error($model,'r_fecha_ingreso'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'r_fecha_modifica'); ?>
		<?php echo $form->textField($model,'r_fecha_modifica'); ?>
		<?php echo $form->error($model,'r_fecha_modifica'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'r_cod_usuario_ing_mod'); ?>
		<?php echo $form->textField($model,'r_cod_usuario_ing_mod'); ?>
		<?php echo $form->error($model,'r_cod_usuario_ing_mod'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->