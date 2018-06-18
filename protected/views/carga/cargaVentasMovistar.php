<?php
$this->breadcrumbs = array('Carga Ventas Movistar',);
$this->renderPartial('/shared/_blockUI');
$this->renderPartial('/shared/_headgrid', array('metodo' => '"VerDatosArchivo"'));
$this->pageTitle = 'Carga Ventas Movistar';
?>

<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/datepicker.css" />
<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/datepicker3.css" />

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/bootstrap-datepicker.es.js"></script>

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl . "/js/carga/cargaVentasMovistar.js"; ?>"></script>

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
                'action' => Yii::app()->request->baseUrl . '/CargaVentasMovistar/SubirArchivo'
            ));
            ?>
            <div class="row">
                <div align="center">
                    <?php echo $form->labelEx($model, 'fechaUltimaCarga'); ?>
                    <?php
//                    $ventas= VentaMovistarModel::model()->
                    $command = Yii::app()->db->createCommand('
                        SELECT 
                        top 1
                        -- DATE(vm_fecha) as fecha 
                        ' . FuncionesBaseDatos::convertToDate('sqlsrv', 'vm_fecha') . '  as fecha 
                            FROM tb_venta_movistar 
                            order by vm_fecha desc 
                            ');
                    $resultado = $command->queryRow();
                    $ultimaFecha = DateTime::createFromFormat('Y-m-d', $resultado['fecha'])->format(FORMATO_FECHA);

                    echo $form->textField($model, 'fechaUltimaCarga'
                            , array(
                        'value' => $ultimaFecha
                        , 'class' => 'txtUltimaCarga'
                        , 'disabled' => 'disabled'
                        , 'style' => 'text-align:center; color:orange; width:150px; height:30px; font-size:22px')
                    )
                    ?>
                </div>
                <div>
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
                <?php echo CHtml::submitButton('Cargar', array('id' => 'btnCargar')); ?>
                <?php // echo CHtml::button('Guardar', array('submit' => array('cargaConsumo/GuardarConsumo'))); ?>
                <?php
                echo CHtml::ajaxSubmitButton('Guardar', CHtml::normalizeUrl(array('cargaVentasMovistar/GuardarVentasMovistar', 'render' => true)), array(
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
                            // alert(datosResult.toSource());
                            $("#tblGrid").trigger(\'reloadGrid\');                            
                            $("#tblGridChipsDuplicadosVentaMovistar").setGridParam({datatype: \'jsonstring\', datastr: datosResult}).trigger(\'reloadGrid\');
                            
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
            </div>

            <?php $this->endWidget(); ?>

        </div>
    </div>     
</section>

<br><br>
<section class="">
    <header class="">
        <h2><strong>Datos archivo ventas</strong></h2>
    </header>
    <div class="">
        <?php $this->renderPartial('/shared/_bodygrid'); ?>
    </div>
</section>
<br />
<!--<div id="grilla" class="_grilla">-->
<!--<div id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent">
    <table id="tblGridChipsDuplicadosVentaMovistar" class="table table-condensed"></table>
    <div id="pagGridChipsDuplicadosVentaMovistar"> </div>
</div>-->
