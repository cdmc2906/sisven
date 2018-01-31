<?php
/* @var $this UsuarioRolController */
/* @var $model UsuarioRolModel */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'usrl_id'); ?>
		<?php echo $form->textField($model,'usrl_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'iduser'); ?>
		<?php echo $form->textField($model,'iduser'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'r_id'); ?>
		<?php echo $form->textField($model,'r_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'usrl_estado'); ?>
		<?php echo $form->textField($model,'usrl_estado'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'usrl_fecha_ingreso'); ?>
		<?php echo $form->textField($model,'usrl_fecha_ingreso'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'usrl_fecha_modifica'); ?>
		<?php echo $form->textField($model,'usrl_fecha_modifica'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'usrl_cod_usuario_ing_mod'); ?>
		<?php echo $form->textField($model,'usrl_cod_usuario_ing_mod'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'usrl_nombre_usuario'); ?>
		<?php echo $form->textField($model,'usrl_nombre_usuario',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->