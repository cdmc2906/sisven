<?php
/* @var $this ResumenRevHistorialController */
/* @var $model ResumenRevHistorialModel */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'rrh_id'); ?>
		<?php echo $form->textField($model,'rrh_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rrh_fecha'); ?>
		<?php echo $form->textField($model,'rrh_fecha'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rrh_ejecutivo'); ?>
		<?php echo $form->textField($model,'rrh_ejecutivo',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rrh_nivel_cumplimiento'); ?>
		<?php echo $form->textField($model,'rrh_nivel_cumplimiento',array('size'=>9,'maxlength'=>9)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rrh_visitas_efectuadas'); ?>
		<?php echo $form->textField($model,'rrh_visitas_efectuadas'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rrh_clientes_ruta'); ?>
		<?php echo $form->textField($model,'rrh_clientes_ruta'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rrh_cliente_no_visitados'); ?>
		<?php echo $form->textField($model,'rrh_cliente_no_visitados'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rrh_visitas_fuera_ruta'); ?>
		<?php echo $form->textField($model,'rrh_visitas_fuera_ruta'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rrh_cantidad_venta_ruta'); ?>
		<?php echo $form->textField($model,'rrh_cantidad_venta_ruta'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rrh_cantidad_venta_fuera_ruta'); ?>
		<?php echo $form->textField($model,'rrh_cantidad_venta_fuera_ruta'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rrh_clientes_venta'); ?>
		<?php echo $form->textField($model,'rrh_clientes_venta'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rrh_total_venta_reportada'); ?>
		<?php echo $form->textField($model,'rrh_total_venta_reportada'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rrh_fecha_ingreso'); ?>
		<?php echo $form->textField($model,'rrh_fecha_ingreso'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rrh_fecha_modificar'); ?>
		<?php echo $form->textField($model,'rrh_fecha_modificar'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rrh_usr_ingresa'); ?>
		<?php echo $form->textField($model,'rrh_usr_ingresa'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rrh_usr_modifica'); ?>
		<?php echo $form->textField($model,'rrh_usr_modifica'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->