<?php
/* @var $this ClienteController */
/* @var $model ClienteModel */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'cli_codigo'); ?>
		<?php echo $form->textField($model,'cli_codigo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cli_codigo_cliente'); ?>
		<?php echo $form->textField($model,'cli_codigo_cliente',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cli_nombre_cliente'); ?>
		<?php echo $form->textField($model,'cli_nombre_cliente',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cli_latitud'); ?>
		<?php echo $form->textField($model,'cli_latitud',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cli_longitud'); ?>
		<?php echo $form->textField($model,'cli_longitud',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cli_estado'); ?>
		<?php echo $form->textField($model,'cli_estado'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cli_fecha_ingreso'); ?>
		<?php echo $form->textField($model,'cli_fecha_ingreso'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cli_fecha_modificacion'); ?>
		<?php echo $form->textField($model,'cli_fecha_modificacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cli_usuario_ingresa_modifica'); ?>
		<?php echo $form->textField($model,'cli_usuario_ingresa_modifica'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->