<?php
/* @var $this ComentarioOficinaController */
/* @var $model ComentarioOficinaModel */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'co_id'); ?>
		<?php echo $form->textField($model,'co_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'co_fecha_historial_revisado'); ?>
		<?php echo $form->textField($model,'co_fecha_historial_revisado'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'co_ejecutivo_revisado'); ?>
		<?php echo $form->textField($model,'co_ejecutivo_revisado',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'co_comentario'); ?>
		<?php echo $form->textField($model,'co_comentario',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'co_enlace_mapa'); ?>
		<?php echo $form->textField($model,'co_enlace_mapa',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'co_enlace_imagen'); ?>
		<?php echo $form->textField($model,'co_enlace_imagen',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'co_estado'); ?>
		<?php echo $form->textField($model,'co_estado'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'co_fecha_ingreso'); ?>
		<?php echo $form->textField($model,'co_fecha_ingreso'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'co_fecha_modificacion'); ?>
		<?php echo $form->textField($model,'co_fecha_modificacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'co_usuario_ingresa_modifica'); ?>
		<?php echo $form->textField($model,'co_usuario_ingresa_modifica'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->