<?php
/* @var $this PreguntaController */
/* @var $model PreguntaModel */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'preg_id'); ?>
		<?php echo $form->textField($model,'preg_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tpreg_id'); ?>
		<?php echo $form->textField($model,'tpreg_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'preg_codigo'); ?>
		<?php echo $form->textField($model,'preg_codigo',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'preg_descripcion'); ?>
		<?php echo $form->textField($model,'preg_descripcion',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'preg_estado'); ?>
		<?php echo $form->textField($model,'preg_estado'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'preg_ingreso'); ?>
		<?php echo $form->textField($model,'preg_ingreso'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'preg_modifica'); ?>
		<?php echo $form->textField($model,'preg_modifica'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->