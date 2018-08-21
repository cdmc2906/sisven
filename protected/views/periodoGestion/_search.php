<?php
/* @var $this PeriodoGestionController */
/* @var $model PeriodoGestionModel */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'pg_id'); ?>
		<?php echo $form->textField($model,'pg_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pg_descripcion'); ?>
		<?php echo $form->textField($model,'pg_descripcion',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pg_fecha_inicio'); ?>
		<?php echo $form->textField($model,'pg_fecha_inicio'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pg_fecha_fin'); ?>
		<?php echo $form->textField($model,'pg_fecha_fin'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pg_anio'); ?>
		<?php echo $form->textField($model,'pg_anio'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pg_mes'); ?>
		<?php echo $form->textField($model,'pg_mes'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pg_estado'); ?>
		<?php echo $form->textField($model,'pg_estado'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pg_tipo'); ?>
		<?php echo $form->textField($model,'pg_tipo',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pg_fecha_ingreso'); ?>
		<?php echo $form->textField($model,'pg_fecha_ingreso'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pg_fecha_modificacion'); ?>
		<?php echo $form->textField($model,'pg_fecha_modificacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pg_cod_usuario_ing_mod'); ?>
		<?php echo $form->textField($model,'pg_cod_usuario_ing_mod'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->