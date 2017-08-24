<?php
/* @var $this ComentarioOficinaController */
/* @var $model ComentarioOficinaModel */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'comentario-oficina-model-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'co_fecha_historial_revisado'); ?>
		<?php echo $form->textField($model,'co_fecha_historial_revisado'); ?>
		<?php echo $form->error($model,'co_fecha_historial_revisado'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'co_ejecutivo_revisado'); ?>
		<?php echo $form->textField($model,'co_ejecutivo_revisado',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'co_ejecutivo_revisado'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'co_comentario'); ?>
		<?php echo $form->textField($model,'co_comentario',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'co_comentario'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'co_enlace_mapa'); ?>
		<?php echo $form->textField($model,'co_enlace_mapa',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'co_enlace_mapa'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'co_enlace_imagen'); ?>
		<?php echo $form->textField($model,'co_enlace_imagen',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'co_enlace_imagen'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'co_estado'); ?>
		<?php echo $form->textField($model,'co_estado'); ?>
		<?php echo $form->error($model,'co_estado'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'co_fecha_ingreso'); ?>
		<?php echo $form->textField($model,'co_fecha_ingreso'); ?>
		<?php echo $form->error($model,'co_fecha_ingreso'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'co_fecha_modificacion'); ?>
		<?php echo $form->textField($model,'co_fecha_modificacion'); ?>
		<?php echo $form->error($model,'co_fecha_modificacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'co_usuario_ingresa_modifica'); ?>
		<?php echo $form->textField($model,'co_usuario_ingresa_modifica'); ?>
		<?php echo $form->error($model,'co_usuario_ingresa_modifica'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->