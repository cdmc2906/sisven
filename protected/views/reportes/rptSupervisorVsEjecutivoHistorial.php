<?php
$pagina_nombre = 'Comparacion Supervisor Vs Ejecutivo';
$this->breadcrumbs = array($pagina_nombre => array('index'));
$this->renderPartial('/shared/_blockUI');
$this->renderPartial('/shared/_headgrid', array('metodo' => '"VerDatosArchivo"'));
$this->pageTitle = $pagina_nombre;
?>

<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/datepicker.css" />
<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/datepicker3.css" />

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/bootstrap-datepicker.es.js"></script>

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl . "/js/reporte/RptSupervisorVsEjecutivoHistorial.js"; ?>"></script>

<?php if (Yii::app()->user->hasFlash('resultadoGuardar')): ?>
    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('resultadoGuardar'); ?>
    </div>
<?php else: ?>
    <div class=""></div>
<?php endif; ?>

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
                        'Revisar historial', CHtml
                        ::normalizeUrl(array('RptSupervisorVsEjecutivoHistorial/revisarhistorial', 'render' => true)), array(
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
                            $("#tblGridSupervisores").setGridParam({datatype: \'jsonstring\', datastr: datosResult}).trigger(\'reloadGrid\');
                            $("#tblGridSupervisores").val(datosResult);
                            $("#RptResumenDiarioHistorialForm_enlaceMapa").val(datosResult[\'enlaceMapa\']);
                            $("#d_enlaceMapa").val(datosResult[\'enlaceMapa\']);

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
                        }'), array('id' => 'btnGenerate', 'class' => 'btn btn-block btn-success btn-sm'));
                ?>
                <?php echo CHtml::Button('Limpiar', array('id' => 'btnLimpiar', 'class' => 'btn btn-block btn-primary btn-sm')); ?>
                <?php // echo CHtml::Button('Exportar Resumen', array('id' => 'btnExcelResumen', 'class' => 'btn btn-theme')); ?>
                <?php echo CHtml::Button('Exportar Detalle Supervisor', array('id' => 'btnRepDetalleSupervisor', 'class' => 'btn btn-block btn-warning btn-sm', 'disabled' => 'true')); ?>
                <?php echo CHtml::Button('Exportar Detalle Ruta', array('id' => 'btnExcel', 'class' => 'btn btn-block btn-warning btn-sm', 'disabled' => 'true')); ?>
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
                            <?php
                            echo $form->labelEx($model, 'horaInicioGestion');
                            echo $form->dropDownList(
                                    $model, 'horaInicioGestion', array(
                                '08:00' => '08:00',
                                '09:00' => '09:00',
                                '10:00' => '10:00'
                                    )
                                    , array('options' => array('10:00' => array('selected' => true)))
                                    //, array("disabled" => "disabled",)
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
//                                , array('empty' => TEXT_OPCION_SELECCIONE, 'options' => array(0 => array('selected' => true)))
                            );
                            ?>
                            <?php echo $form->error($model, 'accionHistorial'); ?>
                        </a>
                    </li>
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
                </ul>
            </div>
        </div>
        <?php $this->endWidget(); ?>
    </div>
    <div class="col-md-9">
        <div class="box box-primary">
            <div class="box-body no-padding">
                <div class="table-responsive mailbox-messages">
                    <div style="align-content:center; align-items: center">
                        <div style="display: flex; justify-content: flex-start;" >
                            <div id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent">
                                <table id="tblGridSupervisores" class="table table-condensed"></table>
                            </div>
                            <div style="margin-left: 5px" id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent">
                                <table id="tblGridRutas" class="table table-condensed"></table>
                            </div>
                        </div>
                    </div>
                    <table style="border: 1px solid black; width:100%">
                        <tr style="border: 1px solid black;">
                            <td style="border: 1px solid black; text-align:center; vertical-align:middle;"><strong>DATOS SUPERVISOR</strong></td>
                            <td style="border: 1px solid black; text-align:center; vertical-align:middle;"><strong>DATOS EJECUTIVO</strong></td>
                        </tr>
                        <tr style="border: 1px solid black;">
                            <td style="border: 1px solid black;">
                                <div  style="margin-left: 5px;display: flex; justify-content: flex-start;">
                                    <div id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent">
                                        <table id="tblCumplimientoSupervisor" class="table table-condensed"></table>
                                    </div>
                                    <div style="margin-left: 5px" id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent">
                                        <table id="tblResumenVisitasValidasInvalidasSupervisor" class="table table-condensed"></table>
                                    </div>
                                </div>
                            </td>
                            <td style="border: 1px solid black;">
                                <div  style="display: flex; justify-content: flex-end">
                                    <div id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent">
                                        <table id="tblResumenVisitasValidasInvalidasEjecutivo" class="table table-condensed"></table>
                                    </div>
                                    <div style="margin-left: 5px" id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent">
                                        <table id="tblCumplimientoEjecutivo" class="table table-condensed"></table>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr style="border: 1px solid black;">
                            <td style="border: 1px solid black;" >
                                <div  style="display: flex; justify-content: flex-start;">
                                    <div id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent">
                                        <table id="tblVisitasSupervisor" class="table table-condensed"></table>                
                                    </div>
                                </div>
                            </td>
                            <td style="border: 1px solid black;">
                                <div  style="display: flex; justify-content: flex-end;">
                                    <div id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent">
                                        <table id="tblVisitasEjecutivo" class="table table-condensed"></table>                
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                    <br/>

                    <div id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent">
                        <table id="tblGridDetalle" class="table table-condensed"></table>
                        <div id="pagGrid"> </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



