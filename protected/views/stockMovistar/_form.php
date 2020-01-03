<?php
/* @var $this StockMovistarController */
/* @var $model StockMovistarModel */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'stock-movistar-model-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'pg_id'); ?>
		<?php echo $form->textField($model,'pg_id'); ?>
		<?php echo $form->error($model,'pg_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sm_distribuidor_id'); ?>
		<?php echo $form->textField($model,'sm_distribuidor_id',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'sm_distribuidor_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sm_nombre_del_distribuidor'); ?>
		<?php echo $form->textField($model,'sm_nombre_del_distribuidor',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'sm_nombre_del_distribuidor'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sm_zona'); ?>
		<?php echo $form->textField($model,'sm_zona',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'sm_zona'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sm_provincia'); ?>
		<?php echo $form->textField($model,'sm_provincia',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'sm_provincia'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sm_ciudad'); ?>
		<?php echo $form->textField($model,'sm_ciudad',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'sm_ciudad'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sm_principal_distribuidor_id'); ?>
		<?php echo $form->textField($model,'sm_principal_distribuidor_id',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'sm_principal_distribuidor_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sm_nombre_del_distribuidor_principal'); ?>
		<?php echo $form->textField($model,'sm_nombre_del_distribuidor_principal',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'sm_nombre_del_distribuidor_principal'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sm_tipo_de_codigo_de_sim'); ?>
		<?php echo $form->textField($model,'sm_tipo_de_codigo_de_sim',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'sm_tipo_de_codigo_de_sim'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sm_sim_inventario_saldo'); ?>
		<?php echo $form->textField($model,'sm_sim_inventario_saldo'); ?>
		<?php echo $form->error($model,'sm_sim_inventario_saldo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sm_estado_de_sim'); ?>
		<?php echo $form->textField($model,'sm_estado_de_sim',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'sm_estado_de_sim'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sm_fecha_ingreso'); ?>
		<?php echo $form->textField($model,'sm_fecha_ingreso'); ?>
		<?php echo $form->error($model,'sm_fecha_ingreso'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sm_fecha_modifica'); ?>
		<?php echo $form->textField($model,'sm_fecha_modifica'); ?>
		<?php echo $form->error($model,'sm_fecha_modifica'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sm_usuario_ingresa_modifica'); ?>
		<?php echo $form->textField($model,'sm_usuario_ingresa_modifica'); ?>
		<?php echo $form->error($model,'sm_usuario_ingresa_modifica'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sm_numero_carga'); ?>
		<?php echo $form->textField($model,'sm_numero_carga'); ?>
		<?php echo $form->error($model,'sm_numero_carga'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sm_estado'); ?>
		<?php echo $form->textField($model,'sm_estado'); ?>
		<?php echo $form->error($model,'sm_estado'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->