<?php
/* @var $this ClienteDireccionController */
/* @var $model ClienteDireccionModel */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cliente-direccion-model-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'dcli_codigo'); ?>
		<?php echo $form->textField($model,'dcli_codigo',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'dcli_codigo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dcli_cliente'); ?>
		<?php echo $form->textField($model,'dcli_cliente',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'dcli_cliente'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dcli_cliente_nombre'); ?>
		<?php echo $form->textField($model,'dcli_cliente_nombre',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'dcli_cliente_nombre'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dcli_cliente_identificacion'); ?>
		<?php echo $form->textField($model,'dcli_cliente_identificacion',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'dcli_cliente_identificacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dcli_cliente_comentario'); ?>
		<?php echo $form->textField($model,'dcli_cliente_comentario',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'dcli_cliente_comentario'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dcli_oficina'); ?>
		<?php echo $form->textField($model,'dcli_oficina',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'dcli_oficina'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dcli_oficina_nombre'); ?>
		<?php echo $form->textField($model,'dcli_oficina_nombre',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'dcli_oficina_nombre'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dcli_codigo_de_barras'); ?>
		<?php echo $form->textField($model,'dcli_codigo_de_barras',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'dcli_codigo_de_barras'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dcli_descripcion'); ?>
		<?php echo $form->textField($model,'dcli_descripcion',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'dcli_descripcion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dcli_contacto'); ?>
		<?php echo $form->textField($model,'dcli_contacto',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'dcli_contacto'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dcli_geo_area'); ?>
		<?php echo $form->textField($model,'dcli_geo_area',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'dcli_geo_area'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dcli_geo_area_nombre'); ?>
		<?php echo $form->textField($model,'dcli_geo_area_nombre',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'dcli_geo_area_nombre'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dcli_geo_area_codigo_recorrido'); ?>
		<?php echo $form->textField($model,'dcli_geo_area_codigo_recorrido',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'dcli_geo_area_codigo_recorrido'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dcli_geo_area_descripcion_recorrido'); ?>
		<?php echo $form->textField($model,'dcli_geo_area_descripcion_recorrido',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'dcli_geo_area_descripcion_recorrido'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dcli_provincia'); ?>
		<?php echo $form->textField($model,'dcli_provincia',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'dcli_provincia'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dcli_canton'); ?>
		<?php echo $form->textField($model,'dcli_canton',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'dcli_canton'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dcli_parroquia'); ?>
		<?php echo $form->textField($model,'dcli_parroquia',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'dcli_parroquia'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dcli_calle_principal'); ?>
		<?php echo $form->textField($model,'dcli_calle_principal',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'dcli_calle_principal'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dcli_nomenclatura'); ?>
		<?php echo $form->textField($model,'dcli_nomenclatura',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'dcli_nomenclatura'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dcli_calle_secundaria'); ?>
		<?php echo $form->textField($model,'dcli_calle_secundaria',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'dcli_calle_secundaria'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dcli_referencia'); ?>
		<?php echo $form->textField($model,'dcli_referencia',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'dcli_referencia'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dcli_codigo_postal'); ?>
		<?php echo $form->textField($model,'dcli_codigo_postal',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'dcli_codigo_postal'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dcli_telefono'); ?>
		<?php echo $form->textField($model,'dcli_telefono',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'dcli_telefono'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dcli_fax'); ?>
		<?php echo $form->textField($model,'dcli_fax',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'dcli_fax'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dcli_email'); ?>
		<?php echo $form->textField($model,'dcli_email',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'dcli_email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dcli_latitud'); ?>
		<?php echo $form->textField($model,'dcli_latitud',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'dcli_latitud'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dcli_longitud'); ?>
		<?php echo $form->textField($model,'dcli_longitud',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'dcli_longitud'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dcli_ultima_visita'); ?>
		<?php echo $form->textField($model,'dcli_ultima_visita'); ?>
		<?php echo $form->error($model,'dcli_ultima_visita'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dcli_estado_de_localizacion'); ?>
		<?php echo $form->textField($model,'dcli_estado_de_localizacion',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'dcli_estado_de_localizacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dcli_fecha_ingreso'); ?>
		<?php echo $form->textField($model,'dcli_fecha_ingreso'); ?>
		<?php echo $form->error($model,'dcli_fecha_ingreso'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dcli_usr_ingresa'); ?>
		<?php echo $form->textField($model,'dcli_usr_ingresa'); ?>
		<?php echo $form->error($model,'dcli_usr_ingresa'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dcli_fecha_modifica'); ?>
		<?php echo $form->textField($model,'dcli_fecha_modifica'); ?>
		<?php echo $form->error($model,'dcli_fecha_modifica'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dcli_usr_modifica'); ?>
		<?php echo $form->textField($model,'dcli_usr_modifica'); ?>
		<?php echo $form->error($model,'dcli_usr_modifica'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->