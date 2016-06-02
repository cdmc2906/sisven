<?php
/* @var $this TipoClienteController */
/* @var $model TipoClienteModel */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'ID_TCLI'); ?>
		<?php echo $form->textField($model,'ID_TCLI'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ID_EST'); ?>
		<?php echo $form->textField($model,'ID_EST'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NOMBRE_TCLI'); ?>
		<?php echo $form->textField($model,'NOMBRE_TCLI',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->