<?php
/* @var $this PresupuestoVentaController */
/* @var $model PresupuestoVentaModel */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'p_id'); ?>
		<?php echo $form->textField($model,'p_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pg_id'); ?>
		<?php echo $form->textField($model,'pg_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'p_codigo_vendedor'); ?>
		<?php echo $form->textField($model,'p_codigo_vendedor',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'p_fecha_ini_validez'); ?>
		<?php echo $form->textField($model,'p_fecha_ini_validez'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'p_fecha_fin_validez'); ?>
		<?php echo $form->textField($model,'p_fecha_fin_validez'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'p_dias_laborables'); ?>
		<?php echo $form->textField($model,'p_dias_laborables'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'p_valor_presupuesto'); ?>
		<?php echo $form->textField($model,'p_valor_presupuesto',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'p_tipo_presupuesto'); ?>
		<?php echo $form->textField($model,'p_tipo_presupuesto',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'p_cantidad_feriados'); ?>
		<?php echo $form->textField($model,'p_cantidad_feriados'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'p_cumplimiento_diario_esperado'); ?>
		<?php echo $form->textField($model,'p_cumplimiento_diario_esperado',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'p_estado_presupuesto'); ?>
		<?php echo $form->textField($model,'p_estado_presupuesto'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'p_fecha_ingreso'); ?>
		<?php echo $form->textField($model,'p_fecha_ingreso'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'p_fecha_modifica'); ?>
		<?php echo $form->textField($model,'p_fecha_modifica'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'p_cod_usuario_ing_mod'); ?>
		<?php echo $form->textField($model,'p_cod_usuario_ing_mod'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->