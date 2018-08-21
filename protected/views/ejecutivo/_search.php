<?php
/* @var $this EjecutivoController */
/* @var $model EjecutivoModel */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'e_cod'); ?>
		<?php echo $form->textField($model,'e_cod'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'e_nombre'); ?>
		<?php echo $form->textField($model,'e_nombre',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'e_usr_mobilvendor'); ?>
		<?php echo $form->textField($model,'e_usr_mobilvendor',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'e_iniciales'); ?>
		<?php echo $form->textField($model,'e_iniciales',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'e_estado'); ?>
		<?php echo $form->textField($model,'e_estado'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'e_tipo'); ?>
		<?php echo $form->textField($model,'e_tipo',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->