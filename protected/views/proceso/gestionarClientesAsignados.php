<?php
$pagina_nombre = 'Gestion Clientes';
$this->breadcrumbs = array($pagina_nombre => array('index'));
$this->renderPartial('/shared/_blockUI');
$this->renderPartial('/shared/_headgrid', array('metodo' => '"VerDatosArchivo"'));
$this->pageTitle = $pagina_nombre;
?>
<style> 
    /*PERMITE QUE EL CONTENIDO DE LAS CELDAS HAGAN WRAPPING --COMENTARIOS*/
    .ui-jqgrid tr.jqgrow td {
        white-space: normal !important;
        height:auto;
        vertical-align:text-top;
        padding-top:2px;
    }
</style>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl . "/js/proceso/GestionarClientesAsignados.js"; ?>"></script>

<?php if (Yii::app()->user->hasFlash('resultadoGuardar')): ?>
    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('resultadoGuardar'); ?>
    </div>
<?php else: ?>
    <div class=""></div>
<?php endif; ?>

<!--GRID RUTAS Y CLIENTES ASIGNADOS-->
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-body no-padding">
                <?php
                echo CHtml::submitButton('Buscar asignaciones', array(
                    'id' => 'btnBuscarAsignaciones',
                    'class' => 'btn btn-success'));
                ?>
                <div  style="display: flex; justify-content: flex-start;">
                    <div id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent">
                        <table id="tblRutasAgente" class="table table-condensed"></table>
                        <!--<div id="pagGridRutasAgente"> </div>--> 
                    </div>
                    <div style="margin-left: 10px" id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent">
                        <table id="tblClientesRuta" class="table table-condensed"></table>
                        <div id="pagGridClientesRuta"> </div> 
                    </div>
                </div>
                <!--<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#modal-wizard">Open Modal</button>-->
            </div>
        </div>
    </div>
</div>

<!--DATOS CLIENTE-->
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-body">
                <div class="col-md-6">
                    <div class="form-group col-md-12">
                        <label class="col-sm-3 control-label" for="nombre">Cliente</label>
                        <div class="col-sm-9">
                            <input class="form-control" disabled="true" type="text" name="txtCodigoCliente" id="txtCodigoCliente">
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="col-sm-3 control-label" for="estadoAnterior">Estado Anterior</label>
                        <div class="col-sm-9">
                            <input class="form-control" disabled="true" type="text" name="txtEstadoAnterior" id="txtEstadoAnterior">
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="col-sm-3 control-label" for="contactos">Contactos</label>
                        <div class="col-sm-9">
                            <input class="form-control" disabled="true" type="text" name="txtContactosCliente" id="txtContactosCliente">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group col-md-12">
                        <label class="col-sm-3 control-label" for="nombre">Nombre</label>
                        <div class="col-sm-9">
                            <input class="form-control" disabled="true" type="text" name="txtNombreCliente" id="txtNombreCliente">
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="col-sm-3 control-label" for="estadoAnterior">Novedades</label>
                        <div class="col-sm-9">
                            <input class="form-control" disabled="true" type="text" name="txtNovedadesCliente" id="txtNovedadesCliente">
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="col-sm-3 control-label" for="contactos">Chips Venta</label>
                        <div class="col-sm-9">
                            <input class="form-control" disabled="true" type="text" name="txtChipsVenta" id="txtChipsVenta">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--PREGUNTAS ENCUESTA-->
