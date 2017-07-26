<?php
/* @var $this ResumenRevHistorialController */
/* @var $model ResumenRevHistorialModel */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'resumen-rev-historial-model-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'rrh_fecha'); ?>
		<?php echo $form->textField($model,'rrh_fecha'); ?>
		<?php echo $form->error($model,'rrh_fecha'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rrh_ejecutivo'); ?>
		<?php echo $form->textField($model,'rrh_ejecutivo',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'rrh_ejecutivo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rrh_nivel_cumplimiento'); ?>
		<?php echo $form->textField($model,'rrh_nivel_cumplimiento',array('size'=>9,'maxlength'=>9)); ?>
		<?php echo $form->error($model,'rrh_nivel_cumplimiento'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rrh_visitas_efectuadas'); ?>
		<?php echo $form->textField($model,'rrh_visitas_efectuadas'); ?>
		<?php echo $form->error($model,'rrh_visitas_efectuadas'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rrh_clientes_ruta'); ?>
		<?php echo $form->textField($model,'rrh_clientes_ruta'); ?>
		<?php echo $form->error($model,'rrh_clientes_ruta'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rrh_cliente_no_visitados'); ?>
		<?php echo $form->textField($model,'rrh_cliente_no_visitados'); ?>
		<?php echo $form->error($model,'rrh_cliente_no_visitados'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rrh_visitas_fuera_ruta'); ?>
		<?php echo $form->textField($model,'rrh_visitas_fuera_ruta'); ?>
		<?php echo $form->error($model,'rrh_visitas_fuera_ruta'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rrh_cantidad_venta_ruta'); ?>
		<?php echo $form->textField($model,'rrh_cantidad_venta_ruta'); ?>
		<?php echo $form->error($model,'rrh_cantidad_venta_ruta'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rrh_cantidad_venta_fuera_ruta'); ?>
		<?php echo $form->textField($model,'rrh_cantidad_venta_fuera_ruta'); ?>
		<?php echo $form->error($model,'rrh_cantidad_venta_fuera_ruta'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rrh_clientes_venta'); ?>
		<?php echo $form->textField($model,'rrh_clientes_venta'); ?>
		<?php echo $form->error($model,'rrh_clientes_venta'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rrh_total_venta_reportada'); ?>
		<?php echo $form->textField($model,'rrh_total_venta_reportada'); ?>
		<?php echo $form->error($model,'rrh_total_venta_reportada'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rrh_fecha_ingreso'); ?>
		<?php echo $form->textField($model,'rrh_fecha_ingreso'); ?>
		<?php echo $form->error($model,'rrh_fecha_ingreso'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rrh_fecha_modificar'); ?>
		<?php echo $form->textField($model,'rrh_fecha_modificar'); ?>
		<?php echo $form->error($model,'rrh_fecha_modificar'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rrh_usr_ingresa'); ?>
		<?php echo $form->textField($model,'rrh_usr_ingresa'); ?>
		<?php echo $form->error($model,'rrh_usr_ingresa'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rrh_usr_modifica'); ?>
		<?php echo $form->textField($model,'rrh_usr_modifica'); ?>
		<?php echo $form->error($model,'rrh_usr_modifica'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->