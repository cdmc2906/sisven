<?php
$pagina_nombre = 'Cierre Periodo';
$this->breadcrumbs = array($pagina_nombre);
//$this->breadcrumbs = array($pagina_nombre => array('CierrePeriodo'));
$this->renderPartial('/shared/_blockUI');
$this->renderPartial('/shared/_headgrid', array('metodo' => '"VerDatosArchivo"'));
$this->pageTitle = $pagina_nombre;
?>

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl . "/js/proceso/CierrePeriodo.js"; ?>"></script>

<?php if (Yii::app()->user->hasFlash('resultadoGuardarRevisionOK')): ?>
    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('resultadoGuardarRevisionOK'); ?>
    </div>
<?php else: ?>
    <div class=""></div>
<?php endif; ?>
<?php if (Yii::app()->user->hasFlash('resultadoGuardarRevisionAviso')): ?>
    <div class="flash-notice">
        <?php echo Yii::app()->user->getFlash('resultadoGuardarRevisionAviso'); ?>
    </div>
<?php else: ?>
    <div class=""></div>
<?php endif; ?>

<?php if (Yii::app()->user->hasFlash('resultadoGuardar')): ?>
    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('resultadoGuardar'); ?>
    </div>
<?php else: ?>
    <div class=""></div>
<?php endif; ?>

<?php
unset(Yii::app()->session['idPeriodoAbierto']);
unset(Yii::app()->session['fechaInicioPeriodo']);
unset(Yii::app()->session['fechaFinPeriodo']);

unset(Yii::app()->session['itemsFueraPeriodo']);

$command1 = Yii::app()->db->createCommand('
            SELECT 
                pg_id as idperiodo,
                pg_fecha_inicio as fechainicio,
                pg_fecha_fin as fechafin,
                pg_descripcion as descripcion
            FROM tcc_control_ruta.tb_periodo_gestion
            WHERE 
            pg_estado=1
            and pg_tipo=\'SEMANAL\';');
$resultado1 = $command1->queryRow();
//                var_dump($resultado1);die();
if ($resultado1) {

    $periodoAbierto = $resultado1['descripcion'];

    Yii::app()->session['idPeriodoAbierto'] = $resultado1['idperiodo'];
    Yii::app()->session['fechaInicioPeriodo'] = $resultado1['fechainicio'];
    Yii::app()->session['fechaFinPeriodo'] = $resultado1['fechafin'];
}
//echo $periodoAbierto;
?>
<?php if ($resultado1): ?>

    <div class="callout callout-info">
        <center>
            <p>Periodo semanal abierto : <b><?php echo $periodoAbierto; ?>
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

