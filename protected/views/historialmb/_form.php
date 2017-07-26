<?php
/* @var $this HistorialMbControllerController */
/* @var $model HistorialMbModel */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'historial-mb-model-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Los campos con  <span class="required">*</span> son obligatorios.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'h_id'); ?>
		<?php echo $form->textField($model,'h_id'); ?>
		<?php echo $form->error($model,'h_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'h_fecha'); ?>
		<?php echo $form->textField($model,'h_fecha'); ?>
		<?php echo $form->error($model,'h_fecha'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'h_usuario'); ?>
		<?php echo $form->textField($model,'h_usuario',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'h_usuario'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'h_ruta'); ?>
		<?php echo $form->textField($model,'h_ruta',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'h_ruta'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'h_ruta_nombre'); ?>
		<?php echo $form->textField($model,'h_ruta_nombre',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'h_ruta_nombre'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'h_semana'); ?>
		<?php echo $form->textField($model,'h_semana'); ?>
		<?php echo $form->error($model,'h_semana'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'h_dia'); ?>
		<?php echo $form->textField($model,'h_dia'); ?>
		<?php echo $form->error($model,'h_dia'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'h_cod_cliente'); ?>
		<?php echo $form->textField($model,'h_cod_cliente',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'h_cod_cliente'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'h_nom_cliente'); ?>
		<?php echo $form->textField($model,'h_nom_cliente',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'h_nom_cliente'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'h_direccion'); ?>
		<?php echo $form->textField($model,'h_direccion',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'h_direccion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'h_accion'); ?>
		<?php echo $form->textField($model,'h_accion',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'h_accion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'h_cod_accion'); ?>
		<?php echo $form->textField($model,'h_cod_accion',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'h_cod_accion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'h_cod_comentario'); ?>
		<?php echo $form->textField($model,'h_cod_comentario',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'h_cod_comentario'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'h_comentario'); ?>
		<?php echo $form->textField($model,'h_comentario',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'h_comentario'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'h_monto'); ?>
		<?php echo $form->textField($model,'h_monto',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'h_monto'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'h_latitud'); ?>
		<?php echo $form->textField($model,'h_latitud',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'h_latitud'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'h_longitud'); ?>
		<?php echo $form->textField($model,'h_longitud',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'h_longitud'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'h_romper_secuencia'); ?>
		<?php echo $form->textField($model,'h_romper_secuencia'); ?>
		<?php echo $form->error($model,'h_romper_secuencia'); ?>
	</div>

<!--	<div class="row">
		<?php echo $form->labelEx($model,'h_fch_ingreso'); ?>
		<?php echo $form->textField($model,'h_fch_ingreso'); ?>
		<?php echo $form->error($model,'h_fch_ingreso'); ?>
	</div>-->

<!--	<div class="row">
		<?php echo $form->labelEx($model,'h_fch_modificacion'); ?>
		<?php echo $form->textField($model,'h_fch_modificacion'); ?>
		<?php echo $form->error($model,'h_fch_modificacion'); ?>
	</div>-->

<!--	<div class="row">
		<?php echo $form->labelEx($model,'h_fch_desde'); ?>
		<?php echo $form->textField($model,'h_fch_desde'); ?>
		<?php echo $form->error($model,'h_fch_desde'); ?>
	</div>-->
<!--
	<div class="row">
		<?php echo $form->labelEx($model,'h_fch_hasta'); ?>
		<?php echo $form->textField($model,'h_fch_hasta'); ?>
		<?php echo $form->error($model,'h_fch_hasta'); ?>
	</div>-->

<!--	<div class="row">
		<?php echo $form->labelEx($model,'h_usr_ing_mod'); ?>
		<?php echo $form->textField($model,'h_usr_ing_mod'); ?>
		<?php echo $form->error($model,'h_usr_ing_mod'); ?>
	</div>-->

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->