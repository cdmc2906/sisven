<?php
/* @var $this RolController */
/* @var $model RolModel */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'r_id'); ?>
		<?php echo $form->textField($model,'r_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'r_nombre_rol'); ?>
		<?php echo $form->textField($model,'r_nombre_rol',array('size'=>60,'maxlength'=>1024)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'r_estado'); ?>
		<?php echo $form->textField($model,'r_estado'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'r_fecha_ingreso'); ?>
		<?php echo $form->textField($model,'r_fecha_ingreso'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'r_fecha_modifica'); ?>
		<?php echo $form->textField($model,'r_fecha_modifica'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'r_cod_usuario_ing_mod'); ?>
		<?php echo $form->textField($model,'r_cod_usuario_ing_mod'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->