<?php
/* @var $this PeriodoGestionController */
/* @var $model PeriodoGestionModel */
/* @var $form CActiveForm */
?>
<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/datepicker.css" />
<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/datepicker3.css" />

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/bootstrap-datepicker.es.js"></script>

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl . "/js/catalogo/PeriodoGestion.js"; ?>"></script>
<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'periodo-gestion-model-form',
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">Campos con <span class="required">*</span> son obligatorios.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <div class="col-md-4">
            <?php echo $form->labelEx($model, 'pg_tipo'); ?>
            <?php
            echo $form->dropDownList(
                    $model, 'pg_tipo', array(
                'SEMANAL' => 'SEMANAL',
                'MENSUAL' => 'MENSUAL',)
                    , array(
                'empty' => TEXT_OPCION_SELECCIONE,
                'options' => array(1 => array('selected' => true)),
                'class' => 'form-control select2',
//                                    'disabled' => 'disabled',
                    )
            );
            ?>

            <?php echo $form->error($model, 'pg_tipo'); ?>    
        </div>
        <div class="col-md-4">
            <?php echo $form->labelEx($model, 'pg_fecha_inicio'); ?>
            <?php
            echo $form->textField($model, 'pg_fecha_inicio', array(
                'class' => 'txtfechaInicioPeriodo',
                'disabled' => 'disabled'
            ));
            ?>
            <?php echo $form->error($model, 'pg_fecha_inicio'); ?>
        </div>
        <div class="col-md-4">
            <?php echo $form->labelEx($model, 'pg_fecha_fin'); ?>
            <?php
            echo $form->textField($model, 'pg_fecha_fin', array(
                'class' => 'txtfechaFinPeriodo',
                'disabled' => 'disabled'
            ));
            ?>
<?php echo $form->error($model, 'pg_fecha_fin'); ?>
        </div>


    </div>

    <!--    <div class="row">
            <div class="col-md-8">
<?php echo $form->labelEx($model, 'pg_descripcion'); ?>
<?php echo $form->textField($model, 'pg_descripcion', array('size' => 40, 'maxlength' => 60)); ?>
    <?php echo $form->error($model, 'pg_descripcion'); ?>                
            </div>
        </div>-->
    <!--    <div class="row">
              <div class="col-md-4">
    <?php echo $form->labelEx($model, 'pg_estado'); ?>
    <?php
//            echo $form->textField($model, 'pg_estado'); 
    echo $form->dropDownList(
            $model, 'pg_tipo', array(
        '1' => 'ACTIVO',
        '2' => 'INACTIVO',)
            , array(
        'empty' => TEXT_OPCION_SELECCIONE,
        'options' => array(1 => array('selected' => true)),
        'class' => 'form-control select2',
        'disabled' => 'disabled',
            )
    );
    ?>
<?php echo $form->error($model, 'pg_estado'); ?>
    
            </div>-->

</div>

<!--	<div class="row">
<?php echo $form->labelEx($model, 'pg_fecha_ingreso'); ?>
<?php echo $form->textField($model, 'pg_fecha_ingreso'); ?>
<?php echo $form->error($model, 'pg_fecha_ingreso'); ?>
        </div>-->

<!--	<div class="row">
<?php echo $form->labelEx($model, 'pg_fecha_modificacion'); ?>
<?php echo $form->textField($model, 'pg_fecha_modificacion'); ?>
<?php echo $form->error($model, 'pg_fecha_modificacion'); ?>
        </div>-->

<!--    <div class="row">
<?php echo $form->labelEx($model, 'pg_cod_usuario_ing_mod'); ?>
    <?php echo $form->textField($model, 'pg_cod_usuario_ing_mod'); ?>
    <?php echo $form->error($model, 'pg_cod_usuario_ing_mod'); ?>
    </div>-->

<div class="row buttons">
<?php echo CHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Save', array('class' => 'btn btn-success btn-sm')); ?>
<?php
echo CHtml::Button('Limpiar', array('id' => 'btnLimpiar', 'class' => 'btn btn-danger btn-sm'));
?>
</div>

<?php $this->endWidget(); ?>

</div><!-- form -->