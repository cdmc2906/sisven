<?php
/* @var $this RutaMbController */
/* @var $model RutaMbModel */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'r_cod'); ?>
		<?php echo $form->textField($model,'r_cod'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'r_ruta'); ?>
		<?php echo $form->textField($model,'r_ruta',array('size'=>60,'maxlength'=>1024)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'r_cod_cliente'); ?>
		<?php echo $form->textField($model,'r_cod_cliente',array('size'=>60,'maxlength'=>1024)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'r_nom_cliente'); ?>
		<?php echo $form->textField($model,'r_nom_cliente',array('size'=>60,'maxlength'=>1024)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'r_cod_direccion'); ?>
		<?php echo $form->textField($model,'r_cod_direccion',array('size'=>60,'maxlength'=>1024)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'r_direccion'); ?>
		<?php echo $form->textField($model,'r_direccion',array('size'=>60,'maxlength'=>1024)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'r_referencia'); ?>
		<?php echo $form->textField($model,'r_referencia',array('size'=>60,'maxlength'=>1024)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'r_semana'); ?>
		<?php echo $form->textField($model,'r_semana'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'r_dia'); ?>
		<?php echo $form->textField($model,'r_dia'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'r_secuencia'); ?>
		<?php echo $form->textField($model,'r_secuencia'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'r_estatus'); ?>
		<?php echo $form->textField($model,'r_estatus'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'r_fch_ingreso'); ?>
		<?php echo $form->textField($model,'r_fch_ingreso'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'r_fch_modificacion'); ?>
		<?php echo $form->textField($model,'r_fch_modificacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'r_fch_desde'); ?>
		<?php echo $form->textField($model,'r_fch_desde'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'r_fch_hasta'); ?>
		<?php echo $form->textField($model,'r_fch_hasta'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'r_usuario_ing_mod'); ?>
		<?php echo $form->textField($model,'r_usuario_ing_mod'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->