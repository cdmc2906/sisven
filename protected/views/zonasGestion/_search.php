<?php
/* @var $this ZonasGestionController */
/* @var $model ZonasGestionModel */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'zg_id'); ?>
		<?php echo $form->textField($model,'zg_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'zg_nombre_zona'); ?>
		<?php echo $form->textField($model,'zg_nombre_zona',array('size'=>60,'maxlength'=>150)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'zg_cod_ejecutivo_asignado'); ?>
		<?php echo $form->textField($model,'zg_cod_ejecutivo_asignado',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'zg_nomb_ejecutivo_asignado'); ?>
		<?php echo $form->textField($model,'zg_nomb_ejecutivo_asignado',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'zg_estado_zona'); ?>
		<?php echo $form->textField($model,'zg_estado_zona'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'zg_fecha_ingreso'); ?>
		<?php echo $form->textField($model,'zg_fecha_ingreso'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'zg_fecha_modifica'); ?>
		<?php echo $form->textField($model,'zg_fecha_modifica'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'zg_cod_usuario_ingresa_modifica'); ?>
		<?php echo $form->textField($model,'zg_cod_usuario_ingresa_modifica'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->