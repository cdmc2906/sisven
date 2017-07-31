<?php
/* @var $this ResumenHistorialDiarioController */
/* @var $model ResumenHistorialDiarioModel */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'rhd_codigo'); ?>
		<?php echo $form->textField($model,'rhd_codigo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rhd_cod_ejecutivo'); ?>
		<?php echo $form->textField($model,'rhd_cod_ejecutivo',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rhd_fecha_historial'); ?>
		<?php echo $form->textField($model,'rhd_fecha_historial'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rhd_parametro'); ?>
		<?php echo $form->textField($model,'rhd_parametro',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rhd_valor'); ?>
		<?php echo $form->textField($model,'rhd_valor',array('size'=>6,'maxlength'=>6)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rhd_fecha_ingreso'); ?>
		<?php echo $form->textField($model,'rhd_fecha_ingreso'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rhd_fecha_modificacion'); ?>
		<?php echo $form->textField($model,'rhd_fecha_modificacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rhd_usuario_ingresa_modifica'); ?>
		<?php echo $form->textField($model,'rhd_usuario_ingresa_modifica'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rhd_observacion_supervisor'); ?>
		<?php echo $form->textField($model,'rhd_observacion_supervisor',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rhd_usuario_supervisor'); ?>
		<?php echo $form->textField($model,'rhd_usuario_supervisor'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rhd_fecha_modifica_observacion'); ?>
		<?php echo $form->textField($model,'rhd_fecha_modifica_observacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rhd_semana'); ?>
		<?php echo $form->textField($model,'rhd_semana'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rhd_fecha_ingreso_observacion'); ?>
		<?php echo $form->textField($model,'rhd_fecha_ingreso_observacion'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->