<div class="row">
    <div class="col-md-12">
        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Periodos gestionados</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="box-group" id="accordion">
                    <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->

                    <div class="panel box box-primary">
                        <div class="box-header with-border">
                            <h4 class="box-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                    Periodos anteriores
                                </a>
                            </h4>
                        </div>

                        <div id="collapseOne" class="panel-collapse collapse in">
                            <div class="box-body">
                                <div class="col-md-6">
                                    <table id="tblPeriodos" class="table table-condensed"></table>
                                    <div id="pagtblPeriodos"> </div>    
                                </div>
                                <div class="col-md-4">
                                    <table id="tblGestionesPeriodo" class="table table-condensed"></table>
                                    <div id="pagtblGestionesPeriodo"> </div> 
                                </div>
                                <div class="col-md-2">
                                    <?php
                                    echo CHtml::submitButton(
                                            'Buscar Periodos', array(
                                        'id' => 'btnBuscarPeriodos'
                                        , 'class' => 'btn btn-block btn-primary btn-sm'
                                    ));
                                    ?>      
                                    <?php
                                    echo CHtml::Button(
                                            'Reversar cierre'
                                            , array('id' => 'btnReversarCierre'
                                        , 'class' => 'btn btn-block btn-warning btn-sm'
                                        , 'disabled' => 'disabled'));
                                    ?>
                                    <?php
                                    echo CHtml::Button(
                                            'Exportar resumen'
                                            , array('id' => 'btnExportarResumen'
                                        , 'class' => 'btn btn-block btn-success btn-sm'
                                        , 'disabled' => 'disabled'));
                                    ?>
                                    <!--<table id="tblGestionesPeriodo" class="table table-condensed"></table>-->
                                    <!--<div id="pagtblGestionesPeriodo"> </div>--> 
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel box box-danger">
                        <div class="box-header with-border">
                            <h4 class="box-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                    Cierre periodo 
                                </a>
                            </h4>
                        </div>
                        <div id="collapseThree" class="panel-collapse collapse">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <?php
                                        $form = $this->beginWidget('CActiveForm', array(
                                            'id' => 'frmLoad',
                                            'enableAjaxValidation' => false,
                                            'enableClientValidation' => true,
                                        ));
                                        ?>

                                        <div class="mailbox-controls">
                                            <div class="btn-group">
                                                <?php
                                                echo CHtml::ajaxSubmitButton(
                                                        'Cerrar Periodo Abierto', CHtml
                                                        ::normalizeUrl(array('CierrePeriodo/CerrarPeriodoSemanal', 'render' => true)), array(
                                                    'dataType' => 'json',
                                                    'type' => 'post',
                                                    'beforeSend' => 'function() {blockUIOpen();}',
                                                    'success' => 'function(data) {
                                                        blockUIClose();
                                                    setMensaje(data.ClassMessage, data.Message);
                                                    if(data.Status==1){
                                                         var datosResult = data.Result;
                                                        $("#tblPeriodos").jqGrid("clearGridData", true).trigger("reloadGrid");
                                                        $("#tblGestionesPeriodo").jqGrid("clearGridData", true).trigger("reloadGrid");
//                                                        sleep(10000);
                                                            alert(\'Proceso concluido correctamente, Continuar?\');
                                                        location.reload();
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
                                                    , 'class' => 'btn btn-block btn-danger btn-sm'));
                                                ?>
                                                <?php
                                                echo CHtml::Button(
                                                        'Limpiar'
                                                        , array('id' => 'btnLimpiar'
                                                    , 'class' => 'btn btn-block btn-primary btn-sm'));
                                                ?>
                                                <?php
//                                                echo CHtml::Button(
//                                                        'Exportar a Excel'
//                                                        , array('id' => 'btnExcel'
//                                                    , 'class' => 'btn btn-block btn-warning btn-sm', 'disabled' => 'true'));
//                                                
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="box box-solid">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">Fecha Inicio / Fin</h3>
                                                <div class="box-tools">
                                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="box-body no-padding">
                                                <ul class="nav nav-pills nav-stacked">
                                                    <!--                    <li>
                                                                            <a href="#">
                                                                                <i class="fa fa-calendar"></i>
                                                    <?php // echo $form->labelEx($model, 'periodoGestion'); ?>
                                                    <?php
                                                    //LISTAR Tipos de Peridos Activos
//                            $periodosAbiertos = PeriodoGestionModel::model()->findAllByAttributes(array('pg_estado' => '1','pg_tipo' => 'SEMANAL'));
//                            $listaPeriodosAbiertos = CHtml::listData($periodosAbiertos, 'pg_id', 'pg_descripcion');
//                            echo $form->dropDownList(
//                                    $model, 'periodoGestion', $listaPeriodosAbiertos, array(
//                                'empty' => '(Seleccione un periodo)',
//                                'options' => array(1 => array('selected' => true),
//                                    'disabled' => true))
//                            );
                                                    ?>
                                                    <?php // echo $form->error($model, 'periodoGestion');  ?>
                                                    
                                                                            </a>
                                                                        </li>-->
                                                    <!--                    <li>
                                                                            <a href="#">
                                                                                <i class="fa fa-calendar"></i>
                                                    <?php // echo $form->labelEx($model, 'fechaFinGestion'); ?>
                                                    <?php // echo $form->textField($model, 'fechaFinGestion', array('class' => 'txtFechaFinGestion'));  ?>
                                                    <?php // echo $form->error($model, 'fechaFinGestion');   ?>
                                                    
                                                                            </a>
                                                                        </li>-->
                                                    <li>
                                                        <a href="#">
                                                            <i class="fa fa-calendar"></i>
                                                            <?php echo $form->labelEx($model, 'ejecutivo'); ?>
                                                            <?php
                                                            echo $form->dropDownList(
                                                                    $model, 'ejecutivo', array(
                                                                'A' => 'TODOS',
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
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
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
                                    </div>
                                    <div class="col-md-3">
                                        <div class="box box-solid ">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">Horario Gestion</h3>
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
                                                            echo $form->labelEx($model, 'horaInicioGestion');
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
                                                            );

                                                            echo $form->error($model, 'horaFinGestion');
                                                            ?>
                                                        </a>
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="box box-solid">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">Acciones Historial</h3>
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
                                                    <li>
                                                        <a href="#">
                                                            <i class="fa fa-calendar"></i>
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
                                                            <?php $this->endWidget(); ?>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>    
</div>
<!-- /.row -->
<!-- END ACCORDION & CAROUSEL-->


