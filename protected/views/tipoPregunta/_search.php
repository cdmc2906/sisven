<?php
/* @var $this TipoPreguntaController */
/* @var $model TipoPreguntaModel */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'tpreg_id'); ?>
		<?php echo $form->textField($model,'tpreg_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tpreg_nombre'); ?>
		<?php echo $form->textField($model,'tpreg_nombre',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tpreg_estado'); ?>
		<?php echo $form->textField($model,'tpreg_estado'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tpreg_fecha_inicio'); ?>
		<?php echo $form->textField($model,'tpreg_fecha_inicio'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tpreg_fecha_modifica'); ?>
		<?php echo $form->textField($model,'tpreg_fecha_modifica'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tpreg_cod_usuario_ing_mod'); ?>
		<?php echo $form->textField($model,'tpreg_cod_usuario_ing_mod'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->