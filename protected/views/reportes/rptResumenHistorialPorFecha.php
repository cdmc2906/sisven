<?php
$this->breadcrumbs = array('Exportar Resumen Historial',);
$this->renderPartial('/shared/_blockUI');
$this->renderPartial('/shared/_headgrid', array('metodo' => '"ConfigurarGrid"'));
$this->pageTitle = 'Exportar Resumen Historial';
?>

<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/datepicker.css" />
<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/datepicker3.css" />

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/bootstrap-datepicker.es.js"></script>

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl . "/js/reporte/RptResumenHistorialPorFecha.js"; ?>"></script>

<section class="">
    <header class="">
        <h2><strong>Exportar Resumen Historial</strong></h2>
    </header>
    <div class="">
        <div class="form">
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'frmLoad',
                'enableAjaxValidation' => false,
                'enableClientValidation' => true,
            ));
            ?>
            <div class="row">
                <div>

                    <?php echo $form->labelEx($model, 'fechaInicioGestion'); ?>
                    <?php echo $form->textField($model, 'fechaInicioGestion', array('class' => 'txtFechaInicioGestion')); ?>
                    <?php echo $form->error($model, 'fechaInicioGestion'); ?>

                    <?php echo $form->labelEx($model, 'fechaFinGestion'); ?>
                    <?php echo $form->textField($model, 'fechaFinGestion', array('class' => 'txtFechaFinGestion')); ?>
                    <?php echo $form->error($model, 'fechaFinGestion'); ?>

                    <?php echo $form->labelEx($model, 'ejecutivo'); ?>
                    <?php
                    echo $form->dropDownList(
                            $model, 'ejecutivo', array(
                        'QU25' => 'EDISON CALVACHE',
                        'QU26' => 'GIOVANA BONILLA',
                        'QU22' => 'JOSE CHAMBA',
                        'QU21' => 'JUAN CLAVIJO',
                        'QU17' => 'JHONNY PLUAS',
                        'QU19' => 'LUIS OJEDA'
                            ), array(
                        'empty' => TEXT_OPCION_SELECCIONE, 'options' => array(0 => array('selected' => true)))
                    );
                    ?>
                    <?php echo $form->error($model, 'ejecutivo'); ?>
                </div>
            </div>

            <div class="">
                <?php // echo CHtml::submitButton('Cargar', array('id' => 'btnCargar')); ?>
                <?php
                echo CHtml::ajaxSubmitButton(
                        'Generar Reporte', CHtml
                        ::normalizeUrl(array('RptResumenHistorialPorFecha/GenerarReporte', 'render' => true)), array(
                    'dataType' => 'json',
                    'type' => 'post',
                    'beforeSend' => 'function() {
                            blockUIOpen();
                            }',
                    'success' => 'function(data) {
                        
                        blockUIClose();
                        setMensaje(data.ClassMessage, data.Message);
                        if(data.Status==1){
                             var datosResult = data.Result;
                            $("#tblGrid").setGridParam({datatype: \'jsonstring\', datastr: datosResult}).trigger(\'reloadGrid\');
                        } else{
                            $.each(data, function(key, val) {
                            $("#frmBankStat #"+key+"_em_").text(val);
                            $("#frmBankStat #"+key+"_em_").show();
                            });
                            }
                        } ',
                    'error' => 'function(xhr,st,err) {
                            blockUIClose();
                            RedirigirError(xhr.status);
                        }'
                        ), array('id' => 'btnGenerate', 'class' => 'btn btn-theme'));
                ?>
                <?php echo CHtml::Button('Limpiar', array('id' => 'btnLimpiar', 'class' => 'btn btn-theme')); ?>
                <?php echo CHtml::Button('Exportar a Excel', array('id' => 'btnExcel', 'class' => 'btn btn-theme', 'disabled' => 'true')); ?>
            </div>
            <?php $this->endWidget(); ?>
        </div>
    </div>     
</section>
