<?php
$pagina_nombre = 'Analisis diario ejecutivo';
$this->breadcrumbs = array($pagina_nombre => array('index'));
$this->renderPartial('/shared/_blockUI');
$this->renderPartial('/shared/_headgrid', array('metodo' => '"VerDatosArchivo"'));
$this->pageTitle = $pagina_nombre;
?>

<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/datepicker.css" />
<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/datepicker3.css" />

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/bootstrap-datepicker.es.js"></script>

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl . "/js/reporte/RptResumenDiarioHistorial.js"; ?>"></script>
<script type="text/javascript" language="javascript" src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>

<!--<div class="row">
    <div class="col-md-3">
<?php
$periodoAbierto = FPeriodoGestionModel::getPeriodoActivoNotificacion();
if ($periodoAbierto != '') :
    ?>
                                                                                                                                                                                                        <div class="callout callout-info">
                                                                                                                                                                                                            <center>
                                                                                                                                                                                                                <p>Periodo semanal abierto : <br/><b><?php echo $periodoAbierto; ?>
                                                                                                                                                                                                                    </b></p>
                                                                                                                                                                                                            </center>
                                                                                                                                                                                                        </div>
<?php else: ?>
                                                                                                                                                                                                        <div class="callout callout-danger">
                                                                                                                                                                                                            <center>
                                                                                                                                                                                                                <p><b>** NO EXISTE PERIODO SEMANAL ABIERTO **</b></p>
                                                                                                                                                                                                            </center>
                                                                                                                                                                                                        </div>
<?php endif; ?>

    </div>
    historial
    <div class="col-md-3">
<?php
$ultimaCargaHistorial = FHistorialModel::getFechaUltimaCarga();
?>
        <div class="callout small-box bg-blue">
            <center>
                <p>Ultima carga historial : <br/><b><?php echo $ultimaCargaHistorial; ?>
                    </b></p>
            </center>
        </div>

    </div>
    rutas
    <div class="col-md-3">
<?php
$ultimaCargaRuta = FRutaModel::getFechaUltimaCarga();
?>
        <div class="callout small-box bg-yellow">
            <center>
                <p>Ultima carga ruta : <br/><b><?php echo $ultimaCargaRuta; ?>
                    </b></p>
            </center>
        </div>

    </div>

    <div class="col-md-3">
<?php
$ultimaCargaOrdenes = FOrdenModel::getFechaUltimaCarga();
?>
        <div class="callout small-box bg-green">
            <center>
                <p>Ultima carga ordenes: <br/><b><?php echo $ultimaCargaOrdenes; ?>
                    </b></p>
            </center>
        </div>

    </div>
</div>-->

