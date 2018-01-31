<?php
/* @var $this RevisionMinesController */
/* @var $model RevisionMinesModel */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'revision-mines-model-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'iduser'); ?>
		<?php echo $form->textField($model,'iduser'); ?>
		<?php echo $form->error($model,'iduser'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rmva_tipo'); ?>
		<?php echo $form->textField($model,'rmva_tipo',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'rmva_tipo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rmva_fecha_gestion'); ?>
		<?php echo $form->textField($model,'rmva_fecha_gestion'); ?>
		<?php echo $form->error($model,'rmva_fecha_gestion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rmva_resultado_llamad'); ?>
		<?php echo $form->textField($model,'rmva_resultado_llamad',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'rmva_resultado_llamad'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rmva_motivo_no_contado'); ?>
		<?php echo $form->textField($model,'rmva_motivo_no_contado',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'rmva_motivo_no_contado'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rmva_operadora'); ?>
		<?php echo $form->textField($model,'rmva_operadora',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'rmva_operadora'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rmva_lugar_compra'); ?>
		<?php echo $form->textField($model,'rmva_lugar_compra',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'rmva_lugar_compra'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rmva_precio'); ?>
		<?php echo $form->textField($model,'rmva_precio',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'rmva_precio'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rmva_estado'); ?>
		<?php echo $form->textField($model,'rmva_estado'); ?>
		<?php echo $form->error($model,'rmva_estado'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rmva_fecha_ingreso'); ?>
		<?php echo $form->textField($model,'rmva_fecha_ingreso'); ?>
		<?php echo $form->error($model,'rmva_fecha_ingreso'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rmva_fecha_modifica'); ?>
		<?php echo $form->textField($model,'rmva_fecha_modifica'); ?>
		<?php echo $form->error($model,'rmva_fecha_modifica'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rmva_cod_usuario_ing_mod'); ?>
		<?php echo $form->textField($model,'rmva_cod_usuario_ing_mod'); ?>
		<?php echo $form->error($model,'rmva_cod_usuario_ing_mod'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->