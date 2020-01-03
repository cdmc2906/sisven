<?php
/* @var $this StockMovistarController */
/* @var $model StockMovistarModel */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'sm_codigo'); ?>
		<?php echo $form->textField($model,'sm_codigo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pg_id'); ?>
		<?php echo $form->textField($model,'pg_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sm_distribuidor_id'); ?>
		<?php echo $form->textField($model,'sm_distribuidor_id',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sm_nombre_del_distribuidor'); ?>
		<?php echo $form->textField($model,'sm_nombre_del_distribuidor',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sm_zona'); ?>
		<?php echo $form->textField($model,'sm_zona',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sm_provincia'); ?>
		<?php echo $form->textField($model,'sm_provincia',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sm_ciudad'); ?>
		<?php echo $form->textField($model,'sm_ciudad',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sm_principal_distribuidor_id'); ?>
		<?php echo $form->textField($model,'sm_principal_distribuidor_id',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sm_nombre_del_distribuidor_principal'); ?>
		<?php echo $form->textField($model,'sm_nombre_del_distribuidor_principal',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sm_tipo_de_codigo_de_sim'); ?>
		<?php echo $form->textField($model,'sm_tipo_de_codigo_de_sim',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sm_sim_inventario_saldo'); ?>
		<?php echo $form->textField($model,'sm_sim_inventario_saldo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sm_estado_de_sim'); ?>
		<?php echo $form->textField($model,'sm_estado_de_sim',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sm_fecha_ingreso'); ?>
		<?php echo $form->textField($model,'sm_fecha_ingreso'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sm_fecha_modifica'); ?>
		<?php echo $form->textField($model,'sm_fecha_modifica'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sm_usuario_ingresa_modifica'); ?>
		<?php echo $form->textField($model,'sm_usuario_ingresa_modifica'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sm_numero_carga'); ?>
		<?php echo $form->textField($model,'sm_numero_carga'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sm_estado'); ?>
		<?php echo $form->textField($model,'sm_estado'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->