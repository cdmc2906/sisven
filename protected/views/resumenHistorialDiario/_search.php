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
		<?php echo $form->label($model,'rhd_id'); ?>
		<?php echo $form->textField($model,'rhd_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pg_id'); ?>
		<?php echo $form->textField($model,'pg_id'); ?>
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
		<?php echo $form->textField($model,'rhd_valor',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rhd_semana'); ?>
		<?php echo $form->textField($model,'rhd_semana'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rhd_tipo'); ?>
		<?php echo $form->textField($model,'rhd_tipo',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rhd_estado'); ?>
		<?php echo $form->textField($model,'rhd_estado'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rhd_orden'); ?>
		<?php echo $form->textField($model,'rhd_orden'); ?>
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

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->