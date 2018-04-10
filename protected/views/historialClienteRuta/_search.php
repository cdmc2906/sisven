<?php
/* @var $this HistorialClienteRutaController */
/* @var $model HistorialClienteRutaModel */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'hcr_id'); ?>
		<?php echo $form->textField($model,'hcr_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hcr_ruta_anterior'); ?>
		<?php echo $form->textField($model,'hcr_ruta_anterior',array('size'=>60,'maxlength'=>150)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hcr_ruta_nueva'); ?>
		<?php echo $form->textField($model,'hcr_ruta_nueva',array('size'=>60,'maxlength'=>150)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hcr_direccion_anterior'); ?>
		<?php echo $form->textField($model,'hcr_direccion_anterior',array('size'=>60,'maxlength'=>150)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hcr_direccion_nueva'); ?>
		<?php echo $form->textField($model,'hcr_direccion_nueva',array('size'=>60,'maxlength'=>150)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hcr_semana_anterior'); ?>
		<?php echo $form->textField($model,'hcr_semana_anterior'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hcr_semana_nueva'); ?>
		<?php echo $form->textField($model,'hcr_semana_nueva'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hcr_dia_anterior'); ?>
		<?php echo $form->textField($model,'hcr_dia_anterior'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hcr_dia_nuevo'); ?>
		<?php echo $form->textField($model,'hcr_dia_nuevo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hcr_secuencia_anterior'); ?>
		<?php echo $form->textField($model,'hcr_secuencia_anterior'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hcr_secuencia_nueva'); ?>
		<?php echo $form->textField($model,'hcr_secuencia_nueva'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hcr_estado_anterior'); ?>
		<?php echo $form->textField($model,'hcr_estado_anterior'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hcr_estado_nuevo'); ?>
		<?php echo $form->textField($model,'hcr_estado_nuevo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hcr_fch_actualiza_ruta'); ?>
		<?php echo $form->textField($model,'hcr_fch_actualiza_ruta'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hcr_cambios'); ?>
		<?php echo $form->textField($model,'hcr_cambios',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hcr_fch_ingreso'); ?>
		<?php echo $form->textField($model,'hcr_fch_ingreso'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hcr_fch_modificacion'); ?>
		<?php echo $form->textField($model,'hcr_fch_modificacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hcr_cod_usuario_ing_mod'); ?>
		<?php echo $form->textField($model,'hcr_cod_usuario_ing_mod'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->