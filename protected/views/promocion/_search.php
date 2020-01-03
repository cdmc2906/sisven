<?php
/* @var $this PromocionController */
/* @var $model PromocionModel */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'pr_id'); ?>
		<?php echo $form->textField($model,'pr_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pr_nombre'); ?>
		<?php echo $form->textField($model,'pr_nombre',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pr_fecha_inicio'); ?>
		<?php echo $form->textField($model,'pr_fecha_inicio'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pr_fecha_fin'); ?>
		<?php echo $form->textField($model,'pr_fecha_fin'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pr_estado'); ?>
		<?php echo $form->textField($model,'pr_estado'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pr_ingreso'); ?>
		<?php echo $form->textField($model,'pr_ingreso'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pr_modificacion'); ?>
		<?php echo $form->textField($model,'pr_modificacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pr_id_usr_ing_mod'); ?>
		<?php echo $form->textField($model,'pr_id_usr_ing_mod'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->