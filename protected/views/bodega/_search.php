<?php
/* @var $this BodegaController */
/* @var $model BodegaModel */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'ID_BODEGA'); ?>
		<?php echo $form->textField($model,'ID_BODEGA'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ID_SUC'); ?>
		<?php echo $form->textField($model,'ID_SUC'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ID_EST'); ?>
		<?php echo $form->textField($model,'ID_EST'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NOMBRE_BODEGA'); ?>
		<?php echo $form->textField($model,'NOMBRE_BODEGA',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->