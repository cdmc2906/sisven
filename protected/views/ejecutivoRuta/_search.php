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
		<?php echo $form->textField($model,'er_ruta_nombre',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'er_estatus'); ?>
		<?php echo $form->textField($model,'er_estatus',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'er_fecha_ingreso'); ?>
		<?php echo $form->textField($model,'er_fecha_ingreso'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'er_fecha_asignacion'); ?>
		<?php echo $form->textField($model,'er_fecha_asignacion'); ?>
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