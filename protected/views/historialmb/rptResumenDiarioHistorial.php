<?php
//session_start();
$this->breadcrumbs = array('Resumen diario historial ejecutivo',);
$this->renderPartial('/shared/_blockUI');
$this->renderPartial('/shared/_headgrid', array('metodo' => '"ConfigurarGrid"'));
?>

<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/datepicker.css" />
<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/datepicker3.css" />

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/bootstrap-datepicker.es.js"></script>

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl . "/js/RptResumenDiarioHistorial.js"; ?>"></script>

<?php if (Yii::app()->user->hasFlash('resultadoGuardar')): ?>
    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('resultadoGuardar'); ?>
    </div>

<?php else: ?>
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
                            <!--<td>-->
                            <?php // echo $form->labelEx($model, 'comentarioSupervision'); ?>
                            <?php echo $form->hiddenField($model, 'comentarioSupervision') ?>
                            <?php // echo $form->error($model, 'comentarioSupervision'); ?>
                            <!--</td>-->
                            <td><?php echo $form->labelEx($model, 'fechagestion'); ?>
                                <?php echo $form->textField($model, 'fechagestion', array('class' => 'txtfechagestion')) ?>
                                <?php echo $form->error($model, 'fechagestion'); ?>
                            </td>
                            <td><?php
                                echo $form->labelEx($model, 'horaInicioGestion');
                                echo $form->dropDownList(
                                        $model, 'horaInicioGestion', array(
                                    '10:00' => '10:00'
                                        )
                                        //, array("disabled" => "disabled",)
                                );

                                echo $form->error($model, 'horaInicioGestion');
                                ?>
                            </td>
                            <td><?php
                                echo $form->labelEx($model, 'horaFinGestion');
                                echo $form->dropDownList(
                                        $model, 'horaFinGestion', array(
                                    '23:59' => 'Sin limite',
                                    '17:00' => '17:00',
                                    '17:00' => '17:30',
                                    '18:00' => '18:00',
                                    '18:30' => '18:30',
                                    '19:00' => '19:00',
                                    '19:30' => '19:30',
                                    '20:00' => '20:00',
                                    '20:30' => '20:30',
                                    '21:00' => '21:00',
                                    '21:30' => '21:30',
                                    '22:00' => '22:00',
                                    '22:30' => '22:30',
                                    '23:00' => '23:00',
                                    '23:30' => '23:30',
                                        )
                                );

                                echo $form->error($model, 'horaFinGestion');
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?php
                                echo $form->labelEx($model, 'ejecutivo');
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
                                echo $form->error($model, 'ejecutivo');
                                ?>
                            </td>
                            <td><?php echo $form->labelEx($model, 'precisionVisita'); ?>
                                <?php
                                echo $form->dropDownList(
                                        $model, 'precisionVisitas'
                                        , array(
                                    '0' => 'Sin limite',
                                    '5' => '5 metros',
                                    '10' => '10 metros',
                                    '15' => '15 metros',
                                    '20' => '20 metros',
                                    '25' => '25 metros',
                                    '50' => '50 metros',
                                    '100' => '100 metros'
                                        )
//                                    , array('empty' => TEXT_OPCION_SELECCIONE, 'options' => array(0 => array('selected' => true)))
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
                            $("#tblGridDetalle").setGridParam({datatype: \'jsonstring\', datastr: datosResult[\'detalle\']}).trigger(\'reloadGrid\');
                            $("#tblResumenGeneral").setGridParam({datatype: \'jsonstring\', datastr: datosResult[\'resumenGeneral\']}).trigger(\'reloadGrid\');
                            $("#tblResumenVisitas").setGridParam({datatype: \'jsonstring\', datastr: datosResult[\'resumenVisitas\']}).trigger(\'reloadGrid\');
                            $("#tblResumenVisitasValidasInvalidas").setGridParam({datatype: \'jsonstring\', datastr: datosResult[\'resumenVisitasValidasInvalidas\']}).trigger(\'reloadGrid\');
                            $("#tblPrimeraUltimaVisita").setGridParam({datatype: \'jsonstring\', datastr: datosResult[\'resumenPrimeraUltima\']}).trigger(\'reloadGrid\');
                            $("#tblResumenVentas").setGridParam({datatype: \'jsonstring\', datastr: datosResult[\'resumenVentas\']}).trigger(\'reloadGrid\');
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
                        }'), array('id' => 'btnGenerate', 'class' => 'btn btn-theme'));
                    ?>
                    <?php echo CHtml::Button('Limpiar', array('id' => 'btnLimpiar', 'class' => 'btn btn-theme')); ?>

                    <?php
//                    var_dump($model);die();
//                    CHtml::submitButton('Save', array('confirm'=>'Are you sure you want to save?'));

                    echo CHtml::button('Guardar Revision', array('submit' => array('rptResumenDiarioHistorial/GuardarRevision')));
                    ?>
                    <?php echo CHtml::Button('Exportar Resumen', array('id' => 'btnExcelResumen', 'class' => 'btn btn-theme')); ?>
                </div>
                <?php $this->endWidget(); ?>

            </div>
        </div>     
    </section>

    <div>
        <div>
            <div class="">
                <div id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent">
                    <table id="tblResumenGeneral" class="table table-condensed"></table>
                </div>
            </div>
        </div><br>
        <div  style="display: flex; justify-content: flex-start;">
            <div id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent">
                <table id="tblResumenVisitas" class="table table-condensed"></table>
            </div>
            <div style="margin-left: 50px" id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent">
                <table id="tblResumenVisitasValidasInvalidas" class="table table-condensed"></table>
            </div>
            <div style="margin-left: 50px" id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent">
                <table id="tblPrimeraUltimaVisita" class="table table-condensed"></table>
            </div>
        </div><br>
        <div  style="display: flex; justify-content: flex-start;">
            <div id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent">
                <table id="tblResumenVentas" class="table table-condensed"></table>                
            </div>

            <div  style="margin-left: 50px"  id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent">
                <h1>Comentario del supervisor de zona:</h1>
                <?php
                echo CHtml::textArea(
                        'd_comentarioSupervision', '', array('onblur' => 'copiarValores(document.getElementById(\'d_comentarioSupervision\').value)', 'id' => 'd_comentarioSupervision', 'cols' => 70, 'rows' => 3, 'maxlength' => 250)
                );
                ?>                    
            </div>

        </div>
    </div>
    </div>
    <br/> <?php echo CHtml::Button('Exportar Detalle', array('id' => 'btnExcel', 'class' => 'btn btn-theme')); ?>
    <br>    
    <!--<div id="grilla" class="_grilla">-->
    <div id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent">
        <table id="tblGridDetalle" class="table table-condensed"></table>
        <div id="pagGrid"> </div>
    </div>
<?php endif; ?>

<script>
    function copiarValores($valor) {
//        alert($valor);
        $("#RptResumenDiarioHistorialForm_comentarioSupervision").val($valor);
    }
</script>