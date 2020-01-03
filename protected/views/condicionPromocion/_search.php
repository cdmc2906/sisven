<?php
/* @var $this CondicionPromocionController */
/* @var $model CondicionPromocionModel */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'cpr_id'); ?>
		<?php echo $form->textField($model,'cpr_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pr_id'); ?>
		<?php echo $form->textField($model,'pr_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cpr_parametro'); ?>
		<?php echo $form->textField($model,'cpr_parametro',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cpr_operador'); ?>
		<?php echo $form->textField($model,'cpr_operador',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cpr_valor_min'); ?>
		<?php echo $form->textField($model,'cpr_valor_min',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cpr_valor_max'); ?>
		<?php echo $form->textField($model,'cpr_valor_max',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cpr_estado'); ?>
		<?php echo $form->textField($model,'cpr_estado'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cpr_fecha_ingreso'); ?>
		<?php echo $form->textField($model,'cpr_fecha_ingreso'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cpr_fecha_modifica'); ?>
		<?php echo $form->textField($model,'cpr_fecha_modifica'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cpr_usr_ing_mod'); ?>
		<?php echo $form->textField($model,'cpr_usr_ing_mod'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->