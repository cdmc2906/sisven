<?php
/* @var $this VentaMovistarController */
/* @var $model VentaMovistarModel */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'venta-movistar-model-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'vm_fecha'); ?>
		<?php echo $form->textField($model,'vm_fecha'); ?>
		<?php echo $form->error($model,'vm_fecha'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'vm_transaccion'); ?>
		<?php echo $form->textField($model,'vm_transaccion',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'vm_transaccion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'vm_distribuidor'); ?>
		<?php echo $form->textField($model,'vm_distribuidor',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'vm_distribuidor'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'vm_nombredistribuidor'); ?>
		<?php echo $form->textField($model,'vm_nombredistribuidor',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'vm_nombredistribuidor'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'vm_codigoscl'); ?>
		<?php echo $form->textField($model,'vm_codigoscl',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'vm_codigoscl'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'vm_inventarioanteriorfuente'); ?>
		<?php echo $form->textField($model,'vm_inventarioanteriorfuente',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'vm_inventarioanteriorfuente'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'vm_inventarioactualfuente'); ?>
		<?php echo $form->textField($model,'vm_inventarioactualfuente',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'vm_inventarioactualfuente'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'vm_tiposim'); ?>
		<?php echo $form->textField($model,'vm_tiposim',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'vm_tiposim'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'vm_icc'); ?>
		<?php echo $form->textField($model,'vm_icc',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'vm_icc'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'vm_min'); ?>
		<?php echo $form->textField($model,'vm_min',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'vm_min'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'vm_estado'); ?>
		<?php echo $form->textField($model,'vm_estado',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'vm_estado'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'vm_iddestino'); ?>
		<?php echo $form->textField($model,'vm_iddestino',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'vm_iddestino'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'vm_nombredestino'); ?>
		<?php echo $form->textField($model,'vm_nombredestino',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'vm_nombredestino'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'vm_inventarioanteriordestino'); ?>
		<?php echo $form->textField($model,'vm_inventarioanteriordestino',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'vm_inventarioanteriordestino'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'vm_inventarioactualdestino'); ?>
		<?php echo $form->textField($model,'vm_inventarioactualdestino',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'vm_inventarioactualdestino'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'vm_canal'); ?>
		<?php echo $form->textField($model,'vm_canal',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'vm_canal'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'vm_lote'); ?>
		<?php echo $form->textField($model,'vm_lote',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'vm_lote'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'vm_zona'); ?>
		<?php echo $form->textField($model,'vm_zona',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'vm_zona'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'vm_fecha_ingreso'); ?>
		<?php echo $form->textField($model,'vm_fecha_ingreso'); ?>
		<?php echo $form->error($model,'vm_fecha_ingreso'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'vm_fecha_modificacion'); ?>
		<?php echo $form->textField($model,'vm_fecha_modificacion'); ?>
		<?php echo $form->error($model,'vm_fecha_modificacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'vm_usuario_ingresa_modifica'); ?>
		<?php echo $form->textField($model,'vm_usuario_ingresa_modifica'); ?>
		<?php echo $form->error($model,'vm_usuario_ingresa_modifica'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->