<?php
$this->breadcrumbs = array('Resumen diario historial ejecutivo',);
$this->renderPartial('/shared/_blockUI');
$this->renderPartial('/shared/_headgrid', array('metodo' => '"ConfigurarGrid"'));
?>

<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/datepicker.css" />
<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/datepicker3.css" />

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/bootstrap-datepicker.es.js"></script>

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl . "/js/RptResumenDiarioHistorial.js"; ?>"></script>

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
//                'action' => Yii::app()->request->baseUrl . '/CargaConsumo/SubirArchivo'
            ));
            ?>
            <div class="row">
                <table>
                    <tr>
                        <td><?php echo $form->labelEx($model, 'fechagestion'); ?>
                            <?php echo $form->textField($model, 'fechagestion', array('class' => 'txtfechagestion')) ?>
                            <?php echo $form->error($model, 'fechagestion'); ?>
                        </td>
                        <td>
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
                        </td>
                        <td><?php echo $form->labelEx($model, 'precisionVisita'); ?>
                            <?php
                            echo $form->dropDownList(
                                    $model, 'precisionVisitas', array(
                                '5' => '5',
                                '10' => '10',
                                '15' => '15',
                                '25' => '25',
                                '50' => '50',
                                '100' => '100'
                                    ), array(
                                'empty' => TEXT_OPCION_SELECCIONE, 'options' => array(0 => array('selected' => true)))
                            );
                            ?>
                            <?php echo $form->error($model, 'precisionVisitas'); ?>
                        </td>
                        
                    </tr>
                </table>
            </div>
            <div class="">
                <?php // echo CHtml::submitButton('Cargar', array('id' => 'btnCargar'));  ?>
                <?php
                echo CHtml::ajaxSubmitButton(
                        'Revisar historial', CHtml
                        ::normalizeUrl(array('rptResumenDiarioHistorial/revisarhistorial', 'render' => true)), array(
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
                             //console.log(JSON.stringify(datosResult[\'detalle\']));
                             //console.log(datosResult.toSource());
                            $("#tblGrid").setGridParam({datatype: \'jsonstring\', datastr: datosResult[\'detalle\']}).trigger(\'reloadGrid\');
                            $("#tblResumenIzquierda").setGridParam({datatype: \'jsonstring\', datastr: datosResult[\'resumenIzquierda\']}).trigger(\'reloadGrid\');
                            $("#tblResumenDerecha").setGridParam({datatype: \'jsonstring\', datastr: datosResult[\'resumenDerecha\']}).trigger(\'reloadGrid\');
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
                <?php echo CHtml::Button('Exportar Detalle', array('id' => 'btnExcel', 'class' => 'btn btn-theme')); ?>
                <?php // echo CHtml::button('Guardar', array('submit' => array('rptResumenDiarioHistorial/guardarhistorial'))); ?>
            </div>


            <?php $this->endWidget(); ?>

        </div>
    </div>     
</section>

<!--<div id="resumenAnalisis">
    <section class="">
        <header class="">
            <h2><strong>Resumen Pivot</strong></h2>
        </header>
        <div class="">
<?php // $this->renderPartial('/shared/_bodygridResumenPivot'); ?>
        </div>
    </section>
</div>-->
<table>
    <tr>
        <td><div id="resumenAnalisis">
                <h2><strong>Parametros</strong></h2>
                <div class="">
                    <div id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent">
                        <table id="tblResumenIzquierda" class="table table-condensed"></table>
                    </div>
                </div>
        </td>
        <td valign="top"><div id="resumenAnalisis">
                <h2><strong>Visitas validas/invalidas</strong></h2>
                <div class="">
                    <div id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent">
                        <table id="tblResumenDerecha" class="table table-condensed"></table>
                    </div>
                </div>
            </div>
        </td></tr>
</table>
<br><br>
<div id="detalleAnalisis" >
    <section class="">
        <header class="">
            <h2><strong>Detalle Analisis</strong></h2>
        </header>
        <div class="">
            <?php $this->renderPartial('/shared/_bodygrid'); ?>
        </div>
    </section>
</div>
