<?php
/* @var $this PreguntaController */
/* @var $model PreguntaModel */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pregunta-model-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'tpreg_id'); ?>
		<?php echo $form->textField($model,'tpreg_id'); ?>
		<?php echo $form->error($model,'tpreg_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'preg_codigo'); ?>
		<?php echo $form->textField($model,'preg_codigo',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'preg_codigo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'preg_descripcion'); ?>
		<?php echo $form->textField($model,'preg_descripcion',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'preg_descripcion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'preg_estado'); ?>
		<?php echo $form->textField($model,'preg_estado'); ?>
		<?php echo $form->error($model,'preg_estado'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'preg_ingreso'); ?>
		<?php echo $form->textField($model,'preg_ingreso'); ?>
		<?php echo $form->error($model,'preg_ingreso'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'preg_modifica'); ?>
		<?php echo $form->textField($model,'preg_modifica'); ?>
		<?php echo $form->error($model,'preg_modifica'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->