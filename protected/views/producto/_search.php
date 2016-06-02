<?php
/* @var $this ProductoController */
/* @var $model ProductoModel */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'ID_PRO'); ?>
		<?php echo $form->textField($model,'ID_PRO'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ID_EST'); ?>
		<?php echo $form->textField($model,'ID_EST'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ID_COMP'); ?>
		<?php echo $form->textField($model,'ID_COMP'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ID_TPRO'); ?>
		<?php echo $form->textField($model,'ID_TPRO'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ID_BODEGA'); ?>
		<?php echo $form->textField($model,'ID_BODEGA'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NOMBRE_PROD'); ?>
		<?php echo $form->textField($model,'NOMBRE_PROD',array('size'=>60,'maxlength'=>1024)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'MIN_PROD'); ?>
		<?php echo $form->textField($model,'MIN_PROD',array('size'=>60,'maxlength'=>1024)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ICC_PROD'); ?>
		<?php echo $form->textField($model,'ICC_PROD',array('size'=>60,'maxlength'=>1024)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'IMEI_PROD'); ?>
		<?php echo $form->textField($model,'IMEI_PROD',array('size'=>60,'maxlength'=>1024)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NUMSERIE_PROD'); ?>
		<?php echo $form->textField($model,'NUMSERIE_PROD',array('size'=>60,'maxlength'=>1024)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'PRECIO_PROD'); ?>
		<?php echo $form->textField($model,'PRECIO_PROD',array('size'=>24,'maxlength'=>24)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'COSTO_PROD'); ?>
		<?php echo $form->textField($model,'COSTO_PROD',array('size'=>24,'maxlength'=>24)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'PORCENTAJEDESCUENTO_PROD'); ?>
		<?php echo $form->textField($model,'PORCENTAJEDESCUENTO_PROD',array('size'=>24,'maxlength'=>24)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'PRECIO1_PROD'); ?>
		<?php echo $form->textField($model,'PRECIO1_PROD',array('size'=>24,'maxlength'=>24)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'PRECIO2_PROD'); ?>
		<?php echo $form->textField($model,'PRECIO2_PROD',array('size'=>24,'maxlength'=>24)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'PRECIO3_PROD'); ?>
		<?php echo $form->textField($model,'PRECIO3_PROD',array('size'=>24,'maxlength'=>24)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->