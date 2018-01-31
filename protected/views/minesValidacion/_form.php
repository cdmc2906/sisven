<?php
/* @var $this MinesValidacionController */
/* @var $model MinesValidacionModel */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'mines-validacion-model-form',
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
		<?php echo $form->labelEx($model,'miva_carga'); ?>
		<?php echo $form->textField($model,'miva_carga'); ?>
		<?php echo $form->error($model,'miva_carga'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'miva_tipo'); ?>
		<?php echo $form->textField($model,'miva_tipo',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'miva_tipo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'miva_fecha'); ?>
		<?php echo $form->textField($model,'miva_fecha'); ?>
		<?php echo $form->error($model,'miva_fecha'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'miva_bodega'); ?>
		<?php echo $form->textField($model,'miva_bodega',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'miva_bodega'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'miva_nomcli'); ?>
		<?php echo $form->textField($model,'miva_nomcli',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'miva_nomcli'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'miva_codgrup'); ?>
		<?php echo $form->textField($model,'miva_codgrup',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'miva_codgrup'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'miva_detalle'); ?>
		<?php echo $form->textField($model,'miva_detalle',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'miva_detalle'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'miva_imei'); ?>
		<?php echo $form->textField($model,'miva_imei',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'miva_imei'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'miva_min'); ?>
		<?php echo $form->textField($model,'miva_min',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'miva_min'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'miva_vendedor'); ?>
		<?php echo $form->textField($model,'miva_vendedor',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'miva_vendedor'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'miva_estado'); ?>
		<?php echo $form->textField($model,'miva_estado'); ?>
		<?php echo $form->error($model,'miva_estado'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'miva_estado_reasignacion'); ?>
		<?php echo $form->textField($model,'miva_estado_reasignacion'); ?>
		<?php echo $form->error($model,'miva_estado_reasignacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'miva_usario_reasignado'); ?>
		<?php echo $form->textField($model,'miva_usario_reasignado'); ?>
		<?php echo $form->error($model,'miva_usario_reasignado'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'miva_fecha_ingreso'); ?>
		<?php echo $form->textField($model,'miva_fecha_ingreso'); ?>
		<?php echo $form->error($model,'miva_fecha_ingreso'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'miva_fecha_modifica'); ?>
		<?php echo $form->textField($model,'miva_fecha_modifica'); ?>
		<?php echo $form->error($model,'miva_fecha_modifica'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'miva_cod_usuario_ing_mod'); ?>
		<?php echo $form->textField($model,'miva_cod_usuario_ing_mod'); ?>
		<?php echo $form->error($model,'miva_cod_usuario_ing_mod'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->