<div class="nav-tabs-custom">
    <div class="btn-group">
        <button type="button" title="Revisar carga" class="btn btn-default" data-toggle="modal" data-target="#modal-cargas">
            <i class="fa fa-align-left"></i>
        </button>
    </div>
    <div class="modal fade" id="modal-cargas">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Informacion Carga</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <?php
                            $periodoAbierto = FPeriodoGestionModel::getPeriodoActivoNotificacion();
                            if ($periodoAbierto != '') :
                                ?>
                                <div class="callout callout-info">
                                    <center>
                                        <p>Periodo semanal abierto : <br/><b><?php echo $periodoAbierto; ?>
                                            </b></p>
                                    </center>
                                </div>
                            <?php else: ?>
                                <div class="callout callout-danger">
                                    <center>
                                        <p><b>** NO EXISTE PERIODO SEMANAL ABIERTO **</b></p>
                                    </center>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <?php
                            $ultimaCargaHistorial = FHistorialModel::getFechaUltimaCarga();
                            ?>
                            <div class="callout small-box bg-blue">
                                <center>
                                    <p>Ultima carga historial : <br/><b><?php echo $ultimaCargaHistorial; ?>
                                        </b></p>
                                </center>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <?php
                            $ultimaCargaRuta = FRutaModel::getFechaUltimaCarga();
                            ?>
                            <div class="callout small-box bg-yellow">
                                <center>
                                    <p>Ultima carga ruta : <br/><b><?php echo $ultimaCargaRuta; ?>
                                        </b></p>
                                </center>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <?php
                            $ultimaCargaOrdenes = FOrdenModel::getFechaUltimaCarga();
                            ?>
                            <div class="callout small-box bg-green">
                                <center>
                                    <p>Ultima carga ordenes: <br/><b><?php echo $ultimaCargaOrdenes; ?>
                                        </b></p>
                                </center>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <!--<button type="button" class="btn btn-primary">Save changes</button>-->
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </div>
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_1" data-toggle="tab">Revision jornada</a></li>
        <li><a href="#tab_2" data-toggle="tab">Revision individual</a></li>
        <li><a href="#tab_3" data-toggle="tab">Control Capilaridad y Sell-In</a></li>
        <li><a href="#tab_4" data-toggle="tab">Control Altas</a></li>
        <li><a href="#tab_5" data-toggle="tab">Notificacion Altas FZ</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tab_1">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1_1" data-toggle="tab">Jornada individual</a></li>
                    <li><a href="#tab_1_2" data-toggle="tab">Jornada mensual</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1_1">
                        <div class="box-solid">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="btn-group">
                                        <button type="button" title="Filtrar" class="btn btn-default" data-toggle="modal" data-target="#modal-filtros">
                                            <i class="fa fa-filter"></i>
                                        </button>
                                    </div>
                                    <div class="modal fade" id="modal-filtros">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title">Filtros</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <?php
                                                    $form = $this->beginWidget('CActiveForm', array('id' => 'frmLoad', 'enableClientValidation' => true, 'clientOptions' => array('validateOnSubmit' => true,), 'htmlOptions' => array("enctype" => "multipart/form-data"),));
                                                    ?>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <i class="fa fa-calendar"></i>
                                                            <?php echo $form->labelEx($model, 'fechaInicioFinJornada'); ?>
                                                            <?php
                                                            echo $form->textField(
                                                                    $model
                                                                    , 'fechaInicioFinJornada'
                                                                    , array(
                                                                'class' => 'txtfechaInicioFinJornadaInicio form-control'));
                                                            ?>
                                                            <?php echo $form->error($model, 'fechaInicioFinJornada'); ?>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <i class="fa fa-user"></i>
                                                            <?php
                                                            echo $form->labelEx($model, 'tipoUsuarioJornada');
                                                            echo $form->dropDownList(
                                                                    $model
                                                                    , 'tipoUsuarioJornada'
                                                                    , array(
                                                                'T' => 'Todos',
                                                                GRUPO_EJECUTIVOS_ZONA_MOVI => 'Ejecutivos Zona Movi',
                                                                GRUPO_EJECUTIVOS_ZONA_TUENTI => 'Ejecutivos Zona Tuenti',
                                                                GRUPO_SUPERVISORES_MOVI => 'Supervisores Movistar',
                                                                GRUPO_SUPERVISORES_TUENTI => 'Supervisores Tuenti',
                                                                GRUPO_SERVICIO_CLIENTE => 'Servicio Cliente',
                                                                GRUPO_DESARROLLADORES => 'Desarrolladores',
                                                                GRUPO_TECNICOS => 'Tecnico ',
                                                                    )
                                                                    , array('class' => 'form-control select2')
                                                            );
                                                            echo $form->error($model, 'tipoUsuarioJornada');
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <i class="fa fa-clock-o"></i>
                                                            <?php
                                                            echo $form->labelEx($model, 'horaInicioGestionJornada');
                                                            echo $form->dropDownList(
                                                                    $model, 'horaInicioGestionJornada', array(
                                                                '01:00' => '01:00',
                                                                '02:00' => '02:00',
                                                                '03:00' => '03:00',
                                                                '04:00' => '04:00',
                                                                '05:00' => '05:00',
                                                                '06:00' => '06:00',
                                                                '07:00' => '07:00',
                                                                '08:00' => '08:00',
                                                                '09:00' => '09:00',
                                                                '10:00' => '10:00',
                                                                '11:00' => '11:00',
                                                                '12:00' => '12:00'
                                                                    )
                                                                    , array('options' => array('08:00' => array('selected' => true))
                                                                , 'class' => 'form-control select2')
                                                            );

                                                            echo $form->error($model, 'horaInicioGestionJornada');
                                                            ?>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <i class="fa fa-clock-o"></i>
                                                            <?php
                                                            echo $form->labelEx($model, 'horaFinGestionJornada');
                                                            echo $form->dropDownList(
                                                                    $model, 'horaFinGestionJornada', array(
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
                                                                    , array('options' => array('23:59' => array('selected' => true))
                                                                , 'class' => 'form-control select2')
                                                            );

                                                            echo $form->error($model, 'horaFinGestionJornada');
                                                            ?>
                                                        </div>
                                                    </div>


                                                    <div class="modal-footer">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <?php
                                                                echo CHtml::ajaxSubmitButton(
                                                                        'Consultar'
                                                                        , CHtml::normalizeUrl(array(
                                                                            'RptResumenDiarioHistorial/ObtenerTiemposGestionTraslado'
                                                                            , 'render' => true))
                                                                        , array(
                                                                    'dataType' => 'json',
                                                                    'type' => 'post',
                                                                    'beforeSend' => 'function() {blockUIOpen();}',
                                                                    'success' => 'function(data) {
                        blockUIClose();
                        //setMensaje(data.ClassMessage, data.Message);
                        if(data.Status==1){
                            var datosResult = data.Result;
                            $("#tblGridResumenJornada").setGridParam({datatype: \'jsonstring\', datastr: datosResult[\'infoJornada\']}).trigger(\'reloadGrid\');
                            
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
                                                                        ), array(
                                                                    'id' => 'btnGenerar'
                                                                    , 'class' => 'btn btn-block btn-success btn-sm'
                                                                    , "data-dismiss" => 'modal'
                                                                ));
                                                                ?>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <?php
                                                                echo CHtml::Button(
                                                                        'Limpiar', array('id' => 'btnLimpiar'
                                                                    , 'class' => 'btn btn-block btn-primary btn-sm'
                                                                    , "data-dismiss" => 'modal'
                                                                ));
                                                                ?>
                                                            </div>
                                                           <?php $this->endWidget(); ?>
                                                        </div>
                                                        <!-- /.modal-content -->
                                                    </div>
                                                    <!-- /.modal-dialog -->
                                                </div>
                                            </div>
                                            <!-- /.FIN MODAL -->
                                        </div>
                                    </div>
                                    <br/>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="box box-primary">
                                                <div class="box-body no-padding">
                                                    <div id="grilla" class="_grilla">
                                                        <table id="tblGridResumenJornada" class="table table-condensed"></table>
                                                        <div id="pagGridResumenJornada"> </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="tab_1_2">
                        <div class="box-solid">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                                <label><?php echo $form->labelEx($model, 'tipoFechaJornadaPeriodo'); ?></label>
                                            </span>
                                            <?php
                                            echo $form->dropDownList(
                                                    $model, 'tipoFechaJornadaPeriodo'
                                                    , array(
                                                'P' => 'Periodo',
                                                'RF' => 'Rango fecha mes',)
                                                    , array('class' => 'form-control select2')
//                                        , array('empty' => TEXT_OPCION_SELECCIONE, 'options' => array(0 => array('selected' => true)))
                                            );
                                            ?>

                                        </div>
                                        <div class="form-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                                <label> <?php echo $form->labelEx($model, 'tipoUsuarioPeriodo'); ?></label>
                                            </span>
                                            <?php
                                            echo $form->dropDownList(
                                                    $model, 'tipoUsuarioPeriodo', array(
                                                'T' => 'Todos',
                                                'SE' => 'Seleccionar ejecutivo',
                                                GRUPO_EJECUTIVOS_ZONA_MOVI => 'Ejecutivos Zona',
                                                GRUPO_SUPERVISORES_MOVI => 'Supervisores',
                                                GRUPO_SERVICIO_CLIENTE => 'Servicio Cliente',
                                                GRUPO_DESARROLLADORES => 'Desarrolladores',
                                                GRUPO_TECNICOS => 'Tecnico',
                                                    ), array('class' => 'form-control select2')
                                            );
                                            ?>

                                        </div>
                                        <div class="form-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-clock-o"></i>
                                                <label><?php echo $form->labelEx($model, 'horaInicioJornadaPeriodo'); ?></label>
                                            </span>
                                            <?php
                                            echo $form->dropDownList(
                                                    $model, 'horaInicioJornadaPeriodo', array(
                                                '01:00' => '01:00',
                                                '02:00' => '02:00',
                                                '03:00' => '03:00',
                                                '04:00' => '04:00',
                                                '05:00' => '05:00',
                                                '06:00' => '06:00',
                                                '07:00' => '07:00',
                                                '08:00' => '08:00',
                                                '09:00' => '09:00',
                                                '10:00' => '10:00',
                                                '11:00' => '11:00',
                                                '12:00' => '12:00',)
                                                    , array('class' => 'form-control select2')
//                                        , array('empty' => TEXT_OPCION_SELECCIONE, 'options' => array(0 => array('selected' => true)))
                                            );
                                            ?>

                                        </div>

                                        <div class="form-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-clock-o"></i>
                                                <label><?php echo $form->labelEx($model, 'horaFinJornadaPeriodo'); ?></label>
                                            </span>
                                            <?php
                                            echo $form->dropDownList(
                                                    $model, 'horaFinJornadaPeriodo', array(
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
                                                '23:30' => '23:30',)
                                                    , array('class' => 'form-control select2')
//                                        , array('empty' => TEXT_OPCION_SELECCIONE, 'options' => array(0 => array('selected' => true)))
                                            );
                                            ?>
                                        </div>
                                    </div>    
                                </div>
                                <!--                                <div class="col-md-3">
                                                                     
                                                                </div>-->
                                <div class="col-md-9">
                                    <div class="box-body no-padding">                                
                                        <div  style="display: flex; justify-content: flex-start;">
                                            <div class="table-responsive mailbox-messages">
                                                <div  style="display: flex; justify-content: flex-start;">
                                                    <div id="grilla_periodos_mensuales" 
                                                         class="_grilla panel panel-shadow" 
                                                         style="background-color: transparent">
                                                        <table id="tblGridPeriodosMensuales" class="table table-condensed"></table>
                                                    </div>
                                                    <div id="grilla_fecha_inicio_fin" 
                                                         class="_grilla panel panel-shadow" 
                                                         style="background-color: transparent; display:none">
                                                        <div class="box box-info">
                                                            <div class="box-header with-border">
                                                                <h3 class="box-title">Seleccione las Fechas de Inicio y Fin</h3>
                                                            </div>
                                                            <div class="box-body">
                                                                <div class="input-group">
                                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                                    <?php
                                                                    echo $form->textField(
                                                                            $model
                                                                            , 'fechaInicioJornadaPeriodo'
                                                                            , array(
                                                                        'class' => 'txtfechaInicioJornadaPeriodo form-control', 'placeholder' => 'Fecha Inicio'));
                                                                    ?>
                                                                </div>
                                                                <br>
                                                                <div class="input-group">
                                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                                    <?php echo $form->textField($model, 'fechaFinJornadaPeriodo', array('class' => 'txtfechaFinJornadaPeriodo form-control', 'placeholder' => 'Fecha Fin')); ?>
                                                                </div>
                                                                <br>
                                                                <div class="input-group">
                                                                    <?php
                                                                    echo CHtml::submitButton(
                                                                            'Revisar Gestion Periodo', array(
                                                                        'id' => 'btnBuscarRevisarGestionRangoFecha'
                                                                        , 'class' => 'btn btn-block btn-primary btn-sm'
                                                                    ));
                                                                    ?>                                                                        
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div style="margin-left: 10px;
                                                         background-color: transparent ;
                                                         display:none" 
                                                         id="grilla_sel_ejecutivos" 
                                                         class="_grilla panel panel-shadow" >
                                                        <table id="tblEjecutivosPeriodo" class="table table-condensed"></table>
                                                        <div id="pagtEjecutivosPeriodo"> </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div id="gridPivotGestionMes">
                                            <table id="tblGestionMes" class="table table-condensed"></table>
                                            <div id="pagtblGestionMes"> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="tab-pane" id="tab_2">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-3">
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
                        <!--mailbox-controls-->
                        <div class="mailbox-controls">
                            <div class="btn-group">
                                <?php
                                echo CHtml::ajaxSubmitButton(
                                        'Revisar historial', CHtml
                                        ::normalizeUrl(array(
                                            'rptResumenDiarioHistorial/revisarhistorial'
                                            , 'render' => true))
                                        , array(
                                    'dataType' => 'json',
                                    'type' => 'post',
                                    'beforeSend' => 'function() {blockUIOpen();}',
                                    'success' => 'function(data) {
                        
                        blockUIClose();
                        setMensaje(data.ClassMessage, data.Message);
                        if(data.Status==1){
                             var datosResult = data.Result;
                            if(datosResult[\'estadoGeneracion\'])
                            {
                                $("#tblGridDetalle").setGridParam({datatype: \'jsonstring\', datastr: datosResult[\'detalle\']}).trigger(\'reloadGrid\');
                                $("#tblResumenGeneral").setGridParam({datatype: \'jsonstring\', datastr: datosResult[\'resumenGeneral\']}).trigger(\'reloadGrid\');
                                $("#tblResumenVisitas").setGridParam({datatype: \'jsonstring\', datastr: datosResult[\'resumenVisitas\']}).trigger(\'reloadGrid\');
                                $("#tblResumenVisitasValidasInvalidas").setGridParam({datatype: \'jsonstring\', datastr: datosResult[\'resumenVisitasValidasInvalidas\']}).trigger(\'reloadGrid\');
                                $("#tblPrimeraUltimaVisita").setGridParam({datatype: \'jsonstring\', datastr: datosResult[\'resumenPrimeraUltima\']}).trigger(\'reloadGrid\');
                                $("#tblResumenVentas").setGridParam({datatype: \'jsonstring\', datastr: datosResult[\'resumenVentas\']}).trigger(\'reloadGrid\');
                                $("#tblResumenTiempos").setGridParam({datatype: \'jsonstring\', datastr: datosResult[\'resumenTiempos\']}).trigger(\'reloadGrid\');

                                $("#d_comentariosSupervision").val(datosResult[\'comentarioSupervisor\']);

                                $("#RptResumenDiarioHistorialForm_enlaceMapa").val(datosResult[\'enlaceMapa\']);
                                mostrarVisitasEnMapa2(datosResult[\'coordenadasClientes\'],datosResult[\'coordenadasVisitas\']);
                            }
                            else
                            {
                                $("#tblGridDetalle").jqGrid("clearGridData", true).trigger("reloadGrid");
                                $("#tblResumenGeneral").jqGrid("clearGridData", true).trigger("reloadGrid");
                                $("#tblResumenVisitas").jqGrid("clearGridData", true).trigger("reloadGrid");
                                $("#tblResumenVisitasValidasInvalidas").jqGrid("clearGridData", true).trigger("reloadGrid");
                                $("#tblPrimeraUltimaVisita").jqGrid("clearGridData", true).trigger("reloadGrid");
                                $("#tblResumenVentas").jqGrid("clearGridData", true).trigger("reloadGrid");
                                $("#tblResumenTiempos").jqGrid("clearGridData", true).trigger("reloadGrid");

                                $("#d_comentariosSupervision").val(\'\');
                                initMap2();
                            }
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
                                    , 'class' => 'btn btn-block btn-success'));
                                ?>
                                <?php
                                echo CHtml::Button(
                                        'Limpiar'
                                        , array('id' => 'btnLimpiar'
                                    , 'class' => 'btn btn-block btn-primary'));
                                ?>
                            </div>
                        </div>
                        <div class="box box-solid">
                            <div class="box-header with-border">
                                <h3 class="box-title">Fecha / Ejecutivo</h3>
                                <div class="box-tools">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="box-body no-padding">
                                <ul class="nav nav-pills nav-stacked">
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-calendar"></i>
                                            <?php echo $form->labelEx($model, 'fechagestion'); ?>
                                            <?php echo $form->textField($model, 'fechagestion', array('class' => 'txtfechagestion')) ?>
                                            <?php echo $form->error($model, 'fechagestion'); ?>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-user-circle"></i>
                                            <?php
                                            echo $form->labelEx($model, 'ejecutivo');
                                            $criteria = new CDbCriteria;
                                            $criteria->addCondition("e_estado = 1");
                                            $criteria->addCondition("e_tipo in ('EZ','D','ST','SC')");

                                            $ejecutivosZona = EjecutivoModel::model()->findAll($criteria);
                                            $listaEjecutivosZona = CHtml::listData($ejecutivosZona, 'e_usr_mobilvendor', 'e_nombre');
                                            echo $form->dropDownList(
                                                    $model, 'ejecutivo', $listaEjecutivosZona, array(
                                                'empty' => '(Seleccione un ejecutivo)',
                                                'options' => array(1 => array('e_usr_mobilvendor' => true),
                                                    'disabled' => true))
                                            );

                                            echo $form->error($model, 'ejecutivo');
                                            ?>
                                        </a>
                                    </li>
                                    <li><a href="#">
                                            <i class="fa  fa-clock-o"></i>
                                            <?php echo $form->labelEx($model, 'semanaRevision'); ?>
                                            <?php
                                            echo $form->dropDownList(
                                                    $model, 'semanaRevision'
                                                    , array(
                                                '1' => 'Semana 1',
                                                '2' => 'Semana 2',
                                                '3' => 'Semana 3',
                                                '4' => 'Semana 4'
                                                    )
//                                    , array('empty' => TEXT_OPCION_SELECCIONE, 'options' => array(0 => array('selected' => true)))
                                            );
                                            ?>
                                            <?php echo $form->error($model, 'semanaRevision'); ?>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="box box-solid collapsed-box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Inicio/Fin Gestion</h3>
                                <div class="box-tools">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="box-body no-padding" style="display: none;">
                                <ul class="nav nav-pills nav-stacked">
                                    <li><a href="#">
                                            <i class="fa  fa-clock-o"></i>
                                            <?php echo $form->labelEx($model, 'horaInicioGestion'); ?>

                                            <?php
                                            echo $form->dropDownList(
                                                    $model, 'horaInicioGestion', array(
                                                '08:00' => '08:00',
                                                '09:00' => '09:00',
                                                '10:00' => '10:00'
                                                    )
                                                    , array('options' => array('08:00' => array('selected' => true)))
                                            );
                                            echo $form->error($model, 'horaInicioGestion');
                                            ?>
                                        </a>
                                    </li>
                                    <li><a href="#">
                                            <i class="fa  fa-clock-o"></i>
                                            <?php
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
                                                    , array('options' => array('23:59' => array('selected' => true)))
                                            );

                                            echo $form->error($model, 'horaFinGestion');
                                            ?> 
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="box box-solid collapsed-box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Acciones</h3>
                                <div class="box-tools">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="box-body no-padding" style="display: none;">
                                <ul class="nav nav-pills nav-stacked">
                                    <li><a href="#">
                                            <i class="fa  fa-clock-o"></i>
                                            <?php echo $form->labelEx($model, 'precisionVisita'); ?>
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
                                        </a>
                                    </li>
                                    <li><a href="#">
                                            <i class="fa  fa-clock-o"></i>
                                            <?php echo $form->labelEx($model, 'accionHistorial'); ?>
                                            <?php
                                            echo $form->dropDownList(
                                                    $model, 'accionHistorial'
                                                    , array(
                                                'Inicio visita' => 'Inicio visita',
                                                'Orden' => 'Orden',
                                                'Forma' => 'Forma',
                                                'Comentario' => 'Comentario',
                                                'Día inicio' => 'Dia inicio',
                                                'Fin de visita' => 'Fin de visita',
                                                'Día fin' => 'Dia fin',
                                                'Nuevo cliente' => 'Nuevo cliente',
                                                'Estatus' => 'Estatus'
                                                    )
//                                    , array('empty' => TEXT_OPCION_SELECCIONE, 'options' => array(0 => array('selected' => true)))
                                            );
                                            ?>
                                            <?php echo $form->error($model, 'accionHistorial'); ?>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </div>
                        <?php $this->endWidget(); ?>
                    </div>

                    <div class="col-md-9">
                        <div class="box box-primary">
                            <div class="box-body no-padding">
                                <div class="table-responsive mailbox-messages">
                                    <div id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent">
                                        <table id="tblResumenGeneral" class="table table-condensed"></table>
                                    </div>
                                    <div  style="display: flex; justify-content: flex-start;">
                                        <div id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent">
                                            <table id="tblResumenVisitas" class="table table-condensed"></table>
                                        </div>
                                        <div style="margin-left: 10px" id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent">
                                            <table id="tblResumenVisitasValidasInvalidas" class="table table-condensed"></table>
                                        </div>
                                        <div style="margin-left: 10px" id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent">
                                            <table id="tblPrimeraUltimaVisita" class="table table-condensed"></table>
                                        </div>
                                    </div>
                                    <div  style="display: flex; justify-content: flex-start;">
                                        <div id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent">
                                            <table id="tblResumenVentas" class="table table-condensed"></table>                
                                        </div>
                                        <div id="grilla" class="_grilla panel panel-shadow" style="margin-left: 10px;background-color: transparent">
                                            <table id="tblResumenTiempos" class="table table-condensed"></table>                
                                        </div>
                                    </div>
                                    <!--<br/>-->
                                    <!--                    <div  style="display: flex; justify-content: flex-start;">
                                                            <div id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent">
                                                                <h1>Comentario del supervisor de zona:</h1>
                                                                <br/>
                                    <?php
//                                echo CHtml::textArea('d_comentarioSupervision', '', array(
//                                    'placeholder' => 'Ingrese un nuevo comentario'
//                                    , 'readonly' => false
//                                    , 'onblur' => 'setComentarioSupervisor(document.getElementById(\'d_comentarioSupervision\').value)'
//                                    , 'id' => 'd_comentarioSupervision', 'cols' => 50, 'rows' => 2, 'maxlength' => 200)
//                                );
                                    ?>  
                                                                <h1>Comentarios anteriores:</h1>
                                                                <br/>
                                    <?php
//                                echo CHtml::textArea('d_comentariosSupervision', '', array(
//                                    'placeholder' => 'Ingrese el comentario'
//                                    , 'readonly' => TRUE
//                                    , 'disabled' => TRUE
//                                    , 'id' => 'd_comentariosSupervision'
//                                    , 'cols' => 50
//                                    , 'rows' => 5
//                                    , 'maxlength' => 100)
//                                );
                                    ?>      
                                                            </div>
                                    
                                                        </div>-->
                                    <!--<br/>-->
                                    <div class="margin">
                                        <div class="btn-group">
                                            <?php
                                            echo CHtml::Button(
                                                    'Exportar Resumen'
                                                    , array('id' => 'btnExcelResumen'
                                                , 'class' => 'btn btn-warning btn-sm'));
                                            ?> 
                                        </div>
                                        <div class="btn-group">
                                            <?php
                                            echo CHtml::Button(
                                                    'Exportar Detalle'
                                                    , array('id' => 'btnExcelDetalle'
                                                , 'class' => 'btn btn-warning btn-sm'));
                                            ?> 
                                        </div>
                                        <div class="btn-group">
                                            <?php
                                            echo CHtml::Button(
                                                    'Exportar Clientes no visitados'
                                                    , array('id' => 'btnExcelNoVisitados'
                                                , 'class' => 'btn btn-warning btn-sm'));
                                            ?> 
                                        </div>
                                        <div class="btn-group">
                                            <?php
                                            echo CHtml::Button(
                                                    'Exportar Tiempos gestion'
                                                    , array('id' => 'btnExcelTiemposGestion'
                                                , 'class' => 'btn btn-warning btn-sm'));
                                            ?>
                                        </div>
                                        <div class="btn-group">
                                            <?php
                                            echo CHtml::Button(
                                                    'Exportar Estado visita x Ruta'
                                                    , array('id' => 'btnExcelEstadoRuta'
                                                , 'class' => 'btn btn-warning btn-sm'));
                                            ?>
                                        </div>
                                    </div>
                                    <div>
                                        <table id="tblGridDetalle" class="table table-condensed"></table>
                                        <div id="pagGrid"> </div>
                                    </div>
                                    <h1>Mapa</h1>
                                    <div  style="display: flex; justify-content: flex-start; border:1px solid green; width: 300px">
                                        <h3 style="margin-top: 5px">Leyenda :</h3>
                                        <div style="margin-top: 10px;margin-left: 30px; width:10px;height:10px;background-color: #dd4b4b; " id="grilla" class="_grilla panel panel-shadow"></div>
                                        <div style="margin-top: 10px;margin-left: 5px; background-color: transparent; " id="grilla" class="_grilla panel panel-shadow">CLIENTE</div>
                                        <div style="margin-top: 10px;margin-left: 50px; width:10px;height:10px;background-color: #0288d1; " id="grilla" class="_grilla panel panel-shadow"></div>
                                        <div style="margin-top: 10px;margin-left: 5px; background-color: transparent; " id="grilla" class="_grilla panel panel-shadow">VISITA</div>
                                    </div>
                                    <div id="map"></div>
                                    <?php // endif;                  ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane" id="tab_3">
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-2">
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

                        <div class="mailbox-controls">
                            <div class="btn-group">
                                <?php
                                echo CHtml::ajaxSubmitButton(
                                        'Evaluar periodo'
                                        , CHtml::normalizeUrl(array(
                                            'RptResumenDiarioHistorial/EvaluarPeriodo'
                                            , 'render' => true))
                                        , array(
                                    'dataType' => 'json',
                                    'type' => 'post',
                                    'beforeSend' => 'function() {blockUIOpen();}',
                                    'success' => 'function(data) {

                        blockUIClose();
                        //setMensaje(data.ClassMessage, data.Message);
                        if(data.Status==1){
                            var datosResult = data.Result;
                            
                            $("#tblCapilaridadMovistar").setGridParam({datatype: \'jsonstring\', datastr: datosResult[\'capilaridadMovistar\']}).trigger(\'reloadGrid\');
                            $("#tblCapilaridadDelta").setGridParam({datatype: \'jsonstring\', datastr: datosResult[\'capilaridadDelta\']}).trigger(\'reloadGrid\');
                            $("#tblSellInMovistar").setGridParam({datatype: \'jsonstring\', datastr: datosResult[\'sellInMovistar\']}).trigger(\'reloadGrid\');
                            $("#tblSellInVentas").setGridParam({datatype: \'jsonstring\', datastr: datosResult[\'sellInDelta\']}).trigger(\'reloadGrid\');
                            jQuery("#tblCapilaridadMovistar").jqGrid(\'setCaption\', "Capilaridad Movistar - * Clientes gestionados por " + datosResult[\'duplicado\']+" ejecutivos").trigger(\'reloadGrid\');                            
                            jQuery("#tblCapilaridadDelta").jqGrid(\'setCaption\', "Capilaridad Indicadores - * Clientes gestionados por " + datosResult[\'duplicadoDelta\']+" ejecutivos").trigger(\'reloadGrid\');                            
                                
                            jQuery("#tblVentaPeriodo").jqGrid(\'jqPivot\', datosResult[\'ventasmensual\'], 
                            // pivot options 
                            { 
                                xDimension : 
                                    [ 
                                        { 
                                            dataName: \'BODEGA\'
                                            //, width:180 
                                            , fixed: true
                                        },
                                    ], 
                                yDimension : 
                                    [ 
                                        { dataName: \'FECHA_VENTA_MOVISTAR\' } 
                                    ], 
                                aggregates : 
                                    [ 
                                        {   member : \'CANTIDAD_MINES\', 
                                            aggregator : \'sum\', 
                                            width:180, label:\'Sum\', 
                                            formatter:\'integer\', 
                                            align:\'right\', 
                                            summaryType: \'sum\' 
                                        } 
                                    ], 
                                groupSummaryPos : \'footer\',
                                rowTotals: true, 
                                colTotals: true,
                                frozenStaticCols : true,
                            }, 
                            // grid options 
                            { 
                                width: 1000,
                                shrinkToFit: true,
                                height: 300,
                                rowNum : 20, 
                                pager: "#pagtblVentaPeriodo", 
                                hidegrid: false,
                                caption: "Ventas diarias Movistar",
                            }
                            
                            );
                            $("#tblVentaPeriodo").jqGrid(\'navGrid\',\'#pagtblVentaPeriodo\',{add:false, edit:false, del:false, search:true});
                            jQuery("#tblVentaPeriodo").jqGrid(\'navButtonAdd\', \'#pagtblVentaPeriodo\',
                            {
                                caption: "Exportar",
                                title: "Exportar Reporte",
                                onClickButton: function () {
                                   var options = {
                                        includeLabels: true,
                                        includeGroupHeader: true,
                                        includeFooter: true,
                                        fileName: "VentasDiariasMovistar.xlsx",
                                        mimetype: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
                                        maxlength: 40,
                                        onBeforeExport: null,
                                        replaceStr: null
                                    }
                                    $("#tblVentaPeriodo").jqGrid(\'exportToExcel\', options);
                                }});

                            
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
                                        ), array(
                                    'id' => 'btnGenerarCapilaridad'
                                    , 'class' => 'btn btn-block btn-success btn-sm'
                                ));
                                ?>
                                <?php
                                echo CHtml::Button(
                                        'Limpiar', array('id' => 'btnLimpiarCapilaridadSellIn'
                                    , 'class' => 'btn btn-block btn-primary btn-sm'));
                                ?>
                            </div>
                        </div>
                        <div class="box box-solid">
                            <div class="box-header with-border">
                                <h3 class="box-title">Fecha</h3>
                                <div class="box-tools">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="box-body no-padding">
                                <ul class="nav nav-pills nav-stacked">
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-calendar"></i>
                                            <?php
                                            echo $form->labelEx($model, 'anioFiltro');
                                            ?><br>
                                            <?php
                                            echo $form->dropDownList(
                                                    $model, 'anioFiltro', array(
                                                '0' => 'Seleccione',
                                                '2016' => '2016',
                                                '2017' => '2017',
                                                '2018' => '2018'
                                                    )
                                                    , array(
                                                'options' => array('0' => array('selected' => true)),
                                                'onchange' => 'js:cargarPeriodosPorAnio(this.value,\'divp\')'
                                                    )
                                            );

                                            echo $form->error($model, 'anioFiltro');
                                            ?>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-calendar"></i>
                                            <?php
                                            echo $form->labelEx($model, 'periodoFiltro');
                                            ?><br>
                                            <div id="divp"></div>
                                            <?php
                                            echo $form->error($model, 'periodoFiltro');
                                            ?>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <?php $this->endWidget(); ?>

                    </div>
                    <div class="col-sm-10">
                        <div class="box box-primary">
                            <div class="box-body no-padding">
                                <div  style="display: flex; justify-content: flex-start;">
                                    <div id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent">
                                        <table id="tblCapilaridadMovistar" class="table table-condensed"></table>
                                        <div id="pagCapilaridadMovistar"> </div>
                                    </div>
                                    <div style="margin-left: 10px" id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent">
                                        <table id="tblCapilaridadDelta" class="table table-condensed"></table>
                                        <div id="pagCapilaridadDelta"> </div>
                                    </div>
                                </div>
                                <div  style="display: flex; justify-content: flex-start;">
                                    <div id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent">
                                        <table id="tblSellInMovistar" class="table table-condensed"></table>
                                        <div id="pagSellInMovistar"> </div>
                                    </div>
                                    <div style="margin-left: 10px" id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent">
                                        <table id="tblSellInVentas" class="table table-condensed"></table>
                                        <div id="pagSellInVentas"> </div>
                                    </div>
                                </div>
                                <div  style="display: flex; justify-content: flex-start;">
                                    <div id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent">
                                        <div id="gridPivotVentasPeriodo">
                                            <table id="tblVentaPeriodo" class="table table-condensed"></table>
                                            <div id="pagtblVentaPeriodo"> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane" id="tab_4">
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-2">
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

                        <div class="mailbox-controls">
                            <div class="btn-group">
                                <?php
                                echo CHtml::ajaxSubmitButton(
                                        'Evaluar Altas Periodo'
                                        , CHtml::normalizeUrl(array(
                                            'RptResumenDiarioHistorial/EvaluarAltasPeriodo'
                                            , 'render' => true))
                                        , array(
                                    'dataType' => 'json',
                                    'type' => 'post',
                                    'beforeSend' => 'function() {blockUIOpen();}',
                                    'success' => 'function(data) {

                        blockUIClose();
                        //setMensaje(data.ClassMessage, data.Message);
                        if(data.Status==1){
                            var datosResult = data.Result;
                            $("#tblAltasCiudadDetalle").setGridParam({datatype: \'jsonstring\', datastr: datosResult[\'detalleAltasVentasTransferencias\']}).trigger(\'reloadGrid\');
                            $("#tblAltasSinVenta").setGridParam({datatype: \'jsonstring\', datastr: datosResult[\'altasSinVenta\']}).trigger(\'reloadGrid\');
                            $("#tblAltasDiaProyeccion").setGridParam({datatype: \'jsonstring\', datastr: datosResult[\'altasDiarias\']}).trigger(\'reloadGrid\');
                            GeneralPivotCiudad(datosResult);                            
//                            GeneralPivotCiudadEjecutivo(datosResult);                            
                            
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
                                        ), array(
                                    'id' => 'btnEvaluarAltasPeriodo'
                                    , 'class' => 'btn btn-block btn-success btn-sm'
                                ));
                                ?>
                                <?php
                                echo CHtml::Button(
                                        'Limpiar', array('id' => 'btnLimpiarAltas'
                                    , 'class' => 'btn btn-block btn-primary btn-sm'));
                                ?>
                            </div>
                        </div>
                        <div class="box box-solid">
                            <div class="box-header with-border">
                                <h3 class="box-title">Fecha</h3>
                                <div class="box-tools">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="box-body no-padding">
                                <ul class="nav nav-pills nav-stacked">
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-calendar"></i>
                                            <?php
                                            echo $form->labelEx($model, 'anioFiltro');
                                            ?><br>
                                            <?php
                                            echo $form->dropDownList(
                                                    $model, 'anioFiltro', array(
                                                '0' => 'Seleccione',
                                                '2016' => '2016',
                                                '2017' => '2017',
                                                '2018' => '2018'
                                                    )
                                                    , array(
                                                'options' => array('0' => array('selected' => true)),
                                                'onchange' => 'js:cargarPeriodosPorAnio(this.value,\'diva\')'
                                                    )
                                            );

                                            echo $form->error($model, 'anioFiltro');
                                            ?>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-calendar"></i>
                                            <?php
                                            echo $form->labelEx($model, 'periodoFiltro');
                                            ?><br>
                                            <div id="diva"></div>
                                            <?php
                                            echo $form->error($model, 'periodoFiltro');
                                            ?>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <?php $this->endWidget(); ?>

                    </div>
                    <div class="col-sm-10">
                        <div class="box box-primary">
                            <div  style="display: flex; justify-content: flex-start;">
                                <div id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent">
                                    <div id="gridPivotAltasCiudad">
                                        <table id="tblAltasCiudad" class="table table-condensed"></table>
                                        <div id="pagtblAltasCiudad"> </div>
                                    </div>
                                </div>
                                <div style="margin-left: 10px" id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent">
                                    <table id="tblAltasDiaProyeccion" class="table table-condensed"></table>
                                    <div id="pagtblAltasDiaProyeccion"> </div>
                                </div>

                            </div>
                            <br/>
                            <div  style="display: flex; justify-content: flex-start;">
                                <table id="tblAltasCiudadDetalle" class="table table-condensed"></table>
                                <div id="pagtblAltasCiudadDetalle"> </div>
                            </div>
                            <br/>
                            <div class="box-body no-padding">
                                <table id="tblAltasSinVenta" class="table table-condensed"></table>
                                <div id="pagtblAltasSinVenta"> </div>
                            </div>
                            <br/>
                            <!--                            <div  style="display: flex; justify-content: flex-start;">
                                                            <div id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent">
                                                                <div id="gridPivotAltasCiudadEjecutivo">
                                                                    <table id="tblAltasCiudadEjecutivo" class="table table-condensed"></table>
                                                                    <div id="pagtblAltasCiudadEjecutivo"> </div>
                                                                </div>
                                                            </div>
                                                        </div>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane" id="tab_5">
            <div class="box-body">
                <!--                <div class="row">
                                    <div class="col-md-3">
                <?php
                //                        echo CHtml::submitButton(
                //                                'Buscar Periodos', array(
                //                            'id' => 'btnBuscarPeriodos'
                //                            , 'class' => 'btn btn-block btn-primary btn-sm'
                //                        ));
                ?>      
                                    </div>
                                </div>-->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="box box-primary">
                            <div  style="display: flex; justify-content: flex-start;">
                                <div id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent">
                                    <table id="tblPeriodos" class="table table-condensed"></table>
                                </div>
                                <div id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent; margin-left: 10px">
                                    <table id="tblAltasFZPorTipoBodega" class="table table-condensed"></table>
                                    <div id="pagtblAltasFZPorTipoBodega"> </div>
                                </div>
                                <div style="margin-left: 10px" id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent">
                                    <table id="tblAltasFZPorBodega" class="table table-condensed"></table>
                                    <div id="pagtblAltasFZPorBodega"> </div>
                                </div>
                            </div>
                            <br/>
                            <div class="box-body no-padding">
                                <div id="gridPivotDetalleAltasFZPorBodega">
                                    <table id="tblDetalleAltasFZPorBodega" class="table table-condensed"></table>
                                    <div id="pagtblDetalleAltasFZPorBodega"> </div>
                                </div>
                            </div>
                            <div class="box-body no-padding">
                                <?php
//                                    echo CHtml::Button(
//                                            'Enviar Mail', array('id' => 'btnEnviarMail'
//                                        , 'class' => 'btn btn-block btn-success btn-sm'
//                                        , 'disabled' => 'disabled'));
                                if (PRUEBA_MAIL) {
                                    echo CHtml::Button(
                                            ' Comprobar Enviar Mail', array('id' => 'btnEstadoEnviarMail'
                                        , 'class' => 'btn btn-block btn-info btn-sm'
                                        , 'disabled' => 'disabled'));
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    function setComentarioSupervisor($comentario) {
        //        alert($valor);
        $("#RptResumenDiarioHistorialForm_comentarioSupervision").val($comentario);
    }
    function setEnlaceMapa($enlace) {
        //        alert($valor);
        $("#RptResumenDiarioHistorialForm_enlaceMapa").val($enlace);
    }
    function openMapsWindow() {
        var url = $("#d_enlaceMapa").val();
        //        alert(url)
        if (url.length > 0)
            var win = window.open(url, '_blank');
        else
            alert('No existe un enlace de mapas para abrir')
    }

    var estiloMapa = [
        {
            featureType: 'water',
            stylers: [
                {color: '#19a0d8'}
            ]
        }, {
            featureType: 'administrative',
            elementType: 'labels.text.stroke',
            stylers: [
                {color: '#ffffff'},
                {weight: 6}
            ]
        }, {
            featureType: 'administrative',
            elementType: 'labels.text.fill',
            stylers: [
                {color: '#e85113'}
            ]
        }, {
            featureType: 'road.highway',
            elementType: 'geometry.stroke',
            stylers: [
                {color: '#efe9e4'},
                {lightness: -40}
            ]
        }, {
            featureType: 'transit.station',
            stylers: [
                {weight: 9},
                {hue: '#e85113'}
            ]
        }, {
            featureType: 'road.highway',
            elementType: 'labels.icon',
            stylers: [
                {visibility: 'off'}
            ]
        }, {
            featureType: 'water',
            elementType: 'labels.text.stroke',
            stylers: [
                {lightness: 100}
            ]
        }, {
            featureType: 'water',
            elementType: 'labels.text.fill',
            stylers: [
                {lightness: -100}
            ]
        }, {
            featureType: 'poi',
            elementType: 'geometry',
            stylers: [
                {visibility: 'on'},
                {color: '#f0e4d3'}
            ]
        }, {
            featureType: 'road.highway',
            elementType: 'geometry.fill',
            stylers: [
                {color: '#efe9e4'},
                {lightness: -25}
            ]
        }
    ];
    function initMap2() {

        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 15,
            styles: estiloMapa,
            mapTypeControl: false,
            center: {lat: -0.205226, lng: -78.495739}
        });
        //        mapa.controls[google.maps.ControlPosition.RIGHT_TOP].pop(legend);

    }

    function mostrarVisitasEnMapa2(coordsClientes, coordsVisitas) {
        //        alert(coordsClientes);
        //        alert(coordsVisitas);
        var opcionesMapa = {
            zoom: 14,
            styles: estiloMapa,
            center: {lat: parseFloat(coordsVisitas[0].LATITUD), lng: parseFloat(coordsVisitas[0].LONGITUD)},
        }
        ;
        var mapa = new google.maps.Map(document.getElementById('map'), opcionesMapa);

        for (var iterador in coordsClientes) {
            //                        alert(coordsClientes[iterador].LATITUD);
            var marcadorCliente = new google.maps.Marker({
                position: {lat: parseFloat(coordsClientes[iterador].LATITUD), lng: parseFloat(coordsClientes[iterador].LONGITUD)},
                map: mapa,
                title: coordsClientes[iterador].LABEL,
                label: coordsClientes[iterador].LABEL,
                icon: pinSymbol('#dd4b4b')
            });
            //            alert(coordsVisitas[iterador].LATITUD);
            var marcadorVisitas = new google.maps.Marker({

                position: {lat: parseFloat(coordsVisitas[iterador].LATITUD), lng: parseFloat(coordsVisitas[iterador].LONGITUD)},
                map: mapa,
                title: coordsVisitas[iterador].LABEL,
                label: coordsVisitas[iterador].LABEL,
                icon: pinSymbol('#0288d1')
            });
        }
    }

    function pinSymbol(color) {
        return {
            path: 'M 0,0 C -2,-20 -10,-22 -10,-30 A 10,10 0 1,1 10,-30 C 10,-22 2,-20 0,0 z',
            fillColor: color,
            fillOpacity: 1,
            strokeColor: '#ffffff',
            strokeWeight: 2,
            scale: 1
        };
    }



</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAuuHti_DAalAmyJGqZNBv71AcUBBmzcI0&callback=initMap2"></script>