<?php
/* @var $this VentaMovistarController */
/* @var $model VentaMovistarModel */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'vm_cod'); ?>
		<?php echo $form->textField($model,'vm_cod'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vm_fecha'); ?>
		<?php echo $form->textField($model,'vm_fecha'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vm_transaccion'); ?>
		<?php echo $form->textField($model,'vm_transaccion',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vm_distribuidor'); ?>
		<?php echo $form->textField($model,'vm_distribuidor',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vm_nombredistribuidor'); ?>
		<?php echo $form->textField($model,'vm_nombredistribuidor',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vm_codigoscl'); ?>
		<?php echo $form->textField($model,'vm_codigoscl',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vm_inventarioanteriorfuente'); ?>
		<?php echo $form->textField($model,'vm_inventarioanteriorfuente',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vm_inventarioactualfuente'); ?>
		<?php echo $form->textField($model,'vm_inventarioactualfuente',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vm_tiposim'); ?>
		<?php echo $form->textField($model,'vm_tiposim',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vm_icc'); ?>
		<?php echo $form->textField($model,'vm_icc',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vm_min'); ?>
		<?php echo $form->textField($model,'vm_min',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vm_estado'); ?>
		<?php echo $form->textField($model,'vm_estado',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vm_iddestino'); ?>
		<?php echo $form->textField($model,'vm_iddestino',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vm_nombredestino'); ?>
		<?php echo $form->textField($model,'vm_nombredestino',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vm_inventarioanteriordestino'); ?>
		<?php echo $form->textField($model,'vm_inventarioanteriordestino',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vm_inventarioactualdestino'); ?>
		<?php echo $form->textField($model,'vm_inventarioactualdestino',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vm_canal'); ?>
		<?php echo $form->textField($model,'vm_canal',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vm_lote'); ?>
		<?php echo $form->textField($model,'vm_lote',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vm_zona'); ?>
		<?php echo $form->textField($model,'vm_zona',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vm_fecha_ingreso'); ?>
		<?php echo $form->textField($model,'vm_fecha_ingreso'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vm_fecha_modificacion'); ?>
		<?php echo $form->textField($model,'vm_fecha_modificacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vm_usuario_ingresa_modifica'); ?>
		<?php echo $form->textField($model,'vm_usuario_ingresa_modifica'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->