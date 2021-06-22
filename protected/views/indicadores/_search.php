<?php
/* @var $this IndicadoresController */
/* @var $model IndicadoresModel */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'i_codigo'); ?>
		<?php echo $form->textField($model,'i_codigo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'i_fecha'); ?>
		<?php echo $form->textField($model,'i_fecha'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'i_sucursal'); ?>
		<?php echo $form->textField($model,'i_sucursal',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'i_numero_bodega'); ?>
		<?php echo $form->textField($model,'i_numero_bodega'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'i_bodega'); ?>
		<?php echo $form->textField($model,'i_bodega',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'i_numero_serie'); ?>
		<?php echo $form->textField($model,'i_numero_serie',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'i_numero_factura'); ?>
		<?php echo $form->textField($model,'i_numero_factura',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'i_cod_cliente'); ?>
		<?php echo $form->textField($model,'i_cod_cliente',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'i_tipo_cliente'); ?>
		<?php echo $form->textField($model,'i_tipo_cliente',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'i_nombre_cliente'); ?>
		<?php echo $form->textField($model,'i_nombre_cliente',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'i_ruc'); ?>
		<?php echo $form->textField($model,'i_ruc',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'i_direccion'); ?>
		<?php echo $form->textField($model,'i_direccion',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'i_ciudad'); ?>
		<?php echo $form->textField($model,'i_ciudad',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'i_telefono'); ?>
		<?php echo $form->textField($model,'i_telefono',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'i_codigo_producto'); ?>
		<?php echo $form->textField($model,'i_codigo_producto',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'i_descripcion_producto'); ?>
		<?php echo $form->textField($model,'i_descripcion_producto',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'i_codigo_grupo'); ?>
		<?php echo $form->textField($model,'i_codigo_grupo',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'i_grupo'); ?>
		<?php echo $form->textField($model,'i_grupo',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'i_cantidad'); ?>
		<?php echo $form->textField($model,'i_cantidad'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'i_detalle'); ?>
		<?php echo $form->textField($model,'i_detalle',array('size'=>60,'maxlength'=>1024)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'i_imei'); ?>
		<?php echo $form->textField($model,'i_imei',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'i_min'); ?>
		<?php echo $form->textField($model,'i_min',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'i_icc'); ?>
		<?php echo $form->textField($model,'i_icc',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'i_costo'); ?>
		<?php echo $form->textField($model,'i_costo',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'i_precio1'); ?>
		<?php echo $form->textField($model,'i_precio1',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'i_precio2'); ?>
		<?php echo $form->textField($model,'i_precio2',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'i_precio3'); ?>
		<?php echo $form->textField($model,'i_precio3',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'i_precio4'); ?>
		<?php echo $form->textField($model,'i_precio4',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'i_precio5'); ?>
		<?php echo $form->textField($model,'i_precio5',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'i_precio'); ?>
		<?php echo $form->textField($model,'i_precio',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'i_porcendes'); ?>
		<?php echo $form->textField($model,'i_porcendes',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'i_descuento'); ?>
		<?php echo $form->textField($model,'i_descuento',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'i_subtotal'); ?>
		<?php echo $form->textField($model,'i_subtotal',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'i_iva'); ?>
		<?php echo $form->textField($model,'i_iva',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'i_total'); ?>
		<?php echo $form->textField($model,'i_total',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'i_e_codigo'); ?>
		<?php echo $form->textField($model,'i_e_codigo',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'i_vendedor'); ?>
		<?php echo $form->textField($model,'i_vendedor',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'i_mes'); ?>
		<?php echo $form->textField($model,'i_mes',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'i_semana'); ?>
		<?php echo $form->textField($model,'i_semana',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'i_cedula'); ?>
		<?php echo $form->textField($model,'i_cedula',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'i_listado_operadora'); ?>
		<?php echo $form->textField($model,'i_listado_operadora',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'i_provincia'); ?>
		<?php echo $form->textField($model,'i_provincia',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'i_estatus'); ?>
		<?php echo $form->textField($model,'i_estatus',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'i_fecha_ingreso'); ?>
		<?php echo $form->textField($model,'i_fecha_ingreso'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'i_fecha_modificacion'); ?>
		<?php echo $form->textField($model,'i_fecha_modificacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'i_usuario_ingresa_modifica'); ?>
		<?php echo $form->textField($model,'i_usuario_ingresa_modifica'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'i_estado_icc'); ?>
		<?php echo $form->textField($model,'i_estado_icc',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->