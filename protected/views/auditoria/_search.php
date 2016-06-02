<?php
/* @var $this AuditoriaController */
/* @var $model AuditoriaModel */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'ID_AUD'); ?>
		<?php echo $form->textField($model,'ID_AUD'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FECHA_AUD'); ?>
		<?php echo $form->textField($model,'FECHA_AUD'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'IDUSR_AUD'); ?>
		<?php echo $form->textField($model,'IDUSR_AUD'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->