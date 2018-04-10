<?php
/* @var $this RutasMbController */
/* @var $model RutaMbModel */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ruta-mb-model-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'pg_id'); ?>
		<?php echo $form->textField($model,'pg_id'); ?>
		<?php echo $form->error($model,'pg_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'r_ruta'); ?>
		<?php echo $form->textField($model,'r_ruta',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'r_ruta'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'r_cod_cliente'); ?>
		<?php echo $form->textField($model,'r_cod_cliente',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'r_cod_cliente'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'r_nom_cliente'); ?>
		<?php echo $form->textField($model,'r_nom_cliente',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'r_nom_cliente'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'r_tipo_negocio'); ?>
		<?php echo $form->textField($model,'r_tipo_negocio',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'r_tipo_negocio'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'r_cod_direccion'); ?>
		<?php echo $form->textField($model,'r_cod_direccion',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'r_cod_direccion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'r_direccion'); ?>
		<?php echo $form->textField($model,'r_direccion',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'r_direccion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'r_referencia'); ?>
		<?php echo $form->textField($model,'r_referencia',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'r_referencia'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'r_semana'); ?>
		<?php echo $form->textField($model,'r_semana'); ?>
		<?php echo $form->error($model,'r_semana'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'r_dia'); ?>
		<?php echo $form->textField($model,'r_dia'); ?>
		<?php echo $form->error($model,'r_dia'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'r_secuencia'); ?>
		<?php echo $form->textField($model,'r_secuencia'); ?>
		<?php echo $form->error($model,'r_secuencia'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'r_estatus'); ?>
		<?php echo $form->textField($model,'r_estatus'); ?>
		<?php echo $form->error($model,'r_estatus'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'r_numero_carga_informacion'); ?>
		<?php echo $form->textField($model,'r_numero_carga_informacion'); ?>
		<?php echo $form->error($model,'r_numero_carga_informacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'r_fch_ingreso'); ?>
		<?php echo $form->textField($model,'r_fch_ingreso'); ?>
		<?php echo $form->error($model,'r_fch_ingreso'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'r_fch_modificacion'); ?>
		<?php echo $form->textField($model,'r_fch_modificacion'); ?>
		<?php echo $form->error($model,'r_fch_modificacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'r_fch_desde'); ?>
		<?php echo $form->textField($model,'r_fch_desde'); ?>
		<?php echo $form->error($model,'r_fch_desde'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'r_fch_hasta'); ?>
		<?php echo $form->textField($model,'r_fch_hasta'); ?>
		<?php echo $form->error($model,'r_fch_hasta'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'r_usuario_ing_mod'); ?>
		<?php echo $form->textField($model,'r_usuario_ing_mod'); ?>
		<?php echo $form->error($model,'r_usuario_ing_mod'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->