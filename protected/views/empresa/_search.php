<?php
/* @var $this EmpresaController */
/* @var $model EmpresaModel */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'ID_EMP'); ?>
		<?php echo $form->textField($model,'ID_EMP'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NOMBRE_EMP'); ?>
		<?php echo $form->textField($model,'NOMBRE_EMP',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'IDUSR_EMP'); ?>
		<?php echo $form->textField($model,'IDUSR_EMP'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FECHAINGRESO_EMP'); ?>
		<?php echo $form->textField($model,'FECHAINGRESO_EMP'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FECHAMODIFICACION_EMP'); ?>
		<?php echo $form->textField($model,'FECHAMODIFICACION_EMP'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->