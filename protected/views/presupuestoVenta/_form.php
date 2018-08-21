<?php
/* @var $this PresupuestoVentaController */
/* @var $model PresupuestoVentaModel */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'presupuesto-venta-model-form',
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
		<?php echo $form->labelEx($model,'p_codigo_vendedor'); ?>
		<?php echo $form->textField($model,'p_codigo_vendedor',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'p_codigo_vendedor'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'p_fecha_ini_validez'); ?>
		<?php echo $form->textField($model,'p_fecha_ini_validez'); ?>
		<?php echo $form->error($model,'p_fecha_ini_validez'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'p_fecha_fin_validez'); ?>
		<?php echo $form->textField($model,'p_fecha_fin_validez'); ?>
		<?php echo $form->error($model,'p_fecha_fin_validez'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'p_dias_laborables'); ?>
		<?php echo $form->textField($model,'p_dias_laborables'); ?>
		<?php echo $form->error($model,'p_dias_laborables'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'p_valor_presupuesto'); ?>
		<?php echo $form->textField($model,'p_valor_presupuesto',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'p_valor_presupuesto'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'p_tipo_presupuesto'); ?>
		<?php echo $form->textField($model,'p_tipo_presupuesto',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'p_tipo_presupuesto'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'p_cantidad_feriados'); ?>
		<?php echo $form->textField($model,'p_cantidad_feriados'); ?>
		<?php echo $form->error($model,'p_cantidad_feriados'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'p_cumplimiento_diario_esperado'); ?>
		<?php echo $form->textField($model,'p_cumplimiento_diario_esperado',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'p_cumplimiento_diario_esperado'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'p_estado_presupuesto'); ?>
		<?php echo $form->textField($model,'p_estado_presupuesto'); ?>
		<?php echo $form->error($model,'p_estado_presupuesto'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'p_fecha_ingreso'); ?>
		<?php echo $form->textField($model,'p_fecha_ingreso'); ?>
		<?php echo $form->error($model,'p_fecha_ingreso'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'p_fecha_modifica'); ?>
		<?php echo $form->textField($model,'p_fecha_modifica'); ?>
		<?php echo $form->error($model,'p_fecha_modifica'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'p_cod_usuario_ing_mod'); ?>
		<?php echo $form->textField($model,'p_cod_usuario_ing_mod'); ?>
		<?php echo $form->error($model,'p_cod_usuario_ing_mod'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->