<?php
/* @var $this UsuarioRutaController */
/* @var $model UsuarioRutaModel */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'ur_id'); ?>
		<?php echo $form->textField($model,'ur_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rg_id'); ?>
		<?php echo $form->textField($model,'rg_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'iduser'); ?>
		<?php echo $form->textField($model,'iduser'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ur_nombre_ejecutivo'); ?>
		<?php echo $form->textField($model,'ur_nombre_ejecutivo',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ur_estado'); ?>
		<?php echo $form->textField($model,'ur_estado'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ur_zona_gestion'); ?>
		<?php echo $form->textField($model,'ur_zona_gestion',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ur_fecha_ingreso'); ?>
		<?php echo $form->textField($model,'ur_fecha_ingreso'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ur_fecha_modifica'); ?>
		<?php echo $form->textField($model,'ur_fecha_modifica'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ur_cod_usuario_ingresa_modifica'); ?>
		<?php echo $form->textField($model,'ur_cod_usuario_ingresa_modifica'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->