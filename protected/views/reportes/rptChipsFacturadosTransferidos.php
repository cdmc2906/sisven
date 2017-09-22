<?php
/* @var $this TiemposGestionController */
$this->breadcrumbs = array('Chips Facturados - Transferidos');
$this->renderPartial('/shared/_blockUI');
$this->renderPartial('/shared/_headgrid', array('metodo' => '"ConsultarReporte"'));
?>

<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/datepicker.css" />
<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/datepicker3.css" />

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/bootstrap-datepicker.es.js"></script>

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl . "/js/RptChipsFacturadosTransferidos.js"; ?>"></script>

<div class="">
    <header class="">
        <h2><strong>Chips Facturados - Transferidos</strong></h2>
    </header>

    <div class="">    
        <div class="form">
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'frmReporte',
                'enableAjaxValidation' => false,
                'enableClientValidation' => true
            ));
            ?>

            <div class="row">
                <div class="col-lg-4">
                    <div>
                        <div>
                            <?php echo $form->hiddenField($model, 'mesConsulta'); ?>
                            <?php // echo $form->labelEx($model, 'anioConsulta'); ?>
                            <?php // echo $form->textField($model, 'mesConsulta', array('class' => 'txtfechaFin')) ?>

                            <?php
//                            echo $form->dropDownList(
//                                    $model, 'anioConsulta', array(
//                                '0' => 'Todos',
//                                '2017' => '2017',
//                                '2016' => '2016'
//                                    ), array(
//                                'empty' => TEXT_OPCION_SELECCIONE, 'options' => array(0 => array('selected' => true)))
//                            );
                            ?>
                            <?php // echo $form->error($model, 'anioConsulta'); ?>

                            <?php // echo $form->labelEx($model, 'mesConsulta'); ?>
                            <?php // echo $form->textField($model, 'mesConsulta', array('class' => 'txtfechaFin')) ?>

                            <?php
