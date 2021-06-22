<?php
/* @var $this ResultadoValidaChipController */
/* @var $model ResultadoValidaChipModel */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'rvc_id'); ?>
		<?php echo $form->textField($model,'rvc_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rvc_dato_chip'); ?>
		<?php echo $form->textField($model,'rvc_dato_chip',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rvc_tipo_validacion'); ?>
		<?php echo $form->textField($model,'rvc_tipo_validacion',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rvc_subtipo_validacion'); ?>
		<?php echo $form->textField($model,'rvc_subtipo_validacion',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rvc_resultado_validacion'); ?>
		<?php echo $form->textField($model,'rvc_resultado_validacion',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rvc_ejecutivo'); ?>
		<?php echo $form->textField($model,'rvc_ejecutivo',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rvc_solicitud_fecha'); ?>
		<?php echo $form->textField($model,'rvc_solicitud_fecha'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rvc_solicitud_ip'); ?>
		<?php echo $form->textField($model,'rvc_solicitud_ip',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rvc_solicitud_dispositivo'); ?>
		<?php echo $form->textField($model,'rvc_solicitud_dispositivo',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rvc_solicitud_navegador'); ?>
		<?php echo $form->textField($model,'rvc_solicitud_navegador',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rvc_estado_validacion'); ?>
		<?php echo $form->textField($model,'rvc_estado_validacion'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->