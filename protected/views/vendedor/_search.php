<?php
/* @var $this VendedorController */
/* @var $model VendedorModel */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'ID_VEND'); ?>
		<?php echo $form->textField($model,'ID_VEND'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ID_EST'); ?>
		<?php echo $form->textField($model,'ID_EST'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NOMBRE_VEND'); ?>
		<?php echo $form->textField($model,'NOMBRE_VEND',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'TELEFONO_VEND'); ?>
		<?php echo $form->textField($model,'TELEFONO_VEND',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CORREO_VEND'); ?>
		<?php echo $form->textField($model,'CORREO_VEND',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->