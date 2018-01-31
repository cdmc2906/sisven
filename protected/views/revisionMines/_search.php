<?php
/* @var $this RevisionMinesController */
/* @var $model RevisionMinesModel */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'rmva_id'); ?>
		<?php echo $form->textField($model,'rmva_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'iduser'); ?>
		<?php echo $form->textField($model,'iduser'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rmva_tipo'); ?>
		<?php echo $form->textField($model,'rmva_tipo',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rmva_fecha_gestion'); ?>
		<?php echo $form->textField($model,'rmva_fecha_gestion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rmva_resultado_llamad'); ?>
		<?php echo $form->textField($model,'rmva_resultado_llamad',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rmva_motivo_no_contado'); ?>
		<?php echo $form->textField($model,'rmva_motivo_no_contado',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rmva_operadora'); ?>
		<?php echo $form->textField($model,'rmva_operadora',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rmva_lugar_compra'); ?>
		<?php echo $form->textField($model,'rmva_lugar_compra',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rmva_precio'); ?>
		<?php echo $form->textField($model,'rmva_precio',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rmva_estado'); ?>
		<?php echo $form->textField($model,'rmva_estado'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rmva_fecha_ingreso'); ?>
		<?php echo $form->textField($model,'rmva_fecha_ingreso'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rmva_fecha_modifica'); ?>
		<?php echo $form->textField($model,'rmva_fecha_modifica'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rmva_cod_usuario_ing_mod'); ?>
		<?php echo $form->textField($model,'rmva_cod_usuario_ing_mod'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->