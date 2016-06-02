<?php
/* @var $this EstadoController */
/* @var $model EstadoModel */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'ID_EST'); ?>
		<?php echo $form->textField($model,'ID_EST'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NOMBRE_EST'); ?>
		<?php echo $form->textField($model,'NOMBRE_EST',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FECHAINGRESO_EST'); ?>
		<?php echo $form->textField($model,'FECHAINGRESO_EST'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FECHAMODIFICACION_EST'); ?>
		<?php echo $form->textField($model,'FECHAMODIFICACION_EST'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->