//                            echo $form->dropDownList(
//                                    $model, 'mesConsulta', array(
//                                '0' => 'Todos',
//                                '1' => 'Enero',
//                                '2' => 'Febrero',
//                                '3' => 'Marzo',
//                                '4' => 'Abril',
//                                '5' => 'Mayo',
//                                '6' => 'Junio',
//                                '7' => 'Julio',
//                                '8' => 'Agosto',
//                                '9' => 'Septiembre',
//                                '10' => 'Octubre',
//                                '11' => 'Noviembre',
//                                '12' => 'Diciembre',
//                                    ), array(
//                                'empty' => TEXT_OPCION_SELECCIONE, 'options' => array(0 => array('selected' => true)))
//                            );
                            ?>
                            <?php // echo $form->error($model, 'mesConsulta'); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div  style="display: flex; justify-content: flex-start; text-align:center;">
                <div id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent; margin:auto;">


                    <?php
                    //$ventas= VentaMovistarModel::model()->
                    $command = Yii::app()->db->createCommand('
                        SELECT DATE(i_fecha) as fecha 
                            FROM tb_indicadores 
                            order by i_fecha desc 
                            limit 1');
                    $resultado = $command->queryRow();
                    $ultimaFechaFactura = DateTime::createFromFormat('Y-m-d', $resultado['fecha'])->format(FORMATO_FECHA);

                    echo CHtml::label('Fecha ultima factura', '_ultimaFechaFactura');
                    echo CHtml::textField(
                            'Text', $ultimaFechaFactura, array(
                        'id' => '_ultimaFechaFactura',
                        'disabled' => 'disabled',
                        'width' => 100,
                        'maxlength' => 100,
                        'style' => 'text-align:center; color:orange; width:150px; height:30px; font-size:22px'));
                    ?>
                </div>
                <div id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent; margin:auto;">
                    <?php
//                    $ventas= VentaMovistarModel::model()->
//                    echo CHtml::label("hi",$model->);
                    $command = Yii::app()->db->createCommand('
                        SELECT DATE(tm_fecha) as fecha 
                            FROM tb_transferencia_movistar
                            order by tm_fecha desc
                            limit 1');
                    $resultado = $command->queryRow();
                    $ultimaFechaTransferencia = DateTime::createFromFormat('Y-m-d', $resultado['fecha'])->format(FORMATO_FECHA);
                    echo CHtml::label('Fecha ultima Transferencia', '_ultimaFechaTransferencia');
                    echo CHtml::textField(
                            'Text', $ultimaFechaTransferencia, array(
                        'id' => '_ultimaFechaTransferencia',
                        'disabled' => 'disabled',
                        'width' => 100,
                        'maxlength' => 100,
                        'style' => 'text-align:center; color:orange; width:150px; height:30px; font-size:22px'));
                    ?>

                </div>
                <div id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent; margin:auto;">
                    <?php
//                    $ventas= VentaMovistarModel::model()->
                    $command = Yii::app()->db->createCommand('
                        SELECT DATE(vm_fecha) as fecha 
                            FROM tb_venta_movistar 
                            order by vm_fecha desc 
                            limit 1');
                    $resultado = $command->queryRow();
                    $ultimaFechaVenta = DateTime::createFromFormat('Y-m-d', $resultado['fecha'])->format(FORMATO_FECHA);

                    echo CHtml::label('Fecha ultima venta', '_ultimaFechaVenta');
                    echo CHtml::textField(
                            'Text', $ultimaFechaVenta, array(
                        'id' => '_ultimaFechaVenta',
                        'disabled' => 'disabled',
                        'width' => 100,
                        'maxlength' => 100,
                        'style' => 'text-align:center; color:orange; width:150px; height:30px; font-size:22px'));
                    ?>
                </div>
            </div>
            <br>
            <div class="row buttons secccionBotones">
                <?php
                echo CHtml::ajaxSubmitButton('Generar'
                        , CHtml::normalizeUrl(array('ReporteChipsFacturadosTransferidos/ConsultarDatos'
                            , 'render' => true)), array(
                    'dataType' => 'json',
                    'type' => 'post',
                    'beforeSend' =>
                    'function() {blockUIOpen();}',
                    'success' =>
                    'function(data) {
                        blockUIClose();
                        setMensaje(data.ClassMessage, data.Message);
                        if(data.Status==1){
                            var datosResult = data.Result;
                            $("#tblGridFacturadosNoTransferidos").setGridParam({datatype: \'jsonstring\', datastr: datosResult[\'FNT\']}).trigger(\'reloadGrid\');
                            $("#tblGridNoFacturadosTransferidos").setGridParam({datatype: \'jsonstring\', datastr: datosResult[\'NFT\']}).trigger(\'reloadGrid\');
                            
                        } else{
                            $.each(data, function(key, val) {
                            $("#frmReporte #"+key+"_em_").text(val);
                            $("#frmReporte #"+key+"_em_").show();
                            });
                            }
                        } ',
                    'error' => 'function(xhr,st,err) {
                            blockUIClose();
                            alert(err);
                        }'
                        ), array('id' => 'btnGenerar', 'class' => 'btn btn-theme'));
                ?>

                <?php echo CHtml::Button('Limpiar', array('id' => 'btnLimpiar', 'class' => 'btn btn-theme')); ?>

            </div>

            <?php $this->endWidget(); ?>

        </div>
    </div>
</div>
<h3>Chips Facturados y No Transferidos</h3>
<?php echo CHtml::Button('Exportar FNT', array('id' => 'btnExcelFacturadosNoTransferidos', 'class' => 'btn btn-theme')); ?>

<?php $this->renderPartial('/shared/_bodygridFacturadosNoTransferidos'); ?>
<br/>
<h3>Chips No Facturados y Transferidos</h3>
<?php echo CHtml::Button('Exportar NFT', array('id' => 'btnExcelNoFacturadosTransferidos', 'class' => 'btn btn-theme')); ?>
<?php $this->renderPartial('/shared/_bodygridNoFacturadosTransferidos'); ?>

<?php $this->renderPartial('/shared/_dialog'); ?>
