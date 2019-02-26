<?php
/* @var $this EjecutivoRutaController */
/* @var $model EjecutivoRutaModel */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'er_cod'); ?>
		<?php echo $form->textField($model,'er_cod'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'e_cod'); ?>
		<?php echo $form->textField($model,'e_cod'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rg_id'); ?>
		<?php echo $form->textField($model,'rg_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'er_usuario'); ?>
		<?php echo $form->textField($model,'er_usuario',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'er_usuario_nombre'); ?>
		<?php echo $form->textField($model,'er_usuario_nombre',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'er_ruta'); ?>
		<?php echo $form->textField($model,'er_ruta',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'er_ruta_nombre'); ?>
		<?php echo $form->textField($model,'er_ruta_nombre',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'er_semana_visitar'); ?>
		<?php echo $form->textField($model,'er_semana_visitar'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'er_dia_visitar'); ?>
		<?php echo $form->textField($model,'er_dia_visitar'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'er_estado'); ?>
		<?php echo $form->textField($model,'er_estado',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'er_fecha_ingreso'); ?>
		<?php echo $form->textField($model,'er_fecha_ingreso'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'er_fecha_modificacion'); ?>
		<?php echo $form->textField($model,'er_fecha_modificacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'er_cod_usr_ing'); ?>
		<?php echo $form->textField($model,'er_cod_usr_ing'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'er_cod_usr_mod'); ?>
		<?php echo $form->textField($model,'er_cod_usr_mod'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->