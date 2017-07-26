<?php
/* @var $this RangoCumplimientoController */
/* @var $model RangoCumplimientoModel */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'c_cod'); ?>
		<?php echo $form->textField($model,'c_cod'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'c_rango_min'); ?>
		<?php echo $form->textField($model,'c_rango_min',array('size'=>4,'maxlength'=>4)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'c_rango_max'); ?>
		<?php echo $form->textField($model,'c_rango_max',array('size'=>4,'maxlength'=>4)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'c_nombre_rango'); ?>
		<?php echo $form->textField($model,'c_nombre_rango',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'c_estado_rango'); ?>
		<?php echo $form->textField($model,'c_estado_rango'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'c_fecha_ingreso'); ?>
		<?php echo $form->textField($model,'c_fecha_ingreso'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'c_fecha_modificacion'); ?>
		<?php echo $form->textField($model,'c_fecha_modificacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'c_codigo_usuario_ingresa'); ?>
		<?php echo $form->textField($model,'c_codigo_usuario_ingresa'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'c_codigo_usuario_modifica'); ?>
		<?php echo $form->textField($model,'c_codigo_usuario_modifica'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->