<?php
/* @var $this DetalleRevisionHistorialController */
/* @var $model DetalleRevisionHistorialModel */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'detalle-revision-historial-model-form',
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
		<?php echo $form->labelEx($model,'drh_semana'); ?>
		<?php echo $form->textField($model,'drh_semana'); ?>
		<?php echo $form->error($model,'drh_semana'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'drh_tipo_historial'); ?>
		<?php echo $form->textField($model,'drh_tipo_historial',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'drh_tipo_historial'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'drh_fecha_revision'); ?>
		<?php echo $form->textField($model,'drh_fecha_revision'); ?>
		<?php echo $form->error($model,'drh_fecha_revision'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'drh_fecha_ruta'); ?>
		<?php echo $form->textField($model,'drh_fecha_ruta'); ?>
		<?php echo $form->error($model,'drh_fecha_ruta'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'drh_codigo_ejecutivo'); ?>
		<?php echo $form->textField($model,'drh_codigo_ejecutivo',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'drh_codigo_ejecutivo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'drh_nombre_ejecutivo'); ?>
		<?php echo $form->textField($model,'drh_nombre_ejecutivo',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'drh_nombre_ejecutivo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'drh_codigo_cliente'); ?>
		<?php echo $form->textField($model,'drh_codigo_cliente',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'drh_codigo_cliente'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'drh_nombre_cliente'); ?>
		<?php echo $form->textField($model,'drh_nombre_cliente',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'drh_nombre_cliente'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'drh_ruta_usada'); ?>
		<?php echo $form->textField($model,'drh_ruta_usada',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'drh_ruta_usada'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'drh_secuencia_visita'); ?>
		<?php echo $form->textField($model,'drh_secuencia_visita'); ?>
		<?php echo $form->error($model,'drh_secuencia_visita'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'drh_ruta_cliente'); ?>
		<?php echo $form->textField($model,'drh_ruta_cliente',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'drh_ruta_cliente'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'drh_secuencia_ruta'); ?>
		<?php echo $form->textField($model,'drh_secuencia_ruta'); ?>
		<?php echo $form->error($model,'drh_secuencia_ruta'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'drh_estado_revision_ruta'); ?>
		<?php echo $form->textField($model,'drh_estado_revision_ruta',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'drh_estado_revision_ruta'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'drh_estado_revision_sec'); ?>
		<?php echo $form->textField($model,'drh_estado_revision_sec',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'drh_estado_revision_sec'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'drh_cantidad_chips_venta'); ?>
		<?php echo $form->textField($model,'drh_cantidad_chips_venta'); ?>
		<?php echo $form->error($model,'drh_cantidad_chips_venta'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'drh_metros'); ?>
		<?php echo $form->textField($model,'drh_metros',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'drh_metros'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'drh_precision_usada'); ?>
		<?php echo $form->textField($model,'drh_precision_usada'); ?>
		<?php echo $form->error($model,'drh_precision_usada'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'drh_validacion'); ?>
		<?php echo $form->textField($model,'drh_validacion',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'drh_validacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'drh_latitud_cliente'); ?>
		<?php echo $form->textField($model,'drh_latitud_cliente',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'drh_latitud_cliente'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'drh_longitud_cliente'); ?>
		<?php echo $form->textField($model,'drh_longitud_cliente',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'drh_longitud_cliente'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'drh_latitud_visita'); ?>
		<?php echo $form->textField($model,'drh_latitud_visita',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'drh_latitud_visita'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'drh_longitud_visita'); ?>
		<?php echo $form->textField($model,'drh_longitud_visita',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'drh_longitud_visita'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'drh_inicio_visita'); ?>
		<?php echo $form->textField($model,'drh_inicio_visita'); ?>
		<?php echo $form->error($model,'drh_inicio_visita'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'drh_fin_visita'); ?>
		<?php echo $form->textField($model,'drh_fin_visita'); ?>
		<?php echo $form->error($model,'drh_fin_visita'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'drh_tiempo_gestion'); ?>
		<?php echo $form->textField($model,'drh_tiempo_gestion'); ?>
		<?php echo $form->error($model,'drh_tiempo_gestion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'drh_tiempo_traslado'); ?>
		<?php echo $form->textField($model,'drh_tiempo_traslado'); ?>
		<?php echo $form->error($model,'drh_tiempo_traslado'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'drh_distancia_cli_eje'); ?>
		<?php echo $form->textField($model,'drh_distancia_cli_eje',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'drh_distancia_cli_eje'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'drh_distancia_cli_anterior'); ?>
		<?php echo $form->textField($model,'drh_distancia_cli_anterior',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'drh_distancia_cli_anterior'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'drh_fch_ingreso'); ?>
		<?php echo $form->textField($model,'drh_fch_ingreso'); ?>
		<?php echo $form->error($model,'drh_fch_ingreso'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'drh_fch_modifica'); ?>
		<?php echo $form->textField($model,'drh_fch_modifica'); ?>
		<?php echo $form->error($model,'drh_fch_modifica'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'drh_cod_usr_ing_mod'); ?>
		<?php echo $form->textField($model,'drh_cod_usr_ing_mod'); ?>
		<?php echo $form->error($model,'drh_cod_usr_ing_mod'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->