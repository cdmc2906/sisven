<?php
/* @var $this HistorialMbController */
/* @var $model HistorialMbModel */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'h_cod'); ?>
		<?php echo $form->textField($model,'h_cod'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pg_id'); ?>
		<?php echo $form->textField($model,'pg_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'h_id'); ?>
		<?php echo $form->textField($model,'h_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'h_fecha'); ?>
		<?php echo $form->textField($model,'h_fecha'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'h_usuario'); ?>
		<?php echo $form->textField($model,'h_usuario',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'h_ruta'); ?>
		<?php echo $form->textField($model,'h_ruta',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'h_ruta_nombre'); ?>
		<?php echo $form->textField($model,'h_ruta_nombre',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'h_semana'); ?>
		<?php echo $form->textField($model,'h_semana'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'h_dia'); ?>
		<?php echo $form->textField($model,'h_dia'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'h_cod_cliente'); ?>
		<?php echo $form->textField($model,'h_cod_cliente',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'h_nom_cliente'); ?>
		<?php echo $form->textField($model,'h_nom_cliente',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'h_direccion'); ?>
		<?php echo $form->textField($model,'h_direccion',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'h_accion'); ?>
		<?php echo $form->textField($model,'h_accion',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'h_cod_accion'); ?>
		<?php echo $form->textField($model,'h_cod_accion',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'h_cod_comentario'); ?>
		<?php echo $form->textField($model,'h_cod_comentario',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'h_comentario'); ?>
		<?php echo $form->textField($model,'h_comentario',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'h_monto'); ?>
		<?php echo $form->textField($model,'h_monto',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'h_latitud'); ?>
		<?php echo $form->textField($model,'h_latitud',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'h_longitud'); ?>
		<?php echo $form->textField($model,'h_longitud',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'h_romper_secuencia'); ?>
		<?php echo $form->textField($model,'h_romper_secuencia'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'h_fch_ingreso'); ?>
		<?php echo $form->textField($model,'h_fch_ingreso'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'h_fch_modificacion'); ?>
		<?php echo $form->textField($model,'h_fch_modificacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'h_fch_desde'); ?>
		<?php echo $form->textField($model,'h_fch_desde'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'h_fch_hasta'); ?>
		<?php echo $form->textField($model,'h_fch_hasta'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'h_usr_ing_mod'); ?>
		<?php echo $form->textField($model,'h_usr_ing_mod'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'h_usuario_nombre'); ?>
		<?php echo $form->textField($model,'h_usuario_nombre',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->