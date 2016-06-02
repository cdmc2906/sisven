<?php
/* @var $this ProductoController */
/* @var $model ProductoModel */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'producto-model-form',
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
		<?php echo $form->labelEx($model,'ID_COMP'); ?>
		<?php echo $form->textField($model,'ID_COMP'); ?>
		<?php echo $form->error($model,'ID_COMP'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ID_TPRO'); ?>
		<?php echo $form->textField($model,'ID_TPRO'); ?>
		<?php echo $form->error($model,'ID_TPRO'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ID_BODEGA'); ?>
		<?php echo $form->textField($model,'ID_BODEGA'); ?>
		<?php echo $form->error($model,'ID_BODEGA'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'NOMBRE_PROD'); ?>
		<?php echo $form->textField($model,'NOMBRE_PROD',array('size'=>60,'maxlength'=>1024)); ?>
		<?php echo $form->error($model,'NOMBRE_PROD'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'MIN_PROD'); ?>
		<?php echo $form->textField($model,'MIN_PROD',array('size'=>60,'maxlength'=>1024)); ?>
		<?php echo $form->error($model,'MIN_PROD'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ICC_PROD'); ?>
		<?php echo $form->textField($model,'ICC_PROD',array('size'=>60,'maxlength'=>1024)); ?>
		<?php echo $form->error($model,'ICC_PROD'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'IMEI_PROD'); ?>
		<?php echo $form->textField($model,'IMEI_PROD',array('size'=>60,'maxlength'=>1024)); ?>
		<?php echo $form->error($model,'IMEI_PROD'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'NUMSERIE_PROD'); ?>
		<?php echo $form->textField($model,'NUMSERIE_PROD',array('size'=>60,'maxlength'=>1024)); ?>
		<?php echo $form->error($model,'NUMSERIE_PROD'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'PRECIO_PROD'); ?>
		<?php echo $form->textField($model,'PRECIO_PROD',array('size'=>24,'maxlength'=>24)); ?>
		<?php echo $form->error($model,'PRECIO_PROD'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'COSTO_PROD'); ?>
		<?php echo $form->textField($model,'COSTO_PROD',array('size'=>24,'maxlength'=>24)); ?>
		<?php echo $form->error($model,'COSTO_PROD'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'PORCENTAJEDESCUENTO_PROD'); ?>
		<?php echo $form->textField($model,'PORCENTAJEDESCUENTO_PROD',array('size'=>24,'maxlength'=>24)); ?>
		<?php echo $form->error($model,'PORCENTAJEDESCUENTO_PROD'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'PRECIO1_PROD'); ?>
		<?php echo $form->textField($model,'PRECIO1_PROD',array('size'=>24,'maxlength'=>24)); ?>
		<?php echo $form->error($model,'PRECIO1_PROD'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'PRECIO2_PROD'); ?>
		<?php echo $form->textField($model,'PRECIO2_PROD',array('size'=>24,'maxlength'=>24)); ?>
		<?php echo $form->error($model,'PRECIO2_PROD'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'PRECIO3_PROD'); ?>
		<?php echo $form->textField($model,'PRECIO3_PROD',array('size'=>24,'maxlength'=>24)); ?>
		<?php echo $form->error($model,'PRECIO3_PROD'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->