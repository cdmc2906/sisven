<?php
/* @var $this RutaGestionController */
/* @var $model RutaGestionModel */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'rg_id'); ?>
		<?php echo $form->textField($model,'rg_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'zg_id'); ?>
		<?php echo $form->textField($model,'zg_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rg_cod_ruta_mb'); ?>
		<?php echo $form->textField($model,'rg_cod_ruta_mb',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rg_nombre_ruta'); ?>
		<?php echo $form->textField($model,'rg_nombre_ruta',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rg_estado_ruta'); ?>
		<?php echo $form->textField($model,'rg_estado_ruta'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rg_fecha_ingreso'); ?>
		<?php echo $form->textField($model,'rg_fecha_ingreso'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rg_fecha_modifica'); ?>
		<?php echo $form->textField($model,'rg_fecha_modifica'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rg_cod_usuario_ingresa_modifica'); ?>
		<?php echo $form->textField($model,'rg_cod_usuario_ingresa_modifica'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->