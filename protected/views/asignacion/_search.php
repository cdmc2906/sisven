<?php
/* @var $this AsignacionController */
/* @var $model AsignacionModel */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'ID_ASIG'); ?>
		<?php echo $form->textField($model,'ID_ASIG'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ID_PRO'); ?>
		<?php echo $form->textField($model,'ID_PRO'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ID_VEND'); ?>
		<?php echo $form->textField($model,'ID_VEND'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FECHAINGRESO_ASIG'); ?>
		<?php echo $form->textField($model,'FECHAINGRESO_ASIG'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'IDUSR_ASIF'); ?>
		<?php echo $form->textField($model,'IDUSR_ASIF'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->