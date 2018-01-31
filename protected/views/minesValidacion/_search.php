<?php
/* @var $this MinesValidacionController */
/* @var $model MinesValidacionModel */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'miva_id'); ?>
		<?php echo $form->textField($model,'miva_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'iduser'); ?>
		<?php echo $form->textField($model,'iduser'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'miva_carga'); ?>
		<?php echo $form->textField($model,'miva_carga'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'miva_tipo'); ?>
		<?php echo $form->textField($model,'miva_tipo',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'miva_fecha'); ?>
		<?php echo $form->textField($model,'miva_fecha'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'miva_bodega'); ?>
		<?php echo $form->textField($model,'miva_bodega',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'miva_nomcli'); ?>
		<?php echo $form->textField($model,'miva_nomcli',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'miva_codgrup'); ?>
		<?php echo $form->textField($model,'miva_codgrup',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'miva_detalle'); ?>
		<?php echo $form->textField($model,'miva_detalle',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'miva_imei'); ?>
		<?php echo $form->textField($model,'miva_imei',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'miva_min'); ?>
		<?php echo $form->textField($model,'miva_min',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'miva_vendedor'); ?>
		<?php echo $form->textField($model,'miva_vendedor',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'miva_estado'); ?>
		<?php echo $form->textField($model,'miva_estado'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'miva_estado_reasignacion'); ?>
		<?php echo $form->textField($model,'miva_estado_reasignacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'miva_usario_reasignado'); ?>
		<?php echo $form->textField($model,'miva_usario_reasignado'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'miva_fecha_ingreso'); ?>
		<?php echo $form->textField($model,'miva_fecha_ingreso'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'miva_fecha_modifica'); ?>
		<?php echo $form->textField($model,'miva_fecha_modifica'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'miva_cod_usuario_ing_mod'); ?>
		<?php echo $form->textField($model,'miva_cod_usuario_ing_mod'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->