<?php
/* @var $this ClienteDireccionController */
/* @var $model ClienteDireccionModel */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'dcli_id'); ?>
		<?php echo $form->textField($model,'dcli_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dcli_codigo'); ?>
		<?php echo $form->textField($model,'dcli_codigo',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dcli_cliente'); ?>
		<?php echo $form->textField($model,'dcli_cliente',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dcli_cliente_nombre'); ?>
		<?php echo $form->textField($model,'dcli_cliente_nombre',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dcli_cliente_identificacion'); ?>
		<?php echo $form->textField($model,'dcli_cliente_identificacion',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dcli_cliente_comentario'); ?>
		<?php echo $form->textField($model,'dcli_cliente_comentario',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dcli_oficina'); ?>
		<?php echo $form->textField($model,'dcli_oficina',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dcli_oficina_nombre'); ?>
		<?php echo $form->textField($model,'dcli_oficina_nombre',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dcli_codigo_de_barras'); ?>
		<?php echo $form->textField($model,'dcli_codigo_de_barras',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dcli_descripcion'); ?>
		<?php echo $form->textField($model,'dcli_descripcion',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dcli_contacto'); ?>
		<?php echo $form->textField($model,'dcli_contacto',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dcli_geo_area'); ?>
		<?php echo $form->textField($model,'dcli_geo_area',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dcli_geo_area_nombre'); ?>
		<?php echo $form->textField($model,'dcli_geo_area_nombre',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dcli_geo_area_codigo_recorrido'); ?>
		<?php echo $form->textField($model,'dcli_geo_area_codigo_recorrido',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dcli_geo_area_descripcion_recorrido'); ?>
		<?php echo $form->textField($model,'dcli_geo_area_descripcion_recorrido',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dcli_provincia'); ?>
		<?php echo $form->textField($model,'dcli_provincia',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dcli_canton'); ?>
		<?php echo $form->textField($model,'dcli_canton',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dcli_parroquia'); ?>
		<?php echo $form->textField($model,'dcli_parroquia',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dcli_calle_principal'); ?>
		<?php echo $form->textField($model,'dcli_calle_principal',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dcli_nomenclatura'); ?>
		<?php echo $form->textField($model,'dcli_nomenclatura',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dcli_calle_secundaria'); ?>
		<?php echo $form->textField($model,'dcli_calle_secundaria',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dcli_referencia'); ?>
		<?php echo $form->textField($model,'dcli_referencia',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dcli_codigo_postal'); ?>
		<?php echo $form->textField($model,'dcli_codigo_postal',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dcli_telefono'); ?>
		<?php echo $form->textField($model,'dcli_telefono',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dcli_fax'); ?>
		<?php echo $form->textField($model,'dcli_fax',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dcli_email'); ?>
		<?php echo $form->textField($model,'dcli_email',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dcli_latitud'); ?>
		<?php echo $form->textField($model,'dcli_latitud',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dcli_longitud'); ?>
		<?php echo $form->textField($model,'dcli_longitud',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dcli_ultima_visita'); ?>
		<?php echo $form->textField($model,'dcli_ultima_visita'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dcli_estado_de_localizacion'); ?>
		<?php echo $form->textField($model,'dcli_estado_de_localizacion',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dcli_fecha_ingreso'); ?>
		<?php echo $form->textField($model,'dcli_fecha_ingreso'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dcli_usr_ingresa'); ?>
		<?php echo $form->textField($model,'dcli_usr_ingresa'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dcli_fecha_modifica'); ?>
		<?php echo $form->textField($model,'dcli_fecha_modifica'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dcli_usr_modifica'); ?>
		<?php echo $form->textField($model,'dcli_usr_modifica'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->