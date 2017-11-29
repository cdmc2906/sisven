<?php
$this->breadcrumbs = array('Revision Mines Desconocidos',);
$this->renderPartial('/shared/_blockUI');
$this->renderPartial('/shared/_headgrid', array('metodo' => '"VerDatosArchivo"'));
$this->pageTitle = 'Revision Mines Desconocidos';
?>

<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/datepicker.css" />
<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/datepicker3.css" />

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/bootstrap-datepicker.es.js"></script>

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl . "/js/carga/CargaRevisaMinesDesconocidos.js"; ?>"></script>

<section class="">
    <div class="">
        <div class="form">
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'frmLoad',
//                'enableAjaxValidation' => true,
                'enableClientValidation' => true,
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                ),
                'htmlOptions' => array("enctype" => "multipart/form-data"),
                'action' => Yii::app()->request->baseUrl . '/RevisaMinesDesconocidos/SubirArchivo'
            ));
            ?>
            <div class="row">
                <div>
                    <?php // echo $form->labelEx($model, 'fechaConsumo'); ?>
                    <?php // echo $form->textField($model, 'fechaConsumo', array('class' => 'txtFecha')) ?>
                    <?php // echo $form->error($model, 'fechaConsumo'); ?>

                    <?php echo $form->labelEx($model, 'rutaArchivo'); ?>
                    <?php echo $form->fileField($model, 'rutaArchivo'); ?>
                    <?php echo $form->error($model, 'rutaArchivo'); ?>

                    <?php echo $form->labelEx($model, 'delimitadorColumnas'); ?>
                    <?php
                    echo $form->dropDownList(
                            $model, 'delimitadorColumnas', array(
                        ';' => 'Punto y Coma',
                        ',' => 'Coma'
                            ), array(
                        'empty' => TEXT_OPCION_SELECCIONE, 'options' => array(0 => array('selected' => true)))
                    );
                    ?>
                    <?php echo $form->error($model, 'delimitadorColumnas'); ?>
                </div>
            </div>

            <div class="">
                <?php echo CHtml::submitButton('Revisar', array('id' => 'btnRevisar')); ?>
                <?php echo CHtml::Button('Exportar Resultado', array('id' => 'btnExcel', 'class' => 'btn btn-theme')); ?>
                <?php echo CHtml::Button('Limpiar', array('id' => 'btnLimpiar', 'class' => 'btn btn-theme')); ?>
            </div>

            <?php $this->endWidget(); ?>

        </div>
    </div>     
</section>

<br><br>
<section class="">
    <div class="">
        <?php $this->renderPartial('/shared/_bodygrid'); ?>
    </div>
</section>