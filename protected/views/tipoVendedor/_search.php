<?php
/* @var $this TipoVendedorController */
/* @var $model TipoVendedorModel */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'ID_TVE'); ?>
		<?php echo $form->textField($model,'ID_TVE'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NOMBRE_TVE'); ?>
		<?php echo $form->textField($model,'NOMBRE_TVE',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FECHAINGRESO_TVE'); ?>
		<?php echo $form->textField($model,'FECHAINGRESO_TVE'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FECHAMODIFICACION_TVE'); ?>
		<?php echo $form->textField($model,'FECHAMODIFICACION_TVE'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'IDUSR_TVE'); ?>
		<?php echo $form->textField($model,'IDUSR_TVE'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ID_EST'); ?>
		<?php echo $form->textField($model,'ID_EST'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->