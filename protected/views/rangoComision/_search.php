<?php
/* @var $this RangoComisionController */
/* @var $model RangoComisionModel */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php // echo $form->label($model,'ID_RCOM'); ?>
		<?php // echo $form->textField($model,'ID_RCOM'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'RANGOMIN_RCOM'); ?>
		<?php echo $form->textField($model,'RANGOMIN_RCOM'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'RANGOMAX_RCOM'); ?>
		<?php echo $form->textField($model,'RANGOMAX_RCOM'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'PORCENTAJE_RCOM'); ?>
		<?php echo $form->textField($model,'PORCENTAJE_RCOM',array('size'=>4,'maxlength'=>4)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FECHAINGRESO_RCOM'); ?>
		<?php echo $form->textField($model,'FECHAINGRESO_RCOM'); ?>
	</div>

	<div class="row">
		<?php // echo $form->label($model,'FECHAMODIFICACION_RCOM'); ?>
		<?php // echo $form->textField($model,'FECHAMODIFICACION_RCOM'); ?>
	</div>

	<div class="row">
		<?php // echo $form->label($model,'IDUSR_RCOM'); ?>
		<?php // echo $form->textField($model,'IDUSR_RCOM'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Buscar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->