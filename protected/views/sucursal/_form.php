<?php
/* @var $this SucursalController */
/* @var $model SucursalModel */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'sucursal-model-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'ID_EST'); ?>
		<?php echo $form->textField($model,'ID_EST'); ?>
		<?php echo $form->error($model,'ID_EST'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'NOMBRE_SUC'); ?>
		<?php echo $form->textField($model,'NOMBRE_SUC',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'NOMBRE_SUC'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'DIRECCION_SUC'); ?>
		<?php echo $form->textField($model,'DIRECCION_SUC',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'DIRECCION_SUC'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'TELEFONO_SUC'); ?>
		<?php echo $form->textField($model,'TELEFONO_SUC',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'TELEFONO_SUC'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ID_EMP'); ?>
		<?php echo $form->textField($model,'ID_EMP'); ?>
		<?php echo $form->error($model,'ID_EMP'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->