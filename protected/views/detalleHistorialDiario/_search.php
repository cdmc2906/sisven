<?php
/* @var $this DetalleHistorialDiarioController */
/* @var $model DetalleHistorialDiarioModel */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'rh_id'); ?>
		<?php echo $form->textField($model,'rh_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rh_item'); ?>
		<?php echo $form->textField($model,'rh_item',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rh_fecha_item'); ?>
		<?php echo $form->textField($model,'rh_fecha_item'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rh_fecha_revision'); ?>
		<?php echo $form->textField($model,'rh_fecha_revision'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rh_codigo_vendedor'); ?>
		<?php echo $form->textField($model,'rh_codigo_vendedor',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rh_cod_cliente'); ?>
		<?php echo $form->textField($model,'rh_cod_cliente',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rh_ruta_visita'); ?>
		<?php echo $form->textField($model,'rh_ruta_visita',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rh_orden_visita'); ?>
		<?php echo $form->textField($model,'rh_orden_visita'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rh_ruta_ejecutivo'); ?>
		<?php echo $form->textField($model,'rh_ruta_ejecutivo',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rh_secuencia_ruta'); ?>
		<?php echo $form->textField($model,'rh_secuencia_ruta'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rh_observacion_ruta'); ?>
		<?php echo $form->textField($model,'rh_observacion_ruta',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rh_observacion_secuencia'); ?>
		<?php echo $form->textField($model,'rh_observacion_secuencia',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rh_chips_compra'); ?>
		<?php echo $form->textField($model,'rh_chips_compra'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rh_metros'); ?>
		<?php echo $form->textField($model,'rh_metros',array('size'=>6,'maxlength'=>6)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rh_validacion'); ?>
		<?php echo $form->textField($model,'rh_validacion',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rh_precision'); ?>
		<?php echo $form->textField($model,'rh_precision'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rh_latitud_cliente'); ?>
		<?php echo $form->textField($model,'rh_latitud_cliente',array('size'=>6,'maxlength'=>6)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rh_longitud_cliente'); ?>
		<?php echo $form->textField($model,'rh_longitud_cliente',array('size'=>6,'maxlength'=>6)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rh_latitud_historial'); ?>
		<?php echo $form->textField($model,'rh_latitud_historial',array('size'=>6,'maxlength'=>6)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rh_longitud_historial'); ?>
		<?php echo $form->textField($model,'rh_longitud_historial',array('size'=>6,'maxlength'=>6)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rh_estado'); ?>
		<?php echo $form->textField($model,'rh_estado',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rh_fecha_ingreso'); ?>
		<?php echo $form->textField($model,'rh_fecha_ingreso'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rh_fecha_modificacion'); ?>
		<?php echo $form->textField($model,'rh_fecha_modificacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rh_usuario_revisa'); ?>
		<?php echo $form->textField($model,'rh_usuario_revisa'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rh_fecha_ruta'); ?>
		<?php echo $form->textField($model,'rh_fecha_ruta'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rh_cliente'); ?>
		<?php echo $form->textField($model,'rh_cliente',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->