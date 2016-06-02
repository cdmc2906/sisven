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
		<?php echo $form->label($model,'ID_CLI'); ?>
		<?php echo $form->textField($model,'ID_CLI'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ID_EST'); ?>
		<?php echo $form->textField($model,'ID_EST'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ID_TCLI'); ?>
		<?php echo $form->textField($model,'ID_TCLI'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NOMBRE_CLI'); ?>
		<?php echo $form->textField($model,'NOMBRE_CLI',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DOCUMENTO_CLI'); ?>
		<?php echo $form->textField($model,'DOCUMENTO_CLI',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DIRECCION_CLI'); ?>
		<?php echo $form->textField($model,'DIRECCION_CLI',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'TELEFONO_CLI'); ?>
		<?php echo $form->textField($model,'TELEFONO_CLI',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'EMAIL_CLI'); ?>
		<?php echo $form->textField($model,'EMAIL_CLI',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FECHAINGRESO_CLI'); ?>
		<?php echo $form->textField($model,'FECHAINGRESO_CLI'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FECHAMODIFICACION_CLI'); ?>
		<?php echo $form->textField($model,'FECHAMODIFICACION_CLI'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'IDUSR_CLI'); ?>
		<?php echo $form->textField($model,'IDUSR_CLI'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'IDDELTA_CLI'); ?>
		<?php echo $form->textField($model,'IDDELTA_CLI'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->