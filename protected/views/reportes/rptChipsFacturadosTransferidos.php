<?php
$pagina_nombre = 'Chips Facturados - Transferidos';
$this->breadcrumbs = array('Procesos', 'Otros', $pagina_nombre => array('index'));
$this->renderPartial('/shared/_blockUI');
$this->renderPartial('/shared/_headgrid', array('metodo' => '"VerDatosArchivo"'));
$this->pageTitle = $pagina_nombre;
?>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl . "/js/reporte/RptChipsFacturadosTransferidos.js"; ?>"></script>


<div class="box box-info">
    <div class="form">
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'frmReporte',
            'enableAjaxValidation' => false,
            'enableClientValidation' => true
        ));
        ?>


        <div  style="display: flex; justify-content: flex-start; text-align:center;">
            <div id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent; margin:auto;">
                <?php echo $form->hiddenField($model, 'anioConsulta'); ?>
                <?php echo $form->hiddenField($model, 'mesConsulta'); ?>
                <!--SECCION FACTURADOS ARRIBA-->
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

                <!--SECCION FACTURADOS ABAJO-->
                <div id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent; margin:auto;">

                    <?php
                    $command = Yii::app()->db->createCommand('
                        SELECT DATE(i_fecha) as fecha 
                            FROM tb_indicadores 
                            order by i_fecha desc 
                            limit 1');
                    $resultado = $command->queryRow();
                    $ultimaFechaFactura = DateTime::createFromFormat('Y-m-d', $resultado['fecha'])->format(FORMATO_FECHA);

                    $consulta = "SELECT 
                            sum(i_cantidad) as cantidad 
                            FROM tb_indicadores 
                            WHERE i_fecha between 
                                (select CAST(DATE_FORMAT('" . $ultimaFechaFactura . "' ,'%Y-%m-01') as DATE)) 
                                AND (select LAST_DAY('" . $ultimaFechaFactura . "')) 
                            ;";
                    $command = Yii::app()->db->createCommand($consulta);
                    $resultado = $command->queryRow();
                    $cantidadFacturado = number_format(intval($resultado['cantidad']), 0, '', '.');

                    echo CHtml::label('Cantidad facturados', '_cantidaMinesFactura');
                    echo CHtml::textField(
                            'Text', $cantidadFacturado . ' mines', array(
                        'id' => '_cantidaMinesFactura',
                        'disabled' => 'disabled',
                        'width' => 100,
                        'maxlength' => 100,
                        'style' => 'text-align:center; color:blue; width:150px; height:30px; font-size:22px'));
                    ?>
                </div>

            </div>
            <div id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent; margin:auto;">
                <!--SECCION TRANSFERIDOS ARRIBA-->
                <div id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent; margin:auto;">
                    <?php
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

                <!--SECCION TRANSFERIDOS ABAJO-->
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

                    $consulta = "SELECT 
                            count(tm_icc) as cantidad 
                            FROM tb_transferencia_movistar 
                            WHERE tm_fecha between 
                                (select CAST(DATE_FORMAT('" . $ultimaFechaTransferencia . "' ,'%Y-%m-01') as DATE)) 
                                AND (select LAST_DAY('" . $ultimaFechaTransferencia . "')) 
                            ;";
                    $command = Yii::app()->db->createCommand($consulta);
                    $resultado = $command->queryRow();

                    $cantidadTransferencia = number_format(intval($resultado['cantidad']), 0, '', '.');

                    echo CHtml::label('Cantidad transferidos', '_cantidadMinesTransferidos');
                    echo CHtml::textField(
                            'Text', $cantidadTransferencia . ' mines', array(
                        'id' => '_cantidadMinesTransferidos',
                        'disabled' => 'disabled',
                        'width' => 100,
                        'maxlength' => 100,
                        'style' => 'text-align:center; color:blue; width:150px; height:30px; font-size:22px'));
                    ?>

                </div>

            </div>
            <div id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent; margin:auto;">
                <!--SECCION VENDIDOS ARRIBA-->
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

                <!--SECCION VENDIDOS ABAJO-->
                <div id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent; margin:auto;">
                    <?php
                    $command = Yii::app()->db->createCommand('
                        SELECT DATE(vm_fecha) as fecha 
                            FROM tb_venta_movistar 
                            order by vm_fecha desc 
                            limit 1');
                    $resultado = $command->queryRow();
                    $ultimaFechaVenta = DateTime::createFromFormat('Y-m-d', $resultado['fecha'])->format(FORMATO_FECHA);
                    
                    $command2 = Yii::app()->db->createCommand(
                            "SELECT 
                            count(vm_icc) as cantidad 
                            FROM tb_venta_movistar 
                            WHERE 1=1
                                AND vm_fecha between 
                                    (select CAST(DATE_FORMAT('" . $ultimaFechaVenta . "' ,'%Y-%m-01') as DATE)) 
                                    AND (select LAST_DAY('" . $ultimaFechaVenta . "')) 
                                and vm_estado_icc ='ICC OK'                                
                            ;"
                            );
//                            var_dump($command2);die();
                    $resultado = $command2->queryRow();
                    $cantidadVenta = number_format(intval($resultado['cantidad']), 0, '', '.');

                    $command = Yii::app()->db->createCommand(
                            "
                            select count(vm_icc) as cantidad
                                from tb_venta_movistar
                                WHERE 1=1
                                    and vm_fecha between 
                                        (select CAST(DATE_FORMAT('" . $ultimaFechaVenta . "' ,'%Y-%m-01') as DATE)) 
                                        AND (select LAST_DAY('" . $ultimaFechaVenta . "'))
                                    and vm_estado_icc ='ICC PROMO'
                                    ;"
                            );
                    $resultado1 = $command->queryRow();
                    $cantidadVentaPromo = number_format(intval($resultado1['cantidad']), 0, '', '.');
                    ?>
                    <div  style="display: flex; justify-content: flex-start; text-align:center;">
                        <div id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent; margin:auto;">
                            <?php
                            echo CHtml::label('Venta', '_cantidadMinesVenta');
                            echo CHtml::textField(
                                    'Text', $cantidadVenta . ' mines', array(
                                'id' => '_ultimaFechaVenta',
                                'disabled' => 'disabled',
                                'width' => 100,
                                'maxlength' => 100,
                                'style' => 'text-align:center; color:blue; width:150px; height:30px; font-size:22px'));
                            ?>
                        </div>
                        <?php if ($cantidadVentaPromo > 0) { ?>
                            <div id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent; margin:auto;">
                                <?php
                                echo CHtml::label('Promocionales vendidos', '_cantidadVentaPromocionales');
                                echo CHtml::textField(
                                        'Text', $cantidadVentaPromo . ' mines', array(
                                    'id' => '_ultimaFechaVenta',
                                    'disabled' => 'disabled',
                                    'width' => 100,
                                    'maxlength' => 100,
                                    'style' => 'text-align:center; color:blue; width:150px; height:30px; font-size:22px'));
                                ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="form">
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
            ), array('id' => 'btnGenerar', 'class' => 'btn btn-success'));
    ?>

    <?php echo CHtml::Button('Limpiar', array('id' => 'btnLimpiar', 'class' => 'btn btn-danger')); ?>

</div>
<!--</div>-->

<?php $this->endWidget(); ?>

<div class="box box-info">
    <header class="">
        <h3><strong>Chips Facturados y No Transferidos</strong></h3>
    </header>
    <?php echo CHtml::Button('Exportar FNT', array('id' => 'btnExcelFacturadosNoTransferidos', 'class' => 'btn btn-warning')); ?>

    <div id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent">
        <table id="tblGridFacturadosNoTransferidos" class="table table-condensed"></table>
        <div id="pagGridFacturadosNoTransferidos"> </div>
    </div>

    <br/>
    <!--<h3>Chips No Facturados y Transferidos</h3>-->
    <header class="">
        <h3><strong>Chips No Facturados y Transferidos</strong></h3>
    </header>

    <?php echo CHtml::Button('Exportar NFT', array('id' => 'btnExcelNoFacturadosTransferidos', 'class' => 'btn btn-warning')); ?>
    <!--<div id="grilla" class="_grilla">-->
    <div id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent">
        <table id="tblGridNoFacturadosTransferidos" class="table table-condensed"></table>
        <div id="pagGridNoFacturadosTransferidos"> </div>
    </div>
</div>
