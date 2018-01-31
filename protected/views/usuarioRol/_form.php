<?php
/* @var $this UsuarioRolController */
/* @var $model UsuarioRolModel */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'usuario-rol-model-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'iduser'); ?>
		<?php echo $form->textField($model,'iduser'); ?>
		<?php echo $form->error($model,'iduser'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'r_id'); ?>
		<?php echo $form->textField($model,'r_id'); ?>
		<?php echo $form->error($model,'r_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'usrl_estado'); ?>
		<?php echo $form->textField($model,'usrl_estado'); ?>
		<?php echo $form->error($model,'usrl_estado'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'usrl_fecha_ingreso'); ?>
		<?php echo $form->textField($model,'usrl_fecha_ingreso'); ?>
		<?php echo $form->error($model,'usrl_fecha_ingreso'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'usrl_fecha_modifica'); ?>
		<?php echo $form->textField($model,'usrl_fecha_modifica'); ?>
		<?php echo $form->error($model,'usrl_fecha_modifica'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'usrl_cod_usuario_ing_mod'); ?>
		<?php echo $form->textField($model,'usrl_cod_usuario_ing_mod'); ?>
		<?php echo $form->error($model,'usrl_cod_usuario_ing_mod'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'usrl_nombre_usuario'); ?>
		<?php echo $form->textField($model,'usrl_nombre_usuario',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'usrl_nombre_usuario'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->