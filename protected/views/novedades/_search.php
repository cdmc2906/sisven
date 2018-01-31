<?php
/* @var $this NovedadesController */
/* @var $model NovedadesModel */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'nov_id'); ?>
		<?php echo $form->textField($model,'nov_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'gno_id'); ?>
		<?php echo $form->textField($model,'gno_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nov_descripcion'); ?>
		<?php echo $form->textField($model,'nov_descripcion',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nov_estado'); ?>
		<?php echo $form->textField($model,'nov_estado'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nov_fecha_ingreso'); ?>
		<?php echo $form->textField($model,'nov_fecha_ingreso'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nov_fecha_modifica'); ?>
		<?php echo $form->textField($model,'nov_fecha_modifica'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nov_cod_usuario_ingresa_modifica'); ?>
		<?php echo $form->textField($model,'nov_cod_usuario_ingresa_modifica'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->