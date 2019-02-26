<?php
/* @var $this EjecutivoRutaController */
/* @var $model EjecutivoRutaModel */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ejecutivo-ruta-model-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'e_cod'); ?>
		<?php echo $form->textField($model,'e_cod'); ?>
		<?php echo $form->error($model,'e_cod'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rg_id'); ?>
		<?php echo $form->textField($model,'rg_id'); ?>
		<?php echo $form->error($model,'rg_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'er_usuario'); ?>
		<?php echo $form->textField($model,'er_usuario',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'er_usuario'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'er_usuario_nombre'); ?>
		<?php echo $form->textField($model,'er_usuario_nombre',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'er_usuario_nombre'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'er_ruta'); ?>
		<?php echo $form->textField($model,'er_ruta',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'er_ruta'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'er_ruta_nombre'); ?>
		<?php echo $form->textField($model,'er_ruta_nombre',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'er_ruta_nombre'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'er_semana_visitar'); ?>
		<?php echo $form->textField($model,'er_semana_visitar'); ?>
		<?php echo $form->error($model,'er_semana_visitar'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'er_dia_visitar'); ?>
		<?php echo $form->textField($model,'er_dia_visitar'); ?>
		<?php echo $form->error($model,'er_dia_visitar'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'er_estado'); ?>
		<?php echo $form->textField($model,'er_estado',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'er_estado'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'er_fecha_ingreso'); ?>
		<?php echo $form->textField($model,'er_fecha_ingreso'); ?>
		<?php echo $form->error($model,'er_fecha_ingreso'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'er_fecha_modificacion'); ?>
		<?php echo $form->textField($model,'er_fecha_modificacion'); ?>
		<?php echo $form->error($model,'er_fecha_modificacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'er_cod_usr_ing'); ?>
		<?php echo $form->textField($model,'er_cod_usr_ing'); ?>
		<?php echo $form->error($model,'er_cod_usr_ing'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'er_cod_usr_mod'); ?>
		<?php echo $form->textField($model,'er_cod_usr_mod'); ?>
		<?php echo $form->error($model,'er_cod_usr_mod'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->