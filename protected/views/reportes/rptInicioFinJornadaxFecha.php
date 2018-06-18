<?php
$pagina_nombre = 'Revision de jornada';
$this->breadcrumbs = array($pagina_nombre => array('index'));
$this->renderPartial('/shared/_blockUI');
$this->renderPartial('/shared/_headgrid', array('metodo' => '"VerDatosArchivo"'));
$this->pageTitle = $pagina_nombre;
?>

<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/datepicker.css" />
<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/datepicker3.css" />

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/bootstrap-datepicker.es.js"></script>

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl . "/js/reporte/RptInicioFinJornadaxFecha.js"; ?>"></script>

<style> 
    /*PERMITE QUE EL CONTENIDO DE LAS CELDAS HAGAN WRAPPING --COMENTARIOS*/
    .ui-jqgrid tr.jqgrow td {
        white-space: normal !important;
        height:auto;
        vertical-align:text-top;
        padding-top:2px;
    }
</style>


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

        <div class="mailbox-controls">
            <div class="btn-group">
                <?php
                echo CHtml::ajaxSubmitButton(
                        'Consultar'
                        , CHtml::normalizeUrl(array(
                            'RptInicioFinJornadaxFecha/ConsultarReporte'
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
                            
                            //alert(datosResult.toSource());
                            // $("#tblGrid").setGridParam({datatype: \'jsonstring\', datastr: datosResult}).trigger(\'reloadGrid\');
                            $("#tblGrid").setGridParam({datatype: \'jsonstring\', datastr: datosResult[\'infoJornada\']}).trigger(\'reloadGrid\');
                            $("#tblGridDetalle").setGridParam({datatype: \'jsonstring\', datastr: datosResult[\'infoVisitas\']}).trigger(\'reloadGrid\');
                            
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
                ));
                ?>
                <?php
                echo CHtml::Button(
                        'Limpiar', array('id' => 'btnLimpiar'
                    , 'class' => 'btn btn-block btn-primary btn-sm'));
                ?>

                <?php
                echo CHtml::Button(
                        'Exportar a Excel', array('id' => 'btnExcel'
                    , 'class' => 'btn btn-block btn-warning btn-sm'));
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
                            <?php echo $form->labelEx($model, 'fechaInicioFinJornadaInicio'); ?>
                            <?php echo $form->textField($model, 'fechaInicioFinJornadaInicio', array('class' => 'txtfechaInicioFinJornadaInicio')); ?>
                            <?php echo $form->error($model, 'fechaInicioFinJornadaInicio'); ?>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-calendar"></i>
                            <?php
                            echo $form->labelEx($model, 'tipoUsuario');
                            echo $form->dropDownList(
                                    $model, 'tipoUsuario', array(
                                'T' => 'Todos',
                                GRUPO_EJECUTIVOS_ZONA => 'Ejecutivos Zona',
                                GRUPO_SUPERVISORES => 'Supervisores',
                                GRUPO_SERVICIO_CLIENTE => 'Servicio Cliente',
                                GRUPO_DESARROLLADORES => 'Desarrolladores',
                                    )
//                                        , array(
//                                    'empty' => TEXT_OPCION_SELECCIONE, 'options' => array(0 => array('selected' => true)))
                            );
                            echo $form->error($model, 'tipoUsuario');
                            ?>
                        </a>
                    </li>

                    <li>
                        <a href="#">
                            <i class="fa fa-calendar"></i>
                            <?php
                            echo $form->labelEx($model, 'horaInicioGestion');
                            echo $form->dropDownList(
                                    $model, 'horaInicioGestion', array(
                                '06:00' => '06:00',
                                '07:00' => '07:00',
                                '08:00' => '08:00',
                                '09:00' => '09:00',
                                '10:00' => '10:00',
                                '11:00' => '11:00',
                                '12:00' => '12:00'
                                    )
                                    , array('options' => array('08:00' => array('selected' => true)))
                                    //, array("disabled" => "disabled",)
                            );

                            echo $form->error($model, 'horaInicioGestion');
                            ?>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-calendar"></i>
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
                                    , array('options' => array('19:00' => array('selected' => true)))
                            );

                            echo $form->error($model, 'horaFinGestion');
                            ?>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <?php $this->endWidget(); ?>

    </div>


    <!--<div id="grilla" class="_grilla">-->
    <div class="col-md-9">
        <div class="box box-primary">
            <div class="box-body no-padding">
                <div id="grilla" class="_grilla">
                    <!--<div id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent">-->
                    <table id="tblGrid" class="table table-condensed"></table>
                    <div id="pagGrid"> </div>
                </div>
                <!--                <div class="table-responsive mailbox-messages">
                                    <div id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent">
                                        <table id="tblGridDetalle" class="table table-condensed"></table>
                                        <div id="pagGridDetalle"> </div>
                                    </div>
                                </div>-->
            </div>
        </div>
    </div>
