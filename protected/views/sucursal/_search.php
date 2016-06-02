<?php
/* @var $this SucursalController */
/* @var $model SucursalModel */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'ID_SUC'); ?>
		<?php echo $form->textField($model,'ID_SUC'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ID_EST'); ?>
		<?php echo $form->textField($model,'ID_EST'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NOMBRE_SUC'); ?>
		<?php echo $form->textField($model,'NOMBRE_SUC',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DIRECCION_SUC'); ?>
		<?php echo $form->textField($model,'DIRECCION_SUC',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'TELEFONO_SUC'); ?>
		<?php echo $form->textField($model,'TELEFONO_SUC',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ID_EMP'); ?>
		<?php echo $form->textField($model,'ID_EMP'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->