<div class="row">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'frmLoad',
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
        'htmlOptions' => array("enctype" => "multipart/form-data"),
    ));
    ?>
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-body">
                <!--COLUMNA IZQUIERDA-->
                <div class="col-md-6">
                    <!--PREGUNTA 1-->
                    <div class="row">
                        <div class="form-group col-md-12">
                            <?php echo $form->labelEx($model, 'pregunta1', array('class' => 'col-sm-5 control-label')); ?>
                            <div class="col-sm-6">
                                <?php
                                echo $form->dropDownList(
                                        $model, 'pregunta1'
                                        , array(
                                    '1' => 'Contactado',
                                    '2' => 'No Contactado'
                                        )
                                        , array(
                                    'empty' => TEXT_OPCION_SELECCIONE,
                                    'options' => array(0 => array('selected' => true)),
                                    'class' => 'form-control select2'
                                        )
                                );
                                ?>
                                <div class="form-group has-error">
                                    <?php echo $form->error($model, 'pregunta1', array('class' => 'help-block')); ?>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!--PREGUNTA 1A-->
                    <div class="row" style="display: none" id="divPregunta1a">
                        <div class="form-group col-md-12">
                            <?php echo $form->labelEx($model, 'pregunta1a', array('class' => 'col-sm-5 control-label')); ?>
                            <div class="col-sm-6">
                                <?php
                                echo $form->dropDownList(
                                        $model, 'pregunta1a'
                                        , array(
                                    '1' => 'Numero incorrecto',
                                    '2' => 'No contesta',
                                    '3' => 'Sin numeros de contacto',
                                    '4' => 'Buzon de mensajes',
                                        )
                                        , array(
                                    'empty' => TEXT_OPCION_SELECCIONE,
                                    'options' => array(0 => array('selected' => true)),
                                    'class' => 'form-control select2',
//                                    'disabled' => 'disabled',
                                        )
                                );
                                ?>
                                <div class="form-group has-error">
                                    <?php echo $form->error($model, 'pregunta1a', array('class' => 'help-block')); ?>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!--PREGUNTA 2-->
                    <div class="row"  style="display: none" id="divPregunta2">
                        <div class="form-group col-md-12">
                            <?php echo $form->labelEx($model, 'pregunta2', array('class' => 'col-sm-5 control-label')); ?>
                            <div class="col-sm-6">
                                <?php
                                echo $form->dropDownList(
                                        $model, 'pregunta2'
                                        , array(
                                    '1' => 'Dueno',
                                    '2' => 'Empleado'
                                        )
                                        , array(
                                    'empty' => TEXT_OPCION_SELECCIONE,
                                    'options' => array(0 => array('selected' => true)),
                                    'class' => 'form-control select2',
//                                    'disabled' => 'disabled',
                                        )
                                );
                                ?>
                                <div class="form-group has-error">
                                    <?php echo $form->error($model, 'pregunta2', array('class' => 'help-block')); ?>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!--PREGUNTA 3-->
                    <div class="row"  style="display: none" id="divPregunta3">
                        <div class="form-group col-md-12">
                            <?php echo $form->labelEx($model, 'pregunta3', array('class' => 'col-sm-5 control-label')); ?>
                            <div class="col-sm-6">
                                <?php
                                echo $form->dropDownList(
                                        $model, 'pregunta3'
                                        , array(
                                    '1' => 'SI',
                                    '2' => 'NO'
                                        )
                                        , array(
                                    'empty' => TEXT_OPCION_SELECCIONE,
                                    'options' => array(0 => array('selected' => true)),
                                    'class' => 'form-control select2',
//                                    'disabled' => 'disabled',
                                        )
                                );
                                ?>
                                <div class="form-group has-error">
                                    <?php echo $form->error($model, 'pregunta3', array('class' => 'help-block')); ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--PREGUNTA 4-->
                    <div class="row"  style="display: none" id="divPregunta4">
                        <div class="form-group col-md-12">
                            <?php echo $form->labelEx($model, 'pregunta4', array('class' => 'col-sm-5 control-label')); ?>
                            <div class="col-sm-6">
                                <?php
                                echo $form->dropDownList(
                                        $model, 'pregunta4'
                                        , array(
                                    '1' => 'SI',
                                    '2' => 'NO'
                                        )
                                        , array(
                                    'empty' => TEXT_OPCION_SELECCIONE,
                                    'options' => array(0 => array('selected' => true)),
                                    'class' => 'form-control select2',
//                                    'disabled' => 'disabled',
                                        )
                                );
                                ?>
                                <div class="form-group has-error">
                                    <?php echo $form->error($model, 'pregunta4', array('class' => 'help-block')); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--COLUMNA DERECHA-->
                <div class="col-md-6">
                    <!--PREGUNTA 5-->
                    <div class="row" style="display: none" id="divPregunta5">
                        <div class="col-md-4">
                            <?php echo $form->labelEx($model, 'pregunta5', array('class' => 'control-label')); ?>
                        </div>
                        <div class="col-md-8">
                            <table id="tblTelefonosCliente" class="table table-condensed"></table>
                            <div id="pagTelefonosCliente"> </div> 
                        </div>

                    </div><br>

                    <!--PREGUNTA 6-->
                    <div class="row" style="display: none" id="divPregunta6">
                        <div class="col-md-4">
                            <?php echo $form->labelEx($model, 'pregunta6', array('class' => 'control-label')); ?>
                        </div>
                        <div class="col-md-8">
                            <table id="tblNovedadesNoCompraChip" class="table table-condensed"></table>
                        </div>
                    </div>
                </div>
                <div class="col-md-12" style="display: none" id="divReportarNovedad">
                    <h3>Reportar Novedad</h3>
                    <div class="col-md-8">
                        <table id="tblNovedadesIncidentes" class="table table-condensed"></table>
                    </div>
                </div>
                <div class="col-md-12" style="display: none" id="divObservacionGeneral">
                    <?php echo $form->labelEx($model, 'pregunta7', array('class' => '')); ?>
                    <!--</div>-->
                    <!--<div class="col-md-8">-->
                    <?php
                    echo $form->textArea(
                            $model, 'pregunta7', array(
                        'class' => 'form-control',
                        'maxlength' => 500,
                        'rows' => 3,
                        'cols' => 100,
                        'style' => 'resize:none',
//                        'disabled' => 'disabled',
                    ));
                    ?>
                    <div class="form-group has-error">
                        <?php echo $form->error($model, 'pregunta4', array('class' => 'help-block')); ?>
                    </div>
                </div>              
            </div>

            <div class="box-body">
                <div class="col-md-2">
                    <?php
                    echo CHtml::ajaxSubmitButton(
                            'Guardar Gestion', CHtml
                            ::normalizeUrl(array('GestionarClientesAsignados/GuardarGestion', 'render' => true)), array(
                        'dataType' => 'json',
                        'type' => 'post',
                        'beforeSend' => 'function() {blockUIOpen();}',
                        'success' => 'function(data) {
                        
                        blockUIClose();
                        setMensaje(data.ClassMessage, data.Message);
                        if(data.Status==1){
                             var datosResult = data.Result;

                            $("#tblGridDetalle").setGridParam({datatype: \'jsonstring\', datastr: datosResult[\'detalle\']}).trigger(\'reloadGrid\');
                            $("#tblResumenGeneral").setGridParam({datatype: \'jsonstring\', datastr: datosResult[\'resumenGeneral\']}).trigger(\'reloadGrid\');
                            $("#tblResumenVisitas").setGridParam({datatype: \'jsonstring\', datastr: datosResult[\'resumenVisitas\']}).trigger(\'reloadGrid\');
                            $("#tblResumenVisitasValidasInvalidas").setGridParam({datatype: \'jsonstring\', datastr: datosResult[\'resumenVisitasValidasInvalidas\']}).trigger(\'reloadGrid\');
                            $("#tblPrimeraUltimaVisita").setGridParam({datatype: \'jsonstring\', datastr: datosResult[\'resumenPrimeraUltima\']}).trigger(\'reloadGrid\');
                            $("#tblResumenVentas").setGridParam({datatype: \'jsonstring\', datastr: datosResult[\'resumenVentas\']}).trigger(\'reloadGrid\');
                            $("#tblResumenTiempos").setGridParam({datatype: \'jsonstring\', datastr: datosResult[\'resumenTiempos\']}).trigger(\'reloadGrid\');
                           
                            $("#d_comentariosSupervision").val(datosResult[\'comentarioSupervisor\']);;

                            $("#RptResumenDiarioHistorialForm_enlaceMapa").val(datosResult[\'enlaceMapa\']);
                            mostrarVisitasEnMapa2(datosResult[\'coordenadasClientes\'],datosResult[\'coordenadasVisitas\']);
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
                        }')
                            , array('id' => 'btnGenerate'
                        , 'class' => 'btn btn-block btn-success btn-sm'));
                    ?>
                </div> 
                <div class="col-md-2">
                    <?php
                    echo CHtml::Button(
                            'Limpiar'
                            , array('id' => 'btnLimpiar'
                        , 'class' => 'btn btn-block btn-primary btn-sm'));
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="box box-primary box-body">
            <div class="col-md-12">
                <h3>Historial Novedades</h3>
                <table id="tblHistorialNovedades" class="table table-condensed"></table>
                <div id="pagHistorialNovedades"> </div>
            </div>
        </div>
    </div>

</div>
<?php $this->endWidget(); ?>