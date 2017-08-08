<?php
/* @var $this TransferenciaMovistarController */
/* @var $model TransferenciaMovistarModel */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'transferencia-movistar-model-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'tm_fecha'); ?>
		<?php echo $form->textField($model,'tm_fecha'); ?>
		<?php echo $form->error($model,'tm_fecha'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tm_codigotransferencia'); ?>
		<?php echo $form->textField($model,'tm_codigotransferencia',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'tm_codigotransferencia'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tm_iddistribuidor'); ?>
		<?php echo $form->textField($model,'tm_iddistribuidor',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'tm_iddistribuidor'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tm_nombredistribuidor'); ?>
		<?php echo $form->textField($model,'tm_nombredistribuidor',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'tm_nombredistribuidor'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tm_codigoscl'); ?>
		<?php echo $form->textField($model,'tm_codigoscl',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'tm_codigoscl'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tm_inventarioanteriorfuente'); ?>
		<?php echo $form->textField($model,'tm_inventarioanteriorfuente',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'tm_inventarioanteriorfuente'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tm_inventarioactualfuente'); ?>
		<?php echo $form->textField($model,'tm_inventarioactualfuente',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'tm_inventarioactualfuente'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tm_tiposim'); ?>
		<?php echo $form->textField($model,'tm_tiposim',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'tm_tiposim'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tm_icc'); ?>
		<?php echo $form->textField($model,'tm_icc',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'tm_icc'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tm_min'); ?>
		<?php echo $form->textField($model,'tm_min',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'tm_min'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tm_estado'); ?>
		<?php echo $form->textField($model,'tm_estado',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'tm_estado'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tm_iddestino'); ?>
		<?php echo $form->textField($model,'tm_iddestino',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'tm_iddestino'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tm_nombredestino'); ?>
		<?php echo $form->textField($model,'tm_nombredestino',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'tm_nombredestino'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tm_inventarioanteriordestino'); ?>
		<?php echo $form->textField($model,'tm_inventarioanteriordestino',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'tm_inventarioanteriordestino'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tm_inventarioactualdestino'); ?>
		<?php echo $form->textField($model,'tm_inventarioactualdestino',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'tm_inventarioactualdestino'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tm_canal'); ?>
		<?php echo $form->textField($model,'tm_canal',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'tm_canal'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tm_numero_lote'); ?>
		<?php echo $form->textField($model,'tm_numero_lote',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'tm_numero_lote'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tm_zona'); ?>
		<?php echo $form->textField($model,'tm_zona',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'tm_zona'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tm_fecha_ingreso'); ?>
		<?php echo $form->textField($model,'tm_fecha_ingreso'); ?>
		<?php echo $form->error($model,'tm_fecha_ingreso'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tm_fecha_modifica'); ?>
		<?php echo $form->textField($model,'tm_fecha_modifica'); ?>
		<?php echo $form->error($model,'tm_fecha_modifica'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tm_usuario_ingresa_modifica'); ?>
		<?php echo $form->textField($model,'tm_usuario_ingresa_modifica'); ?>
		<?php echo $form->error($model,'tm_usuario_ingresa_modifica'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->