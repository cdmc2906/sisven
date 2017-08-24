<?php
/* @var $this ComentarioSupervisionController */
/* @var $model ComentarioSupervisionModel */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'cs_id'); ?>
		<?php echo $form->textField($model,'cs_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cs_fecha_historial_supervisado'); ?>
		<?php echo $form->textField($model,'cs_fecha_historial_supervisado'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cs_ejecutivo_supervisado'); ?>
		<?php echo $form->textField($model,'cs_ejecutivo_supervisado',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cs_comentario'); ?>
		<?php echo $form->textField($model,'cs_comentario',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cs_estado'); ?>
		<?php echo $form->textField($model,'cs_estado'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cs_fecha_ingreso'); ?>
		<?php echo $form->textField($model,'cs_fecha_ingreso'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cs_fecha_modificacion'); ?>
		<?php echo $form->textField($model,'cs_fecha_modificacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cs_usuario_ingresa_modifica'); ?>
		<?php echo $form->textField($model,'cs_usuario_ingresa_modifica'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->