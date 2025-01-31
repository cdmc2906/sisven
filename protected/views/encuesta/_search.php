<?php
/* @var $this EncuestaController */
/* @var $model EncuestaModel */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'enc_id'); ?>
		<?php echo $form->textField($model,'enc_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'enc_codigo'); ?>
		<?php echo $form->textField($model,'enc_codigo',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'enc_nombre'); ?>
		<?php echo $form->textField($model,'enc_nombre',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->