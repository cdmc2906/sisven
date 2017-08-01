<?php
$this->breadcrumbs = array('Carga Ordenes Mobilvendor',);
$this->renderPartial('/shared/_blockUI');
$this->renderPartial('/shared/_headgrid', array('metodo' => '"VerDatosArchivo"'));
?>

<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/datepicker.css" />
<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/datepicker3.css" />

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/bootstrap-datepicker.es.js"></script>

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl . "/js/CargaOrdenesMb.js"; ?>"></script>

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
                'action' => Yii::app()->request->baseUrl . '/CargaOrdenesMb/SubirArchivo'
            ));
            ?>
            <div class="row">
                <div align="center">
                    <?php echo $form->labelEx($model, 'fechaUltimaCarga'); ?>
                    <?php
//                    $ventas= VentaMovistarModel::model()->
                    $command = Yii::app()->db->createCommand('
                        select 
                                 o_fch_ingreso as fecha 
                            from tb_ordenes_mb 
                            order by o_fch_ingreso desc 
                            limit 1;');
                    $resultado = $command->queryRow();
                    $ultimaFecha = DateTime::createFromFormat('Y-m-d H:i:s', $resultado['fecha'])->format(FORMATO_FECHA_LONG_2);

                    echo $form->textField($model, 'fechaUltimaCarga'
                            , array(
                        'value' => $ultimaFecha
                        , 'class' => 'txtUltimaCarga'
                        , 'disabled' => 'disabled'
                        , 'style' => 'text-align:center; color:orange; width:200px; height:30px; font-size:22px')
                    )
                    ?>
                </div>
                <div>
                    <?php
                    echo $form->labelEx($model, 'rutaArchivo');
                    echo $form->fileField($model, 'rutaArchivo');
                    echo $form->error($model, 'rutaArchivo');
                    echo $form->labelEx($model, 'delimitadorColumnas');

                    echo $form->dropDownList(
                            $model, 'delimitadorColumnas', array(
                        ';' => 'Punto y Coma',
                        ',' => 'Coma'
                            ), array(
                        'empty' => TEXT_OPCION_SELECCIONE, 'options' => array(0 => array('selected' => true)))
                    );
                    echo $form->error($model, 'delimitadorColumnas');
                    ?>
                </div>
            </div>
            <div>

            </div>
            <div class="">
                <?php echo CHtml::submitButton('Cargar', array('id' => 'btnCargar')); ?>
                <?php // echo CHtml::button('Guardar', array('submit' => array('cargaConsumo/GuardarConsumo'))); ?>
                <?php
                echo CHtml::ajaxSubmitButton('Guardar', CHtml::normalizeUrl(array('cargaordenesmb/guardarOrdenes', 'render' => true)), array(
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
                            $("#tblGridResumen").setGridParam({datatype: \'jsonstring\', datastr: datosResult}).trigger(\'reloadGrid\');
                            
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
        <h2><strong>Detalle archivo Ordenes</strong></h2>
    </header>
    <div class="">
        <?php $this->renderPartial('/shared/_bodygrid'); ?>
    </div>
</section>