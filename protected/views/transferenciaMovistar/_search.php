<?php
/* @var $this TransferenciaMovistarController */
/* @var $model TransferenciaMovistarModel */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'tm_codigo'); ?>
		<?php echo $form->textField($model,'tm_codigo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tm_fecha'); ?>
		<?php echo $form->textField($model,'tm_fecha'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tm_codigotransferencia'); ?>
		<?php echo $form->textField($model,'tm_codigotransferencia',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tm_iddistribuidor'); ?>
		<?php echo $form->textField($model,'tm_iddistribuidor',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tm_nombredistribuidor'); ?>
		<?php echo $form->textField($model,'tm_nombredistribuidor',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tm_codigoscl'); ?>
		<?php echo $form->textField($model,'tm_codigoscl',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tm_inventarioanteriorfuente'); ?>
		<?php echo $form->textField($model,'tm_inventarioanteriorfuente',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tm_inventarioactualfuente'); ?>
		<?php echo $form->textField($model,'tm_inventarioactualfuente',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tm_tiposim'); ?>
		<?php echo $form->textField($model,'tm_tiposim',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tm_icc'); ?>
		<?php echo $form->textField($model,'tm_icc',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tm_min'); ?>
		<?php echo $form->textField($model,'tm_min',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tm_estado'); ?>
		<?php echo $form->textField($model,'tm_estado',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tm_iddestino'); ?>
		<?php echo $form->textField($model,'tm_iddestino',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tm_nombredestino'); ?>
		<?php echo $form->textField($model,'tm_nombredestino',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tm_inventarioanteriordestino'); ?>
		<?php echo $form->textField($model,'tm_inventarioanteriordestino',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tm_inventarioactualdestino'); ?>
		<?php echo $form->textField($model,'tm_inventarioactualdestino',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tm_canal'); ?>
		<?php echo $form->textField($model,'tm_canal',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tm_numero_lote'); ?>
		<?php echo $form->textField($model,'tm_numero_lote',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tm_zona'); ?>
		<?php echo $form->textField($model,'tm_zona',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tm_fecha_ingreso'); ?>
		<?php echo $form->textField($model,'tm_fecha_ingreso'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tm_fecha_modifica'); ?>
		<?php echo $form->textField($model,'tm_fecha_modifica'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tm_usuario_ingresa_modifica'); ?>
		<?php echo $form->textField($model,'tm_usuario_ingresa_modifica'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->